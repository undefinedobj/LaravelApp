<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Discussion;

class SyncDiscussionViewCounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'discussion:sync-discussion-view-counts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '将帖子 view_count 从 Redis 同步到数据库中';

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
     * @return mixed
     */
    public function handle(Discussion $discussion)
    {
        $discussion->syncDiscussionViewCounts();
        $this->info("Sync Success");
    }
}
