(function ($, win) {
    $.ajaxSetup({
        // 默认添加请求头
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').prop('content'),
       }
    });
})(jQuery, window);

$(function () {
    $(document).on('click', '.J-go-back', function () {
        win.history.back();
    });

    (function () {
        var menuIndex = localStorage.menuIndex, menuSubIndex;
        if (menuIndex !== undefined) {
            menuSubIndex = localStorage.menuSubIndex || 0;
            $('#sidebarMenu').children().eq(menuIndex).addClass('active')
                .find('li').eq(menuSubIndex).addClass('active');
        }
    })();

    $('#sidebarMenu').on('click', '.treeview-menu li', function () {
        var $this = $(this),
            index = $this.parent().parent().index(),
            subIndex = $this.index();
        localStorage.menuIndex = index;
        localStorage.menuSubIndex = subIndex;
    })
})