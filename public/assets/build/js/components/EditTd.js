import React, { Component, PropTypes } from 'react';

const propTypes = {
    className: PropTypes.string,
    value: PropTypes.string,
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
        var value = e.target.value.trim();
        if (value === '' || value === this.props.value) {
            return this.setState({
                editing: false,
            })
        }
        //
        console.log('ajax submit!');
        this.setState({
            editing: false,
            value,
        })
    }

    render() {
        // 对象的解构需要 babel-preset-stage 支持，stage-1 可以
        const { value, ...props } = this.props;
        let element;

        if (this.state.editing) {
            element = <input
                className="form-control"
                defaultValue={ this.state.value }
                onBlur={ this.handleSubmit }
                ref="input"
            />
        } else {
            element = <p>{ this.state.value }</p>;
        }

        return (
            <td
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