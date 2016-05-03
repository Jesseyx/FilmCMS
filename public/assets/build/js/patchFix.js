(function ($) {
    $.ajaxSetup({
        // 默认添加请求头
       headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').prop('content'),
       }
    });
})(jQuery, window);