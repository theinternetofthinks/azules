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
class Manufacturer extends ManufacturerCore
{
    /*
    * module: creativeelements
    * date: 2026-05-07 12:27:34
    * version: 2.14.0
    */
    const CE_OVERRIDE = true;
    /*
    * module: creativeelements
    * date: 2026-05-07 12:27:34
    * version: 2.14.0
    */
    public function __construct($id = null, $idLang = null)
    {
        parent::__construct($id, $idLang);
        if (!$this->active && $GLOBALS['context']->controller instanceof ManufacturerController && !ManufacturerController::$initialized
            && Tools::getIsset('adtoken') && Tools::getIsset('id_employee')
            && Module::getInstanceByName('creativeelements') && CreativeElements::hasAdminToken('AdminManufacturers')
        ) {
            $this->active = true;
        }
    }
}
