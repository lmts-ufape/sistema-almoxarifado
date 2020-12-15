$(function () {
    $('#tableNotificacoes').DataTable({
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
            "targets": [],
            "orderable": false
        }]
    });

    $('#tableNotificacoes').on('page.dt', function () {
        $('html, body').animate({
            scrollTop: $(".dataTables_wrapper").offset().top
        }, 'fast');
    });

    $('#tableNotificacoes').DataTable().columns().iterator('column', function (ctx, idx) {
        $($('#tableNotificacoes').DataTable().column(idx).header()).append('<span class="sort-icon"/>');
    });
});