<?php

namespace App\Application\Models;

class Predmet
{
    public function __construct(
        public int    $id,
        public string $ime,
        public int    $espb,
        public string $katedra,
        public int    $brojStudenata,
        public string $profesor,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {}

}
