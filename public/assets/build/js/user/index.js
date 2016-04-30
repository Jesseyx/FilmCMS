import React, { Component, Proptypes } from 'react';
import ReactDOM from 'react-dom';
import UserListBox from './UserListBox';

ReactDOM.render(
    <UserListBox className="table-responsive" dataUrl="http://localhost:8000/api/user" />,
    document.getElementById('JAdminListBox')
);

