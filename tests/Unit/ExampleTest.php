<?php

declare(strict_types=1);

it('passes a trivial unit assertion', function (): void {
    expect(true)->toBeTrue();
});

it('validates helper env() coercion', function (): void {
    // env() lives in app/Helpers/helpers.php via autoload.files
    expect(env('APP_ENV'))->toBeString();
});
