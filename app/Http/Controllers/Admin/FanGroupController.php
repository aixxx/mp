<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\FanGroup\CreateRequest;
use App\Http\Requests\FanGroup\UpdateRequest;
use App\Http\Requests\FanGroup\MoveRequest;
use App\Repositories\FanGroupRepository;
use App\Repositories\FanRepository;
use Illuminate\Http\Request;

class FanGroupController extends Controller
{
    /**
     * AccountRepository.
     *
     * @var AccountRepository
     */
    private $fanGroup;

    /**
     * Account.
     *
     * @var Object
     */
    private $account;

    /**
     * 获取多少条数据.
     *
     * @var type
     */
    private $pageSize = 100;

    /**
     * constructer.
     *
     * @param FanGroupRepository $fanGroup
     */
    public function __construct(FanGroupRepository $fanGroup)
    {
        $this->fanGroup = $fanGroup;
        $this->account = $this->getAccount();
    }

    /**
     * Test.
     */
    public function getTest(Request $request)
    {
        //return $this->fanGroup->lists($this->account->id, $this->pageSize, $request);	//获取粉丝组列表--
        //return $this->fanGroup->store($this->account->id, ['title'=>'0629']) //创建分组--
        //return $this->fanGroup->update($this->account->id, ['id'=>9,'title'=>'test113-1']); //修改粉丝组--
        //return $this->fanGroup->delete($this->account->id, 9); //删除分组--

        /*
         * 请求参数：
         *
         * ids: 粉丝自增ID
         * to_group_id: 粉丝组group_id
         */
        $request = [
            'ids' => [2192,2193,2194],
            'to_group_id' => 120,
        ];
        $request = (object) $request;
        /*
         * 1 校验粉丝ID
         */
        if (!is_array($request->ids)) {
            return '粉丝ID类型不正确';
        }

        /*
         * 2 使用 to_group_id 查找分组是否存在
         */
        $group = $this->fanGroup->getGroupByGroupid($this->account->id, $request->to_group_id);

        if ($group) {
            $fan = new FanRepository();
            /*
             * 2.1) 通过粉丝ID 获取粉丝原所在组group_id
             */
            $groupIds = $fan->getFanGroupByfanIds($request->ids);
            /*
             * 2.2) 存在则移动
             */
            if ($fan->moveFanGroupByFansid($request->ids, $request->to_group_id)) {
                /*
                 * 2.2.1) 更改粉丝组的 fan_count 值
                 */
                $this->fanGroup->cutFanCount($this->account->id, $group->id, $groupIds, count($request->ids));
            }
        }
    }

    /**
     * 获取分组列表.
     *
     * @return Response
     */
    public function getLists(Request $request)
    {
        /*
         * 请求参数：
         *
         * sort_by: xxx	排序字段
         * page: 1	页码
         */
        return $this->fanGroup->lists($this->account->id, $this->pageSize, $request);
    }

    /**
     * 创建分组.
     *
     * @return Reponse
     */
    public function postStore(CreateRequest $request)
    {

        /*
         * 请求参数：
         * title: 名称
         */

        /*
         * 1 执行本地创建操作
         */
        return $this->fanGroup->store($this->account->id, $request);
    }

    /**
     * 更改分组信息.
     *
     * @return Response
     */
    public function postUpdate(UpdateRequest $request)
    {

        /*
         * 请求参数：
         *
         * id: 粉丝组自增ID
         * title: 名称
         */

        /*
         * 1 执行本地更改操作
         */
        return $this->fanGroup->update($this->account->id, $request);
    }

    /**
     * 删除分组.
     *
     * @param int $id 粉丝组自增ID
     *
     * @return Response
     */
    public function deleteDestory($id)
    {
        /*
         * 1 校验自增ID
         */
        if ($id !== (int) $id) {
            return '类型错误';
        }

        /*
         * 2 执行本地删除操作
         */
        return $this->fanGroup->delete($this->account->id, $id);
    }

    /**
     * 移动粉丝所属组[支持批量].
     */
    public function postMoveFans(MoveRequest $request)
    {

        /*
         * 请求参数：
         *
         * ids: 粉丝自增ID
         * to_group_id: 粉丝组group_id
         */

        /*
         * 1 校验粉丝ID
         */
        if (!is_array($request->ids)) {
            return '粉丝ID类型不正确';
        }

        /*
         * 2 使用 to_group_id 查找分组是否存在
         */
        $group = $this->fanGroup->getGroupByGroupid($this->account->id, $request->to_group_id);

        if ($group) {
            $fan = new FanRepository();
            /*
             * 2.1) 通过粉丝ID 获取粉丝原所在组group_id
             */
            $groupIds = $fan->getFanGroupByfanIds($request->ids);
            /*
             * 2.2) 存在则移动
             */
            if ($fan->moveFanGroupByFansid($request->ids, $request->to_group_id)) {
                /*
                 * 2.2.1) 更改粉丝组的 fan_count 值
                 */
                $this->fanGroup->cutFanCount($this->account->id, $group->id, $groupIds, count($request->ids));
            }
        }
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
