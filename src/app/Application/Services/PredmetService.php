<?php

namespace App\Application\Services;

use App\Application\Models\Predmet;
use App\Application\Repositories\PredmetRepositoryInterface;

class PredmetService
{
    private PredmetRepositoryInterface $predmetRepository;

    public function __construct(PredmetRepositoryInterface $predmetRepository)
    {
        $this->predmetRepository = $predmetRepository;
    }

    public function getAll(?int $perPage = 10, ?int $semestar = null, ?int $espbMin = null): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->predmetRepository->paginateWithFilters($perPage, $semestar, $espbMin);
    }

    public function find(int $id): Predmet
    {
        return $this->predmetRepository->findById($id);
    }

    public function create(array $data): Predmet
    {
        return $this->predmetRepository->create($data);
    }

    public function update(Predmet $predmet, array $data): Predmet
    {
        return $this->predmetRepository->update($predmet, $data);
    }

    public function delete(Predmet $predmet): void
    {
        $this->predmetRepository->delete($predmet);
    }
}
