import 'blueimp-file-upload';
import '../../vendor/js/Jcrop-v0.9.12/js/jquery.Jcrop';
import '../../vendor/js/Jcrop-v0.9.12/css/jquery.Jcrop';

import React from 'react';
import ReactDOM from 'react-dom';
import CropImage from '../components/crop';

import config from '../config/Banner';

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
        const id = $('#source_id').val();
        if (!id) {
            return;
        }

        const type = +$('#resource_type').val();
        let url = '';

        if (type === 3) {
            // h5
            return;
        } else if (type === 1) {
            url = '/api/movie/library/' + id;
        } else if (type === 2) {
            url = '/api/game/library' + id;
        } else {
            return;
        }

        $.getJSON(url, {})
            .done((res) => {
                if (res.status !== 200) {
                    return;
                }

                const data = res.data;
                $('#title').val(data.title);
                if (type === 1) {
                    $('#sub_title').val(data.attract);
                } else {
                    $('#sub_title').val(data.sub_title);
                }
            })
    });
})
