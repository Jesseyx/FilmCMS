import React, { Component, PropTypes } from 'react';

const propTypes = {
    icon: PropTypes.string,
    value: PropTypes.string.isRequired,
}

class IconTh extends Component {
    concatClassName() {
        const { icon } = this.props;
        if (!icon) {
            return 'fa';
        }

        return `fa fa-${ icon }`;
    }

    render() {
        const { value } = this.props;
        return (
            <th>
                <i className={ this.concatClassName() }></i>
                <span>{ value }</span>
            </th>
        )
    }
}

IconTh.propTypes = propTypes;

export default IconTh;