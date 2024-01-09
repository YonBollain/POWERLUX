$(document).ready(function() {
    $('.clientes').select2({
        width: "100%",
        templateResult: formatResult,
        escapeMarkup: function (markup) {
            return markup;
        },
        placeholder: "Buscar por DNI/NIE/CIF o nombre ...",
        allowClear: true,
        language: {
            noResults: function () {
                return '<p>No hay resultados...</p><a href="/clientes/crear">Crear nuevo cliente</a>';
            },
        },
        minimumInputLength: 5,
        matcher: function(params, data) {
            var term = $.trim(params.term);
            var dni = $(data.element).data('dni');
            if (term === dni) {
                return data;
            }
            return null;
        }
    });
});
$(document).ready(function() {
    $('.users').select2({
        width: "100%",
        templateResult: formatResult,
        escapeMarkup: function (markup) {
            return markup; // Permitir que los elementos HTML se muestren en los resultados
        },
        placeholder: "Buscar por DNI o nombre ...",
        allowClear: true,
        language: {
            noResults: function () { // Personalizar el mensaje de no hay resultados
                return '<p>No hay resultados...</p>';
            },
        },
        minimumInputLength: 2,
    });
});
$(document).ready(function() {
    $('.usuarios').select2({
        width: "100%",
        templateResult: formatResult,
        escapeMarkup: function (markup) {
            return markup; // Permitir que los elementos HTML se muestren en los resultados
        },
        placeholder: "Buscar por DNI o nombre",
        allowClear: true,
        language: {
            noResults: function () { // Personalizar el mensaje de no hay resultados
                return '<p>No hay resultados...</p>';
            },
        },
        minimumInputLength: 2,
    });
});
function formatResult(result) {
    if (!result.id) {
        return result.text;
    }
    return '<div>' + result.text + '</div>';
}
