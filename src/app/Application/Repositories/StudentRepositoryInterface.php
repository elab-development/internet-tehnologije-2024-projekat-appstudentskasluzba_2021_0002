<?php

namespace App\Application\Repositories;

use App\Application\Models\Student;
use Illuminate\Pagination\LengthAwarePaginator;

interface StudentRepositoryInterface
{
    public function paginateWithFilters(
        ?int $perPage,
        ?string $q
    ): LengthAwarePaginator;

    public function findById(int $id): Student;

    public function create(array $data): Student;

    public function update(Student $student, array $data): Student;

    public function delete(Student $student): void;

    public function getNextIndexSuffixForYear(int $year): int;
}
