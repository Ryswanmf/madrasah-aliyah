<?php

namespace Tests\Feature;

use App\Models\PpdbRegistration;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PpdbTest extends TestCase
{
    use RefreshDatabase;

    public function test_landing_page_renders_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('PPDN Darun Najah');
        $response->assertSee('LKP Langgas Sinau');
        $response->assertSee('https://www.langgas-sinau.com/');
    }

    public function test_can_register_new_student(): void
    {
        $data = [
            'full_name' => 'Ahmad Fajar Shodiq',
            'nisn' => '0081234567',
            'gender' => 'L',
            'birth_place' => 'Sekampung',
            'birth_date' => '2010-05-15',
            'school_origin' => 'MTs Darun Najah',
            'parent_name' => 'H. Sulaiman',
            'phone_number' => '081234567890',
            'address' => 'Desa Sambikarto RT 02/01',
            'program_choice' => 'MIPA (Sains & Teknologi)',
            'dormitory_choice' => '1',
        ];

        $response = $this->post(route('ppdb.store'), $data);
        $response->assertRedirect();
        $response->assertSessionHas('ppdb_success', true);

        $this->assertDatabaseHas('ppdb_registrations', [
            'full_name' => 'Ahmad Fajar Shodiq',
            'nisn' => '0081234567',
        ]);
    }
}
