<?php

namespace App\Repositories;

interface PrimeYearRepositoryInterface
{
    public function bulkInsert(array $data);

    public function isPrimeYear($num);

    public function getPrimeYears();
}