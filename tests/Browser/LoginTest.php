<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase {

    public function testHomePage() {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login');
        });
    }

    public function testLogin() {
        $this->browse(function (Browser $browser) {

            $browser->visit('/')
                    ->type('email', 'admin@email.com')
                    ->type('password', 'password1')
                    ->press('login')->waitFor('.cp-header');
                    
            
        });
    }

}
