<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Eloquent\PostRepository;
use App\Repositories\Eloquent\MemberRepository;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\MemberRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $repositories = [
            MemberRepositoryInterface::class => MemberRepository::class,
            PostRepositoryInterface::class   => PostRepository::class,
        ];

        foreach ($repositories as $interface => $repository) {
            $this->app->bind($interface, $repository);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
