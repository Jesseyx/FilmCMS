import 'blueimp-file-upload';
import '../../../vendor/Jcrop-v0.9.12/js/jquery.Jcrop';
import '../../../vendor/Jcrop-v0.9.12/css/jquery.Jcrop';

import React from 'react';
import ReactDOM from 'react-dom';
import CropImage from '../components/crop';

$(function () {
    $('#JAvatarFile').fileupload({
        url: '/image/upload?type=user_avatar',
        dataType: 'json',
        autoUpload: true,
        formData: {},
        done: (e, data) => {
            const res = data.result;
            if (res && res.status === 200) {
                const origin = {
                    id: res.data.id,
                    src: res.data.url,
                };

                const thumbnails = [
                    {
                        width: 50,
                        height: 50,
                    },
                    {
                        width: 80,
                        height: 80,
                    },
                    {
                        width: 100,
                        height: 100,
                    },
                    {
                        width: 160,
                        height: 160,
                    }
                ];

                const container = document.getElementById('cropContainer');
                ReactDOM.render(
                    <CropImage
                        origin={ origin }
                        maxWidth={ 500 }
                        maxHeight={ 500 }
                        selectAreaWidth={ 100 }
                        ratio={ 1 }
                        action='http://localhost:8000/image/crop'
                        data={{ type: 'user_avatar' }}
                        thumbnails={ thumbnails }
                        success={
                            (res) => {
                                $('#avatarInput').val(res.data.url).prev('img').prop('src', res.data.url);
                            }
                        }
                        fail={
                            (err) => {
                                console.log(err);
                            }
                        }
                    />,
                    container,
                );
            }
        }
    })
})
