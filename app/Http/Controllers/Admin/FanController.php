<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\FanRepository;
use App\Http\Requests\Fan\UpdateRequest;
use App\Services\FanReport;

/**
 * 粉丝管理.
 *
 * @author overtrue <i@overtrue.me>
 */
class FanController extends Controller
{
    /**
     * FanRepository.
     *
     * @var FanRepository
     */
    private $fan;

    /**
     * 获取多少条数据.
     *
     * @var type
     */
    private $pageSize = 21;

    /**
     * constructer.
     *
     * @param AccountRepository $account
     */
    public function __construct(FanRepository $fan)
    {
        $this->fan = $fan;
    }

    public function getTest()
    {
        $fanReport = new FanReport();
        $fanReport->setLiveness(1, 'oNlnUjpv99nmXBcX-sOTaFzShPpA', 'test');
        //return $this->fan->updateRemark(['id'=>2192, 'remark'=>'宋艳辉']);
    }

    public function getIndex()
    {
        return admin_view('fan.index');
    }

    /**
     * 获取粉丝列表.
     *
     * @return Response
     */
    public function getLists(Request $request)
    {
        /*
         * 请求参数：
         *
         * page: 1
         * sort_by: xxx
         */
        $account = $this->getAccount();

        return $this->fan->lists($account->id, $this->pageSize, $request);
    }

    /**
     * 更新粉丝备注.
     *
     * @param int $id 粉丝ID
     *
     * @return Response
     */
    public function postRemark(UpdateRequest $request)
    {
        /*
         * 请求参数：
         *
         * id: 自增ID
         * remark: 新的备注名
         */
        return $this->fan->updateRemark($request);
    }

    /**
     * 获取 Account.
     *
     * @return Object
     */
    private function getAccount()
    {
        return $this->account();
    }
}
