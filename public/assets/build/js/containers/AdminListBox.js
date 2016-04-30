import React, { Component, PropTypes } from 'react';
import * as utils from '../utils';
import SearchBox from './SearchBox';
import TableBox from './TableBox';
import Pagination from './Pagination';

const propTypes = {
    className: PropTypes.string,
    dataUrl: PropTypes.string.isRequired
}

class AdminListBox extends Component {
    constructor(props) {
        super(props);

        this.state = {
            loading: true,
            data: [],
        }

        this.handleSearchClick = this.handleSearchClick.bind(this);
        this.handleSortClick = this.handleSortClick.bind(this);
        this.handlePageClick = this.handlePageClick.bind(this);
    }

    componentDidMount() {
        this.loadData();
    }

    loadData(query) {
        if (!query) {
            query = $(this.refs.form).serialize();
        }
        const { dataUrl } = this.props;
        const url = utils.concatUrl(dataUrl, query);
        console.log('url = ' + url);
        $.getJSON(url, function (json) {
            const results = json.data;

            this.setState({
                data: results.data,
                links: results.links,
                loading: false,
                per_page: results.per_page,
                query: query,
                total: results.total,
            });
        }.bind(this));
    }

    handleSearchClick() {
        const query = $(this.refs.form).serialize();

        if (query === this.state.query) {
            return;
        }

        this.loadData(query);
    }

    handleSortClick(field, sign) {
        const query = this.state.query + '&orderBy=' + field + ',' + sign;
        this.loadData(query);
    }

    renderPagination() {
        const { links, per_page, total } = this.state;
        if (!total) {
            return null;
        }

        return <Pagination links={ links } perPage={ per_page } total={ total } onPageClick={ this.handlePageClick } />
    }

    handlePageClick(url) {
        const query = utils.getSearch(url);
        this.loadData(query);
    }

    render() {console.log(this.state);
        const { className } = this.props;
        const { data, loading } = this.state;

        return (
            <div className={ className + ' table-content' }>
                <SearchBox>
                    <form className="form-inline" ref="form">
                        <div className="form-group">
                            <label htmlFor="status">状态：</label>
                            <select id="status" className="form-control" name="status">
                                <option value="">全部</option>
                                <option value="1">已启用</option>
                                <option value="-1">已禁用</option>
                            </select>
                        </div>
                        <div className="form-group">
                            <label htmlFor="userId">用户id：</label>
                            <input id="userId" className="form-control" type="text" name="id" placeholder="用户id：" />
                        </div>
                        <div className="form-group">
                            <label htmlFor="username">用户名：</label>
                            <input id="username" className="form-control" type="text" name="username" placeholder="用户名：" />
                        </div>
                        <div className="form-group">
                            <label htmlFor="name">姓名：</label>
                            <input id="name" className="form-control" type="text" name="name" placeholder="姓名：" />
                        </div>
                        <div className="form-group" style={{ marginLeft: '15px' }}>
                            <button className="btn btn-default" type="button" onClick={ this.handleSearchClick }>
                                <i className="fa fa-search"></i>
                                <span>&nbsp;搜索</span>
                            </button>
                        </div>
                    </form>
                </SearchBox>

                <TableBox data={ data } loading={ loading } onSort={ this.handleSortClick } />

                { this.renderPagination() }
            </div>
        )
    }
}

AdminListBox.propTypes = propTypes;

export default AdminListBox;
