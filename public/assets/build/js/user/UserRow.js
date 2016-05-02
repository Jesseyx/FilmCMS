import React, { Component, PropTypes } from 'react';
import CommonTd from '../components/CommonTd';
import EditTd from '../components/EditTd';
import ImageTd from '../components/ImageTd';

const propTypes = {
    data: PropTypes.object.isRequired,
}

class UserRow extends Component {
    render() {
        const { data } = this.props;
        return (
            <tr>
                <CommonTd value={ data.id } />
                <EditTd className="pointer" name="name" action="http://localhost:8000/user/ajax-edit" method="POST" type="" value={ data.name } data={{ id: data.id }} />
                <ImageTd className="pointer" value={ data.avatar } preview={ data.avatar } width="60" height="60" />
                <EditTd className="pointer" name="username" action="http://localhost:8000/user/ajax-edit" value={ data.username } data={{ id: data.id }} />
                <EditTd className="pointer" name="cellphone" action="http://localhost:8000/user/ajax-edit" value={ data.cellphone } data={{ id: data.id }} />
                <EditTd className="pointer" name="email" action="http://localhost:8000/user/ajax-edit" value={ data.email } data={{ id: data.id }} />
                <CommonTd value={ data.last_login_at } />
                <CommonTd value={ data.created_at } />
                <CommonTd value={ data.last_ip } />


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