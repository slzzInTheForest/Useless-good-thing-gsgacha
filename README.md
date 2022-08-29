# Currently only Chinese version!

### 当前版本除api外未经测试，不保证稳定性！
/
目前功能： \
1.祈愿记录返回结果自定义(api) \
2.游戏内兑换码不管输入什么都提示兑换成功 \
3.抽卡UI展示（需使用请看自述文件下方的“注意”) \

说明：此处教程为小白版本教程，教程一切操作基于[宝塔面板](https://www.bt.cn/)，建议专业人士自行部署！ \
\
\
准备工具：\
1.一台服务器(自己的电脑也行，但是不建议，你问我苹果系统可不可以?¿当然不可以)\
2.一双有点小问题会自己百度一下的手 \
3.一个脑子 \
4.Navicat Premium 16数据库管理工具(不会吧不会吧，绿色版都不知道¿) \
3.5 小声bb:数据库web操作在写了，还没写完... \
\
前置操作： \
0.在服务器上安装宝塔面板!\
1.在服务器上安装mysql,php7.4,nginx服务，一般首次进入宝塔面板都会跳出的。 \
2.(windows)安装git(百度) \
\
提示：宝塔面板在网站页面，点击网站后面的根目录的哪一行绿字可以直接前往那个文件夹 \
\
操作流程(linux): \
1.进入ssh，克隆项目
```bash
cd /www/wwwroot
git clone https://github.com/slzzInTheForest/Useless-good-thing-gsgacha.git
```
2.前往宝塔面板网站页面→添加站点 \
3.\
域名：hk4e-api.mihoyo.com \
根目录：/www/wwwroot/Useless-good-thing-gsgacha \
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
9.打开mysql.php，将前面几行的数据库填入，然后打开/event/gacha_info/api/getGachaLog.php，同样将前面几行的数据库填入 \
10.(一定要重启浏览器)访问 hk4e-api.mihoyo.com/mysql.php \
11.然后就可以根据下面数据库的备注修改数据库，愉快的装逼了！
\
\
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
9.打开mysql.php，将前面几行的数据库填入，然后打开/event/gacha_info/api/getGachaLog.php，同样将前面几行的数据库填入 \
10.(一定要重启浏览器)访问 hk4e-api.mihoyo.com/mysql.php \
11.然后就可以根据下面数据库的备注修改数据库，愉快的装逼了！
\
注意：\
只有安装了CA证书，并且修改了hosts的电脑才能正常访问！\
目前UI和API暂时只支持zh-cn \
在文件"bundle_da41cd81ff0f0a573208.js"中，搜索"your.gacha.api.url"给他改成你的URL \
我对js并不熟悉，没有能力修改他 \
文件在yoururl/genshin/event/e20190909gacha-v2/bundle_da41cd81ff0f0a573208.js \
\
网址： \
api ：你的url/event/gacha_info/api/getGachaLog \
UI界面:你的url/genshin/event/e20190909gacha-v2/index.html?init_type=301&lang=zh-cn&authkey=你数据库设置的#/log \
因API仅开发人员用得到，故自行附加get参数！

备注：\
数据库说明(Database Description)【例子(example only in Chinese)】: \
id = 记录ID不可重复(Record ID is not repeatable)【1】 \
authkey = 用户标识(User ID)【c9wjf9ihn29b】 \
item_type = 角色/武器 (Character/Weapon)【角色】 \
rank_type = 星级 (won't translate)【5】 \
name = 武器角色名字(weapon character name)【妮露】 \
time = 获取时间 (Get Time)【2022-08-24 13:38:41】 \
gacha_type = 卡池ID(won't translate)【301】\
uid = 不多BB( :) )【114514666】 \
lang = 保留参数(Reserved parameter)【】\
count = 保留参数(Reserved parameter)【】\
item_id = 保留参数(Reserved parameter)【】
