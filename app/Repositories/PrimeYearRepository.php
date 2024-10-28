<?php

namespace App\Repositories;

use App\Models\PrimeYear;
use Illuminate\Support\Facades\Crypt;

class PrimeYearRepository implements PrimeYearRepositoryInterface
{
    public function bulkInsert(array $data)
    {
        $years = collect($data)->pluck('year')->toArray();
        $existingYears = PrimeYear::whereIn('year', $years)->pluck('year')->toArray();

        $dataToInsert = collect($data)->reject(function ($item) use ($existingYears) {
            return in_array($item['year'], $existingYears);
        })->map(function ($item) {
            return [
                'year' => $item['year'],
                'day' => $item['day'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        if(count($dataToInsert)) {
            PrimeYear::insert($dataToInsert);

            return true;
        }

        return false;

    }

    public function isPrimeYear($year)
    {
        if ($year < 2) {
            return false;
        }
        for ($i = 2; $i <= sqrt($year); $i++) {
            if ($year % $i == 0) {
                return false;
            }
        }
        return true;
    }

    public function getPrimeYears()
    {
        return PrimeYear::all()->map(function ($item) {
            $item->day = Crypt::decryptString($item->day);

            return $item;
        });
    }
}