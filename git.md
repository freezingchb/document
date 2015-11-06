安装完git后

右键   git bash

cd ~

mkdir .ssh

cd .ssh

pwd

进入~/.ssh/目录，查看是否有id_rsa.pub文件。若没有：

ssh-keygen

一路回车，完成后，便发现目录中多有id_rsa.pub。复制其内容粘贴到上面操作服务器的authorized_keys文件中

测试是否密钥登录成功

ssh git@yourserverip

为了得一个项目的拷贝(copy),我们需要知道这个项目仓库的地址(Git URL)

git clone git://git.kernel.org/pub/scm/git/git.git

就可把项目down到本地

Git鼓励大量使用分支：

查看分支：git branch

创建分支：git branch <name>

切换分支：git checkout <name>

本地test分支创建完后，git push origin test就可以直接在远程创建test分支

创建+切换分支：git checkout -b <name>

合并某分支到当前分支：git merge <name>

删除分支：git branch -d <name>

3,查看分支

git branch   本地

git branch -r  远程

4,从远程获取

git pull origin master

5,本地分支与远程对应，即设置git push,pull默认的提交获取分支,这样就很方便的使用git push 提交信息或git pull获取信息

git branch --set-upstream-to=origin/dev

取消对master的跟踪

git branch --unset-upstream master

5、提交全部

git add .

git commit -m 'test'

git push origin master

若提交Git时，提示错误：RPC failed; result=22, HTTP code = 411。代表：上传的包过大，HTTP的头错误导致的。

解决办法：打开项目中隐藏的.git文件夹，找到config配置文件，在后天添加如下配置：

[http] 

      postBuffer = 524288000



意思是上传的最大数据量为50MB。

7.分支切换，需先commit

本地在A分支上修改文件后要commit才可以切换到B分支，不然B分支可以看到在A分支上修改的内容