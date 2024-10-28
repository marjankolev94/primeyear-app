<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\PrimeYear;
use Illuminate\Support\Facades\Crypt;

class PrimeYearControllerTest extends TestCase
{
    //use RefreshDatabase;

    protected $response;

    protected function setUp(): void
    {
        parent::setUp();

        $formData = [
            'year' => 2024,
        ];

        $this->response = $this->post(route('primeyear.store'), $formData);
    }

    public function test_store_prime_year_response()
    {
        $formData = [
            'year' => 2024,
        ];

        $this->response = $this->post(route('primeyear.store'), $formData);

        $this->response->assertStatus(200);

        $this->response->assertJsonStructure([
            'message',
            'primeYears' => [
                '*' => [
                    'year',
                    'day',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
    }

    public function test_prime_years_count()
    {
        // Assert there are exactly 30 records in the prime_years table, for the '2024' as an input year
        $this->assertCount(30, PrimeYear::all());
    }

    public function test_prime_years_unique()
    {
        // Assert that all 30 years backwards 2024 are unique
        $this->assertEquals(30, PrimeYear::distinct()->count('year'));
    }

    public function test_prime_years_exact_values()
    {
        $expectedPrimeYears = [2017, 2011, 2003, 1999, 1997, 
                                1993, 1987, 1979, 1973, 1951, 
                                1949, 1933, 1931, 1913, 1907, 
                                1901, 1889, 1879, 1877, 1873, 
                                1871, 1867, 1861, 1847, 1831, 
                                1823, 1811, 1801, 1789, 1787];
        
        // Assert that values for all 30 prime years are as expected
        foreach ($expectedPrimeYears as $year) {
            $this->assertDatabaseHas('prime_years', ['year' => $year]);
        }
    }
}
