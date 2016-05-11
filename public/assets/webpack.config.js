var path = require('path');
var webpack = require('webpack');

module.exports = {
    devtool: 'source-map',
    // 根目录
    context: path.join(__dirname, 'build', 'js'),
    entry: {
        // user
        user_index: ['./user/index'],
        user_edit: ['./user/edit'],
        user_create: ['./user/create'],

        // role
        role_index: ['./role/index'],
    },
    output: {
        path: path.join(__dirname, 'dist', 'js'),
        filename: '[name].bundle.js',
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                loaders: ['babel'],
                exclude: /node_modules/,
            }
        ]
    },
    resolve: {
        alias: {
            'jquery': path.join('jquery', 'dist', 'jquery'),
        }
    }
}
