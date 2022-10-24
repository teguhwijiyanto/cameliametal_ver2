<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminCustomerTest extends TestCase
{
    public function test_customer_page_with_super_admin_account()
    {
        $user = User::factory(1)->create()->first();
        $user->assignRole('super-admin');
        $response = $this->actingAs($user)
                        ->withSession(['foo'=>'bar'])
                        ->get('admin/customer');
        $response->assertStatus(200);
        $user->delete();
    }
    public function test_customer_page_with_operator_account()
    {
        $user = User::factory(1)->create()->first();
        $user->assignRole('operator');
        $response = $this->actingAs($user)
                        ->withSession(['foo'=>'bar'])
                        ->get('admin/customer');
        $response->assertStatus(403);
        $user->delete();
    }
    public function test_customer_page_with_admin_office_account()
    {
        $user = User::factory(1)->create()->first();
        $user->assignRole('office-admin');
        $response = $this->actingAs($user)
                        ->withSession(['foo'=>'bar'])
                        ->get('admin/customer');
        $response->assertStatus(200);
        $user->delete();
    }
    public function test_input_page()
    {
        $user = $user = User::factory(1)->create()->first();
        $user->assignRole('office-admin');
        $response = $this->actingAs($user)
                        ->get('admin/customer')
                        ->seePageIs('/admin/customer/create');
        $response->assertStatus(200);
        $user->delete();
    }



    
}
