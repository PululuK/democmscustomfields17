<?php

namespace PrestaShop\Module\Democmscustomfields17\Factory;

use PrestaShop\Module\Democmscustomfields17\Model\CmsCustomFields;
use DbQuery;
use Db;

abstract class CmsCustomFieldsFactory{

    public static function create(
        int $idCms,
        ?int $idLang = null,
        ?int $idShop = null
    ): CmsCustomFields{

        $sql = new DbQuery();
        $sql->select(CmsCustomFields::$definition['primary']);
        $sql->from(CmsCustomFields::$definition['table'], 'c');
        $sql->where('c.id_cms = '.$idCms);
    
        $idObject = (int) Db::getInstance()->getValue($sql);
    
        return (new CmsCustomFields($idObject, $idLang, $idShop));
    }
}