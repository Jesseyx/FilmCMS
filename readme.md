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

2. 安装项目依赖。请确保 composer 正常安装
 ```
 // 进入目录
 $ cd FilmCMS/
 // 安装依赖
 $ composer install
 ```
 
3. 将 .env.example 复制一份为 .env，自行配置 mysql 数据库名（比如 film_cms），然后生成项目密钥
 ```
 $ php artisan key:generate
 ```
 
4. 导入表及测试数据
 ```
 $ php artisan migrate
 $ php artisan db:seed
 ```

5. 进入资源文件夹，安装依赖
 ```
 $ cd resources/assets/
 $ npm install
 ```

6. 构建前端代码
 ```
 $ gulp build
 // 以后可以进入调试模式
 $ gulp
 ```

7. 返回主目录，启动服务后访问 http://localhost:8000/ 即可
 ```
 $ php artisan serve
 ```
