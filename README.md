# Currently only Chinese version!
## 网页UI版将不再进行更新！
当前已知BUG: \
1.mongodb数据库往回翻存在丢失内容的问题 

目前功能： \
1.祈愿记录返回结果自定义,支持mysql和mongodb的读取(api) \
注意:mongodb数据库仅支持读取数据,将配置文件中$m_uid配置为uid,并且php版本需为7.x且安装mongodb的拓展！ \
2.游戏内兑换码不管输入什么都提示兑换成功 \
3.抽卡UI展示（需使用请看自述文件下方的“注意”) \
4.兑换码自定义返回文本 (目前只支持数据库中修改) \
5.mysql支持一键插入扭蛋数据 \

#### 安装说明：|[linux教程](/README/installlinux.md)|windows暂无测试过教程,宝塔面板有win版本,自行在电脑安装git后参照linux教程即可|
##### PS:安装说明为小白专用，教程一切操作基于[宝塔面板](https://www.bt.cn/)，建议专业人士自行部署！
注意：\
1.抓包出来的UI的URL在浏览器中是 无 法 使 用 的，请在游戏内直接查看，或者直接使用API！ \
2.只有安装了CA证书，并且修改了hosts的电脑才能正常访问！\
3.目前UI和API暂时只支持zh-cn \
4.当前自动填充版本自动填充内容为黑缨枪！ \
5.若使用mongo搭配gc则注意卡池id:301=角色1 302=武器 100=新手 200=常驻 400=角色2 ,其他id无法识别!


### 数据库说明： |[数据库说明](/README/database.md)|

注意2：
1.在文件"bundle_da41cd81ff0f0a573208.js"中，搜索"your.gacha.api.url"给他改成你的URL \
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
