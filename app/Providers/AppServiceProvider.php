<?php

namespace App\Providers;

use App\Http\Interfaces\AuthInterface;
use App\Http\Interfaces\GenreInterface;
use App\Http\Interfaces\MessageInterface;
use App\Http\Interfaces\ShowInterface;
use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\GenreRepository;
use App\Http\Repositories\MessageRepositpory;
use App\Http\Repositories\ShowRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  
    public function register(): void
    {
        $this->app->singleton(AuthInterface::class, AuthRepository::class);
        $this->app->singleton(ShowInterface::class, ShowRepository::class);
        $this->app->singleton(GenreInterface::class, GenreRepository::class);
        $this->app->singleton(MessageInterface::class, MessageRepositpory::class);

    }

  
    public function boot(): void
    {
        //
    }
}
