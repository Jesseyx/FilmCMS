import React, { Component, PropTypes } from 'react';

const propTypes = {
    value: PropTypes.any,
}

class CommonTd extends Component {
    render() {
        return (
            <td>
                { this.props.value }
            </td>
        )
    }
}

CommonTd.propTypes = propTypes;

export default CommonTd;