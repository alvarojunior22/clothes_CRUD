<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Vite;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


     protected function setUp(): void
{
    parent::setUp();

    Vite::shouldReceive('__invoke')->andReturn('');
    Vite::shouldReceive('asset')->andReturn('');
    Vite::shouldReceive('useBuildDirectory')->andReturnSelf();
    Vite::shouldReceive('cspNonce')->andReturn(null);
}

}

