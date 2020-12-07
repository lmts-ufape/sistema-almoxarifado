function onlyNums(e, t) {
    try {
        if (window.event) {
            var charCode = window.event.keyCode;
        } else if (e) {
            var charCode = e.which;
        } else {
            return true;
        }
        if ((charCode >= 48 && charCode <= 57)) {
            return true;
        } else {
            return false;
        }
    } catch (err) {
        alert('Digite apenas números na quantidade');
    }
}

function showItens(id) {
    $("#overlay").show();

    $("#detalhesSolicitacao").modal('show');

    $('#numSolicitacao').text(id);

    $.ajax({
        url: '/observacao_solicitacao/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#textObservacaoRequerente').text(data[0]['observacao_requerente']);
            $('#textObservacaoAdmin').text(data[0]['observacao_admin']);;
        }
    });

    $.ajax({
        url: '/itens_solicitacao_admin/' + id,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var ret = '';
            for (var item in data) {
                ret += "<tr>";
                ret += "<td>" + data[item]['nome'] + "</td>";
                ret += "<td>" + data[item]['descricao'] + "</td>";
                ret += "<td style=\"text-align: center\">" + data[item]['quantidade_solicitada'] + "</td>";
                ret += "<td style=\"text-align: center\">" + '<input min=\"0\" onkeypress=\"return onlyNums(event,this);\" style=\"width: 85%\" type=\"number\" id=\"inputQuantAprovada\" name=\"quantAprovada[]\" value=\"' + data[item]['quantidade_aprovada'] + '\">' + "</td>";
                ret += "</tr>";
            }

            $('#solicitacaoID').val(id);
            $("#tableItens tbody").append(ret);
            $("#overlay").hide();
            $("#modalBody").show();
            $('#negaSolicitacao').show();
            $('#aprovaSolicitacao').show();
        }
    });
}

$(function () {
    var buttonSubmitID = "";

    $('#textObservacaoAdmin').on('input propertychange', function () {
        if ($(this).val().length < 5) {
            $('#negaSolicitacao').prop('disabled', true);
            $('#aprovaSolicitacao').prop('disabled', true);
        } else {
            $('#negaSolicitacao').prop('disabled', false);
            $('#aprovaSolicitacao').prop('disabled', false);
        }
    });

    $("#formSolicitacao button[type = 'submit']").click(function (e) {
        buttonSubmitID = $(this).attr("id");
    })

    $('#tableSolicitacoes').on('page.dt', function () {
        $('html, body').animate({
            scrollTop: $(".dataTables_wrapper").offset().top
        }, 'fast');
    });

    $("#formSolicitacao").submit(function (e) {
        if (buttonSubmitID == "aprovaSolicitacao") {
            vari = $('[name="quantAprovada[]"]');
            count = 0;
            for (var i = 0; i < vari.length; i++) {
                if (vari[i]['value'] == "") {
                    count++;
                }
            }
            if (count == vari.length) {
                alert("Informe algum valor para a quantidade aprovada");
                return false;
            }
        }
    });

    var table = $('#tableSolicitacoes').DataTable({
        searching: false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "info": "Exibindo página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "zeroRecords": "Nenhum registro disponível",
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo"
            }
        },
        "order": [],
        "columnDefs": [{
            "targets": [1],
            "orderable": false
        }]
    });

    $('#tableSolicitacoes tbody').on('click', 'td.expandeOption', function (e) {
        e.preventDefault();
        e.stopPropagation();

        var tr = $(this).closest('tr');
        var row = table.row(tr);
        var id = tr.data('id');

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            $.ajax({
                url: '/itens_solicitacao_admin/' + id,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var ret = '<table id=\"tableExpanded\" class=\"table table-hover table-responsive-md\"">' +
                        '<thead>' +
                        '<tr>' +
                        '<th scope=\"col\" class=\"align-middle\">Material</th>' +
                        '<th scope=\"col\" class=\"align-middle\">Descrição</th>' +
                        '<th scope=\"col\" style=\"text-align: center; width: 10%\">Qtd. Solicitada</th>' +
                        '</tr>' +
                        '</thead>' +
                        '<tbody>';
                    for (var item in data) {
                        ret += "<tr data-id=" + id + " onclick=\"showItens( " + id + "  )\" style=\"cursor: pointer;\">";
                        ret += "<td>" + data[item]['nome'] + "</td>";
                        ret += "<td>" + data[item]['descricao'] + "</td>";
                        ret += "<td style=\"text-align: center\">" + data[item]['quantidade_solicitada'] + "</td>";
                        ret += "</tr>";
                    }
                    row.child(ret).show();
                    tr.addClass('shown');
                }
            });
        }
    });

    $('#detalhesSolicitacao').on('hidden.bs.modal', function (e) {
        $('#solicitacaoID').val(0);
        $("#modalBody").hide();
        $('#negaSolicitacao').hide();
        $('#aprovaSolicitacao').hide();
        $("#listaItens").empty();
    });
});
