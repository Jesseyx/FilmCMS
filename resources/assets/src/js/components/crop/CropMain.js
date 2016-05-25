import React, { Component, PropTypes } from 'react';

const propTypes = {
    origin: PropTypes.object.isRequired,
    thumbnails: PropTypes.array,
    maxWidth: PropTypes.number.isRequired,
    maxHeight: PropTypes.number.isRequired,
    ratio: PropTypes.number.isRequired,
    selectAreaWidth: PropTypes.number,
    onSelect: PropTypes.func.isRequired,
}

class CropMain extends Component {
    constructor(props) {
        super(props);
        this.Jcrop = null;
    }

    componentDidMount() {
        const { ratio, maxWidth, maxHeight } = this.props;

        const $target = $(this.refs['crop-target']);
        const $cropContainer = $(this.refs['crop-container']);

        $target.load(() => {
            // 2.x 版本不知什么原因触发两次 load 事件，后面再研究，2.x 的版本 bug 太多了，退回 0.9.12 版本
            $target.unbind('load');

            this.adjustSize((finalSize) => {
                const _this = this;

                $target.Jcrop({
                    aspectRatio: ratio,
                    onChange: (c) => {
                        this.handleCropChange(c);
                    },
                    onSelect: (c) => {
                        this.handleCropSelect(c, finalSize);
                    }
                }, function () {
                    // 不能使用箭头函数
                    _this.Jcrop = this;
                    _this.initSelectionArea(finalSize);
                });
            });
        });
    }

    adjustSize(callback) {
        const { origin, maxWidth, maxHeight } = this.props;
        const image = new window.Image();
        const finalSize = {};

        image.onload = function () {
            const width = image.width,
                height = image.height;

            finalSize.width = width;
            finalSize.height = height;

            if (maxWidth / maxHeight > width / height) {
                // 总体用高来缩放
                if (height > maxHeight) {
                    finalSize.height = maxHeight;
                    finalSize.width = maxHeight / height * width;
                }
            } else {
                // 总体用宽来缩放
                if (width > maxWidth) {
                    finalSize.width = maxWidth;
                    finalSize.height = maxWidth / width * height;
                }
            }

            // 保存缩放比例，等比缩放的
            finalSize.scale = width / finalSize.width;

            const target = this.refs['crop-target'],
                targetParent = target.parentNode;
            target.style.width = finalSize.width + 'px';
            target.style.height = finalSize.height + 'px';
            targetParent.style.width = finalSize.width + 'px';
            targetParent.style.height = finalSize.height + 'px';

            callback && callback(finalSize);
        }.bind(this);

        image.src = origin.src;
    }

    initSelectionArea(finalSize) {
        const $target = $(this.refs['crop-target']),
            targetWidth = finalSize.width,
            targetHeight = finalSize.height;

        const { selectAreaWidth, ratio } = this.props;

        let relativeX, x, y, x1, y1;

        relativeX = selectAreaWidth / ratio;
        x = (targetWidth - relativeX) / 2;
        y = (targetHeight - relativeX) / 2;
        x1 = x + relativeX;
        y1 = y + relativeX;

        this.Jcrop.setSelect([x, y, x1, y1]);
    }

    handleCropChange(c) {
        const $thumbnailsContainer = $(this.refs['thumbnails-container']),
            $previewImages = $thumbnailsContainer.find('.thumbnail-img'),
            cropper = this.Jcrop;
        let $img, $container, pWidth, pHeight, rX, rY, bounds, boundX, boundY;

        // 先转化为整型
        if (~~c.w > 0 && cropper) {
            $previewImages.each((i, elem) => {
                $img = $(elem),
                $container = $img.parent(),
                pWidth = $container.width(),
                pHeight = $container.height(),
                rX = pWidth / c.w,
                rY = pHeight / c.h,
                bounds = cropper.getBounds(),
                boundX = bounds[0],
                boundY = bounds[1];

                $img.css({
                    width:  Math.round(rX * boundX) + 'px',
                    height: Math.round(rY * boundY) + 'px',
                    marginLeft: -Math.round(rX * c.x) + 'px',
                    marginTop: -Math.round(rY * c.y) + 'px',
                });
            });
        }
    }

    handleCropSelect(c, finalSize) {
        this.props.onSelect({
            x: c.x,
            y: c.y,
            w: c.w,
            h: c.h,
            scale: finalSize.scale
        });
    }

    renderThumbnailItems() {
        const { origin, thumbnails } = this.props;

        return thumbnails.map((thumbnail, i) => {
            return (
                <li
                    key={ i }
                >
                    <div
                        className="img-rounded"
                        style={{ width: thumbnail.width, height: thumbnail.height }}
                    >
                        <img className="thumbnail-img" src={ origin.src } />
                    </div>

                    <p >{ thumbnail.width }x{ thumbnail.height } </p>
                </li>
            )
        })
    }

    render() {
        const { origin } = this.props;

        return (
            <div>
                <div ref="crop-container" className="crop-origin-container">
                    <img ref="crop-target" className="origin-img" src={ origin.src } style={{ width: '1px', height: '1px' }} />
                </div>

                <div ref="thumbnails-container" className="crop-thumbnails-container">
                    <ul>
                        { this.renderThumbnailItems() }
                    </ul>
                </div>
            </div>
        )
    }
}

CropMain.propTypes = propTypes;

export default CropMain;
