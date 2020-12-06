$(function () {
    $(".menuEffect").on("mouseenter", function () {
        $(this).css("background-color", "#3E3767");
    });

    $(".menuEffect").on("mouseleave", function () {
        $(this).css("background-color", " #151631");
    });

    $(".menuSupEInf").on("mouseenter", function () {
        $(this).css("background-color", "#151631");
    });

    $(".menuSupEInf").on("mouseleave", function () {
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