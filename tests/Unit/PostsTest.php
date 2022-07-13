<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
use Tests\TestCase;
/*use Illuminate\Support\Facades\Auth;
use App\User;*/
use App\Post;

class PostsTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_post_index()
    {
        $response = $this->get(route('post.index'));
        $response->assertViewIs('post.index');
        //$response->assertStatus(200);
    }

    public function test_post_create(){
        $response = $this->get(route('post.show', 1));
        $response->assertStatus(200);
    }

    public function test_post_store(){
        $response = $this->call('POST', route('post.store'), [
            '_token' => csrf_token(),
            //'description' => 'probando el testing de post',
            'image' => null
        ]);
        //dd($response);
        $response->assertSessionHasErrors('description');
       //$response->assertStatus($response->status(), 200);
    }
}
