import 'blueimp-file-upload';
import '../../vendor/js/Jcrop-v0.9.12/js/jquery.Jcrop';
import '../../vendor/js/Jcrop-v0.9.12/css/jquery.Jcrop';

import React from 'react';
import ReactDOM from 'react-dom';
import CropImage from '../components/crop';

$(function () {
    $('#JBannerImgFile').fileupload({
        url: '/image/upload?type=banner_carousel',
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
                        width: 108,
                        height: 45,
                    },
                    {
                        width: 360,
                        height: 150,
                    }
                ];

                const container = document.getElementById('cropContainer');
                ReactDOM.render(
                    <CropImage
                        origin={ origin }
                        maxWidth={ 500 }
                        maxHeight={ 500 }
                        selectAreaWidth={ 108 }
                        ratio={ 2.4 }
                        action='http://localhost:8000/image/crop'
                        data={{ type: 'banner_carousel' }}
                        thumbnails={ thumbnails }
                        success={
                            (res) => {
                                $('#bannerImgInput').val(res.data.url).prev('img').prop('src', res.data.url);
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

    $('#btnGetSourceId').bind('click', function () {
        alert('稍后再做');
    });
})
