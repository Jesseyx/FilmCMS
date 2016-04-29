import React, { Component, PropTypes } from 'react';
import SearchBox from './SearchBox';
import TableBox from './TableBox';
import Pagination from './Pagination';

const propTypes = {
    className: PropTypes.string,
    dataUrl: PropTypes.string.isRequired
}

class AdminListBox extends Component {
    render() {
        const { className, dataUrl } = this.props;

        return (
            <div className={ className + ' table-content' }>
                <SearchBox>
                    <form className="form-inline">
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
                            <button className="btn btn-default" type="button">
                                <i className="fa fa-search"></i>
                                <span>&nbsp;搜索</span>
                            </button>
                        </div>
                    </form>
                </SearchBox>

                <TableBox dataUrl={ dataUrl }>
                    
                </TableBox>


                <Pagination>

                </Pagination>
            </div>
        )
    }
}

AdminListBox.propTypes = propTypes;

export default AdminListBox;
