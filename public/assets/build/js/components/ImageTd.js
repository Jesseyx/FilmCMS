import React, { Component, PropTypes } from 'react';

const propTypes = {
    className: PropTypes.string,
    value: PropTypes.string.isRequired,
}

class ImageTd extends Component {
    render() {
        const { className, value } = this.props;

        return (
            <td>
                <img className={ className } src={ value } width="60" height="60" />
            </td>
        )
    }
}

ImageTd.propTypes = propTypes;

export default ImageTd;