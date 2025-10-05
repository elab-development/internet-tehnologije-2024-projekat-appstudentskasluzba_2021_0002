<?php

namespace App\Infrastructure\Repositories;

use App\Application\Repositories\PredmetRepositoryInterface;
use App\Application\Models\Predmet as DomainPredmet;
use App\Infrastructure\EloquentModels\Predmet as EloquentPredmet;
use App\Infrastructure\Mappers\PredmetMapper;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentPredmetRepository implements PredmetRepositoryInterface
{

    public function paginateWithFilters(?int $perPage, ?int $espbMin, ?string $katedra, ?string $profesor): LengthAwarePaginator
    {
        $q = Predmet::query();

        if (!is_null($espbMin)) {
            $q->where('espb', '>=', $espbMin);
        }
        if (!is_null($katedra) && $katedra !== '') {
            $q->where('katedra', 'LIKE', "%{$katedra}%");
        }
        if (!is_null($profesor) && $profesor !== '') {
            $q->where('profesor', 'LIKE', "%{$profesor}%");
        }

        return $q->orderBy('ime')->paginate($perPage ?? 10);
    }

    public function findById(int $id): DomainPredmet
    {
        return PredmetMapper::toDomain(EloquentPredmet::findOrFail($id));

    }

    public function create(array $data): DomainPredmet
    {
        return PredmetMapper::toDomain(EloquentPredmet::create($data));
    }

    public function update(DomainPredmet $predmet, array $data): DomainPredmet
    {
        $row = EloquentPredmet::findOrFail($predmet->id);
        $row->fill($data)->save();
        return PredmetMapper::toDomain($row->refresh());
    }

    public function delete(DomainPredmet $predmet): void
    {
        EloquentPredmet::findOrFail($predmet->id)->delete();

    }
}
