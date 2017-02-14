<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Tests\Unit;

use Tests\TestCase;
/**
 * Description of UserRegistrationTest
 *
 * @author shivay
 */
use \App\Http\Utils\SeedUtils;

class UserRegistrationTest extends TestCase {

    public function testRegistration() {
        echo "--------------Registration------------------\n";
        SeedUtils::run();
        $email = "u" . uniqid() . "@email.com";
        $response = $this->json('POST', '/register', ['name' => 'Test Name', 'email' => $email, 'password' => \App\Http\Utils\MsRand::generateRandomString()]);

        $response
                ->assertStatus(200)
                ->assertJson([
                    'message' => "account created. Please login"
        ]);
    }

    public function testLogin() {
        echo "--------------Login------------------\n";
        SeedUtils::run();

        $email = "u" . uniqid() . "@email.com";
        $password = \App\Http\Utils\MsRand::generateRandomString();
        $response = $this->json('POST', '/register', ['name' => 'Test Name', 'email' => $email, 'password' => $password]);
        $response = $this->json('POST', '/authenticate', [ 'email' => $email, 'password' => $password]);
        $response->assertStatus(200);
    }

    public function testLogout() {
        echo "--------------Logout------------------\n";
        SeedUtils::run();
        $response = $this->json('GET', '/logout', []);
        $response->assertStatus(200)->assertJson([
            'message' => "success"
        ]);
    }

    public function testValidateToken() {
        echo "--------------ValidateToken------------------\n";
        SeedUtils::run();
        $email = "u" . uniqid() . "@email.com";
        $password = \App\Http\Utils\MsRand::generateRandomString();
        $response = $this->json('POST', '/register', ['name' => 'Test Name', 'email' => $email, 'password' => $password]);
        $response = $this->json('POST', '/authenticate', [ 'email' => $email, 'password' => $password]);
        $original = $response->original;
        $token = $original['token'];
        $response = $this->json('GET','validateToken', [],['Authorization' => 'Bearer ' . $token]);
        $response->assertStatus(200)->assertJson([
            'status' => "success"
        ]);
    }

}
