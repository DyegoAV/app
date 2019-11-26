$(function() {
    $('#data_inicio').mask('00/00/0000');
    $('#data_fim').mask('00/00/0000');

    $('#local').change(function() {
        var tipo_local = $(this).find(':selected').data('tipo');
        console.log(tipo_local);
        if (tipo_local == 1) {
            $("#pontoColeta").prop("disabled", true);
            $("#pontoColeta").prop("checked", true);
            $("#entregaPresentes").prop("disabled", true);
            $("#entregaPresentes").prop("checked", false);
            $("#palestraResponsaveis").prop("disabled", true);
            $("#palestraResponsaveis").prop("checked", false);
        }
        else {
            $("#pontoColeta").prop("disabled", true);
            $("#pontoColeta").prop("checked", false);
            $("#entregaPresentes").prop("disabled", false);
            $("#entregaPresentes").prop("checked", true);
            $("#palestraResponsaveis").prop("disabled", false);
            $("#palestraResponsaveis").prop("checked", false);
        }
    })
});