<?php

namespace Tests\Unit\Http\Controllers;

use Tests\TestCase;
use App\Models\ZipCode;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ZipCodeControllerTest extends TestCase
{
    use RefreshDatabase;
    use DatabaseMigrations;

    /** @test */
    public function it_returns_zip_code_data()
    {
        $zip_code = ZipCode::factory()->create(['id' => 1234]);

        $this->getJson("/api/zip-codes/{$zip_code->id}")
                ->assertStatus(200)
                ->assertExactJson([
                    'zip_code'       => $zip_code->zip_code,
                    'locality'       => $zip_code->city,
                    'federal_entity' => $zip_code->federal_entity,
                    'settlements'    => $zip_code->settlements,
                    'municipality'   => $zip_code->municipality,
                ]);
    }
}
