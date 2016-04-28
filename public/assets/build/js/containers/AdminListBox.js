import React, { Component, PropTypes } from 'react';
import SearchBox from '../components/SearchBox';

const propTypes = {

}

class AdminListBox extends Component {
    render() {
        return (
            <div className="table-responsive">
                <SearchBox>
                    <form className="form-inline">
                        <div className="form-group">
                            <label for="status">状态：</label>
                            <select id="status" className="form-control" name="status">
                                <option value="">全部</option>
                                <option value="1">已启用</option>
                                <option value="-1">已禁用</option>
                            </select>
                        </div>
                        <div className="form-group">
                            <label for="userId">用户id：</label>
                            <input id="userId" className="form-control" type="text" name="id" placeholder="用户id：" />
                        </div>
                        <div className="form-group">
                            <label for="username">用户名：</label>
                            <input id="username" className="form-control" type="text" name="username" placeholder="用户名：" />
                        </div>
                        <div className="form-group">
                            <label for="name">姓名：</label>
                            <input id="name" className="form-control" type="text" name="name" placeholder="姓名：" />
                        </div>
                        <div className="form-group" style={{ marginLeft: '15px' }}>
                            <button className="btn btn-default" type="button">
                                <i className="fa fa-search"></i>
                                <span>&nbsp;搜索</span>
                            </button>
                        </div>
                    </form>
                </SearchBox>
            </div>
        )
    }
}

AdminListBox.propTypes = propTypes;

export default AdminListBox;
