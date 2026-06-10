{if isset($custom_grid_images) && $custom_grid_images}
    <div class="custom-product-images-grid">
        {foreach from=$custom_grid_images item=image_url}
            <div class="grid-image-item">
                <img src="{$image_url}" alt="{$product_name|escape:'html':'UTF-8'}" loading="lazy" class="img-fluid" />
            </div>
        {/foreach}
    </div>

    {* Estilos CSS básicos para asegurar el comportamiento de grid vertical *}
    <style>
        .custom-product-images-grid {
            display: flex;
            flex-direction: column;
            gap: 15px; /* Espacio entre imágenes */
            width: 100%;
        }
        .grid-image-item img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>
{else}
    <p>{l s='No hay imágenes disponibles para este producto.' mod='customproductgrid'}</p>
{/if}