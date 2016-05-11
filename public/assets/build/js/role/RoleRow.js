import React, { Component, PropTypes } from 'react';
import CommonTd from '../components/CommonTd';
import EditTd from '../components/EditTd';
import OperationTd from './OperationTd';

const propTypes = {
    data: PropTypes.object.isRequired,
}

class UserRow extends Component {
    render() {
        const { data } = this.props;
        return (
            <tr>
                <CommonTd value={ data.id } />
                <EditTd className="pointer" name="name" action="http://localhost:8000/role/ajax-edit" method="POST" type="" value={ data.name } data={{ id: data.id }} />
                <EditTd className="pointer" name="description" action="http://localhost:8000/role/ajax-edit" value={ data.description } data={{ id: data.id }} />
                <EditTd className="pointer" name="order" action="http://localhost:8000/role/ajax-edit" value={ data.order } data={{ id: data.id }} />
                <CommonTd value={ data.created_at } />
                <CommonTd value={ data.updated_at } />
                <OperationTd className="btn btn-default" action="http://localhost:8000/role/ajax-edit" value={ data.status } data={{ id: data.id }} />
            </tr>
        )
    }
}

UserRow.propTypes = propTypes;

export default UserRow;
