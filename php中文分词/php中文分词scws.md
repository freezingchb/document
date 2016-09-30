**PHP中文分词系统SCWS安装和使用**

SCWS 是 Simple Chinese Word Segmentation 的首字母缩写（即：简易中文分词系统）

**二、scws安装**

# wget -c http://www.xunsearch.com/scws/down/scws-1.2.3.tar.bz2
# tar jxvf scws-1.2.3.tar.bz2
# cd scws-1.2.3
# ./configure --prefix=/usr/local/scws
# make && make install

**三、scws的PHP扩展安装**

1.生成扩展  scws.so
# cd ./phpext
# phpize 
# ./configure --with-php-config=/usr/local/php/bin/php-config
# make && make install

2.在php配置文件/usr/local/php/etc/php.ini加入配置（fpath要与上一步生成的scws.so所在的目录对应）
# [scws]
# extension = scws.so
# scws.default.charset = utf-8
# scws.default.fpath = /usr/local/scws/etc/

**四、词库安装**

# wget http://www.xunsearch.com/scws/down/scws-dict-chs-utf8.tar.bz2
# tar jxvf scws-dict-chs-utf8.tar.bz2 -C /usr/local/scws/etc/
# chown www:www /usr/local/scws/etc/dict.utf8.xdb

**五、php实例代码**

 //实例化分词插件核心类

 $so = scws_new();

 //设置分词时所用编码

 $so->set_charset('utf-8');

 //设置分词所用词典(此处使用utf8的词典)

 $so->set_dict('/usr/local/scws/etc/dict.utf8.xdb');

 //设置分词所用规则

 $so->set_rule('/usr/local/scws/etc/rules.utf8.ini ');

 //分词前去掉标点符号

 $so->set_ignore(true);

 //是否复式分割，如“中国人”返回“中国＋人＋中国人”三个词。

 $so->set_multi(true);

 //设定将文字自动以二字分词法聚合

 $so->set_duality(true);

 //要进行分词的语句

 $so->send_text(“欢迎来到火星时代IT开发”);

 //获取分词结果，如果提取高频词用get_tops方法

 while ($tmp = $so->get_result())
 {
     print_r($tmp);
 }

 $so->close();