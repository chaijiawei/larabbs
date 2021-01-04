<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CalcActiveUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larabbs:calc-active-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '计算活跃用户';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('开始计算...');
        (new User())->refreshActiveUserCache();
        $this->info('计算完毕。');
    }
}
