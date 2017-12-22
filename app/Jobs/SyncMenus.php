<?php

namespace App\Jobs;

use App\Services\Menu as MenuService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * 同步菜单Job.
 *
 * @author rongyouyuan <rongyouyuan@163.com>
 */
class SyncMenus extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * 公众号.
     *
     * @var account
     */
    private $account;

    /**
     * Create a new job instance.
     */
    public function __construct($account)
    {
        $this->account = $account;
    }

    /**
     * Execute the job.
     */
    public function handle(MenuService $menuService)
    {
        if (!$this->account) {
            $this->delete();
        }

        $menuService->syncToLocal($this->account);

        $this->delete();
    }
}
