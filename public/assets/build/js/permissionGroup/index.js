import React, { Component, Proptypes } from 'react';
import ReactDOM from 'react-dom';
import PermissionGroupListBox from './PermissionGroupListBox';

ReactDOM.render(
    <PermissionGroupListBox className="table-responsive" dataUrl="http://localhost:8000/api/permission-group" />,
    document.getElementById('JAdminListBox')
);
