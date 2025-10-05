<?php

namespace App\Application\Models;

use Ramsey\Uuid\Type\Integer;

class Student
{
    public function __construct(
        public int $brojIndeksa,
        public string $ime,
        public string $prezime,
        public string $email,
        public int $godina,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {}
}
