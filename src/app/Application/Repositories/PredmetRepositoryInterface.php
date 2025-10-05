<?php

namespace App\Application\Repositories;

use App\Application\Models\Predmet;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PredmetRepositoryInterface
{
    public function paginateWithFilters(?int $perPage, ?int $espbMin, ?string $katedra, ?string $profesor) : LengthAwarePaginator;

    public function findById(int $id) : Predmet;

    public function create(array $data) : Predmet;

    public function update(Predmet $predmet, array $data) : Predmet;

    public function delete(Predmet $predmet) : void;
}
