$(function() {
    $('#data_inicio').mask('00/00/0000');
    $('#data_fim').mask('00/00/0000');

    $('#local').change(function() {
        var tipo_local = $(this).find(':selected').data('tipo');
        console.log(tipo_local);
        if (tipo_local != 2) {
            $("#divQtdBeneficiados").hide();
            $("#divQtdResponsaveis").hide();
            $("#quantidade_beneficiados").val("");
            $("#quantidade_responsaveis").val("");
        }
        else {
            $("#divQtdBeneficiados").show();
            $("#divQtdResponsaveis").show();
            $("#quantidade_beneficiados").val("50");
            $("#quantidade_responsaveis").val("0");
        }
    })
});