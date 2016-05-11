<?php

return [
  'authority' => [
      'supers' => ['admin', 'root'],
      'ignores' => [
          ['location' => 'Home\Home@index', 'name' => '后台-访问主页'],
          ['location' => 'Auth\Auth@getLogout', 'name' => '授权-登出'],
          ['location' => 'User\User@getProfile', 'name' => '个人中心-查看个人资料'],
          ['location' => 'User\User@getEdit|User\User@postEdit', 'name' => '个人中心-编辑部分个人资料'],
          ['location' => 'Password\Password@getReset|Password\Password@postReset', 'name' => '个人中心-修改密码'],
      ]
  ]
];