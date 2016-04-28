import React, { Component, PropTypes } from 'react';

const propTypes = {

}

class TableBox extends Component {
    render() {
        return (
            <div className="box">
                <div className="overlay" style={{ display: 'none' }}>
                    <i className="fa fa-refresh fa-spin"></i>
                </div>
                
                <table className="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#id</th>
                            <th>
                                <i className="fa fa-edit"></i>
                                <span>姓名</span>
                            </th>
                            <th>
                                <i className="fa fa-hand-pointer-o"></i>
                                <span>头像</span>
                            </th>
                            <th>
                                <i className="fa fa-edit"></i>
                                <span>账号</span>
                            </th>
                            <th>
                                <i className="fa fa-edit"></i>
                                <span>手机</span>
                            </th>
                            <th>
                                <i className="fa fa-edit"></i>
                                <span>邮箱</span>
                            </th>
                            <th>
                                <i className="fa fa-edit"></i>
                                <span>最近登录时间</span>
                                <a href="#" className="btn btn-danger">
                                    <i className="fa fa-long-arrow-up"></i>
                                </a>
                                <a href="#" className="btn btn-primary">
                                    <i className="fa fa-long-arrow-down"></i>
                                </a>
                            </th>
                            <th>
                                <i className="fa fa-edit"></i>
                                <span>注册时间</span>
                                <a href="#" className="btn btn-danger">
                                    <i className="fa fa-long-arrow-up"></i>
                                </a>
                                <a href="#" className="btn btn-primary">
                                    <i className="fa fa-long-arrow-down"></i>
                                </a>
                            </th>
                            <th>最近登录</th>
                            <th>操作</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td className="pointer">
                                <p className="mh-225" style={{ padding: '0 12px', margin: 0 }}>王名杰</p>
                            </td>
                            <td>
                                <img className="pointer" src="/assets/node_modules/admin-lte/dist/img/user2-160x160.jpg" width="60" height="60" />
                            </td>
                            <td className="pointer">
                                <p className="mh-225" style={{ padding: '0 12px', margin: 0 }}>wangmingjie</p>
                            </td>
                            <td className="pointer">
                                <p className="mh-225" style={{ padding: '0 12px', margin: 0 }}>13428282016</p>
                            </td>
                            <td className="pointer">
                                <p className="mh-225" style={{ padding: '0 12px', margin: 0 }}>929936389@qq.com</p>
                            </td>
                            <td></td>
                            <td>-0001-11-30 00:00:00</td>
                            <td></td>
                            <td>
                                <a className="btn btn-default" href="/user/1/edit" target="_blank" style={{ marginBottom: '10px' }}>
                                    <i className="fa fa-edit"></i>
                                    <span> 编辑</span>
                                </a>
                                <a className="btn btn-default hide" href="#" method="post">
                                    <i className="fa fa-arrow-up"></i>
                                    <span> 启用</span>
                                </a>
                                <a className="btn btn-default" href="#" method="post">
                                    <i className="fa fa-arrow-down"></i>
                                    <span> 编辑</span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        )
    }
}

TableBox.propTypes = propTypes;

export default TableBox;