import React, { Component, PropTypes } from 'react';
import CommonTd from '../components/CommonTd';
import EditTd from '../components/EditTd';
import ImageTd from '../components/ImageTd';
import OperationTd from './OperationTd';

const propTypes = {
    data: PropTypes.object.isRequired,
    reload: PropTypes.func.isRequired,
}

class BannerRow extends Component {
    render() {
        const { data, reload } = this.props;
        return (
            <tr>
                <CommonTd value={ data.id } />
                <EditTd name="title" action="http://localhost:8000/banner/ajax-edit" method="POST" type="" value={ data.title } data={{ id: data.id }} />
                <ImageTd value={ data.img_url } preview={ data.img_url } width="108" height="45" />
                <EditTd name="description" action="http://localhost:8000/banner/ajax-edit" value={ data.description } data={{ id: data.id }} />
                <CommonTd value={ data.up_time } />
                <CommonTd value={ data.down_time } />
                <EditTd name="order" action="http://localhost:8000/banner/ajax-edit" value={ data.order } data={{ id: data.id }} />
                <OperationTd action="http://localhost:8000/banner/ajax-edit" value={ data.status } data={{ id: data.id }} reload={ reload } />
            </tr>
        )
    }
}

BannerRow.propTypes = propTypes;

export default BannerRow;
