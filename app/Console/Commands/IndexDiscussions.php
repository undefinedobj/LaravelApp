<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use TeamTNT\TNTSearch;

class IndexDiscussions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:discussions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Index the discussions table';

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
    public function handle()
    {
//        composer remove vanry/laravel-scout-tntsearch
        $indexer = TNTSearch::createIndex('discussions.index');
        $indexer->query('SELECT id, title, view_count, `order`, body, categories_id, user_id FROM discussions;');
        $indexer->run();
    }
}
