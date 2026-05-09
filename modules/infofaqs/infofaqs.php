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
        $faqs = json_decode(Configuration::get('INFOFAQS_DATA'), true) ?: [];
        
        usort($faqs, function($a, $b) {
            return ($a['position'] ?? 0) <=> ($b['position'] ?? 0);
        });

        $this->context->smarty->assign([
            'faqs' => $faqs,
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
 
    public function getContent()
    {
        $this->context->controller->addJS($this->_path.'views/js/Sortable.min.js');
        $this->context->controller->addJS($this->_path.'views/js/admin-sortable.js');

        $output = '';

        if (Tools::isSubmit('submit_infofaqs')) {
            $faqs = Tools::getValue('INFOFAQS_DATA');
            Configuration::updateValue('INFOFAQS_DATA', json_encode($faqs));
            $output .= $this->displayConfirmation($this->l('Guardado correctamente'));
        }

        $faqs = json_decode(Configuration::get('INFOFAQS_DATA'), true) ?: [];

        $this->context->smarty->assign([
            'faqs' => $faqs,
            'module_dir' => $this->_path,
        ]);

        return $output . $this->display(__FILE__, 'views/templates/admin/configure.tpl');
    }
}
