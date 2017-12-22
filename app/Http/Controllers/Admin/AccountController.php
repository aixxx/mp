<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Account\CreateRequest;
use App\Http\Requests\Account\UpdateRequest;
use App\Repositories\AccountRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Account;

/**
 * 公众号管理.
 *
 * @author rongyouyuan <rongyouyuan@163.com>
 */
class AccountController extends Controller
{
    /**
     * 分页.
     *
     * @var int
     */
    private $pageSize = 10;

    /**
     * AccountRepository.
     *
     * @var AccountRepository
     */
    private $accountRepository;

    /**
     * constructer.
     *
     * @param AccountRepository $account
     */
    public function __construct(AccountRepository $account)
    {
        $this->accountRepository = $account;

        $this->middleware('account', ['only' => 'getManage']);
    }

    /**
     * 展示公众号.
     *
     * @return Response
     */
    public function getIndex()
    {
        $accounts = $this->accountRepository->lists($this->pageSize);

        return admin_view('account.index', compact('accounts'));
    }

    /**
     * 预览首页.
     */
    public function getManage()
    {
        $account = $this->account();

        return admin_view('account.manage', compact('account'));
    }

    /**
     * 添加公众号.
     *
     * @return Response
     */
    public function getCreate()
    {
        return admin_view('account.form');
    }

    /**
     * 创建账户.
     *
     * @param CreateRequest $request
     *
     * @return Redirect
     */
    public function postCreate(CreateRequest $request)
    {
        $this->accountRepository->store($request);

        return redirect(admin_url('account'))->withMessage('创建成功！');
    }

    /**
     * 展示修改.
     *
     * @param int $id id
     */
    public function getUpdate($id)
    {
        $account = $this->accountRepository->getById($id);

        return admin_view('account.form', compact('account'));
    }

    /**
     * 提交.
     *
     * @param int           $id      id
     * @param UpdateRequest $request request
     *
     * @return Redirect
     */
    public function postUpdate(UpdateRequest $request, $id)
    {
        $this->accountRepository->update($id, $request);

        return redirect(admin_url('account'))->withMessage('修改成功！');
    }

    /**
     * 删除公众号.
     *
     * @param ineger $id 公众号iD
     */
    public function getDestroy($id)
    {
        $this->accountRepository->destroy($id);

        return redirect(admin_url('account'))->withMessage('删除成功！');
    }

    /**
     * 切换公众号.
     *
     * @param int $id id
     */
    public function getChangeAccount($id)
    {
        account()->chose($id);

        return redirect(admin_url('/'));
    }
}
