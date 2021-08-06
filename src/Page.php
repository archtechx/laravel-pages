<?php

declare(strict_types=1);

namespace ArchTech\Pages;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Route;
use Orbit\Concerns\Orbital;

class Page extends Model
{
    use Orbital;

    protected $guarded = [];

    public static function schema(Blueprint $table)
    {
        $table->string('slug');
        $table->string('title');
        $table->longText('content');
    }

    public function getKeyName()
    {
        return 'slug';
    }

    public function getIncrementing()
    {
        return false;
    }

    public static function routes(): void
    {
        Route::get('/{page}', config('pages.routes.handler'))
            ->prefix(config('pages.routes.prefix'))
            ->name(config('pages.routes.name'));
    }
}
