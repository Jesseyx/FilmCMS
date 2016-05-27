import 'admin-lte/plugins/iCheck/icheck.min';
import 'admin-lte/plugins/iCheck/square/blue';

$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
});