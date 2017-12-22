<?php

namespace App\Observers;

use App\Jobs\SyncImageMaterial;
use App\Jobs\SyncVoiceMaterial;
use App\Jobs\SyncVideoMaterial;
use App\Jobs\SyncNewsMaterial;
use App\Jobs\SyncMenus;
use App\Models\Account;
use Queue;

/**
 * Account模型观察者.
 *
 * @author rongyouyuan <rongyouyuan@163.com>
 */
class AccountObserver
{
    /**
     * 保存事件.
     *
     * @param Account $account account
     */
    public function saving(Account $account)
    {
        $account->token = account()->buildToken();

        $account->aes_key = account()->buildAesKey();

        $account->tag = account()->buildTag();
    }

    /**
     * 创建事件.
     *
     * @param Account $account account
     */
    public function created(Account $account)
    {
        //同步图片
        Queue::push(new SyncImageMaterial($account));
        //同步声音
        Queue::push(new SyncVoiceMaterial($account));
        // 同步视频
        Queue::push(new SyncVideoMaterial($account));
        //同步图文
        Queue::push(new SyncNewsMaterial($account));
        //同步菜单
        //Queue::push(new SyncMenus($account));
    }
}
