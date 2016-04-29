import React, { Component, PropTypes } from 'react';

const propTypes = {
    value: PropTypes.string.isRequired,
}

class CommonTh extends Component {
    render() {
        return (
            <th>
                { this.props.value }
            </th>
        )
    }
}

CommonTh.propTypes = propTypes;

export default CommonTh;