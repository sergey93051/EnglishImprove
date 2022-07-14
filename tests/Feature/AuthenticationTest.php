<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    private $email = 'csddfddx@mail.ru';
    private $password = 'ascsacsc123';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_register()
    {
        $roles = ['student', 'teacher'];

        $key = array_rand($roles);
        $role = $roles[$key];

        $response = $this->postJson('/v1/register',[
            'email'         => $this->email,
            'password'      => $this->password,
            'role'          => $role
        ]);

        $response->assertJson(fn(AssertableJson $json)=>
            $json
            ->has('token')
            ->where('success' , true)
            ->where('email_verified' , false)
            ->etc()
        );

        $response->assertStatus(201);

    }

    public function testLogin()
    {
        $response = $this->post('/v1/login',[
            'email'     => $this->email,
            'password'  => $this->password
        ]);

        $response->assertJson(fn(AssertableJson $json)=>
        $json
            ->where('success' , true)
            ->has('token')
            ->has('email_verified')
            ->etc()
        );

        $response->assertStatus(200);

    }

    public function testUpdateTwoFaState()
    {
        $loginResponse = $this->post('/v1/login',[
            'email'     => $this->email,
            'password'  => $this->password
        ]);

        $token = $loginResponse->getData()->token;

        $response = $this->withHeaders(['Authorization'=>'Bearer '.$token,'Accept' => 'application/json'])
            ->put('v1/update-2fa-state',[
                'twoFa' => 1
             ]);

        $this->assertTrue($response->getData()->success);
    }

    public function testLoginAfterIpConfirmation()
    {
        $response = $this->post('/v1/login',[
            'email'     => $this->email,
            'password'  => $this->password
        ]);

        $response->assertJson(fn(AssertableJson $json)=>
        $json
            ->where('success' , false)
            ->has('response')
            ->etc()
        );

        $response->assertStatus(406);
    }

    public function testRemoveUser()
    {
        $response = $this->
             withHeaders(['Accept' => 'application/json'])
             ->post('/v1/delete-user',[
             'email'     => $this->email,
        ]);

        $response->assertStatus(200);
    }
}
