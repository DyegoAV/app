$(function() {
    
    $("#select-instituicao").select2({
        language: "pt-BR"
    });

    $("#add-instituicao").click(function() {
        var valor = $("#select-instituicao").val().split("-");
        var campanha = valor[0];
        var instituicao = valor[1];

        if (campanha > 0 && instituicao > 0) {
            console.log("Clicou pra add a instituição de id " + instituicao + " na campanha " + campanha);

            window.location.href = base_url + "campanha/add_instituicao/" + campanha + "/" + instituicao;

            console.log(window.location);
            /*$.ajax({
                method: "GET",
                url: "/campanha/add_instituicao/" + campanha + "/" + instituicao
            })
            .done(function(data) {
                window.location.reload();
            })
            .fail(function(jqXHR, textStatus) {
                console.log("FAIL", jqXHR, textStatus);
            });*/
        }
    });

    $(".selecionar-todas").click(function() {
        if ($(this).is(":checked")) {
            $(".selecao").each(function(idx, obj) {
                if (!$(obj).is(":disabled")) {
                    $(obj).prop('checked', true);
                    habilitar_acoes = true;
                }
            });
        }
        else {
            $(".selecao").each(function(idx, obj) {
                $(obj).prop('checked', false);
            });
            habilitar_acoes = false;
        }

        habilitarAcoes(habilitar_acoes);
    });

    $(".selecao").click(function() {
        if ($(this).is(":checked")) {
            $(this).prop('checked', true);
            habilitar_acoes = true;
        }
        else {
            $(this).prop('checked', false);
            habilitar_acoes = false;
            $(".selecao").each(function(idx, obj) {
                if ($(obj).is(":checked")) {
                    habilitar_acoes = true;
                }
            });
        }

        habilitarAcoes(habilitar_acoes);
    });

    $("#aplicar-acao").click(function() {
        if ($("#coleta").val() == "" && $("#evento").val() == "") {
            Swal.fire({
                title: 'Favor selecionar um Ponto de Coleta e/ou Local de Evento nos campos ao lado para atribuir à(s) instituição(ões) selecionada(s).',
                text: '',
                type: 'info',
                onAfterClose: () => {
                    $("#coleta").click();
                }
            });
            return;
        }
        else {
            var data = [];
            $(".selecao").each(function(idx, obj) {
                if ($(obj).is(":checked")) {
                    data.push({
                        instituicao: $(obj).data("instituicao"),
                        coleta: $("#coleta").val(),
                        evento: $("#evento").val()
                    });
                }
            });

            $.ajax({
                method: "POST",
                url: base_url + "instituicao/atribuir_locais/",
                data: { instituicoes: data }
            })
            .done(function(data) {
                // data = JSON.parse(data);
                console.log("DONE", data);
                location.reload();
            })
            .fail(function(jqXHR, textStatus) {
                console.log("FAIL", jqXHR, textStatus);
            });
        }
    });

});


var habilitarAcoes = function(habilitar_acoes) {
    console.log("habilitarAcoes", habilitar_acoes);

    if (habilitar_acoes) {
        $(".acoes").prop("disabled", false);
    }
    else {
        $(".acoes").prop("disabled", true);
    }
}

