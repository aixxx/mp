<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;

/**
 * 系统设置.
 *
 * 功能1： 系统设置
 *
 * @author yhsong <13810377933@163.com>
 */
class SettingsController extends Controller
{
    /**
     * 系统设置界面.
     */
    public function getAll()
    {
        return admin_view('settings.index');
    }
}
