<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

class CodeSniffer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cbf:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '格式化代码';

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
        $process = new Process('php-cs-fixer fix '.app_path());

        try {
            $process->run(function ($type, $buffer) {
                if (Process::ERR === $type) {
                    $this->error($buffer);
                } else {
                    $this->info($buffer);
                }
            });

            $this->line('Finished.');
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
