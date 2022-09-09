# Currently only Chinese version!
## 网页UI版将不再进行BUG修复或者更新！
# 因为V1版本修改运算逻辑之后问题过多，懒得修复了，现进行V2版本重新构建！
当前已知BUG: \
1.为了适配倒序读取ID，导致目前authkey只能存在一个，否则出现前几个无法读取数据的BUG，正在重构新思路中！ \

目前功能： \
1.祈愿记录返回结果自定义(api) \
2.游戏内兑换码不管输入什么都提示兑换成功 \
3.抽卡UI展示（需使用请看自述文件下方的“注意”) 


#### 安装说明：|[linux教程](/README/installlinux.md)|windows暂无测试过教程,宝塔面板有win版本,自行在电脑安装git后参照linux教程即可|
##### PS:安装说明为小白专用，教程一切操作基于[宝塔面板](https://www.bt.cn/)，建议专业人士自行部署！ 

### 数据库说明： |[数据库说明](/README/database.md)|

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
数据设置: 你的url/event/gacha_info/api/gachalogadd?authkey=&item_type=&rank_type=&name=&gacha_type=&uid=&quantity= \
数据设置中可参照数据库说明进行配置！(数据设置为临时版，填充抽数暂时均为黑缨枪！)
\
因API仅开发人员用得到，故自行附加get参数！
