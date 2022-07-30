<?php

namespace PrestaShop\Module\Democmscustomfields17\Model;

use ObjectModel;

class CmsCustomFields extends ObjectModel {

    /** @var int ID */
    public $id;

    /** @var int cms ID */
    public $id_cms;

    /** @var string  */
    public $custom_field_text_type;

    /** @var string|array  */
    public $custom_field_translatable_type;

    /** @var string|array  */
    public $custom_field_translate_type;

    /** @var bool  */
    public $custom_field_switch_type;

    /** @var string Object creation date */
    public $date_add;

    /** @var string Object last modification date */
    public $date_upd;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = [
        'table' => 'democmscustomfields17',
        'primary' => 'id_democmscustomfields17',
        'multilang' => true,
        'multilang_shop' => true,
        'fields' => [
            'id_cms' => [
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedId'
            ],
            'custom_field_text_type' => [
                'type' => self::TYPE_STRING,
            ],
            'custom_field_translatable_type' => [
                'type' => self::TYPE_STRING,
                'lang' => true,
                'shop' => true,
            ],
            'custom_field_translate_type' => [
                'type' => self::TYPE_HTML,
                'lang' => true,
                'shop' => true,
                'validate' => 'isCleanHtml'
            ],
            'custom_field_switch_type' => [
                'type' => self::TYPE_BOOL
            ],
            'date_add' => [
                'type' => self::TYPE_DATE,
                'validate' => 'isDate'
            ],
            'date_upd' => [
                'type' => self::TYPE_DATE,
                'validate' => 'isDate'
            ],
        ],
    ];
}