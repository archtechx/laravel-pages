<?php

namespace ArchTech\Pages\Tests;

use Orchestra\Testbench\TestCase as TestbenchTestCase;
use ArchTech\Pages\PagesServiceProvider;
use ArchTech\SEO\SEOServiceProvider;
use Orbit\OrbitServiceProvider;

class TestCase extends TestbenchTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            SEOServiceProvider::class,
            OrbitServiceProvider::class,
            PagesServiceProvider::class,
        ];
    }
}
