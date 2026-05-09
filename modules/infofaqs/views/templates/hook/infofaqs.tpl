<div class="infofaqs-banner">
  <div class="inner-container">
      <div class="header-component">
        <h2>Preguntas frecuentes</h2>
        <p>Información útil para comprar con más tranquilidad.</p>
      </div>
      <ul>
        {foreach from=$faqs item=faq}
            <li class="faq-item">
                <h3>{$faq.question}</h3>
                 <div class="faq-content">
                     <p>{$faq.answer}</p>
                 </div>
            </li>
        {/foreach}
      </ul>
  </div>
</div>
    
