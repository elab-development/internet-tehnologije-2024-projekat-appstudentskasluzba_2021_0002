<?php

namespace App\Infrastructure\Mappers;

use App\Application\Models\Predmet as DomainPredmet;
use App\Infrastructure\EloquentModels\Predmet as EloquentPredmet;

final class PredmetMapper
{
    public static function toDomain(EloquentPredmet $m): DomainPredmet
    {
        return new DomainPredmet(
            id:             (int) $m->id,
            ime:            (string) $m->ime,
            espb:           (int) $m->espb,
            katedra:        (string) $m->katedra,
            brojStudenata:  (int) $m->broj_studenata,
            profesor:       (string) $m->profesor,
            createdAt:      $m->created_at?->toISOString(),
            updatedAt:      $m->updated_at?->toISOString(),
        );
    }
}
