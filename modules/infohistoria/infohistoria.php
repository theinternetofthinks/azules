<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class infohistoria extends Module
{
    public function __construct()
    {
        $this->name = 'infohistoria';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Marcos';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Info Historia');
        $this->description = $this->l('Muestra la historia de Azules de Vergara.');

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

        return $this->fetch('module:infohistoria/views/templates/hook/infohistoria.tpl');
    }
    public function hookHeader()
    {
        $this->context->controller->registerStylesheet(
            'module-infohistoria',
            'modules/'.$this->name.'/views/css/infohistoria.css',
            [
                'media' => 'all',
                'priority' => 150,
            ]
        );
    }
}
