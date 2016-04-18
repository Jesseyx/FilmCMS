<?php

return [
    'movie' => [
        'text' => '影视管理',
        'children' => [
            'movieList' => ['href' => '/movie/library', 'text' => '影片列表'],
            'movieCreate' => ['href' => '/movie/library/create', 'text' => '添加影片'],
            'channelList' => ['href' => '/movie/channel', 'text' => '影视频道列表'],
            'channelCreate' => ['href' => '/movie/channel/create', 'text' => '添加影视频道'],
            'subList' => ['href' => '/movie/sub', 'text' => '影视子集列表'],
            'movieRankList' => ['href' => '/movie/rank', 'text' => '影视排行榜列表'],
            'movieRankCreate' => ['href' => '/movie/rank/create', 'text' => '添加影视排行榜数据'],
        ]
    ],

    'game' => [
        'text' => '游戏管理',
        'children' => [
            'gameList' => ['href' => '/game/library', 'text' => '游戏列表'],
            'gameCreate' => ['href' => '/game/library/create', 'text' => '添加游戏'],
            'channelList' => ['href' => '/game/channel', 'text' => '游戏频道列表'],
            'channelCreate' => ['href' => '/game/channel/create', 'text' => '添加游戏频道'],
        ]
    ],

    'bannerChannel' => [
        'text' => '轮播图管理',
        'children' => [
            'list' => ['href' => '/banner', 'text' => '轮播图列表'],
            'create' => ['href' => '/banner/create', 'text' => '添加轮播图'],
        ]
    ],

    'column' => [
        'text' => '栏目管理',
        'children' => [
            'columnList' => ['href' => '/column', 'text' => '栏目列表'],
            'columnCreate' => ['href' => '/column/create', 'text' => '添加栏目'],
            'contentList' => ['href' => '/column/content', 'text' => '栏目内容列表'],
            'contentCreate' => ['href' => '/column/content/create', 'text' => '添加栏目内容'],
        ]
    ],

    'userCenter' => [
        'text' => '用户中心',
        'icon' => 'fa-user',
        'children' => [
            'profile' => ['href' => '/user/profile', 'text' => '基本信息'],
            'password' => ['href' => '/password/reset', 'text' => '修改密码'],
        ]
    ],

    'userAuth' => [
        'text' => '用户权限管理',
        'icon' => 'fa-users',
        'children' => [
            'userList' => ['href' => '/user', 'text' => '用户列表'],
            'addUser' => ['href' => '/user/create', 'text' => '添加用户'],
            'RoleList' => ['href' => '/role', 'text' => '角色列表'],
            'addRole' => ['href' => '/role/create', 'text' => '添加角色'],
            'authList' => ['href' => '/authority', 'text' => '权限列表'],
            'addAuth' => ['href' => '/authority/create', 'text' => '添加权限'],
            'groupList' => ['href' => '/auth-group', 'text' => '权限分组列表'],
            'addGroup' => ['href' => '/auth-group/create', 'text' => '添加权限分组'],
        ]
    ],

    'scripts' => [
        'text' => '脚本管理',
        'children' => [
            'script' => ['href' => '/script', 'text' => '脚本'],
        ]
    ]
];