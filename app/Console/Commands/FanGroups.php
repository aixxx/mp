<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Account;
use App\Models\FanGroup as FanGroupModel;
use App\Repositories\AccountRepository;
use Overtrue\Wechat\Group;

class FanGroups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:groups {account_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '通过account_id同步线上粉丝组列表';

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
        /*
         * 1 获取Account
         */
        $account = $this->getAccount($accountId);
        $fanGroupModel = new FanGroupModel();
        /*
         * 2 初始化 SDK Config, 构建 SDK 对象
         */
        $groupService = new Group($account->app_id, $account->app_secret);
        $groups = $groupService->lists();

        if ($groups) {
            $insert = [];
            $this->output->progressStart(count($groups));

            foreach ($groups as $groupKey => $group) {
                $insert[$groupKey]['group_id'] = $group['id'];
                $insert[$groupKey]['account_id'] = $account->id;
                $insert[$groupKey]['title'] = $group['name'];
                $insert[$groupKey]['fan_count'] = $group['count'];
                $insert[$groupKey]['is_default'] = in_array($group['name'], ['默认组', '屏蔽组', '星标组']) ? 1 : 0;

                $this->info("\t{$group['name']} created!");

                $this->output->progressAdvance();
            }

            /*
             * clean
             */
            $fanGroupModel->where('account_id', $account->id)->forceDelete();

            $result = $fanGroupModel->insert($insert);
        }

        $this->output->progressFinish();
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
