<?php

$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'democmscustomfields17`';
$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'democmscustomfields17_lang`';

foreach ($sql as $query) {
    if (Db::getInstance()->execute($query) == false) {
        return false;
    }
}
