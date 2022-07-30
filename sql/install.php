<?php

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'democmscustomfields17` (
    `id_democmscustomfields17` int(11) NOT NULL AUTO_INCREMENT,
    `id_cms` INT(11) unsigned NOT NULL,
    `custom_field_text_type` VARCHAR(255) DEFAULT NULL,
    `custom_field_switch_type` TINYINT(1) UNSIGNED NOT NULL DEFAULT "0",
    `date_add` DATETIME NOT NULL,
    `date_upd` DATETIME NOT NULL,
    PRIMARY KEY  (`id_democmscustomfields17`),
    KEY `id_cms` (`id_cms`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'democmscustomfields17_lang` (
    `id_democmscustomfields17` INT(11) UNSIGNED NOT NULL,
    `id_shop` INT(11) UNSIGNED NOT NULL DEFAULT "1",
    `id_lang` INT(11) UNSIGNED NOT NULL DEFAULT "1",
    `custom_field_translatable_type` VARCHAR(255) DEFAULT NULL,
    `custom_field_translate_type` TEXT DEFAULT NULL,
    PRIMARY KEY  (`id_democmscustomfields17`, `id_shop`, `id_lang`)
) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8;';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
