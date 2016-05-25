import React, { Component, PropTypes } from 'react';

const propTypes = {
    icon: PropTypes.string,
    value: PropTypes.string.isRequired,
    field: PropTypes.string.isRequired,
    onAsc: PropTypes.func.isRequired,
    onDesc: PropTypes.func.isRequired,
}

class SortTh extends Component {
    constructor(props) {
        super(props);

        this.handleAscClick = this.handleAscClick.bind(this);
        this.handleDescClick = this.handleDescClick.bind(this);
    }

    concatClassName() {
        const { icon } = this.props;
        if (!icon) {
            return 'fa';
        }

        return `fa fa-${ icon }`;
    }

    handleAscClick(e) {
        e.preventDefault();
        const { field } = this.props;
        this.props.onAsc(field, 'asc');
    }

    handleDescClick(e) {
        e.preventDefault();
        const { field } = this.props;
        this.props.onDesc(field, 'desc');
    }

    render() {
        const { value } = this.props;
        return (
            <th>
                <i className={ this.concatClassName() }></i>
                <span>{ value }</span>
                <a href="#"
                   className="btn btn-danger"
                   onClick={ this.handleAscClick }
                >
                    <i className="fa fa-long-arrow-up"></i>
                </a>
                <a href="#"
                   className="btn btn-primary"
                   onClick={ this.handleDescClick }
                >
                    <i className="fa fa-long-arrow-down"></i>
                </a>
            </th>
        )
    }
}

SortTh.propTypes = propTypes;

export default SortTh;
