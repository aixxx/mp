<?php

namespace App\Observers;

use App\Models\FanGroup;
use App\Repositories\FanGroupRepository;
use Overtrue\Wechat\Group;

/**
 * FanGroup模型观察者.
 *
 * @author yhsong <13810377933@163.com>
 */
class FanGroupObserver
{
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
    private $fanGroupRepository;

    public function __construct(FanGroupRepository $fanGroupRepository)
    {
        $account = account()->getCurrent();
        /*
         * 1 初始化 SDK Config
         * 2 构建 SDK 对象
         */
        $this->group = new Group($account->app_id, $account->app_secret);

        /*
         * 3 构建 FanGroup Repository 对象
         */
        $this->fanGroupRepository = $fanGroupRepository;
    }

    /**
     * 粉丝组创建完成后执行.
     *
     * @param \App\Models\FanGroup $fanGroupModel
     */
    public function created(FanGroup $fanGroupModel)
    {
        /*
         * 1 获取更新的属性
         */
        $insertArr = $fanGroupModel->getDirty();
        if (isset($insertArr['group_id']) && $insertArr['group_id'] != -1) {
            /*
             * 1.1 创建的粉丝组信息同步到线上
             */
            $createResult = $this->group->create($fanGroupModel->title);

            /*
             * 1.2 group_id 回写入本地数据库
             */
            $input['id'] = $fanGroupModel->id;
            $input['group_id'] = $createResult['id'];
            $this->fanGroupRepository->update($fanGroupModel->account_id, $input);
        }
    }

    /**
     * 粉丝组更新完成后执行.
     *
     * @param \App\Models\FanGroup $fanGroupModel
     */
    public function updated(FanGroup $fanGroupModel)
    {
        /*
         * 1 获取更新的属性
         */
        $updateArr = $fanGroupModel->getDirty();

        if (isset($updateArr['title'])) {
            /*
             * 1.1 更改的粉丝组名称同步到线上, 自带分组不能改
             */
            if ($fanGroupModel->group_id > 2) {
                $this->group->update($fanGroupModel->group_id, $updateArr['title']);
            }
        }
    }

    /**
     * 粉丝组删除完成后执行.
     *
     * @param \App\Models\FanGroup $fanGroupModel
     */
    public function deleted(FanGroup $fanGroupModel)
    {
        /*
         * 1 线上同步删除, 自带分组不能删
         */
        if (!$fanGroupModel->is_default) {
            $this->group->delete($fanGroupModel->group_id);
        }
    }
}
