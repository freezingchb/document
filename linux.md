1.CentOS下安装SecureCRT的sz/rz工具包
2.ssh文件传输
3.压缩和解压缩命令大全
4.文件权限

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