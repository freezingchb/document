1.CentOS下安装SecureCRT的sz/rz工具包

2.ssh文件传输

3.压缩和解压缩命令大全

4.文件权限

5.linux定时任务crontab

6.改变文件权限、所属用户、组

7.tail命令

8.whereis命令用于程序名的搜索

9.du命令查看文件占用空间情况

10.查看进程和端口的网络连接情况

----------

1.yum自动安装：yum install lrzsz

----------

2.sz命令发送文件到本地：# sz filename。rz命令本地上传文件到服务器：# rz

----------

3.
tar命令

　　解包：tar zxvf FileName.tar

　　打包：tar czvf FileName.tar DirName 

gz命令

　　解压1：gunzip FileName.gz

　　解压2：gzip -d FileName.gz

　　压缩：gzip FileName 

　　.tar.gz 和 .tgz

　　解压：tar zxvf FileName.tar.gz

　　压缩：tar zcvf FileName.tar.gz DirName

   压缩多个文件：tar zcvf FileName.tar.gz DirName1 DirName2 DirName3 ... 

bz2命令

　　解压1：bzip2 -d FileName.bz2

　　解压2：bunzip2 FileName.bz2

　　压缩： bzip2 -z FileName 

　　.tar.bz2

　　解压：tar jxvf FileName.tar.bz2

　　压缩：tar jcvf FileName.tar.bz2 DirName 

bz命令

　　解压1：bzip2 -d FileName.bz

　　解压2：bunzip2 FileName.bz

　　压缩：未知 

　　.tar.bz

　　解压：tar jxvf FileName.tar.bz 

Z命令

　　解压：uncompress FileName.Z

　　压缩：compress FileName 

　　.tar.Z

　　解压：tar Zxvf FileName.tar.Z

　　压缩：tar Zcvf FileName.tar.Z DirName 

zip命令

　　解压：unzip FileName.zip

　　压缩：zip FileName.zip DirName

----------


4.mkdir函数创建的目录默认属于当前用户和组，比如www，权限是755

x权限代表目录可进入，文件可执行

7->rwx->421->读写执行

网页访问php脚本执行file_put_contents('a.txt','aa')时

没有a.txt文件会创建，创建的文件所属者和所属组都是www，权限为644

执行file_put_contents('../data/doc/a.txt','aa')时

如果../data存在，doc目录不存在，该函数将不执行

可以用如下方法解决问题

if(!is_dir('../data/doc')) mkdir('../data/doc');

----------
5.# crontab -e  编辑当前用户的定时任务

添加如下代码（每一分钟用php脚本解释器执行一次script.php）：

*/1 * * * * /bin/local/php /path/to/your/php/script.php

添加完后# service crond status 查看运行状态

 # service crond start 启动定时任务

 # service crond stop 关闭定时任务

执行的php脚本如果有相对路径，可以在脚本头部加入代码：$cur_dir = dirname(__FILE__);chdir($cur_dir);

----------

6.使用chown命令可以修改文件或目录所属的用户：

       命令：chown 用户 目录或文件名

使用chgrp命令可以修改文件或目录所属的组：

       命令：chgrp 组 目录或文件名

 # chmod -R 751 directory 递归地给directory目录下所有文件和子目录分配权限

----------

7.循环查看文件内容 # tail -f test.log

----------

8.和find相比，whereis查找的速度非常快，因为系统内的所有文件都记录在一个数据库文件中，但是该数据库文件一星期更新一次，因此，我们在用whereis和locate不能查找实时文件 # whereis httpd 

----------

9.du -sh * 查看当前目录下文件和目录的大小

----------

10.查看是否有mysql进程 # ps -ef | grep mysql 查看mysql端口占用情况 netstat -anp | grep mysql