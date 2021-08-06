<?php

use ArchTech\Pages\Page;

beforeEach(function () {
    Page::routes();

    Page::query()->delete();

    view()->addNamespace('test', __DIR__ . '/../views');

    config([
        'pages.views.layout' => 'test::layout',
        'pages.views.path' => 'test::',
        'orbit.paths.content' => __DIR__ . '/../orbit/content',
        'orbit.paths.cache' => __DIR__ . '/../orbit/cache',
    ]);
});

test('a view is shown if it exists')
    ->get('/example')
    ->assertSee('Test view');

test('markdown is rendered if it exists', function () {
    Page::create([
        'slug' => 'test',
        'title' => 'Markdown page',
        'content' => 'This is a **test page**'
    ]);

    using($this)
        ->get('/test')
        ->assertSee('Markdown page')
        ->assertSee('<strong>test page</strong>', false);
});

test('view takes precedence over markdown', function () {
    Page::create([
        'slug' => 'example',
        'title' => 'Test page',
        'content' => 'This is a test page'
    ]);

    using($this)
        ->get('/example')
        ->assertSee('Test view')
        ->assertDontSee('Test page');
});

test('404 is returned if no view or markdown is found')
    ->get('/foo')
    ->assertNotFound();

test('a custom layout can be used', function () {
    config(['pages.views.layout' => 'test::layout2']);

    Page::create([
        'slug' => 'test',
        'title' => 'Test page',
        'content' => 'This is a test page'
    ]);

    using($this)
        ->get('/test')
        ->assertSee('second layout');
});

test('SEO metadata is set on markdown pages', function () {
    Page::create([
        'slug' => 'test',
        'title' => 'Test page',
        'content' => 'This is a test page'
    ]);

    using($this)
        ->get('/test')
        ->assertSee('<meta property="og:title" content="Test page" />', false)
        ->assertSee('<meta property="og:description" content="This is a test page" />', false);
});
