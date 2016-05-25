import React, { Component, PropTypes } from 'react';

const propTypes = {
    useDefault: PropTypes.bool,
    data: PropTypes.array.isRequired,
}

class Select extends Component {
    renderDefault() {
        let { useDefault } = this.props;
        // 默认显示
        useDefault = typeof useDefault === 'undefined' ? true : useDefault;

        if (!useDefault) {
            return null;
        }

        return (
            <option value="">全部</option>
        )
    }

    renderItems() {
        const { data } = this.props;

        return data.map((item) => {
            return (
                <option key={ item.value } value={ item.value }>{ item.name }</option>
            )
        })
    }

    render() {
        const { useDefault, data, ...props } = this.props;

        return (
            <select { ...props }>
                { this.renderDefault() }
                { this.renderItems() }
            </select>
        )
    }
}

Select.propTypes = propTypes;

export default Select;
