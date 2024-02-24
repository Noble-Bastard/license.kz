<?php

namespace App\Http\Controllers\Core;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;

class ArtisanController extends Controller
{
  public function migrate_install()
  {
    self::_echo('init migrate:install');
    Artisan::call('migrate:install');
    self::_echo('done migrate:install');
  }

  public function migrate()
  {
    self::_echo('init migrate');
    Artisan::call('migrate');
    self::_echo('done migrate');
  }

  public function clearCache()
  {
    Artisan::call('cache:clear');
    self::_echo('cache:clear');

    Artisan::call('config:cache');
    self::_echo('config:cache');

    Artisan::call('route:cache');
    self::_echo('route:cache');

    Artisan::call('view:clear');
    self::_echo('view:clear');
  }

  public function cache()
  {
    Artisan::call('config:cache');
    self::_echo('config:cache');
  }

  public function clearCompiled()
  {
    Artisan::call('clear-compiled');
    self::_echo('clear-compiled');
  }

  public function storageLink()
  {
    App::make('files')->link(storage_path('app/public'), public_path('storage'));
    self::_echo('storage:link');
  }

  public function seedData()
  {
    Artisan::call('db:seed --class=ExtraServiceSeeder');
    self::_echo('seed complete');
  }

  private function _echo($val)
  {
    echo '<br/>' . $val;
  }
}
