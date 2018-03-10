<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        $this->mapCoordinatorRoutes();

        $this->mapQamanagerRoutes();

        $this->mapStaffRoutes();

        $this->mapAdminRoutes();

        $this->mapStudentRoutes();

        //
    }

    /**
     * Define the "student" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapStudentRoutes()
    {
        Route::group([
            'middleware' => ['web', 'student', 'auth:student'],
            'prefix' => 'student',
            'as' => 'student.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/student.php');
        });
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::group([
            'middleware' => ['web', 'admin', 'auth:admin'],
            'prefix' => 'admin',
            'as' => 'admin.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/admin.php');
        });
    }

    /**
     * Define the "staff" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapStaffRoutes()
    {
        Route::group([
            'middleware' => ['web', 'staff', 'auth:staff'],
            'prefix' => 'staff',
            'as' => 'staff.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/staff.php');
        });
    }

    /**
     * Define the "qamanager" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapQamanagerRoutes()
    {
        Route::group([
            'middleware' => ['web', 'qamanager', 'auth:qamanager'],
            'prefix' => 'qamanager',
            'as' => 'qamanager.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/qamanager.php');
        });
    }

    /**
     * Define the "coordinator" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapCoordinatorRoutes()
    {
        Route::group([
            'middleware' => ['web', 'coordinator', 'auth:coordinator'],
            'prefix' => 'coordinator',
            'as' => 'coordinator.',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/coordinator.php');
        });
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
}
