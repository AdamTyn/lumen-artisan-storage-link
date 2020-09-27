<?php

namespace AdamTyn\Lumen\Artisan;

use Illuminate\Console\Command;
use Illuminate\Contracts\Container\BindingResolutionException;

class StorageLinkCommand extends Command
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'storage:link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '为 Lumen 应用创建符号连接';

    /**
     * Execute the console command.
     * @throws BindingResolutionException
     */
    public function handle()
    {
        foreach ($this->links() as $link => $target) {
            if (file_exists($link)) {
                $this->error("The [$link] link already exists.");
            } else {
                $this->laravel->make('files')->link($target, $link);

                $this->info("The [$link] link has been connected to [$target].");
            }
        }

        $this->info('The links have been created.');
    }

    /**
     * Get the symbolic links that are configured for the application.
     *
     * @return array
     */
    protected function links()
    {
        return $this->laravel['config']['filesystems.links'] ??
               [base_path('public/storage') => storage_path('app/public')];
    }
}
