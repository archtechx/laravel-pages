# Laravel Pages

This package lets you create pages using Markdown or Blade without having to worry about creating routes or controllers yourself.

Essentially, you create either `content/pages/foo.md` or `resources/views/pages/foo.blade.php` and the page will be accessible on the `/foo` route.

Markdown files use a pre-defined Blade view to get rendered. Blade files are meant for pages which don't follow the default layout and need more custom styling.

For instance, you could have the `/pricing` route use a Blade file (`pages/pricing.blade.php`) with a pretty design that accompanies your pricing copy.

Whereas for `/about`, you could have a simple Markdown file (`content/pages/about.md`) that describes your service using pure text without any special graphical elements.

We use this on the ArchTech website — the [About](https://archte.ch/about), [Careers](https://archte.ch/careers), and [Open source](https://archte.ch/open-source) pages are simple Markdown files.

## Installation

Require the package via composer:

```
composer require archtechx/laravel-pages
```

Publish the config file:

```
php artisan vendor:publish --tag=archtech-pages-config
```

And finally, add this line to the **end** of your `routes/web.php` file:

```php
ArchTech\Pages\Page::routes();
```

This line will register the routes in a way that ensures that your routes take precedence, and the page route is only used as the final option.

**Important: Before attempting to visit URLs managed by this package, make sure that you configure it to use the correct layout (see the section below). Otherwise you might get an error saying that the view cannot be found.**

## Usage

### Markdown pages

To create a markdown file, create a file in `content/pages/`. The route to the page will match the file name (without `.md`).

For example, to create the `/about` page, create `content/pages/about.md` with this content:

```md
---
slug: about
title: 'About us'
updated_at: 2021-05-19T19:09:02+00:00
created_at: 2021-05-19T19:09:02+00:00
---

We are a web development agency that specializes in ...
```

### Blade pages

To create a Blade page, create a file in `resources/views/pages/`. Like in the Markdown example, the route to the page will match the file name without the extension.

Therefore to create the `/about` page, you'd create `resources/views/pages/about.blade.php`:

```html
<x-app-layout>
    This view can use any layouts or markup.
</x-app-layout>
```

## Configuration

You'll likely want to configure a few things, most likely the used layout.

To do that, simply modify `config/pages.php`.

The config file lets you change:
- the used model
- the used controller
- the layout used by the markdown views
- the view file used to render Markdown pages
- routing details

The layout is used *by* the vendor (package-provided) Markdown view. You'll likely want to set it to something like `app-layout` or `layouts.app`.

If you'd like to change the file that renders the Markdown itself, create `resources/views/pages/_markdown.blade.php` (the `_` prefix is important as it prevents direct visits) and change the `pages.views.markdown` config key to `pages._markdown`.

And if you'd like to customize the routing logic more ethan the config file allows you, simply register the route yourself (instead of calling `Page::routes()`):

```php
Route::get('/{page}', ArchTech\Pages\PageController::class);
```

## Ecosystem support

The package perfectly supports other tools in the ecosystem, such as [Laravel Nova](https://nova.laravel.com) or [Lean Admin](https://lean-admin.dev).

For example, in Laravel Nova you could create a resource for the package-provided `Page` model (`ArchTech\Pages\Page`) and use the following field schema:

```php
public function fields(Request $request)
{
    return [
        Text::make('slug'),
        Text::make('title'),
        Markdown::make('content'),
    ];
}
```

## Git integration & Orbit

This package uses [Orbit](https://github.com/ryangjchandler/orbit) under the hood — to manage the Markdown files as Eloquent models. If you'd like to customize some things related to that logic, take a look at the Orbit documentation.

The package also uses another package of ours, [Laravel SEO](https://github.com/archtechx/laravel-seo), to provide meta tag support for Markdown pages. We recommended that you use this package yourself, since it will make handling meta tags as easy as adding the following line to your layout's `<head>` section:

```html
<x-seo::meta />
```
