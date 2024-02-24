<?php

namespace App\Providers;

use App\Repositories\AuthUserRepository;
use App\Repositories\BaseRepository;
use App\Repositories\ExtraServiceDocumentsRepository;
use App\Repositories\ExtraServiceQuestionMapRepository;
use App\Repositories\ExtraServiceQuestionRepository;
use App\Repositories\ExtraServiceQuestionValueRepository;
use App\Repositories\ExtraServiceRepository;
use App\Repositories\ExtraServiceStepBodesRepository;
use App\Repositories\ExtraServiceStepRepository;
use App\Repositories\Interfaces\IExtraServiceDocumentsRepository;
use App\Repositories\Interfaces\IExtraServiceQuestionMapRepository;
use App\Repositories\Interfaces\IExtraServiceQuestionRepository;
use App\Repositories\Interfaces\IExtraServiceQuestionValueRepository;
use App\Repositories\Interfaces\IExtraServiceRepository;
use App\Repositories\Interfaces\IExtraServiceStepBodesRepository;
use App\Repositories\Interfaces\IExtraServiceStepRepository;
use App\Repositories\Interfaces\IMediaRepository;
use App\Repositories\Interfaces\IOkedRepository;
use App\Repositories\Interfaces\IRepository;
use App\Repositories\Interfaces\IReviewRepository;
use App\Repositories\MediaRepository;
use App\Repositories\OkedRepository;
use App\Repositories\ReviewRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    public function register() : void
    {
        //
    }


    public function boot() : void
    {
        $this->app->bind(IRepository::class, BaseRepository::class);
        $this->app->bind(IMediaRepository::class, MediaRepository::class);
        $this->app->bind(IReviewRepository::class, ReviewRepository::class);
        $this->app->bind(IOkedRepository::class, OkedRepository::class);
        $this->app->bind(IExtraServiceRepository::class, ExtraServiceRepository::class);
        $this->app->bind(IExtraServiceQuestionRepository::class, ExtraServiceQuestionRepository::class);
        $this->app->bind(IExtraServiceQuestionMapRepository::class, ExtraServiceQuestionMapRepository::class);
        $this->app->bind(IExtraServiceQuestionValueRepository::class, ExtraServiceQuestionValueRepository::class);
        $this->app->bind(IExtraServiceStepRepository::class, ExtraServiceStepRepository::class);
        $this->app->bind(IExtraServiceStepBodesRepository::class, ExtraServiceStepBodesRepository::class);
        $this->app->bind(IExtraServiceDocumentsRepository::class, ExtraServiceDocumentsRepository::class);
    }
}
