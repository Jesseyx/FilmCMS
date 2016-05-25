import React, { Component, PropTypes } from 'react';

const propTypes = {
    value: PropTypes.string.isRequired,
    preview: PropTypes.string,
}

class ImageTd extends Component {
    constructor(props) {
        super(props);

        this.handleClick = this.handleClick.bind(this);
    }
    handleClick() {
        const { preview } = this.props;
        if (!this.$preview) {
            this.$preview = $('<div class="modal fade" style="text-align: center;"><div class="modal-dialog" style="min-width: 700px; min-height: 400px; width: auto;text-align: center; display: inline-block;"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> <h4 class="modal-title">查看大图</h4> </div><div class="modal-body" style="overflow-x: auto; padding: 0;" ><img /></div><div class="modal-footer"> <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button></div></div></div></div>');
            this.$preview.find('img').prop('src', preview);
        }

        this.$preview.modal();
    }

    render() {
        const { value, preview, ...props } = this.props;
        let element;
        if (preview) {
            element = <img
                className="pointer"
                { ...props }
                src={ value }
                onClick={ this.handleClick }
            />
        } else {
            element = <img
                { ...props }
                src={ value }
            />
        }

        return (
            <td>
                { element }
            </td>
        )
    }
}

ImageTd.propTypes = propTypes;

export default ImageTd;
