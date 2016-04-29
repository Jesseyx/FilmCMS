import React, { Component, PropTypes } from 'react';

const propTypes = {
    icon: PropTypes.string,
    value: PropTypes.string.isRequired,
}

class SortTh extends Component {
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
                <a href="#" className="btn btn-danger">
                    <i className="fa fa-long-arrow-up"></i>
                </a>
                <a href="#" className="btn btn-primary">
                    <i className="fa fa-long-arrow-down"></i>
                </a>
            </th>
        )
    }
}

SortTh.propTypes = propTypes;

export default SortTh;