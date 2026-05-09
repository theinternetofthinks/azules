<?php
/**
 * Creative Elements - live Theme & Page Builder
 *
 * @author    WebshopWorks
 * @copyright 2019-2025 WebshopWorks.com
 * @license   One domain support license
 */
if (!defined('_PS_VERSION_')) {
    exit;
}
class Category extends CategoryCore
{
    /*
    * module: creativeelements
    * date: 2026-05-07 12:27:33
    * version: 2.14.0
    */
    const CE_OVERRIDE = true;
    /*
    * module: creativeelements
    * date: 2026-05-07 12:27:33
    * version: 2.14.0
    */
    public function __construct($idCategory = null, $idLang = null, $idShop = null)
    {
        $initialized = isset(ObjectModel::$loaded_classes[self::class]);
        parent::__construct($idCategory, $idLang, $idShop);
        if (!$this->active && $GLOBALS['context']->controller instanceof CategoryController && !$initialized
            && Tools::getIsset('adtoken') && $id_employee = (int) Tools::getValue('id_employee')
            && Module::getInstanceByName('creativeelements') && CreativeElements::hasAdminToken('AdminCategories')
        ) {
            $this->active = true;
        }
    }
}
