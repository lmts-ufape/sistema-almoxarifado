$(function () {
    $('#tableDepositos').DataTable({
        searching: false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "info": "Exibindo página _PAGE_ de _PAGES_",
            "infoEmpty": "",
            "zeroRecords": "Selecione um depósito no campo direito superior",
            "paginate": {
                "previous": "Anterior",
                "next": "Próximo"
            }
        },
        "order": [],
        "columnDefs": [{
            "targets": [0, 1],
            "orderable": false
        }]
    });
});