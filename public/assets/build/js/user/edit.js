$(function () {
    $('#JAvatarFile').fileupload({
        url: '/image/upload?type=user_avatar',
        dataType: 'json',
        autoUpload: true,
        formData: {},
        done: (e, data) => {
            var res = data.result;
            if (res && res.status === 200) {
                console.log(res);
            }
        }
    })
})