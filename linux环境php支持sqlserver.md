**Linux环境PHP5.5以上连接SqlServer2008**

1.安装FreeTDS

FreeTDS是一个让Unix跟Liunx访问SQL Server跟Sybase数据库的库。目前最新版本为0.91，但是我安装的0.82版本。我们先进行它的安装：

wget http://ibiblio.org/pub/Linux/ALPHA/freetds/stable/freetds-stable.tgz

tar zxvf freetds-stable.tgz

cd freetds-0.82

./configure --prefix=/usr/local/freetds --with-tdsver=8.0 --enable-msdblib --enable-dbmfix

make && make install

----------

2.配置FreeTDS及连接测试

cd ../

echo "/usr/local/freetds/lib/" > /etc/ld.so.conf.d/freetds.conf

ldconfig

验证FreeTDS版本

这一步非常重要，通过才可以继续，不然后面的步骤都是无意义的。

首先看看版本信息

/usr/local/freetds/bin/tsql -C

----------

3.关于freetds/etc/freetds.conf配置项

/usr/local/freetds/etc/freetds.conf，其实这个不需要配置。

如果配置也可以，配置了PHP就可以调用这个配置项，否则需要PHP代码里指定数据库服务器信息即可。

[egServer70]  
    host = 192.168.1.235  这个是数据库服务器IP  
    port = 1433  
    tds version = 7.1

----------

4.添加PHP扩展mssql

(1).增加PHP扩展mssql

cd /usr/php-5.5.28/ext/mssql/  根据情况调整php安装路径

./configure --with-php-config=/usr/local/php/bin/php-config --with-mssql=/usr/local/freetds/

make && make install

(3).在php.ini配置文件中增加.so

cd /usr/local/php/lib下的php.ini 增加：

extension = "mssql.so"  

(4).重启PHP FastCGI

killall php-fpm

/etc/init.d/php-fpm


----------

5.使用PHP调用SQLserver

(1).mssql_connect配置版

<?php  
header("Content-type: text/html; charset=utf-8");  
$msdb=mssql_connect("egServer70","blog.csdn.net.unix21","password");  
if (!$msdb) {  
	echo "connect sqlserver error";  
	exit;  
}