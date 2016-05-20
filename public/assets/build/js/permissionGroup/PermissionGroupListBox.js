import React, { Component, PropTypes } from 'react';
import SearchBox from './SearchBox';
import DataGrid from './DataGrid';

const propTypes = {
    className: PropTypes.string,
    dataUrl: PropTypes.string.isRequired
}

class PermissionGroupListBox extends Component {
    constructor(props) {
        super(props);

        this.state = {
            query: '',
        }

        this.handleSearchClick = this.handleSearchClick.bind(this);
    }

    handleSearchClick(query) {
        this.setState({
            query
        })
    }

    render() {
        const { className, dataUrl } = this.props;
        const { query } = this.state;

        return (
            <div className={ className + ' table-content' }>
                <SearchBox
                    query={ query }
                    onSearch={ this.handleSearchClick }
                />

                <DataGrid
                    dataUrl={ dataUrl }
                    query={ query }
                />
            </div>
        )
    }
}

PermissionGroupListBox.propTypes = propTypes;

export default PermissionGroupListBox;

