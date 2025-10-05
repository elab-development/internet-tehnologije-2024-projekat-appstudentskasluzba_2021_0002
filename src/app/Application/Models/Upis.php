<?php

namespace App\Application\Models;

class Upis
{
    public function __construct(
        public int    $id,
        public int    $studentId,
        public int    $predmetId,
        public string $status,   // 'upisan' | 'polozio' | 'pao'
        public ?int   $ocena,    // 6–10 ili null
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {}
}
