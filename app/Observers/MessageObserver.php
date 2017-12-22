<?php

namespace App\Observers;

use Carbon\Carbon;

/**
 * Message模型观察者.
 *
 * @author rongyouyuan <rongyouyuan@163.com>
 */
class MessageObserver
{
    public function saving(Material $message)
    {
        //处理发送时间
        $message->sent_at = Carbon::createFromTimeStamp($message->sent_at);
    }

    public function created(Material $material)
    {
    }
}
