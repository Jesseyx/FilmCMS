import React, { Component, PropTypes } from 'react';

const propTypes = {
    action: PropTypes.string.isRequired,
    method: PropTypes.string,
    data: PropTypes.object.isRequired,
    onSuccess: PropTypes.func.isRequired,
    onError: PropTypes.func.isRequired,
    children: PropTypes.node.isRequired,
}

class AjaxAnchor extends Component {
    constructor(props) {
        super(props);
        this.handleClick = this.handleClick.bind(this);
    }

    handleClick() {
        let { action, method, data, onSuccess, onError } = this.props;

        if (!method) {
            method = 'POST';
        }

        $.ajax({
            url: action,
            type: method,
            data,
            dataType: 'json',
        })
            .done(function (res) {
                if (res.status === 200) {
                    onSuccess(res, {
                        action,
                        method,
                        data
                    });
                } else {
                    onError(res, {
                        action,
                        method,
                        data,
                    })
                }
            })
            .fail(function (err) {
                onError(err, {
                    action,
                    method,
                    data,
                });
            })
    }

    render() {
        const { action, method, data, onSuccess, onError, children, ...props } = this.props;

        return (
            <a
                { ...props }
                onClick={ this.handleClick }
            >
                { children }
            </a>
        )
    }
}

AjaxAnchor.propTypes = propTypes;

export default AjaxAnchor;