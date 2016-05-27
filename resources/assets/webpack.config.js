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
        // path: path.join(__dirname, '..', '..', 'public', 'assets', 'js'),
        filename: '[name].bundle.js',
    },
    module: {
        loaders: [
            {
                test: /\.js$/,
                loaders: ['babel'],
                exclude: /node_modules/,
            },

            {
                test: /\.css$/,
                loaders: ['style', 'css'],
            },

            {
                test: /\.(jpg|png|gif)$/,
                loader: 'url?limit=10000',
            }
        ]
    },
    resolve: {
        // 猜测文件的后戳
        extensions: ['', '.js', '.css'],
        alias: {
            // 配置别名，不然上传插件找不到
            'jquery.ui.widget': 'blueimp-file-upload/js/vendor/jquery.ui.widget'
        }
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
    ],
}
