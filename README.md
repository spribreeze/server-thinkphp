## 安装

~~~
composer install
~~~

启动服务

~~~
php think run
~~~

然后就可以在浏览器中访问

~~~
http://localhost:8000
~~~

如果需要更新框架使用
~~~
composer update topthink/framework
~~~

#### .env配置

APP_DEBUG = true

DB_DRIVER=mysql
DB_TYPE = mysql
DB_HOST = 127.0.0.1
DB_NAME = php_server
DB_USER = root
DB_PASS = 123456
DB_PORT = 3306
DB_CHARSET = utf8

DEFAULT_LANG = zh-cn

JWT_SECRET_KEY=5f4dcc3b5aa765d61d8327deb882cf99a1b3c7b2e5d5f0a3c7a1b4c8e9d7f123