import React, { Component, PropTypes } from 'react';
import ReactDOM from 'react-dom';
import CropForm from './CropForm';
import CropMain from './CropMain';

const propTypes = {
    // 元数据
    origin: PropTypes.object.isRequired,
    // POST 地址
    action: PropTypes.string.isRequired,
    // 附加的数据
    data: PropTypes.object,
    // 所需的缩略图
    thumbnails: PropTypes.array,
    // 成功回调
    success: PropTypes.func.isRequired,
    // 失败回调
    fail: PropTypes.func.isRequired,
    // 裁减对象的最大宽高
    maxWidth: PropTypes.number.isRequired,
    maxHeight: PropTypes.number.isRequired,
    // 要裁减的宽高比
    ratio: PropTypes.number.isRequired,
    // 默认的选择区域宽度，默认是正方形
    selectAreaWidth: PropTypes.number,
}

class CropImage extends Component {
    constructor(props) {
        super(props);

        this.state = {
            submitting: false,
            area: {
                x: 0,
                y: 0,
                w: 0,
                h: 0,
            }
        }
    }


    componentDidMount() {
        const $modal = $(this.refs.modal);

        $modal.modal().on('hidden.bs.modal', () => {
            // 箭头函数无需绑定 this
            ReactDOM.unmountComponentAtNode(this.refs.modal.parentNode);
        });
    }

    render() {
        const { origin, action, data, thumbnails, success, fail, maxWidth, maxHeight, ratio, selectAreaWidth, ...props } = this.props;
        const { submitting, area } = this.state;

        return (
            <div className="modal" { ...props } ref="modal">
                <div className="modal-dialog">
                    <div className="modal-content">
                        <div className="modal-header">
                            <button className="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 className="modal-title">图片裁剪</h4>
                        </div>

                        <div className="modal-body">
                            <CropForm area={ area } />
                            <CropMain
                                origin={ origin }
                                thumbnails={ thumbnails }
                                maxWidth={ maxWidth }
                                maxHeight={ maxHeight }
                                ratio={ ratio }
                                selectAreaWidth={ selectAreaWidth }
                            />
                        </div>

                        <div className="modal-footer">
                            <button className="btn btn-default" type="button" data-dismiss="modal">关闭</button>
                            <button
                                className={ "btn btn-primary" + (submitting ? ' disabled' : '') }
                                type="button">
                                裁切{ submitting ? '中...' : '' }
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

CropImage.propTypes = propTypes;

export default CropImage;