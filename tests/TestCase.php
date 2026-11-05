<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Schema;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Run all migrations before each test.
        // This ensures the ratings table exists for tests.
        if (! Schema::hasTable('ratings')) {
            $this->artisan('migrate')->run();
        }
    }
}
