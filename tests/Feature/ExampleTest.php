<?php

declare(strict_types=1);
use Illuminate\Container\Container;
use Illuminate\Routing\Router;

it('loads the application config', function (): void {
    $app = require __DIR__.'/../../bootstrap/app.php';

    expect($app)->toBeInstanceOf(Container::class);
    expect($app->make('config')->get('app.name'))->toBeString();
});

it('resolves the router', function (): void {
    $app = require __DIR__.'/../../bootstrap/app.php';

    expect($app->make('router'))->toBeInstanceOf(Router::class);
});
