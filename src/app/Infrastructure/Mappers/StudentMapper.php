<?php

namespace App\Infrastructure\Mappers;

use App\Application\Models\Student as DomainStudent;
use App\Infrastructure\EloquentModels\Student as EloquentStudent;

final class StudentMapper
{
    public static function toDomain(EloquentStudent $m): DomainStudent
    {
        return new DomainStudent(
            brojIndeksa:  (int) $m->broj_indeksa,
            ime:          (string) $m->ime,
            prezime:      (string) $m->prezime,
            email:        (string) $m->email,
            godina:       (int) $m->godina,
            createdAt:    $m->created_at?->toISOString(),
            updatedAt:    $m->updated_at?->toISOString(),
        );
    }
}
