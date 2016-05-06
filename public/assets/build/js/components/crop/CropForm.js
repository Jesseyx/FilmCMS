import React, { Component, PropTypes } from 'react';

const propTypes = {
    area: PropTypes.object.isRequired,
}

class CropForm extends Component {
    render() {
        const { area } = this.props;

        return (
            <form ref="form">
                <input type="hidden" name="x" ref="x" value={ area.x } />
                <input type="hidden" name="y" ref="y" value={ area.y } />
                <input type="hidden" name="w" ref="w" value={ area.w } />
                <input type="hidden" name="h" ref="h" value={ area.h } />
            </form>
        )
    }
}

CropForm.propTypes = propTypes;

export default CropForm;