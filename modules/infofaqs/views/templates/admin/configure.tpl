<div class="panel">
    <h3>Gestión de FAQs</h3>

    <form method="post">
        <div id="faq-container">
            {foreach from=$faqs item=faq key=i}
            <div class="faq-item panel">
                <div class="row">
                    <div class="col-md-1">
                        <span class="drag-handle" style="cursor:move;font-size:22px;">☰</span>
                    </div>

                    <div class="col-md-11">
                        <input type="hidden" name="INFOFAQS_DATA[{$i}][position]" value="{$faq.position|default:$i}" class="faq-position">

                        <label>Pregunta</label>
                        <input type="text" name="INFOFAQS_DATA[{$i}][question]" value="{$faq.question}" class="form-control">

                        <label>Respuesta</label>
                        <textarea name="INFOFAQS_DATA[{$i}][answer]" class="form-control">{$faq.answer}</textarea>
                        <button type="button" class="btn btn-danger delete-faq" style="margin-top:10px;">
                            Eliminar
                        </button>
                    
                    </div>
                </div>

                <hr>
            </div>
            {/foreach}
        </div>

        <button type="button" id="add-faq" class="btn btn-default">Añadir FAQ</button>
        <br><br>

        <button type="submit" name="submit_infofaqs" class="btn btn-primary">
            Guardar
        </button>
    </form>
</div>

<script>
document.getElementById('add-faq').addEventListener('click', function() {
    const container = document.getElementById('faq-container');
    const index = container.children.length;

    const html =
    '<div class="faq-item panel">' +
        '<div class="row">' +
            '<div class="col-md-1">' +
                '<span class="drag-handle" style="cursor:move;font-size:22px;">☰</span>' +
            '</div>' +
            '<div class="col-md-11">' +
                '<input type="hidden" ' +
                    'name="INFOFAQS_DATA[' + index + '][position]" ' +
                    'value="' + index + '" ' +
                    'class="faq-position">' +

                '<label>Pregunta</label>' +
                '<input type="text" ' +
                    'name="INFOFAQS_DATA[' + index + '][question]" ' +
                    'class="form-control">' +

                '<label>Respuesta</label>' +
                '<textarea ' +
                    'name="INFOFAQS_DATA[' + index + '][answer]" ' +
                    'class="form-control"></textarea>' +
                '<button type="button" class="btn btn-danger delete-faq" style="margin-top:10px;">Eliminar</button>' +

            '</div>' +
        '</div>' +
        '<hr>' +
    '</div>';

    container.insertAdjacentHTML('beforeend', html);
});
</script>