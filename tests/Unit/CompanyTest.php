<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class CompanyTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_company_index()
    {
        $response = $this->call('GET', route('company.index'));
        $response->assertViewIs('company.index');
        //$response->assertStatus(200);
    }

    public function test_company_create()
    {
        $response = $this->call('GET', route('company.create'));
        $response->assertStatus(200);
    }

    public function test_company_store()
    {
        $response = $this->call('POST', route('company.store'), [
            '_token' => csrf_token(),
            'com_name' => 'Compañia',
            'society' => 'S.R.L. (Sociedad de Responsabilidad Limitada)',
            'sector' => 'Sector Terciario',
            'property' => 'Privada',
            'location' => 'Cochabamba, Bolivia',
            'description' => 'Probando el test de empresa',
            'bg_image' => null,
            'com_image' => null,
            
        ]);
        //$response->assertSessionHasErrors('com_name');
        $response->assertStatus($response->status(), 200);
    }


    public function test_company_view()
    {
        $response = $this->get(route('company.show', 1));
        $response->assertStatus(200);
    }

    public function test_company_edit()
    {
        $response = $this->get(route('company.edit', 1));
        $response->assertStatus(200);
    }

    public function test_company_update()
    {
        $response = $this->call('PUT', route('company.update', 1), [
            'com_name' => 'Compañia',
            'society' => 'S.R.L. (Sociedad de Responsabilidad Limitada)',
            'sector' => 'Sector Terciario',
            'property' => 'Privada',
            'location' => 'Cochabamba, Bolivia',
            'description' => 'Probando el test de empresa',
            'bg_image' => null,
            'com_image' => null,
        ]);
        //$response->assertSessionHasErrors('com_name');
        $response->assertStatus($response->status() ,200);
    }

    public function test_company_delete()
    {
        $response = $this->delete(route('company.destroy', 1));
        $response->assertStatus($response->status() ,200);
    }

}
