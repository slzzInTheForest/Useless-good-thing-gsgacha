操作流程(windows)未经测试！: \
1.进入cmd，克隆项目(不知道cmd是什么的建议别用了)
```bash
git clone https://github.com/slzzInTheForest/Useless-good-thing-gsgacha.git
```
2.前往宝塔面板网站页面→添加站点 \
3.\
域名：hk4e-api.mihoyo.com \
根目录：C:\Users\你电脑的名字\Useless-good-thing-gsgacha  \
4.配置ssl证书，在面板网站界面点击 设置→SSL \
(在ssl文件夹中，密钥：ssl.key证书：ssl.crt，别管宝塔提示的密钥为pen) \
5.也是在这个界面，点开 配置文件 将下述内容插入到 "#SSL-START SSL相关配置" 的上一行
```bash
    #去掉php后缀
    location / {
    try_files $uri $uri/ $uri.php?$args;
    }
```
6.将ssl文件夹中的CA.crt下载到你的电脑，并且安装 \
(双击证书→安装证书→下一页→将所有证书放入：受信任的根证书颁发机构→下一页→完成) \
上面如果跳提示了就点确定就行了\
7.编辑本地hosts (你的ip hk4e-api.mihoyo.com)\
8.前往面板数据库页面，添加数据库→（数据库名用户名密码看着写）→提交
9.打开config.php，将数据库等配置填入 \
10.(一定要重启浏览器)访问 hk4e-api.mihoyo.com/mysql.php (备注:如果设置key请在后面加上: ?key=你设置的key)\
11.然后就可以根据下面数据库的备注修改数据库，愉快的装逼了！
\