import React, { Component, PropTypes } from 'react';

const propTypes = {
    className: PropTypes.string,
    value: PropTypes.string,
}

class EditTd extends Component {
    constructor(props) {
        super(props);

        this.state = {
            edit: false
        }
    }

    render() {
        const { className, value } = this.props;

        if (this.state.edit) {
            return (
                <td className={ className }>
                    <input value={ value } />
                </td>
            )
        }
        return (
            <td className={ className }>
                <p>{ this.props.value }</p>
            </td>
        )
    }
}

EditTd.propTypes = propTypes;

export default EditTd;