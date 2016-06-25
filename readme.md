# FilmCMS

**FilmCMS**一个影视后台管理系统。后台使用 Laravel 开发，前端使用 React 开发，用 webpack 和 gulp 进行前端资源构建，界面采用 admin-lte 模板。该项目仅供学习使用。

## 项目情况

目前开发完成的有：

  * 用户中心
  * 用户权限管理
  * 轮播图管理

其它栏目大同小异，后续将不再完善。


## Usage

 1. 签出项目
```
 $ git clone https://github.com/Jesseyx/FilmCMS.git
```

 2. 进入资源文件夹，安装依赖
```
 $ cd FilmCMS/resources/assets/
 $ npm install
```

 3. 构建前端代码
```
 $ gulp build
 // 以后可以进入调试模式
 $ gulp
```

 4. 返回主目录，安装 laravel 依赖，请确保 composer 和 laravel 正常安装
```
 $ composer install
```

 5. 启动服务后访问 http://localhost:8000/ 即可
```
 $ php artisan serve
```
