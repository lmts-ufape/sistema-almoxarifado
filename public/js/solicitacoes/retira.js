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
                ret += "<td style=\"text-align: center\">" + (data[item]['quantidade_aprovada'] == null ? '' : data[item]['quantidade_aprovada']) + "</td>";
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

    $('#tableSolicitacoes').on('page.dt', function () {
        $('html, body').animate({
            scrollTop: $(".dataTables_wrapper").offset().top
        }, 'fast');
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
        $("#listaItens").empty();
        $("#modalBody").hide();
    });

    $('#tableSolicitacoes tbody').on('click', '.entregaSolicitacao', function (e) {
        e.preventDefault();
        e.stopPropagation();

        let escolha = confirm("Tem certeza que deseja fazer a entrega?");

        if (escolha) {
            var id = $(this).data('id');

            $.ajax({
                type: 'POST',
                url: "entrega_solicitacao",
                data: { _token: $('meta[name="csrf-token"]').attr('content'), id: id },
                success: function (data) {
                    location.reload();
                }
            });
        } else {
            return false;
        }
    });

    $('#tableSolicitacoes tbody').on('click', '.cancelaEntregaSolicitacao', function (e) {
        e.preventDefault();
        e.stopPropagation();

        let escolha = confirm("Tem certeza que deseja cancelar a entrega?");

        if (escolha) {
            var id = $(this).data('id');

            $.ajax({
                type: 'POST',
                url: "cancela_entrega_solicitacao",
                data: { _token: $('meta[name="csrf-token"]').attr('content'), id: id },
                success: function (data) {
                    location.reload();
                }
            });
        } else {
            return false;
        }
    });
});