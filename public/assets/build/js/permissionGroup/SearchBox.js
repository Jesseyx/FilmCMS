import React, { Component, PropTypes } from 'react';
import SearchHeader from '../components/SearchHeader';
import Select from '../components/Select';
import config from '../config/PermissionGroup';

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
                            <Select id="status" className="form-control" name="status" data={ config.status } />
                        </div>
                        <div className="form-group">
                            <label htmlFor="name">名称：</label>
                            <input id="name" className="form-control" type="text" name="name" placeholder="权限分组名称" />
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
