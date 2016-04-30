import React, { Component, PropTypes } from 'react';
import SearchHeader from '../components/SearchHeader';

const propTypes = {
    query: PropTypes.string,
    onSearch: PropTypes.func.isRequired,
}

class SearchBox extends Component {
    constructor(props) {
        super(props);

        this.handleSearchClick = this.handleSearchClick.bind(this);
    }

    handleSearchClick() {
        const query = $(this.refs.form).serialize();

        if (query === this.props.query) {
            return;
        }

        this.props.onSearch(query);
    }

    render() {
        return (
            <div className="box box-success box-solid">
                <SearchHeader />
                <div className="box-body">
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
                </div>
            </div>
        )
    }
}

SearchBox.propTypes = propTypes;

export default SearchBox;