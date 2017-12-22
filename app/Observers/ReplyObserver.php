<?php

namespace App\Observers;

use App\Services\Reply as ReplyService;
use App\Models\Reply;

/**
 * Reply模型观察者.
 *
 * @author rongyouyuan <rongyouyuan@gmail.com>
 */
class ReplyObserver
{
    /**
     * reply.
     *
     * @var App\Services\Reply
     */
    private $replyService;

    public function __construct(ReplyService $replyService)
    {
        $this->replyService = $replyService;
    }

    public function saved(Reply $reply)
    {
        $this->replyService->rebuildReplyCache($reply->account_id);
    }
}
