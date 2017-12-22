<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

/**
 * 管理账号.
 *
 * @author overtrue <anzhengchao@gmail.com>
 */
class UserController extends Controller
{
    /**
     * 首页.
     *
     * @return Response
     */
    public function getIndex()
    {
        return admin_view('user.index');
    }

    /**
     * 修改密码.
     *
     * @return Response
     */
    public function getPassword()
    {
        return admin_view('user.password');
    }
}
