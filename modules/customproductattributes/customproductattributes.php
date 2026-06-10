<?php
if (!defined('_PS_VERSION_')) {
    exit;
}

class CustomProductAttributes extends Module
{
    public function __construct()
    {
        $this->name = 'customproductattributes';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Tu Nombre';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = ['min' => '8.0.0', 'max' => _PS_VERSION_];

        parent::__construct();

        $this->displayName = $this->l('Atributos de Producto Personalizados (Universal)');
        $this->description = $this->l('Módulo polivalente para botones de tallas y colores. Compatible con Elementor y plantillas TPL.');
    }

    public function install()
    {
        // REGISTRAMOS AMBOS HOOKS AL INSTALAR
        // 1. El personalizado para ir por código directo en el TPL
        // 2. El nativo para que Creative Elements (Elementor) lo reconozca en su lista
        return parent::install() 
            && $this->registerHook('displayCustomProductAttributes') 
            && $this->registerHook('displayProductAdditionalInfo');
    }

    public function uninstall()
    {
        return parent::uninstall();
    }

    /**
     * OPCIÓN 1: Para usar SIN Elementor (Directo en tu product.tpl)
     */
    public function hookDisplayCustomProductAttributes($params)
    {
        return $this->renderCustomAttributes();
    }

    /**
     * OPCIÓN 2: Para usar CON Elementor (Seleccionando este hook en el widget)
     */
    public function hookDisplayProductAdditionalInfo($params)
    {
        return $this->renderCustomAttributes();
    }

    /**
     * Lógica centralizada para no repetir código (DRY)
     */
    protected function renderCustomAttributes()
    {
        $id_product = (int)Tools::getValue('id_product');
        if (!$id_product) {
            return '';
        }

        $context = Context::getContext();
        $product = new Product($id_product, false, $context->language->id);
        
        $attributes_groups = $product->getAttributesGroups($context->language->id);
        
        $selected_attributes = Tools::getValue('group');
        if (empty($selected_attributes)) {
            $id_product_attribute = (int)Product::getDefaultAttribute($id_product);
            if ($id_product_attribute) {
                $combination_attributes = Product::getAttributesParams($id_product, $id_product_attribute);
                $selected_attributes = [];
                foreach ($combination_attributes as $attr) {
                    $selected_attributes[$attr['id_attribute_group']] = $attr['id_attribute'];
                }
            }
        }

        $groups = [];
        if (!empty($attributes_groups)) {
            foreach ($attributes_groups as $row) {
                $id_group = $row['id_attribute_group'];
                if (!isset($groups[$id_group])) {
                    $groups[$id_group] = [
                        'id_attribute_group' => $id_group,
                        'group_name' => $row['group_name'],
                        'public_name' => $row['public_name'],
                        'group_type' => $row['group_type'], 
                        'attributes' => []
                    ];
                }

                $id_attr = $row['id_attribute'];
                if (!isset($groups[$id_group]['attributes'][$id_attr])) {
                    $is_selected = isset($selected_attributes[$id_group]) && $selected_attributes[$id_group] == $id_attr;
                    
                    $groups[$id_group]['attributes'][$id_attr] = [
                        'id_attribute' => $id_attr,
                        'attribute_name' => $row['attribute_name'],
                        'attribute_color' => $row['attribute_color'],
                        'selected' => $is_selected
                    ];
                }
            }
        }

        $this->context->smarty->assign([
            'custom_attributes_groups' => $groups
        ]);

        return $this->display(__FILE__, 'views/templates/hook/product-attributes.tpl');
    }
}