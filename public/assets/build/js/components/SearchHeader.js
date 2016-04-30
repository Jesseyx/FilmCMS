import React, { Component, PropTypes } from 'react';

const propTypes = {
    value: PropTypes.string,
}

class SearchHeader extends Component {
    render() {
        const { value } = this.props;
        return (
            <div className="box-header with-border">
                <h3 className="box-title">{ value ? value : '搜索栏'}</h3>
                <div className="box-tools pull-right">
                    <button type="button" className="btn btn-box-tool" data-widget="collapse">
                        <i className="fa fa-minus"></i>
                    </button>
                </div>
            </div>
        )
    }
}

SearchHeader.propTypes = propTypes;

export default SearchHeader;