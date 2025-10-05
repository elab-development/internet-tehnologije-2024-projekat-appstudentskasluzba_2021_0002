<?php

namespace App\Infrastructure\Repositories;

use App\Application\Models\Student as DomainStudent;
use App\Infrastructure\EloquentModels\Student as EloquentStudent;
use App\Infrastructure\Mappers\StudentMapper;
use App\Application\Repositories\StudentRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class EloquentStudentRepository implements StudentRepositoryInterface
{
    public function paginateWithFilters(
        ?int $perPage,
        ?string $q
    ): LengthAwarePaginator {
        $query = EloquentStudent::query();

        if (!empty($q)) {
            $like = "%{$q}%";
            $query->where(function ($qq) use ($like) {
                $qq->where('ime', 'like', $like)
                    ->orWhere('prezime', 'like', $like)
                    ->orWhere('broj_indeksa', 'like', $like)
                    ->orWhere('email', 'like', $like);
            });
        }

        return $query
            ->orderBy('prezime')
            ->orderBy('ime')
            ->paginate($perPage ?? 10)
            ->through(fn (EloquentStudent $m) => StudentMapper::toDomain($m));
    }

    public function findById(int $id): DomainStudent
    {
        return StudentMapper::toDomain(EloquentStudent::findOrFail($id));
    }

    public function create(array $data): DomainStudent
    {
        return StudentMapper::toDomain(EloquentStudent::create($data));
    }

    public function update(DomainStudent $student, array $data): DomainStudent
    {
        $row = EloquentStudent::findOrFail($student->brojIndeksa);
        $row->fill($data)->save();
        return StudentMapper::toDomain($row->refresh());
    }

    public function delete(DomainStudent $student): void
    {
        EloquentStudent::findOrFail($student->brojIndeksa)->delete();
    }

    public function getNextIndexSuffixForYear(int $year): int
    {
        $prefix = (string) $year;

        $max = EloquentStudent::query()
            ->where('broj_indeksa', 'like', $prefix.'%')
            ->selectRaw("MAX(CAST(SUBSTRING(broj_indeksa, 5, 4) AS UNSIGNED)) as max_suffix")
            ->value('max_suffix');

        $next = (int) ($max ?? 0) + 1;

        if ($next > 9999) {
            throw new \RuntimeException("Nema slobodnih brojeva indeksa za godinu {$year}.");
        }

        return $next;
    }
}
