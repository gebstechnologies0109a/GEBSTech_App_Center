<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_the_application_redirects_to_app_center(): void
    {
        $this->get('/')
            ->assertRedirect('/app-center');
    }
}
