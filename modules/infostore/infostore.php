<?php

if (!defined('_PS_VERSION_')) {
    exit;
}

class Infostore extends Module
{
    public function __construct()
    {
        $this->name = 'infostore';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Marcos';
        $this->need_instance = 0;
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Info Store Banner');
        $this->description = $this->l('Muestra un banner de texto en la parte superior (displayBanner).');

        $this->ps_versions_compliancy = [
            'min' => '1.7.0.0',
            'max' => _PS_VERSION_,
        ];
    }

    public function install()
    {
        return parent::install()
            && $this->registerHook('displayBanner');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    public function hookDisplayBanner($params)
    {
        // Aquí podrías cargar texto desde configuración; de momento, fijo:
        $this->context->smarty->assign([
            'infostore_text' => 'Bienvenido a nuestra tienda — Envíos rápidos y atención personalizada.',
        ]);

        return $this->fetch('module:infostore/views/templates/hook/infostore.tpl');
    }
}
