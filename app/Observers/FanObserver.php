<?php

namespace App\Observers;

use App\Models\Fan;
use App\Repositories\FanRepository;
use Overtrue\Wechat\User;
use Overtrue\Wechat\Group;

/**
 * Fan模型观察者.
 *
 * @author yhsong <13810377933@163.com>
 */
class FanObserver
{
    /**
     * wechat SDK.
     *
     * @var Overtrue\Wechat\User
     */
    private $user;

    /**
     * wechat SDK.
     *
     * @var Overtrue\Wechat\Group
     */
    private $group;

    /**
     * FanGroup Repository.
     *
     * @var App\Repositories\FanGroupRepository
     */
//    private $fanRepository;

    public function __construct(FanRepository $fanRepository)
    {
        /*
         * 1 初始化 SDK Config
         */
        $account = account()->getCurrent();

        /*
         * 2 构建 SDK 对象
         */
        $this->user = new User($account->app_id, $account->app_secret);

        /*
         * 3 构建 SDK 对象
         */
        $this->group = new Group($account->app_id, $account->app_secret);

        /*
         * 4 构建 Fan Repository 对象
         */
//		$this->fanRepository = $fanRepository;
    }

    /**
     * 粉丝更新完成后执行.
     *
     * @param \App\Models\Fan $fanModel
     */
    public function updated(Fan $fanModel)
    {
        /*
         * 1 获取更新的属性
         */
        $updateArr = $fanModel->getDirty();

        if (isset($updateArr['group_id'])) {
            /*
             * 1 移动用户到指定分组同步到线上
             */
            $this->group->moveUser($fanModel->openid, $updateArr['group_id']);
        }

        if (isset($updateArr['remark'])) {
            /*
             * 1 更改的粉丝备注同步到线上
             */
            $this->user->remark($fanModel->openid, $updateArr['remark']);
        }
    }
}
