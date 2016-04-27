<?php

return [
    'movie' => [
        'text' => '影视管理',
        'icon' => 'fa-file-movie-o',
        'children' => [
            'movieList' => ['text' => '影片列表', 'href' => '#'],
            'movieCreate' => ['text' => '添加影片', 'href' => '#'],
            'channelList' => ['text' => '影视频道列表', 'href' => '#'],
            'channelCreate' => ['text' => '添加影视频道', 'href' => '#'],
            'subList' => ['text' => '影视子集列表', 'href' => '#'],
            'movieRankList' => ['text' => '影视排行榜列表', 'href' => '#'],
            'movieRankCreate' => ['text' => '添加影视排行榜数据', 'href' => '#'],
        ]
    ],
    'game' => [
        'text' => '游戏管理',
        'icon' => 'fa-gamepad',
        'children' => [
            'gameList' => ['text' => '游戏列表', 'href' => '#'],
            'gameCreate' => ['text' => '添加游戏', 'href' => '#'],
            'channelList' => ['text' => '游戏频道列表', 'href' => '#'],
            'channelCreate' => ['text' => '添加游戏频道', 'href' => '#'],
        ]
    ],
    'bannerChannel' => [
        'text' => '轮播图管理',
        'icon' => 'fa-file-image-o',
        'children' => [
            'list' => ['text' => '轮播图列表', 'href' => '#'],
            'create' => ['text' => '添加轮播图', 'href' => '#'],
        ]
    ],
    'column' => [
        'text' => '栏目管理',
        'icon' => 'fa-columns',
        'children' => [
            'columnList' => ['text' => '栏目列表', 'href' => '#'],
            'columnCreate' => ['text' => '添加栏目', 'href' => '#'],
            'contentList' => ['text' => '栏目内容列表', 'href' => '#'],
            'contentCreate' => ['text' => '添加栏目内容', 'href' => '#'],
        ]
    ],
    'userCenter' => [
        'text' => '用户中心',
        'icon' => 'fa-user',
        'children' => [
            'profile' => ['text' => '基本信息', 'href' => '/user/profile'],
            'password' => ['text' => '修改密码', 'href' => '/password/reset'],
        ]
    ],
    'userAuth' => [
        'text' => '用户权限管理',
        'icon' => 'fa-users',
        'children' => [
            'userList' => ['text' => '用户列表', 'href' => '#'],
            'addUser' => ['text' => '添加用户', 'href' => '#'],
            'roleList' => ['text' => '角色列表', 'href' => '#'],
            'addRole' => ['text' => '添加角色', 'href' => '#'],
            'authList' => ['text' => '权限列表', 'href' => '#'],
            'addAuth' => ['text' => '添加权限', 'href' => '#'],
            'groupList' => ['text' => '权限分组列表', 'href' => '#'],
            'addGroup' => ['text' => '添加权限分组', 'href' => '#'],

        ]
    ],
    'scripts' => [
        'text'=>'脚本管理',
        'icon' => 'fa-superscript',
        'children' => [
            'script' => ['text'=>'脚本', 'href' => '#']
        ]
    ],
];