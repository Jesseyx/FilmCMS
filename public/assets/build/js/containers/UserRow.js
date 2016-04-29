import React, { Component, PropTypes } from 'react';
import CommonTd from '../components/CommonTd';

const propTypes = {
    data: PropTypes.object.isRequired,
}

class UserRow extends Component {
    render() {
        const { data } = this.props;
        return (
            <tr>
                <CommonTd value={ data.id } />
                <td className="pointer">
                    <p>王名杰</p>
                </td>
                <td>
                    <img className="pointer" src="/assets/node_modules/admin-lte/dist/img/user2-160x160.jpg" width="60" height="60" />
                </td>
                <td className="pointer">
                    <p>wangmingjie</p>
                </td>
                <td className="pointer">
                    <p>13428282016</p>
                </td>
                <td className="pointer">
                    <p>929936389@qq.com</p>
                </td>
                <td></td>
                <td>-0001-11-30 00:00:00</td>
                <td></td>
                <td>
                    <a className="btn btn-default" href="/user/1/edit" target="_blank" style={{ marginBottom: '10px' }}>
                        <i className="fa fa-edit"></i>
                        <span> 编辑</span>
                    </a>
                    <a className="btn btn-default hide" href="#" method="post">
                        <i className="fa fa-arrow-up"></i>
                        <span> 启用</span>
                    </a>
                    <a className="btn btn-default" href="#" method="post">
                        <i className="fa fa-arrow-down"></i>
                        <span> 禁用</span>
                    </a>
                </td>
            </tr>
        )
    }
}

UserRow.propTypes = propTypes;

export default UserRow;