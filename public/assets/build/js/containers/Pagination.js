import React, { Component, PropTypes } from 'react';

const propTypes = {
    links: PropTypes.string.isRequired,
    perPage: PropTypes.number.isRequired,
    total: PropTypes.number.isRequired,
    onPageClick: PropTypes.func.isRequired,
}

class Pagination extends Component {
    constructor(props) {
        super(props);
        this.handleOnClick = this.handleOnClick.bind(this);
    }

    componentDidMount() {
        $(document).on('click', '.pagination a', this.handleOnClick);
    }

    componentWillUnmount() {
        $(document).unbind('click', '.pagination a');
    }

    handleOnClick(e) {
        e.preventDefault();
        const url = e.target.href;
        this.props.onPageClick(url);
    }

    render() {
        const { links, perPage, total } = this.props;
        return (
            <div className="pull-right">
                <p className="summary">
                    <span>共</span>
                    <span>{ total }</span>
                    <span>条数据</span>
                    <span>{ total < perPage ? 1 : Math.round(total / perPage) }</span>
                    <span>页，每页</span>
                    <span>{ perPage }</span>
                    <span>行</span>
                </p>
                <nav dangerouslySetInnerHTML={{ __html: this.props.links }}>
                </nav>
            </div>
        )
    }
}

Pagination.propTypes = propTypes;

export default Pagination;