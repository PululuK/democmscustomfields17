<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once __DIR__.'/vendor/autoload.php';

use \PrestaShop\PrestaShop\Core\Module\Exception\ModuleErrorException;
use PrestaShop\Module\Democmscustomfields17\Form\Cms\CustomFieldsForm as CmsCustomFieldsForm;
use Symfony\Component\Form\FormBuilderInterface;
use PrestaShop\Module\Democmscustomfields17\Form\Cms\FormDataHandler;
use PrestaShop\Module\Democmscustomfields17\Model\CmsCustomFields;

class Democmscustomfields17 extends Module
{
    protected $cmsCustomFieldsHandler;

    public function __construct()
    {
        $this->name = 'democmscustomfields17';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'PululuK';

        parent::__construct();

        $this->displayName = $this->l('Demo cms custom field PS 17 ');
        $this->description = $this->l('Demo cms custom field PS 17 ');
        $this->confirmUninstall = $this->l('Are you sure you want to uninstall my module?');
        $this->ps_versions_compliancy = ['min' => '1.7', 'max' => _PS_VERSION_];

        $this->cmsCustomFieldsHandler = new FormDataHandler();
    }

    public function isUsingNewTranslationSystem()
    {
        return true;
    }

    protected function getHooks()
    {
        return [
            'actionCMSPageFormBuilderModifier',
            'actionAfterCreateCMSPageFormHandler',
            'actionAfterUpdateCMSPageFormHandler',
            'filterCmsContent',
            'actionObjectCmsDeleteAfter',
        ];
    }

    public function install()
    {
        include(dirname(__FILE__).'/sql/install.php');

        return parent::install() && $this->registerHook($this->getHooks());
    }

    public function uninstall()
    {
        include(dirname(__FILE__).'/sql/uninstall.php');

        return parent::uninstall();
    }

    public function hookActionCMSPageFormBuilderModifier($params)
    {
        $formBuilder = $params['form_builder'];

        if(is_a($formBuilder, FormBuilderInterface::class)) {

            (new CmsCustomFieldsForm(
                $this->get('translator'),
                $this->get('prestashop.adapter.data_provider.language')->getLanguages()
            ))->buildForm($formBuilder, []);

            $customFieldsData = $this->cmsCustomFieldsHandler->getData([
                'id_cms' => (int) $params['id'],
            ]);

            $formData = array_merge($customFieldsData, $params['data']);
            $formBuilder->setData($formData, $params);
        }
    }

    public function hookActionAfterCreateCMSPageFormHandler($params) {
        $this->setCmsCustomData($params);
    }

    public function hookActionAfterUpdateCMSPageFormHandler($params) {
        $this->setCmsCustomData($params);
    }

    public function hookActionObjectCmsDeleteAfter($params){
        $cmsObject = $params['object'];

        if($cmsObject instanceof CmsCustomFields){
            $this->cmsCustomFieldsHandler->deleteData((int)$cmsObject->id);
        }
    }

    /**
     * @param array $params
     * @throws ModuleErrorException
     */
    protected function setCmsCustomData($params): void
    {
        $formData = $params['form_data'] ?? [];
        $formData['id_cms'] = (int) $params['id'];
        $this->cmsCustomFieldsHandler->saveData($formData);
    }

    public function hookFilterCmsContent($params)
    {
        $idCms = (int) $params['object']['id'];

        $cmsCustomFields = $this->cmsCustomFieldsHandler->getData([
            'id_cms' => $idCms,
            'id_lang' => (int) $this->context->language->id,
            'id_shop' => (int) $this->context->shop->id
        ]);

        $params['object'] = array_merge($cmsCustomFields, $params['object']);

        return [
            'object' => $params['object'],
        ];
    }
}
