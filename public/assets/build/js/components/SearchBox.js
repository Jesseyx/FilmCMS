import React, { Component, PropTypes } from 'react';

const propTypes = {
    children: PropTypes.node,
}

class SearchBox extends Component {
    render() {
        return (
            <div className="box box-success box-solid">
                <div className="box-header with-border">
                    <h3 className="box-title">搜索栏</h3>
                    <div className="box-tools pull-right">
                        <button type="button" className="btn btn-box-tool" data-widget="collapse">
                            <i className="fa fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div className="box-body">
                    { this.props.children }
                </div>
            </div>
        )
    }
}

SearchBox.propTypes = propTypes;

export default SearchBox;