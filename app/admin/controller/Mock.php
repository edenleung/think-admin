<?php

declare(strict_types=1);

/*
 * This file is part of TAnt.
 * @link     https://github.com/edenleung/think-admin
 * @document https://www.kancloud.cn/manual/thinkphp6_0
 * @contact  QQ Group 996887666
 * @author   Eden Leung 758861884@qq.com
 * @copyright 2019 Eden Leung
 * @license  https://github.com/edenleung/think-admin/blob/6.0/LICENSE.txt
 */

namespace app\admin\controller;

use app\BaseController;

class Mock extends BaseController
{
    public function projects()
    {
        $data = json_decode('[{"id":"xxx1","title":"Alipay","logo":"https://gw.alipayobjects.com/zos/rmsportal/WdGqmHpayyMjiEhcKoVE.png","description":"那是一种内在的东西，他们到达不了，也无法触及的","updatedAt":"2019-12-11T03:53:53.038Z","member":"科学搬砖组","href":"","memberLink":""},{"id":"xxx2","title":"Angular","logo":"https://gw.alipayobjects.com/zos/rmsportal/zOsKZmFRdUtvpqCImOVY.png","description":"希望是一个好东西，也许是最好的，好东西是不会消亡的","updatedAt":"2017-07-24T00:00:00.000Z","member":"全组都是吴彦祖","href":"","memberLink":""},{"id":"xxx3","title":"Ant Design","logo":"https://gw.alipayobjects.com/zos/rmsportal/dURIMkkrRFpPgTuzkwnB.png","description":"城镇中有那么多的酒馆，她却偏偏走进了我的酒馆","updatedAt":"2019-12-11T03:53:53.038Z","member":"中二少女团","href":"","memberLink":""},{"id":"xxx4","title":"Ant Design Pro","logo":"https://gw.alipayobjects.com/zos/rmsportal/sfjbOqnsXXJgNCjCzDBL.png","description":"那时候我只会想自己想要什么，从不想自己拥有什么","updatedAt":"2017-07-23T00:00:00.000Z","member":"程序员日常","href":"","memberLink":""},{"id":"xxx5","title":"Bootstrap","logo":"https://gw.alipayobjects.com/zos/rmsportal/siCrBXXhmvTQGWPNLBow.png","description":"凛冬将至","updatedAt":"2017-07-23T00:00:00.000Z","member":"高逼格设计天团","href":"","memberLink":""},{"id":"xxx6","title":"React","logo":"https://gw.alipayobjects.com/zos/rmsportal/kZzEzemZyKLKFsojXItE.png","description":"生命就像一盒巧克力，结果往往出人意料","updatedAt":"2017-07-23T00:00:00.000Z","member":"骗你来学计算机","href":"","memberLink":""}]', true);
        $result['data'] = $data;

        return $this->sendSuccess($result);
    }

    public function activity()
    {
        $data = json_decode('[{"id":"trend-1","updatedAt":"2019-12-11T03:53:53.038Z","user":{"name":"曲丽丽","avatar":"https://gw.alipayobjects.com/zos/antfincdn/XAosXuNZyF/BiazfanxmamNRoxxVxka.png"},"group":{"name":"高逼格设计天团","link":"http://github.com/"},"project":{"name":"六月迭代","link":"http://github.com/"},"template":"在 @{group} 新建项目 @{project}"},{"id":"trend-2","updatedAt":"2019-12-11T03:53:53.038Z","user":{"name":"付小小","avatar":"https://gw.alipayobjects.com/zos/rmsportal/cnrhVkzwxjPwAaCfPbdc.png"},"group":{"name":"高逼格设计天团","link":"http://github.com/"},"project":{"name":"六月迭代","link":"http://github.com/"},"template":"在 @{group} 新建项目 @{project}"},{"id":"trend-3","updatedAt":"2019-12-11T03:53:53.038Z","user":{"name":"林东东","avatar":"https://gw.alipayobjects.com/zos/rmsportal/gaOngJwsRYRaVAuXXcmB.png"},"group":{"name":"中二少女团","link":"http://github.com/"},"project":{"name":"六月迭代","link":"http://github.com/"},"template":"在 @{group} 新建项目 @{project}"},{"id":"trend-4","updatedAt":"2019-12-11T03:53:53.038Z","user":{"name":"周星星","avatar":"https://gw.alipayobjects.com/zos/rmsportal/WhxKECPNujWoWEFNdnJE.png"},"project":{"name":"5 月日常迭代","link":"http://github.com/"},"template":"将 @{project} 更新至已发布状态"},{"id":"trend-5","updatedAt":"2019-12-11T03:53:53.038Z","user":{"name":"朱偏右","avatar":"https://gw.alipayobjects.com/zos/rmsportal/ubnKSIfAJTxIgXOKlciN.png"},"project":{"name":"工程效能","link":"http://github.com/"},"comment":{"name":"留言","link":"http://github.com/"},"template":"在 @{project} 发布了 @{comment}"},{"id":"trend-6","updatedAt":"2019-12-11T03:53:53.038Z","user":{"name":"乐哥","avatar":"https://gw.alipayobjects.com/zos/rmsportal/jZUIxmJycoymBprLOUbT.png"},"group":{"name":"程序员日常","link":"http://github.com/"},"project":{"name":"品牌迭代","link":"http://github.com/"},"template":"在 @{group} 新建项目 @{project}"}]', true);

        return $this->sendSuccess($data);
    }

    public function radar()
    {
        $data = json_decode('[{"item":"引用","个人":70,"团队":30,"部门":40},{"item":"口碑","个人":60,"团队":70,"部门":40},{"item":"产量","个人":50,"团队":60,"部门":40},{"item":"贡献","个人":40,"团队":50,"部门":40},{"item":"热度","个人":60,"团队":70,"部门":40},{"item":"引用","个人":70,"团队":50,"部门":40}]', true);

        return $this->sendSuccess($data);
    }

    public function teams()
    {
        $data = json_decode('[{"id":1,"name":"科学搬砖组","avatar":"https://gw.alipayobjects.com/zos/rmsportal/BiazfanxmamNRoxxVxka.png"},{"id":2,"name":"程序员日常","avatar":"https://gw.alipayobjects.com/zos/rmsportal/cnrhVkzwxjPwAaCfPbdc.png"},{"id":1,"name":"设计天团","avatar":"https://gw.alipayobjects.com/zos/rmsportal/gaOngJwsRYRaVAuXXcmB.png"},{"id":1,"name":"中二少女团","avatar":"https://gw.alipayobjects.com/zos/rmsportal/ubnKSIfAJTxIgXOKlciN.png"},{"id":1,"name":"骗你学计算机","avatar":"https://gw.alipayobjects.com/zos/rmsportal/WhxKECPNujWoWEFNdnJE.png"}]', true);

        return $this->sendSuccess($data);
    }
}
