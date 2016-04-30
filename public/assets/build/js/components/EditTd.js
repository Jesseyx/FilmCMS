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

        this.handleEditClick = this.handleEditClick.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleEditClick() {
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
        const { value, props } = this.props;

        if (this.state.editing) {
            return (
                <td { ...props }>
                    <input
                        className="form-control"
                        defaultValue={ this.state.value }
                        onBlur={ this.handleSubmit }
                        ref="input"
                    />
                </td>
            )
        }
        return (
            <td
                { ...props }
                onClick={ this.handleEditClick }
            >
                <p>{ this.state.value }</p>
            </td>
        )
    }
}

EditTd.propTypes = propTypes;

export default EditTd;