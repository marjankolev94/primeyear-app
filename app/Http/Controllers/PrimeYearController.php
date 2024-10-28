<?php

namespace App\Http\Controllers;

use App\Repositories\PrimeYearRepositoryInterface;
use App\Http\Requests\StorePrimeYearRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class PrimeYearController extends Controller
{
    protected $primeYearRepository;

    public function __construct(PrimeYearRepositoryInterface $primeYearRepository)
    {
        $this->primeYearRepository = $primeYearRepository;
    }

    public function create()
    {
        return view('primeyear.create', ['primeYears' => $this->primeYearRepository->getPrimeYears()]);
    }

    public function store(StorePrimeYearRequest $request)
    {
        $year = $request->input('year');
        $primeYears = [];
        $currentYear = $year;

        while (count($primeYears) < 30) {
            if ($this->primeYearRepository->isPrimeYear($currentYear)) {
                $primeYears[] = $currentYear;
            }
            $currentYear--;
        }

        $data = [];
        foreach ($primeYears as $primeYear) {
            $christmasDay = Carbon::create($primeYear, 12, 25)->format('l');
            $encryptedDay = Crypt::encryptString($christmasDay);

            $data[] = [
                'year' => $primeYear,
                'day' => $encryptedDay,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $message = $this->primeYearRepository->bulkInsert($data) ? 'Prime years saved successfully.' : 'Prime years for entered year already saved.';

        $primeYears = $this->primeYearRepository->getPrimeYears();

        return response()->json(['message' => $message, 'primeYears' => $primeYears]);
    }

}
