import React, { Component, PropTypes } from 'react';
import CommonTh from '../components/CommonTh';
import IconTh from '../components/IconTh';
import SortTh from '../components/SortTh';
import UserRow from '../containers/UserRow';

const propTypes = {
    data: PropTypes.array.isRequired,
    loading: PropTypes.bool.isRequired,
}

class TableBox extends Component {

    renderLoading() {
        const { loading } = this.props;

        return (
            <div className="overlay" style={{ display: loading ? 'block' : 'none'  }}>
                <i className="fa fa-refresh fa-spin"></i>
            </div>
        )
    }

    renderRows() {
        const { data } = this.props;
        console.log(data);
        if (!data.length) return null;
        const rows = data.map(item => {
            return (
                <UserRow data={ item } key={ item.id } />
            )
        });

        return rows;
    }

    render() {
        return (
            <div className="box">
                { this.renderLoading() }
                
                <table className="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <CommonTh value="#id" />
                            <IconTh icon="user" value="姓名" />
                            <IconTh icon="image" value="头像" />
                            <IconTh icon="user" value="账号" />
                            <IconTh icon="mobile" value="手机" />
                            <IconTh icon="envelope" value="邮箱" />
                            <SortTh icon="edit" value="最近登录时间" />
                            <SortTh icon="edit" value="注册时间" />
                            <CommonTh value="最近登录IP" />
                            <CommonTh value="操作" />
                        </tr>
                    </thead>

                    <tbody>
                        { this.renderRows() }
                    </tbody>
                </table>
            </div>
        )
    }
}

TableBox.propTypes = propTypes;

export default TableBox;