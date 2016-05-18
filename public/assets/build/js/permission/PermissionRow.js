import React, { Component, PropTypes } from 'react';
import CommonTd from '../components/CommonTd';
import EditTd from '../components/EditTd';
import OperationTd from './OperationTd';

const propTypes = {
    data: PropTypes.object.isRequired,
}

class PermissionRow extends Component {
    render() {
        const { data } = this.props;
        return (
            <tr>
                <CommonTd value={ data.id } />
                <EditTd name="name" action="http://localhost:8000/permission/ajax-edit" method="POST" type="" value={ data.name } data={{ id: data.id }} />
                <CommonTd value={ data.group.name } />
                <EditTd name="location" action="http://localhost:8000/permission/ajax-edit" value={ data.location } data={{ id: data.id }} type="area" />
                <EditTd name="description" action="http://localhost:8000/permission/ajax-edit" value={ data.description } data={{ id: data.id }} />
                <EditTd name="order" action="http://localhost:8000/permission/ajax-edit" value={ data.order } data={{ id: data.id }} />
                <CommonTd value={ data.created_at } />
                <CommonTd value={ data.updated_at } />
                <OperationTd action="http://localhost:8000/permission/ajax-edit" value={ data.status } data={{ id: data.id }} />
            </tr>
        )
    }
}

PermissionRow.propTypes = propTypes;

export default PermissionRow;
