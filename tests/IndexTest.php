<?php

namespace  CodersStudio\Notifications\Tests;

use CodersStudio\Notifications\Notifications\System;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use CodersStudio\Notifications\Facades\Notifications;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;
use Auth;

class IndexTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * Test index action
     *
     * @return void
     */
    public function testIndex()
    {
        $this->init();
    }

     /**
     * Test read action
     *
     * @return void
     */
    public function testRead()
    {
        $content = $this->init();
        $response = $this->patch('/users/1/notifications/'.$content['data']['0']['id']);
        $response->assertStatus(204);
    }

     /**
     * Test read all action
     *
     * @return void
     */
    public function testReadAll()
    {
        $content = $this->init();
        $response = $this->patch('/users/1/notifications/read-all');
        $response->assertStatus(204);
    }

    /**
     * Login with fake user
     *
     * @return void
     */
    public function loginWithFakeUser()
    {
        $user = new User();
        $user->id = 1;
        $this->be($user);
    }

    /**
     * Init user and message
     *
     * @return void
     */
    public function init(){
        $this->loginWithFakeUser();
        //Uncomment to test telegram be sure using proxy if not on vps
//        Notification::send(Auth::user(), new System("test message", "/something",['telegram' => true]));
        Notifications::send(Auth::user(), "test", "/", ['telegram' => true]);
        $response = $this->get('/users/1/notifications');
        $response->assertStatus(200);
        $response->assertJson([
            "data" => [
                ["type"=> "notifications"]
            ]
        ]);
        return $response->decodeResponseJson();
    }
}
