<?php

namespace App\Providers;

use App\Http\Interfaces\ArtistFilterInterface;
use App\Http\Interfaces\AuthInterface;
use App\Http\Interfaces\FilterInterface;
use App\Http\Interfaces\GenreInterface;
use App\Http\Interfaces\MessageInterface;
use App\Http\Interfaces\ShowInterface;
use App\Http\Interfaces\VenueFilterInterface;
use App\Http\Repositories\ArtistFilterRepository;
use App\Http\Repositories\AuthRepository;
use App\Http\Repositories\FilterRepository;
use App\Http\Repositories\GenreRepository;
use App\Http\Repositories\MessageRepositpory;
use App\Http\Repositories\ShowRepository;
use App\Http\Repositories\VenueFilterRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  
    public function register(): void
    {
        $this->app->singleton(AuthInterface::class, AuthRepository::class);
        $this->app->singleton(ShowInterface::class, ShowRepository::class);
        $this->app->singleton(GenreInterface::class, GenreRepository::class);
        $this->app->singleton(MessageInterface::class, MessageRepositpory::class);
        $this->app->singleton(ArtistFilterInterface::class, ArtistFilterRepository::class);
        $this->app->singleton(VenueFilterInterface::class, VenueFilterRepository::class);
        $this->app->singleton(FilterInterface::class, FilterRepository::class);
    }

  
    public function boot(): void
    {
        //
    }
}
