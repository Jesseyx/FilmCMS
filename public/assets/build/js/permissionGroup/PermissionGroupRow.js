import React, { Component, PropTypes } from 'react';
import CommonTd from '../components/CommonTd';
import EditTd from '../components/EditTd';
import OperationTd from './OperationTd';

const propTypes = {
    data: PropTypes.object.isRequired,
}

class PermissionGroupRow extends Component {
    render() {
        const { data } = this.props;
        return (
            <tr>
                <CommonTd value={ data.id } />
                <EditTd name="name" action="http://localhost:8000/permission-group/ajax-edit" method="POST" type="" value={ data.name } data={{ id: data.id }} />
                <EditTd name="order" action="http://localhost:8000/permission-group/ajax-edit" value={ data.order } data={{ id: data.id }} />
                <CommonTd value={ data.created_at } />
                <CommonTd value={ data.updated_at } />
                <OperationTd action="http://localhost:8000/permission-group/ajax-edit" value={ data.status } data={{ id: data.id }} />
            </tr>
        )
    }
}

PermissionGroupRow.propTypes = propTypes;

export default PermissionGroupRow;
