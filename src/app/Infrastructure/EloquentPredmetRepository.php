<?php

namespace App\Infrastructure;

use App\Application\Models\Predmet;
use App\Application\Repositories\PredmetRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentPredmetRepository implements PredmetRepositoryInterface
{

    public function paginateWithFilters(?int $perPage, ?int $semestar, ?int $espbMin): LengthAwarePaginator
    {
        // TODO: Implement paginateWithFilters() method.
    }

    public function findById(int $id): Predmet
    {
        // TODO: Implement findById() method.
    }

    public function create(array $data): Predmet
    {
        // TODO: Implement create() method.
    }

    public function update(Predmet $predmet, array $data): Predmet
    {
        // TODO: Implement update() method.
    }

    public function delete(Predmet $predmet): void
    {
        // TODO: Implement delete() method.
    }
}
