import React, { Component, PropTypes } from 'react';

const propTypes = {
    show: PropTypes.bool.isRequired,
}

class Loading extends Component {
    render() {
        return (
            <div className="overlay" style={{ display: this.props.show ? 'block' : 'none'  }}>
                <i className="fa fa-refresh fa-spin"></i>
            </div>
        )
    }
}

Loading.propTypes = propTypes;

export default Loading;