$(function () {
    $(".menuEffect").hover(function () {
        $(this).css("background-color", "#3E3767");
    }, function () {
        $(this).css("background-color", " #151631");
    });
    $(".menuSupEInf").hover(function () {
        $(this).css("background-color", "#151631");
    }, function () {
        $(this).css("background-color", "#3E3767");
    });

    let selectedCollapse = sessionStorage.getItem('selectedCollapse');
    if (selectedCollapse != null) {
        $(selectedCollapse).addClass('show');
    }

    $('.selectedMenu').on('click', function () {
        let target = $(this).data('target');
        sessionStorage.setItem('selectedCollapse', target);
    });
});