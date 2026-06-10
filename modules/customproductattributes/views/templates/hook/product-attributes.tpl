{if isset($custom_attributes_groups) && $custom_attributes_groups}
    <div class="product-variants custom-attributes-wrapper">
        {foreach from=$custom_attributes_groups item=group}
            <div class="attribute-group-item" data-group-id="{$group.id_attribute_group}">
                <span class="attribute-group-title">{$group.public_name}</span>
                
                {if $group.group_type == 'color'}
                    <div class="custom-colors-container">
                        {foreach from=$group.attributes item=attribute}
                            <label class="custom-color-item {if $attribute.selected}selected-attr{/if}" title="{$attribute.attribute_name}">
                                <input type="radio" 
                                       class="input-variant-selector"
                                       name="group[{$group.id_attribute_group}]" 
                                       value="{$attribute.id_attribute}" 
                                       {if $attribute.selected}checked="checked"{/if} />
                                <span class="color-swatch-circle" style="background-color: {$attribute.attribute_color};"></span>
                            </label>
                        {/foreach}
                    </div>
                {else}
                    <div class="custom-sizes-container">
                        {foreach from=$group.attributes item=attribute}
                            <label class="custom-size-item {if $attribute.selected}selected-attr{/if}">
                                <input type="radio" 
                                       class="input-variant-selector"
                                       name="group[{$group.id_attribute_group}]" 
                                       value="{$attribute.id_attribute}" 
                                       {if $attribute.selected}checked="checked"{/if} />
                                <span class="size-box-text">{$attribute.attribute_name}</span>
                            </label>
                        {/foreach}
                    </div>
                {/if}
            </div>
        {/foreach}
    </div>

    <style>
        .custom-attributes-wrapper {
            margin: 20px 0;
        }
        .attribute-group-item {
            margin-bottom: 20px;
        }
        .attribute-group-title {
            display: block;
            font-weight: bold;
            font-size: 13px;
            text-transform: uppercase;
            margin-bottom: 8px;
            color: #333;
            letter-spacing: 0.5px;
        }
        
        /* Ocultamos por completo el radio button nativo horrendo */
        .input-variant-selector {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
            margin: 0;
        }

        /* DISEÑO DE BOTONES DE TALLA */
        .custom-sizes-container {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        .custom-size-item {
            cursor: pointer;
        }
        .size-box-text {
            display: block;
            padding: 10px 18px;
            border: 1px solid #ddd;
            font-size: 14px;
            font-weight: 500;
            text-align: center;
            min-width: 45px;
            background-color: #fff;
            color: #000;
            transition: all 0.2s ease;
        }
        .custom-size-item:hover .size-box-text {
            border-color: #000;
        }
        /* Estado seleccionado (Fondo negro, letra blanca) */
        .custom-size-item.selected-attr .size-box-text {
            background-color: #000;
            border-color: #000;
            color: #fff;
        }

        /* DISEÑO DE CÍRCULOS DE COLOR */
        .custom-colors-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }
        .custom-color-item {
            cursor: pointer;
            position: relative;
            display: inline-block;
            padding: 2px;
            border: 1px solid transparent;
            border-radius: 50%;
            transition: all 0.2s ease;
        }
        .color-swatch-circle {
            display: block;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            border: 1px solid rgba(0,0,0,0.15);
        }
        .custom-color-item:hover {
            border-color: #999;
        }
        /* Estado seleccionado (Añade un aro exterior negro alrededor del círculo) */
        .custom-color-item.selected-attr {
            border-color: #000;
        }
    </style>
{/if}