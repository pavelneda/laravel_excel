<?php

namespace App\Console\Commands;

use App\Imports\ProjectDynamicImport;
use App\Imports\ProjectImport;
use App\Models\Task;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-excel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import-excel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Excel::import(new ProjectDynamicImport(Task::find(4)), 'files/projects2.xlsx', 'public');
    }
}
