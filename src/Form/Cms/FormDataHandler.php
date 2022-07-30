<?php

namespace PrestaShop\Module\Democmscustomfields17\Form\Cms;

use PrestaShop\PrestaShop\Core\Module\Exception\ModuleErrorException;
use PrestaShop\Module\Democmscustomfields17\Factory\CmsCustomFieldsFactory;
use PrestaShop\PrestaShop\Adapter\Presenter\Object\ObjectPresenter;
use Exception;

final class FormDataHandler
{
    public function saveData(array $data): bool{

        $cmsCustomFields = CmsCustomFieldsFactory::create((int)$data['id_cms']);

        $cmsCustomFieldsDefinition = $cmsCustomFields::$definition['fields'];

        if(!empty($cmsCustomFieldsDefinition)){
            foreach($cmsCustomFieldsDefinition as $field => $definition){
                if(isset($data[$field])){
                    $cmsCustomFields->{$field} = $data[$field];
                }
            }
        }

        try {
            if($cmsCustomFields->save()){
                return true;
            }
        } catch(Exception $e){
            throw new ModuleErrorException($e->getMessage());
        }

        return false;
    }

    public function getData(array $params): array{

        $cmsCustomFields = CmsCustomFieldsFactory::create(
            (int)$params['id_cms'],
            $params['id_lang'] ?? null,
            $params['id_shop'] ?? null
        );

        return (new ObjectPresenter())->present($cmsCustomFields);
    }

    public function deleteData(int $idCms): bool{

        $cmsCustomFields = CmsCustomFieldsFactory::create($idCms);

        try {
            if($cmsCustomFields->delete()){
                return true;
            }
        } catch(Exception $e){
            throw new ModuleErrorException($e->getMessage());
        }

        return false;
    }
}