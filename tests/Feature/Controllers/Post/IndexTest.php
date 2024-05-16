<?php
use function Pest\Laravel\get;
use Inertia\Testing\AssertableInertia as Assert;

it('should return the correct route view component', function() {
    get(route('posts.index'))
        ->assertInertia(fn (Assert $inertia) => $inertia
            ->component('Posts/Index')
        );
});
