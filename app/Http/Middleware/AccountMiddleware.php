<?php

namespace App\Http\Middleware;

use App\Services\Account;
use Closure;

/**
 * 公众号切换中间件.
 *
 * @author rongyouyuan <rongyouyuan@163.com>
 */
class AccountMiddleware
{
    /**
     * 账号服务
     *
     * @var \App\Services\Account
     */
    private $account;

    /**
     * construct.
     *
     * @param \App\Services\Account $account
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!account()->chosedId()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect(admin_url('account'));
            }
        }

        return $next($request);
    }
}
