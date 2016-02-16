**Memcached 安装**

Redhat/Fedora/Centos：

yum install memcached

**Memcached 运行**

作为后台服务程序运行：

/usr/local/memcached/bin/memcached -p 11211 -m 64m -d

注意：如果使用自动安装 memcached 命令位于 /usr/local/bin/memcached。

启动选项：

-d是启动一个守护进程；

-m是分配给Memcache使用的内存数量，单位是MB；

-u是运行Memcache的用户；

-l是监听的服务器IP地址，可以有多个地址；

-p是设置Memcache监听的端口，，最好是1024以上的端口；

-c是最大运行的并发连接数，默认是1024；

-P是设置保存Memcache的pid文件。

----------

**PHP Memcache 扩展安装**

wget http://pecl.php.net/get/memcache-2.2.7.tgz

tar -zxvf memcache-2.2.7.tgz

cd memcache-2.2.7

/usr/local/php/bin/phpize

./configure --with-php-config=/usr/local/php/bin/php-config

make && make install

注意：/usr/local/php/ 为php的安装路径，需要根据你安装的实际目录调整。

安装成功后会显示你的memcache.so扩展的位置，比如我的：

Installing shared extensions:     /usr/local/php/lib/php/extensions/no-debug-non-zts-20090626/

最后我们需要把这个扩展添加到php中，打开你的php.ini文件在最后添加以下内容：

[Memcache]

extension_dir = "/usr/local/php/lib/php/extensions/no-debug-non-zts-20090626/"

extension = memcache.so

添加完后 重新启动php,我使用的是nginx+php-fpm进程所以命令如下：

kill -USR2 `cat /usr/local/php/var/run/php-fpm.pid`

如果是apache的使用以下命令:

/usr/local/apache2/bin/apachectl restart

检查安装结果

/usr/local/php/bin/php -m | grep memcache

安装成功会输出：memcache。

或者通过浏览器访问 phpinfo() 函数来查看

**PHP 连接 Memcached**

<?php

$memcache = new Memcache;             //创建一个memcache对象

$memcache->connect('localhost', 11211) or die ("Could not connect"); //连接Memcached服务器

$memcache->set('key', 'test');        //设置一个变量到内存中，名称是key 值是test

$get_value = $memcache->get('key');   //从内存中取出key的值

echo $get_value;
