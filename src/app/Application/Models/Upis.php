<?php

namespace App\Application\Models;

class Upis
{
    public function __construct(
        public int    $id,
        public int    $studentId,
        public int    $predmetId,
        public string $status,
        public ?int   $ocena,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {}
}
