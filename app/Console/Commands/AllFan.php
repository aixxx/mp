<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Account;

class AllFan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:all_fans';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '获取全部公众号,同步粉丝';

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
        $accountModel = new Account();
        $accounts = $accountModel->get();

        $this->info("\n开始同步...");

        $this->output->progressStart($accounts->count());

        foreach ($accounts as $account) {
            $this->call('sync:fans', array('account_id' => $account->id));
            $this->output->progressAdvance();
        }

        $this->output->progressFinish();

        $this->info("\n同步完成。");
    }
}
