<?php

namespace App\Providers;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use NascentAfrica\Jetstrap\JetstrapFacade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        \URL::forceScheme(parse_url(config('app.url'))['scheme']);
        JetstrapFacade::useAdminLte3();

        $this->menu_build($events);
    }

    private function menu_build(Dispatcher &$events){
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add([
                'text'        => 'Home',
                'icon'        => 'fa fa-home',
                'route' => 'home',
            ]);

            $event->menu->add([
                'header' => 'ADMINISTRAÇÃO',
                'can' => 'pode-acessar-area-admin'
            ]);
            $event->menu->add([
                'text'        => 'Role',
                'icon'        => 'fa fa-user-tag',
                'route' => 'roles.index',
                'can' => 'pode-acessar-area-admin'
            ]);
            $event->menu->add([
                'text'        => 'Permissions',
                'icon'        => 'fa fa-user-tag',
                'route' => 'permissions.index',
                'can' => 'pode-acessar-area-admin'
            ]);
            $event->menu->add([
                'text'        => 'Cliente',
                'icon'        => 'fa fa-user-tag',
                'route' => 'clients.index',
                'can' => 'pode-acessar-area-cliente'
            ]);
        });
    }
}
