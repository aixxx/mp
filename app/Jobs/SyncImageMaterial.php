<?php

namespace App\Jobs;

use App\Services\Material as MaterialService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * 图片素材Job.
 *
 * @author rongyouyuan <rongyouyuan@163.com>
 */
class SyncImageMaterial extends Job implements SelfHandling, ShouldQueue
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
    public function handle(MaterialService $materialService)
    {
        if (!$this->account) {
            $this->delete();
        }

        $materialService->syncRemoteMaterial($this->account, 'image');

        $this->delete();
    }
}
