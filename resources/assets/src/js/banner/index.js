import React, { Component, Proptypes } from 'react';
import ReactDOM from 'react-dom';
import BannerListBox from './BannerListBox';

ReactDOM.render(
    <BannerListBox className="table-responsive" dataUrl="http://localhost:8000/api/banner" />,
    document.getElementById('JAdminListBox')
);
