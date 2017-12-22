<?php

namespace App\Http\Controllers;

trait AccountHelper
{
    /**
     * 当前公众号.
     *
     * @return Account|null
     */
    public function account()
    {
        return app('viease.current_account');
    }
}
