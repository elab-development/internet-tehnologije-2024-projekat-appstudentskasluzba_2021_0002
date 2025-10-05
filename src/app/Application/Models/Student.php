<?php

namespace App\Application\Models;

class Student
{
    public function __construct(
        public int    $id,
        public string $brojIndeksa,
        public string $ime,
        public string $prezime,
        public string $email,
        public int    $godina,
        public ?string $createdAt = null,
        public ?string $updatedAt = null,
    ) {}
}
