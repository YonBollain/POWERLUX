let contratos = [];
function main(){
    $(".enlace").on("click", function(event) {
        event.preventDefault();
        var enlaceId = $(this).attr("id");

        $.ajax({
            url: "/datos/contratos/clientes",
            method: "GET",
            data: { cliente_id: enlaceId },
            success: function(data) {
                $("#tabla-contratos tbody").empty();
                if (data.length === 0) {
                    $("#tabla-contratos tbody").append("<tr><td colspan='7'>No hay datos disponibles</td></tr>");
                }else {
                    $.each(data, function (index, contrato) {
                        var fila = "<tr>" +
                            "<td>#" + contrato.id + "</td>" +
                            "<td>" + contrato.tipo_contrato + "</td>" +
                            "<td>" + contrato.cups + "</td>" +
                            "<td>" + contrato.estado + "</td>" +
                            "<td>" + contrato.cp + ", " + contrato.direccion + ", " + contrato.poblacion + "</td>" +
                            "<td>" + contrato.fecha_fin + "</td>" +
                            "<td class='text-center'>" +
                            "<div class='row'><div class='col-6'>" +
                            "<a href='/contratos/mostrar/" + contrato.id + "' class='text-success'><i class='fas fa-eye'></i></a>" +
                            "</div>" +
                            "<div class='col-6'>" +
                            "<a href='/contratos/editar/" + contrato.id + "' class='text-info'><i class='fas fa-edit'></i></a>" +
                            "</div></div>" +
                            "</td>" +
                            "</tr>";
                        $("#tabla-contratos tbody").append(fila);
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error al obtener contratos: " + error);
            }
        });
    });
}
document.addEventListener('DOMContentLoaded',main);
