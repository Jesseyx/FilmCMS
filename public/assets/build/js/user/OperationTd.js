import React, { Component, PropTypes } from 'react';
import AjaxAnchor from '../components/AjaxAnchor';

const propTypes = {
    value: PropTypes.number.isRequired,
    action: PropTypes.string.isRequired,
    data: PropTypes.object.isRequired,
}

class OperationTd extends Component {
    constructor(props) {
        super(props);

        this.state = {
            isVisible: props.value
        }

        this.handleSuccess = this.handleSuccess.bind(this);
        this.handleError = this.handleError.bind(this);
    }

    renderOperation() {
        const { value, data, ...props } = this.props;
        const { isVisible } = this.state;
        let element;

        if (isVisible > 0) {;
            element = <AjaxAnchor
                { ...props }
                className="btn btn-default"
                data={{ id: data.id, status: -1 }}
                onSuccess={ this.handleSuccess }
                onError={ this.handleError }
            >
                <i className="fa fa-arrow-down"></i>
                <span> 禁用</span>
            </AjaxAnchor>
        } else {
            element = <AjaxAnchor
                { ...props }
                className="btn btn-default"
                data={{ id: data.id, status: 1 }}
                onSuccess={ this.handleSuccess }
                onError={ this.handleError }
            >
                <i className="fa fa-arrow-up"></i>
                <span> 启用</span>
            </AjaxAnchor>
        }

        return element;
    }

    handleSuccess(res, options) {
        return this.setState({
            isVisible: options.data.status,
        })
    }

    handleError(res, options) {
        return null;
    }

    render() {
        const { data } = this.props;

        return (
            <td>
                <a
                    className="btn btn-default"
                    href={ '/user/' + data.id + '/edit' }
                    target="_blank"
                    style={{ marginBottom: '10px' }}
                >
                    <i className="fa fa-edit"></i>
                    <span> 编辑</span>
                </a>

                { this.renderOperation() }
            </td>
        )
    }
}

OperationTd.propTypes = propTypes;

export default OperationTd;