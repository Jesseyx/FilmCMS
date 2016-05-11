import React, { Component, Proptypes } from 'react';
import ReactDOM from 'react-dom';
import RoleListBox from './RoleListBox';

ReactDOM.render(
    <RoleListBox className="table-responsive" dataUrl="http://localhost:8000/api/role" />,
    document.getElementById('JAdminListBox')
);
