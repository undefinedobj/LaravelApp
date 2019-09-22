<?php

namespace App\Providers;

use Faker\Factory as FakerFactory;
use Faker\Generator as FakerGenerator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
//        为本地开发环境添加 `Laravel-5-Generators-Extended 代码生成器`
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

//        将Eloquent Repository与其相应的Repository Interface绑定, 并加载
        $this->app->register(RepositoryServiceProvider::class);

//        使用自定义分页视图
        Paginator::defaultView('vendor.pagination.bootstrap-4');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 将视图合成器添加到全部视图
        View::composer(
            '*', 'App\Http\View\Composers\CategoryComposer'
        );

        /**
         * 增加内存防止中文分词报错
         *
         * php 默认的 memory_limit 是 128M；
         * 为了防止 PHP Fatal error: Allowed memory size of n bytes exhausted ；
         */
        ini_set('memory_limit', "256M");

        // Faker 本地化
        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('zh_CN');
        });
    }
}
