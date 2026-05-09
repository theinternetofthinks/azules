<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class infoextras extends Module
{
    public function __construct()
    {
        $this->name = 'infoextras';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Marcos';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Info Extras');
        $this->description = $this->l('Muestra los extras de Azules de Vergara.');

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

        return $this->fetch('module:infoextras/views/templates/hook/infoextras.tpl');
    }
    public function hookHeader()
    {
        $this->context->controller->registerStylesheet(
            'module-infoextras',
            'modules/'.$this->name.'/views/css/infoextras.css',
            [
                'media' => 'all',
                'priority' => 150,
            ]
        );
    }
}
