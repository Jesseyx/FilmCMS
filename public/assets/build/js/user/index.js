import React, { Component, Proptypes } from 'react';
import ReactDOM from 'react-dom';
import AdminListBox from '../containers/AdminListBox';

ReactDOM.render(
    <AdminListBox dataUrl="http://localhost:8000/api/user" />,
    document.getElementById('JAdminListBox')
);

