<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminUserTest extends DuskTestCase
{
    public function testBadAccessOfficeAdminPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(2))
                    ->visit('/admin/user')
                    ->assertSee('403');
        });
    }

    public function testBadAccessOperatorPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/admin/user')
                    ->assertSee('403');
        });
    }

    public function testPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/admin/user')
                    ->assertSee('User Account List');
        });
    }

    public function testCreateAccountPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->clickLink('Add Account')
                    ->assertSee('Add New Account');
        });
    }
    
    public function testFillWrongData()
    {
        $this->browse(function (Browser $browser) {
            $browser->type('name','')
                    ->type('employeeId','01')
                    ->select('role','')
                    ->press('Add')
                    ->assertSee('Kolom name harus diisi')
                    ->assertSee('Kolom employee id harus setidaknya diisi 8 digit')
                    ->assertSee('Kolom role harus diisi');
        });
    }

    public function testFillCreateUserForm()
    {
        $this->browse(function (Browser $browser) {
            $browser->type('name','Testing Account')
                    ->type('employeeId','00000999')
                    ->select('role','super-admin')
                    ->press('Add')
                    ->assertSee('Data Added Successfully');
        });

        // User::where('employeeId','00000999')->delete();
    }

    public function testFillEditUserForm()
    {
        $user = User::where('employeeId','00000999')->first();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/user/'.$user->id.'/edit')
                    ->assertSee('Edit Account')
                    ->assertInputValue('name','Testing Account')
                    ->assertInputValue('employeeId','00000999')
                    ->assertSelected('role','super-admin')
                    ->type('name','')
                    ->type('employeeId','000009991')
                    ->press('Edit')
                    ->assertSee('Kolom name harus diisi')
                    ->assertSee('Kolom employee id tidak bisa diisi lebih dari 8 digit');
        });
    }

    public function testEditAccountPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->type('name','Testing Account Edit')
                    ->type('employeeId','00000998')
                    ->select('role','office-admin')
                    ->press('Edit')
                    ->assertSee('Data Updated Successfully');
        });

        User::where('employeeId','00000998')->delete();
    }
}
