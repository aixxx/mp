<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Reply\CreateRequest;
use App\Http\Requests\Reply\UpdateRequest;
use App\Http\Requests\Reply\EventRequest;
use App\Services\Reply as ReplyService;
use App\Repositories\ReplyRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * 自动回复管理.
 *
 * @author rongyouyuan <rongyouyuan@163.com>
 */
class ReplyController extends Controller
{
    /**
     * 默认分页数量.
     *
     * @var int
     */
    private $pageSize = 10;

    /**
     * replyRepository.
     *
     * @var App\Repositories\ReplyRepository
     */
    private $replyRepository;

    /**
     * replyService.
     *
     * @var replyService
     */
    private $replyService;

    /**
     * construct.
     *
     * @param ReplyRepository $autoReply
     */
    public function __construct(ReplyRepository $replyRepository, ReplyService $replyService)
    {
        $this->replyService = $replyService;

        $this->replyRepository = $replyRepository;
    }

    /**
     * 获取自动回复.
     */
    public function getIndex()
    {
        return admin_view('reply.index');
    }

    /**
     * 获取无匹配回复的值.
     */
    public function getFollowReply()
    {
        $reply = $this->replyRepository->getFollowReply($this->account()->id);

        return $this->replyService->resolveEventReply($reply);
    }

    /**
     * 获取无匹配时的自动回复.
     */
    public function getNoMatchReply()
    {
        return $this->replyRepository->getNoMatchReply($this->account()->id);
    }

    /**
     * 取得自动回复的列表.
     *
     * @param Request $request request
     */
    public function getLists(Request $request)
    {
        $replies = $this->replyRepository->getList($this->account()->id, $this->pageSize);

        return $this->replyService->resolveReplies($replies);
    }

    /**
     * 新增与保存事件自动回复[ 关注与无匹配 ].
     *
     * @param EventRequest $request request
     *
     * @return array
     */
    public function postSaveEventReply(EventRequest $request)
    {
        $reply = $this->replyRepository->saveEventReply($request, $this->account()->id);

        return $this->replyService->resolveReply($reply);
    }

    /**
     * 保存自动回复内容.
     *
     * @param CreateRequest $request request
     *
     * @return array
     */
    public function postStore(CreateRequest $request)
    {
        $reply = $this->replyRepository->store($request, $this->account()->id);

        return $this->replyService->resolveReply($reply);
    }

    /**
     * 更改自动回复内容.
     *
     * @param UpdateRequest $request request
     * @param int           $id      id
     *
     * @return array
     */
    public function postUpdate(UpdateRequest $request, $id)
    {
        $reply = $this->replyRepository->update($id, $request, $this->account()->id);

        return $this->replyService->resolveReply($reply);
    }
}
