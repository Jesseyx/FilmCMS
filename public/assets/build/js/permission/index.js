import React, { Component, Proptypes } from 'react';
import ReactDOM from 'react-dom';
import PermissionListBox from './PermissionListBox';

ReactDOM.render(
    <PermissionListBox className="table-responsive" dataUrl="http://localhost:8000/api/permission" />,
    document.getElementById('JAdminListBox')
);
