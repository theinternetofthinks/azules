{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
<div class="container">

  <div class="footer-top">

    <div class="col column">
      <h2 class="caps">AZULES DE VERGARA</h2>
      <p>Especialistas en ropa de trabajo y uniformes laborales desde hace más de 100 años.</p>
      <h3 class="caps">Suscríbete a la newsletter</h3>
      {block name='hook_footer_before'}
        {hook h='displayFooterBefore'}
      {/block}
    </div>
    <div class="col">
      {block name='hook_footer'}
        {hook h='displayFooter'}
      {/block}
    
    </div>
    <div class="col">
      {block name='hook_footer_after'}
        {hook h='displayFooterAfter'}
      {/block}
      
    </div>
  </div>

  <div class="footer-bottom">
    {block name='copyright_link'}
      <a href="https://www.prestashop-project.org/" target="_blank" rel="noopener noreferrer nofollow">
        {l s='%copyright% %year% - Ecommerce software by %prestashop%' sprintf=['%prestashop%' => 'PrestaShop™', '%year%' => 'Y'|date, '%copyright%' => '©'] d='Shop.Theme.Global'}
      </a>
    {/block}

  </div>

</div>


<style>
    footer {
      border-top: 1px solid rgba(#6B7480, .4);
    }
    .block_newsletter #block-newsletter-label,
    footer p {
      font-size: 14px;
      color: #7a7a7a;
    }

    .footer-top {
      display: flex;
      flex-direction: column;
    }
    @media (min-width: 768px) {
      .footer-top {
        flex-direction: row;
      }
      .footer-top .col:first-child{
        max-width: 30%;
      }
    }

    .footer-top h2 {
      margin-bottom: 24px;
      font-family: 'Inter', sans-serif;
      font-size: 16px;
      text-transform: uppercase;
      font-weight: 600;

    }
     .footer-top h3 {
      margin-bottom: 16px;
      font-family: 'Inter', sans-serif;
      font-size: 12px;
      text-transform: uppercase;
      font-weight: 400;

     }
      .footer-top .links h3 {
        font-size: 14px;
        font-family: 'Inter', sans-serif;

     }
    .footer-top p.h4,
    .footer-top p.h3,
    .footer-top a {
     text-decoration: none;
     color: #6B7480;
     font-size: 14px;
    }
    .footer-top p.h4,
    .footer-top p.h3 {
       color: #0B1B2B;;
    }
     @media (max-width: 767px) {
      .footer-top .col-md-6.wrapper {
        padding: 0;
      }
       .footer-top span.h3 {
        font-size: 12px;
       }
      .footer-top .wrapper,
      .footer-top .links .title {
        padding: .625rem 0;
      }
    }

    .col.column {
      flex-direction: column;
    }
    input[type="email"] {
      background: #F3F6F9;
      color:#757575;
    }
    .btn {
      border-radius: 0 4px 4px 0px
    }
    .btn-primary {
      background: #0B1B2B;
      color: #FBFDFF;
      text-transform: none;
      font-size: 14px;
    }
</style>


