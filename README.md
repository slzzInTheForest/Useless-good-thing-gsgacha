# Currently only Chinese version!
# 目前该版本的一键版暂未完善！
说明：此处为小白版本，教程一切操作基于[宝塔面板](https://www.bt.cn/),建议专业人士[前往该版本](https://github.com/slzzInTheForest/Useless-good-thing-gsgacha) \
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
2.(windows)安装git(百度)
\
\
操作流程(linux): \
1.进入ssh，克隆项目
```bash
cd /www/wwwroot
git clone https://github.com/slzzInTheForest/Useless-good-thing-gsgacha-primary.git
```
2.前往宝塔面板网站页面→添加站点 \
3.\
域名：hk4e-api.mihoyo.com \
根目录：/www/wwwroot/Useless-good-thing-gsgacha-primary \
4.配置ssl证书 \
5.编辑本地hosts \
6.修改数据库 \
\
\
操作流程(windows): \
1.进入cmd，克隆项目(不知道cmd是什么的建议别用了)
```bash
git clone https://github.com/slzzInTheForest/Useless-good-thing-gsgacha-primary.git
```
2.前往宝塔面板网站页面→添加站点 \
3.\
域名：hk4e-api.mihoyo.com \
根目录：C:\Users\你电脑的名字\Useless-good-thing-gsgacha-primary  \
4.配置ssl证书 \
5.编辑本地hosts \
6.修改数据库 \