import React, { Component, PropTypes } from 'react';

const propTypes = {

}

class Pagination extends Component {
    render() {
        return (
            <div className="pull-right">
                <p className="summary">
                    <span>共</span>
                    <span>66</span>
                    <span>条数据</span>
                    <span>4</span>
                    <span>页，每页</span>
                    <span>20</span>
                    <span>行</span>
                </p>
                <nav>
                    <ul className="pagination">
                        <li className="disabled">
                            <span>&laquo;</span>
                        </li>
                        <li className="active">
                            <span>1</span>
                        </li>
                        <li>
                            <a href="#">2</a>
                        </li>
                        <li>
                            <a href="#">3</a>
                        </li>
                        <li>
                            <a href="#">4</a>
                        </li>
                        <li>
                            <a href="#" rel="next">&raquo;</a>
                        </li>
                    </ul>
                </nav>
            </div>
        )
    }
}

Pagination.propTypes = propTypes;

export default Pagination;