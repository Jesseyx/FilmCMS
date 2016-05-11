import React, { Component, PropTypes } from 'react';

const propTypes = {
    value: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.number,
    ]),
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
