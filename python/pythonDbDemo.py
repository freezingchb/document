#!/usr/bin/python
# -*- coding: UTF-8 -*-

import MySQLdb

# 打开数据库连接
db = MySQLdb.connect("127.0.0.1","root","autosale123","test", 3306, "utf8" )

# 使用cursor()方法获取操作游标 
cursor = db.cursor()

# 使用execute方法执行SQL语句
cursor.execute('set names utf8')

cursor.execute('insert into test (name, age) values (%s, %s)', ['陈晨', 15])
cursor.execute("insert into test (name,age) values ('lisi', 25)")

# 执行插入、修改时必须要commit操作，select时不需要
db.commit()

# 使用 fetchall() 方法获取全部数据
# data = cursor.fetchall()
# 使用 fetchone() 方法获取一条数据
# data = cursor.fetchone()
# print data

# 关闭数据库连接
db.close()