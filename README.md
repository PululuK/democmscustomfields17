# democmscustomfields17
Demo cms custom field PS 17

This module is an architectural skeleton for module developers, who want to add custom fields in the cms page on the backoffice.
It's a base, you have to adapt it to your needs ... This will save you a lot of time!

## Requirements

- Prestashop >= 1.7.x
- composer >= 1.10.1


## Install

#### BO Install

- Donwload the last release here https://github.com/PululuK/democmscustomfields17/releases
- Go to BO > Improvement > Modules catalogue and install

#### DEV install

- `cd` your_shop_root_dir/modules
- `git` https://github.com/PululuK/democmscustomfields17.git
- `cd` democmscustomfields17
- `composer` install
- Go to BO > Improvement > Modules catalogue and install


## How to use ?

- ### 1 : Update DB schema

Update the table schema (add or remove fields the custom fields) [see here](https://github.com/PululuK/democmscustomfields17/blob/main/sql/install.php)

**NOTE** : put the multilang fields in `democmscustomfields17_lang` table.

- ### 2 : Update the model

Update the model (add or remove fields the custom fields) [see here](https://github.com/PululuK/democmscustomfields17/blob/main/src/Model/CmsCustomFields.php)

- ### 3 : Update the Form

Update the form (add or remove fields the custom fields) [see here](https://github.com/PululuK/democmscustomfields17/blob/main/src/Form/Cms/CustomFieldsForm.php)


![image](https://user-images.githubusercontent.com/16455155/181866998-999ccb07-ec28-4045-ba72-30305bab9b07.png)

- ### 4 : Acces data in FRONT

#### JS

```js
console.log(prestashop.modules.democmscustomfields17.your_field_name);
```

#### Smarty

```smarty
{$modules.democmscustomfields17.your_field_name}
```

NOTE : this data is accessible only in the cms pages controller. You can access them outside this controller as follows

```php

<?php


$params = [
  'id_cms' => 10,
  'id_lang' => 1,
  'id_shop' => 3,
];

$myCmsCustomDatas = (new \PrestaShop\Module\Democmscustomfields17\Form\Cms\FormDataHandler())->getData($params);

```






