<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class infofaqs extends Module
{
    public function __construct()
    {
        $this->name = 'infofaqs';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Marcos';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Info Faqs');
        $this->description = $this->l('Muestra las faqs de Azules de Vergara.');

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

        return $this->fetch('module:infofaqs/views/templates/hook/infofaqs.tpl');
    }
    public function hookHeader()
    {
        // CSS
        $this->context->controller->registerStylesheet(
            'module-infofaqs',
            'modules/'.$this->name.'/views/css/infofaqs.css',
            [
                'media' => 'all',
                'priority' => 150,
            ]
        );
        // JS
        $this->context->controller->registerJavascript(
            'module-infofaqs-js',
            'modules/'.$this->name.'/views/js/infofaqs.js',
            [
                'position' => 'bottom',
                'priority' => 150,
            ]
        );
    }
}
