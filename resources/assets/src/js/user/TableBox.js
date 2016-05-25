import React, { Component, PropTypes } from 'react';
import CommonTh from '../components/CommonTh';
import IconTh from '../components/IconTh';
import SortTh from '../components/SortTh';
import UserRow from './UserRow';

const propTypes = {
    data: PropTypes.array.isRequired,
    onSort: PropTypes.func.isRequired,
}

class TableBox extends Component {
    constructor(props) {
        super(props);
        this.onAsc = this.onAsc.bind(this);
        this.onDesc = this.onDesc.bind(this);
    }

    onAsc(field, sign) {
        this.props.onSort(field, sign);
    }

    onDesc(field, sign) {
        this.props.onSort(field, sign);
    }

    renderRows() {
        const { data } = this.props;
        
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
            <table className="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <CommonTh value="#id" />
                        <IconTh icon="user" value="姓名" />
                        <IconTh icon="image" value="头像" />
                        <IconTh icon="user" value="账号" />
                        <IconTh icon="mobile" value="手机" />
                        <IconTh icon="envelope" value="邮箱" />
                        <SortTh icon="edit" value="最近登录时间" field="last_login_at" onAsc={ this.onAsc } onDesc={ this.onDesc } />
                        <SortTh icon="edit" value="注册时间" field="created_at" onAsc={ this.onAsc } onDesc={ this.onDesc } />
                        <CommonTh value="最近登录IP" />
                        <CommonTh value="操作" />
                    </tr>
                </thead>

                <tbody>
                    { this.renderRows() }
                </tbody>
            </table>
        )
    }
}

TableBox.propTypes = propTypes;

export default TableBox;
