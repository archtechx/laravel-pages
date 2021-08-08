<?php

declare(strict_types=1);

namespace ArchTech\Pages;

use Illuminate\Support\Str;

class PageController
{
    public function __invoke(string $page)
    {
        if (str_starts_with($page, '_')) {
            abort(404);
        }

        $view = config('pages.views.path') . $page;

        if (view()->exists($view)) {
            return view($view);
        }

        if ($model = config('pages.model')::find($page)) {
            if ($model->password) {
                abort_unless(request()->query('password') === $model->password, 403);
            }

            seo()
                ->title($model->title)
                ->description(Str::limit($model->content, 100));

            return view(config('pages.views.markdown'), ['page' => $model]);
        }

        abort(404);
    }
}
