<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Infosectores extends Module
{
    public function __construct()
    {
        $this->name = 'infosectores';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Marcos';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Info Sectores Banner');
        $this->description = $this->l('Muestra los productos de las diferentes secciones.');

        $this->ps_versions_compliancy = [
            'min' => '1.7.0.0',
            'max' => _PS_VERSION_,
        ];
    }

    public function install()
    {
        return parent::install()
            && $this->registerHook('displayHome')
            && $this->registerHook('header');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }
    public function hookDisplayHome($params)
    {
        $this->context->smarty->assign([
            'module_dir_custom' => $this->_path,
        ]);

        return $this->fetch('module:infosectores/views/templates/hook/infosectores.tpl');
    }
    public function hookHeader()
    {
        $this->context->controller->registerStylesheet(
            'module-infosectores',
            'modules/'.$this->name.'/views/css/infosectores.css',
            [
                'media' => 'all',
                'priority' => 150,
            ]
        );
    }
}
