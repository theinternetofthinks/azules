<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class CustomProductGrid extends Module
{
    public function __construct()
    {
        $this->name = 'customproductgrid';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'ME';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '8.0.0', 'max' => _PS_VERSION_]; // <-- CORREGIDO: Con guion bajo al final

        parent::__construct();

        $this->displayName = $this->l('Grid de Imágenes de Producto (Universal)');
        $this->description = $this->l('Muestra las imágenes del producto en un grid vertical continuo. Compatible con Elementor y TPL.');
    }

    public function install()
    {
        // Registramos ambos ganchos para soporte híbrido (Código directo y Elementor)
        return parent::install() 
            && $this->registerHook('displayCustomProductGrid') 
            && $this->registerHook('displayProductLeftColumn');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    /**
     * OPCIÓN 1: Para usar SIN Elementor (Directo en tu product.tpl)
     */
    public function hookDisplayCustomProductGrid($params)
    {
        return $this->renderProductGrid();
    }

    /**
     * OPCIÓN 2: Para usar CON Elementor (Widget de Hook)
     */
    public function hookDisplayProductLeftColumn($params)
    {
        return $this->renderProductGrid();
    }

    /**
     * Lógica centralizada y segura del Grid de Imágenes
     */
    protected function renderProductGrid()
    {
        $id_product = (int)Tools::getValue('id_product');

        if (!$id_product) {
            return '';
        }

        $context = Context::getContext();
        $product = new Product($id_product, false, $context->language->id);
        
        // Verificación de seguridad: Comprobar que el producto realmente existe cargado
        if (!Validate::isLoadedObject($product)) {
            return '';
        }

        $images = $product->getImages($context->language->id);
        $images_urls = [];

        if (!empty($images)) {
            foreach ($images as $image) {
                // Protección multidioma: Nos aseguramos de extraer la url amigable como string limpio
                $link_rewrite = is_array($product->link_rewrite) ? $product->link_rewrite[$context->language->id] : $product->link_rewrite;

                $images_urls[] = $context->link->getImageLink(
                    $link_rewrite,
                    $image['id_image'],
                    'large_default'
                );
            }
        }

        // Protección multidioma para el nombre del producto
        $product_name = is_array($product->name) ? $product->name[$context->language->id] : $product->name;

        $this->context->smarty->assign([
            'custom_grid_images' => $images_urls,
            'product_name' => $product_name
        ]);

        return $this->display(__FILE__, 'views/templates/hook/product-grid.tpl');
    }
}