var path = require('path');
var webpack = require('webpack');

module.exports = {
    devtool: 'cheap-source-map',
    // 根目录
    context: path.join(__dirname, 'src', 'js'),
    entry: {
        // 库
        vendor: ['./vendor'],
        // IE fix
        ieShim: ['./ieShim'],
        
        // user
        user_index: ['./user/index'],
        user_edit: ['./user/edit'],
        user_create: ['./user/create'],

        // role
        role_index: ['./role/index'],
        role_edit: ['./role/edit'],
        role_create: ['./role/create'],

        // permission
        permission_index: ['./permission/index'],

        // permissionGroup
        permissionGroup_index: ['./permissionGroup/index'],
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
    plugins: [
        new webpack.optimize.CommonsChunkPlugin({
            name: 'vendor',
            filename: 'vendor.js',
        }),
        new webpack.ProvidePlugin({
            $: 'jquery',
            jQuery: 'jquery',
            'window.jQuery': 'jquery',
        })
    ]
}
