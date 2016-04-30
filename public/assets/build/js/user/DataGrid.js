import React, { Component, PropTypes } from 'react';
import * as utils from '../utils';
import Loading from '../components/Loading';
import TableBox from './TableBox';
import Pagination from '../components/Pagination';

const propTypes = {
    dataUrl: PropTypes.string.isRequired,
    query: PropTypes.string,
}

class DataGrid extends Component {
    constructor(props) {
        super(props);

        this.state = {
            loading: true,
            data: [],
        }

        this.handleSortClick = this.handleSortClick.bind(this);
        this.handlePageClick = this.handlePageClick.bind(this);
    }

    componentDidMount() {
        this.loadData(this.props.query);
    }

    componentWillReceiveProps(nextProps) {
        this.setState({
            loading: true,
        })
        this.loadData(nextProps.query);
    }

    loadData(query) {
        const { dataUrl } = this.props;
        const url = utils.concatUrl(dataUrl, query);

        $.getJSON(url, function (json) {
            const results = json.data;

            this.setState({
                data: results.data,
                links: results.links,
                loading: false,
                per_page: results.per_page,
                total: results.total,
            });
        }.bind(this));
    }

    handleSortClick(field, sign) {
        this.setState({
            loading: true,
        })
        const query = this.state.query + '&orderBy=' + field + ',' + sign;
        this.loadData(query);
    }

    renderPagination() {
        const { links, per_page, total } = this.state;
        if (!total) {
            return null;
        }

        return <Pagination links={ links } perPage={ per_page } total={ total } onPageClick={ this.handlePageClick } />
    }

    handlePageClick(url) {
        this.setState({
            loading: true,
        })
        const query = utils.getSearch(url);
        this.loadData(query);
    }

    render() {
        const { loading, data } = this.state;

        return (
            <div>
                <div className="box">
                    <Loading show={ loading } />

                    <TableBox data={ data } onSort={ this.handleSortClick } />
                </div>

                { this.renderPagination() }
            </div>
        )
    }
}

DataGrid.propTypes = propTypes;

export default DataGrid;