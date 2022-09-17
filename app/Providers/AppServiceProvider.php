<?php

namespace App\Providers;

use App\Entity\Extract\CommandExtractor;
use App\Entity\Extract\Extractable;
use App\Entity\File\FileSaveable;
use App\Entity\File\FileSaver;
use App\Entity\File\UploadedFilesReceiver;
use App\Entity\JSON\ExtractedJSONFileConvertable;
use App\Entity\JSON\ExtractedJSONFileConverter;
use App\Mock\MockExtractor;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(FileSaveable::class, FileSaver::class);
        $this->app->bind(UploadedFilesReceiver::class, function (Application$app) {
            return new UploadedFilesReceiver($app->make(FileSaveable::class));
        });
        $this->app->bind(Extractable::class, CommandExtractor::class);

        $this->app->bind(ExtractedJSONFileConvertable::class, ExtractedJSONFileConverter::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
