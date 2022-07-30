<?php

namespace PrestaShop\Module\Democmscustomfields17\Form\Cms;

use PrestaShopBundle\Form\Admin\Type\TranslatorAwareType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use PrestaShopBundle\Form\Admin\Type\TranslatableType;
use PrestaShopBundle\Form\Admin\Type\SwitchType;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use PrestaShop\PrestaShop\Core\ConstraintValidator\Constraints\CleanHtml;
use PrestaShopBundle\Form\Admin\Type\FormattedTextareaType;
use PrestaShopBundle\Form\Admin\Type\TranslateType;
use PrestaShop\Module\Democmscustomfields17\Translation\TransDomains;

class CustomFieldsForm extends TranslatorAwareType 
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $formBuilder, array $options)
    {
        $formBuilder
            ->add('custom_field_text_type', TextType::class, [
                'label' => $this->trans('Example Text Type', TransDomains::ADMIN_FORM_LABEL),
                'required' => false,
            ])
            ->add('custom_field_switch_type', SwitchType::class, [
                'label' => $this->trans('Example Switch Type', TransDomains::ADMIN_FORM_LABEL),
                'required' => false,
            ])
            ->add('custom_field_translatable_type', TranslatableType::class, [
                'label' => $this->trans('Example Translatable Type', TransDomains::ADMIN_FORM_LABEL),
                'required' => false,
                'type' => TextType::class,
                'options' => [
                    'constraints' => [
                        new Regex([
                            'pattern' => '/^[^<>;=#{}]*$/u',
                            'message' => $this->trans('%s is invalid.', TransDomains::ADMIN_FORM_ERROR),
                        ]),
                    ],
                ],
            ])
            ->add('custom_field_translate_type', TranslateType::class, [
                'label' => $this->trans('Example Translate Type', TransDomains::ADMIN_FORM_LABEL),
                'type' => FormattedTextareaType::class,
                'locales' => $this->locales,
                'hideTabs' => false,
                'required' => false,
                'options' => [
                    'constraints' => [
                        new CleanHtml([
                            'message' => $this->trans('This field is invalid', TransDomains::ADMIN_FORM_ERROR),
                        ]),
                    ],
                ],
            ])
        ;
    }
}