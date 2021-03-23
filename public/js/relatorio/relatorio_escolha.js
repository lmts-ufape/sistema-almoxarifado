$(function() {
    document.getElementById('data_inicio').max = new Date(new Date().getTime() - new Date()
    .getTimezoneOffset() * 60000).toISOString().split("T")[0];

    document.getElementById('data_fim').max = new Date(new Date().getTime() - new Date()
    .getTimezoneOffset() * 60000).toISOString().split("T")[0];
});