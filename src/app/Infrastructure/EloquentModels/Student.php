<?php

namespace App\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student
{
    protected $table = 'studenti';

    protected $fillable = [
        'broj_indeksa', 'ime', 'prezime', 'email', 'godina',
    ];

    protected $casts = [
        'godina' => 'integer',
    ];

    public function upisi(): HasMany
    {
        return $this->hasMany(EloquentUpisModel::class, 'student_id');
    }
}
