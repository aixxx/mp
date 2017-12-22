<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Fan as FanModel;
use App\Models\Account;
use App\Services\Fan as FanService;
use App\Repositories\AccountRepository;
use Overtrue\Wechat\User;

class FanInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:fan_info {account_id} {openid}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '通过openid同步线上粉丝详情';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $accountId = $this->argument('account_id');
        $openId = $this->argument('openid');
        /*
         * 1 获取Account
         */
        $account = $this->getAccount($accountId);

        $fanModel = new FanModel();
        $FanService = new FanService();

        /*
         * 2 初始化 SDK Config, 构建 SDK 对象
         */
        $userService = new User($account->app_id, $account->app_secret);
        $fan = $userService->get($openId);

        if (isset($fan['subscribe']) && $fan['subscribe']) {    //subscribe=1 关注了公众号
            $updateInput = $FanService->formatFromWeChat($fan);

            /*
             * 存入本地
             */
            $fanModel->where('account_id', $accountId)->where('openid', $openId)->update($updateInput);
        }
    }

    /**
     * 获取Account.
     *
     * @param Int $id AccountID
     */
    private function getAccount($accountId)
    {
        $accountRepository = new AccountRepository(new Account());

        return $accountRepository->getById($accountId);
    }
}
