<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testLoginPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Login');
        });
    }

    public function testFalseEmployeeId()
    {
        $this->browse(function(Browser $browser){
            $browser->visit('/login')
                    ->type('employeeId','000009991')
                    ->type('password','12345678')
                    ->press('Login')
                    ->assertSee('These credentials do not match our records');
        });
    }

    public function testFalsePassword()
    {
        $this->browse(function(Browser $browser){
            $browser->visit('/login')
                    ->type('employeeId','00000001')
                    ->type('password','12345678910')
                    ->press('Login')
                    ->assertSee('These credentials do not match our records');
        });
    }

    public function testLoginWithSuperAdmin()
    {
        $this->browse(function(Browser $browser){
            $browser->visit('/login')
                    ->type('employeeId','00000001')
                    ->type('password','12345678')
                    ->press('Login')
                    ->assertSee('Home')
                    ->clickLink('Logout');
        });
    }

    public function testLoginWithOfficeAdmin()
    {
        $this->browse(function(Browser $browser){
            $browser->visit('/login')
                    ->type('employeeId','00000002')
                    ->type('password','12345678')
                    ->press('Login')
                    ->assertSee('Home')
                    ->clickLink('Logout');
        });
    }
    public function testLoginWithOperator()
    {
        $this->browse(function(Browser $browser){
            $browser->visit('/login')
                    ->type('employeeId','00000003')
                    ->type('password','12345678')
                    ->press('Login')
                    ->assertSee('Home')
                    ->clickLink('Logout');
        });
    }
}
