import React, { Component, PropTypes } from 'react';

const propTypes = {
    name: PropTypes.string.isRequired,
    action: PropTypes.string.isRequired,
    method: PropTypes.string,
    type: PropTypes.string,
    value: PropTypes.oneOfType([
        PropTypes.string,
        PropTypes.number,
    ]),
    data: PropTypes.object.isRequired,
}

class EditTd extends Component {
    constructor(props) {
        super(props);

        this.state = {
            editing: false,
            value: props.value,
            error: false,
            submitting: false,
        }

        this.handleDoubleClick = this.handleDoubleClick.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleDoubleClick() {
        this.setState({
            editing: true
        }, () => {
            this.refs.input.focus();
        })
    }

    handleSubmit(e) {
        let { name, action, method, data, value } = this.props;

        const text = e.target.value.trim();
        if (text === '' || text === value) {
            return this.setState({
                editing: false,
            })
        }
        // ajax 提交
        if (!method) method = 'POST';
        data[name] = text;

        $.ajax({
            url: action,
            type: method,
            data,
            dataType: 'json'
        })
            .done((res) => {
                if (res.status === 200) {
                    this.setState({
                        'editing': false,
                        'value': text,
                    })
                }
            })
            .fail((error) => {
                console.log(error);

                this.setState({
                    error: true
                })
            });
    }

    render() {
        // 对象的解构需要 babel-preset-stage 支持，stage-1 可以
        const { name, action, method, type, value, data,  ...props } = this.props;
        let element;

        if (this.state.editing) {
            if (type === 'area') {
                element = <textarea
                    className="form-control"
                    defaultValue={ this.state.value }
                    onBlur={ this.handleSubmit }
                    ref="input"
                />
            } else {
                element = <input
                    className="form-control"
                    defaultValue={ this.state.value }
                    onBlur={ this.handleSubmit }
                    ref="input"
                />
            }
        } else {
            element = <p>{ this.state.value }</p>;
        }

        return (
            <td
                className="pointer"
                { ...props }
                onDoubleClick={ this.handleDoubleClick }
            >
                { element }
            </td>
        )
    }
}

EditTd.propTypes = propTypes;

export default EditTd;
