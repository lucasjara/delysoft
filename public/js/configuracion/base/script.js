$(document).ready(function () {
// Variables Globales
    var btn_local = $("#btn_confirmar_local")
    var contenido_cargo = $("#contenido_cargo")
    var tabla_cargos = $("#tabla_cargos")
    var usuario_select = $("#usuario_select2");
// Fin Variables Globales
// Carga Inicial Web
    $("#cargo").select2().width("100%");
    $("#region").select2();
    $("#ciudad").select2();
    tabla_cargos.DataTable({
        'language': {
            'url': '/delysoft/public/Spanish.json',
        }
    });

    $("#example1").select2({
        placeholder: "Selecciona Usuario",
        minimumInputLength: 3,
        language: {
            errorLoading: function () {
                return "Buscando..."
            }
        },
        multiple: false,
        width: 400,
        ajax: {
            url: '/delysoft/administracion/Usuarios/busca_usuario_json',
            dataType: 'json',
            data: function (term) {
                return {
                    usuario: term.term
                }
            },
            processResults: function (data, params) {
                var results = [];
                data.items.forEach(function(element) {
                    results.push({
                        id: element.ID,
                        usuario: element.USUARIO.toUpperCase()
                    });
                });
                return {
                    results: results
                };
                return {
                    usuario: term.term
                }
            }

        },
        escapeMarkup: function (markup) {
            return markup;
        }, // let our custom formatter work
        minimumInputLength: 2,
        templateResult: formatRepo,
        templateSelection: formatRepoSelection
    });

    function formatRepo(item) {
        if (item.loading) {
            return item.text;
        }
        var markup = $("<div>" +
            "<strong>" + item.usuario + "</strong>" +
            "<div>" +
            "<small></small>" +
            "</div>" +
            "<div>");
        return markup;
    }

    function formatRepoSelection(item) {
        return item.usuario || item.text;
    }

// Fin Carga Inicial Web
// Eventos

// Fin Eventos
// Funciones
// Fin Funciones
});