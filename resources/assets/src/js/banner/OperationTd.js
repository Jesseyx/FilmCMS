import React, { Component, PropTypes } from 'react';
import AjaxAnchor from '../components/AjaxAnchor';

const propTypes = {
    value: PropTypes.number.isRequired,
    action: PropTypes.string.isRequired,
    data: PropTypes.object.isRequired,
    reload: PropTypes.func.isRequired,
}

class OperationTd extends Component {
    constructor(props) {
        super(props);

        this.state = {
            isVisible: props.value
        }

        this.handleSuccess = this.handleSuccess.bind(this);
        this.handleError = this.handleError.bind(this);
        this.handleTopSuccess = this.handleTopSuccess.bind(this);
    }

    renderOperation() {
        const { value, data, ...props } = this.props;
        const { isVisible } = this.state;
        let element;

        if (isVisible > 0) {
            element = <AjaxAnchor
                { ...props }
                className="btn btn-default"
                data={{ id: data.id, status: -1 }}
                onSuccess={ this.handleSuccess }
                onError={ this.handleError }
            >
                <i className="fa fa-arrow-down"></i>
                <span> 下架</span>
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
                <span> 上架</span>
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

    renderTop() {
        const { value, data, ...props } = this.props;
        return (
            <AjaxAnchor
                { ...props }
                className="btn btn-default"
                data={{ id: data.id, order: 9999 }}
                onSuccess={ this.handleTopSuccess }
                onError={ this.handleTopError }
                style={{ marginTop: '10px' }}
            >
                <i className="fa fa-arrow-circle-up"></i>
                <span> 置顶</span>
            </AjaxAnchor>
        )
    }

    handleTopSuccess(res, options) {
        const query = {
            orderBy: 'order,desc'
        }
        
        this.props.reload(query);
    }

    handleTopError(res, options) {

    }

    render() {
        const { data } = this.props;

        return (
            <td>
                <a
                    className="btn btn-default"
                    href={ '/user/' + data.id + '/edit' }
                    style={{ marginBottom: '10px' }}
                >
                    <i className="fa fa-edit"></i>
                    <span> 编辑</span>
                </a>

                { this.renderOperation() }
                { this.renderTop() }
            </td>
        )
    }
}

OperationTd.propTypes = propTypes;

export default OperationTd;
