<?php

namespace Tests\Browser;

use App\Models\User;
use Tests\DuskTestCase;
use App\Models\Supplier;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminSupplierTest extends DuskTestCase
{
    public function testBadAccessSupplierPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(3))
                    ->visit('/admin/supplier')
                    ->assertSee('403');
        });
    }

    public function testSupplierPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs((User::find(2)))
                    ->visit('/admin/supplier')
                    ->assertSee('Supplier List');
        });
    }

    public function testCreateSupplierPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->clickLink('Add Supplier')
                    ->assertSee('Add New Supplier');
        });
    }

    public function testFillWrongDataOnCreateSupplier()
    {
        $this->browse(function (Browser $browser) {
            $browser->type('name','')
                    ->type('grade','')
                    ->type('diameter','')
                    ->type('qty_kg','')
                    ->type('qty_coil','')
                    ->press('Add')
                    ->assertSee('Kolom name harus diisi')
                    ->assertSee('Kolom grade harus diisi')
                    ->assertSee('Kolom diameter harus diisi')
                    ->assertSee('Kolom qty kg harus diisi');
        });
    }

    public function testFillCreateSupplier()
    {
        $this->browse(function (Browser $browser) {
            $browser->type('name','Supplier Test')
                    ->type('grade','SS400')
                    ->type('diameter','10.04')
                    ->type('qty_kg','7000')
                    ->type('qty_coil','2')
                    ->press('Add')
                    ->assertSee('Data Added Successfully');
        });
    }

    public function testEditSupplierPage()
    {
        $supplier = Supplier::where('name','Supplier Test')->first();

        $this->browse(function (Browser $browser) use ($supplier) {
            $browser->visit('/admin/supplier/'.$supplier->id.'/edit')
                    ->assertSee('Edit Supplier')
                    ->assertInputValue('name','Supplier Test')
                    ->assertInputValue('grade','SS400')
                    ->assertInputValue('diameter','10.04')
                    ->assertInputValue('qty_kg','7000')
                    ->assertInputValue('qty_coil','2')
                    ->press('Edit')
                    ->assertSee('Data Updated Successfully');
        });

        $supplier->delete();
    }

    

}
