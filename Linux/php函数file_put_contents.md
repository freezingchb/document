网页访问php脚本执行file_put_contents('a.txt','aa')时

没有a.txt文件会创建，创建的文件所属者和所属组都是www，权限为644

执行file_put_contents('../data/doc/a.txt','aa')时

如果../data存在，doc目录不存在，该函数将不执行

可以用如下方法解决问题

if(!is_dir('../data/doc')) mkdir('../data/doc');


----------

mkdir函数创建的目录默认属于当前用户和组，比如www，权限是755

x权限代表目录可进入，文件可执行

7->rwx->421->读写执行