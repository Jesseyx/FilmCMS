import React, { Component, PropTypes } from 'react';
import CommonTh from '../components/CommonTh';
import IconTh from '../components/IconTh';
import SortTh from '../components/SortTh';
import RoleRow from './RoleRow';

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
                <RoleRow data={ item } key={ item.id } />
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
                        <IconTh icon="life-saver" value="名称" />
                        <IconTh icon="won" value="描述" />
                        <SortTh icon="edit" value="排序" field="order" onAsc={ this.onAsc } onDesc={ this.onDesc } />
                        <SortTh icon="edit" value="创建时间" field="created_at" onAsc={ this.onAsc } onDesc={ this.onDesc } />
                        <SortTh icon="edit" value="修改时间" field="updated_at" onAsc={ this.onAsc } onDesc={ this.onDesc } />
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
