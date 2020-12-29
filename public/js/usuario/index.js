$(function () {
    $('#tableUsuarios').DataTable({
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
            "targets": [3],
            "orderable": false
        }]
    });

    $('#tableUsuarios').on('page.dt', function () {
        $('html, body').animate({
            scrollTop: $(".dataTables_wrapper").offset().top
        }, 'fast');
    });

    $('#tableUsuarios').DataTable().columns().iterator('column', function (ctx, idx) {
        $($('#tableUsuarios').DataTable().column(idx).header()).append('<span class="sort-icon"/>');
    });
});
