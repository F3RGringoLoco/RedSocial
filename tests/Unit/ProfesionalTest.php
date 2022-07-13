<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfesionalTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_profesional_index()
    {
        $response = $this->call('GET', route('profesional.index'));
        $response->assertStatus(200);
    }

    public function test_profesional_view()
    {
        $response = $this->get(route('profesional.show', 1));
        $response->assertStatus(200);
    }

    public function test_welcome(){
        $user = factory(User::class)->make();

        $response = $this->actingAs($user)->get(route('home'));
        $response->assertStatus(200);
    }

}
