<?php

namespace App\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $table = 'studenti';

    protected $primaryKey = 'broj_indeksa';
    public $incrementing = false;
    protected $keyType = 'iny';

    protected $fillable = [
        'broj_indeksa', 'ime', 'prezime', 'email', 'godina'
    ];

    protected $casts = [
        'godina' => 'int',
        'broj_indeksa' => 'int',
    ];

    public function upisi(): HasMany
    {
        return $this->hasMany(Upis::class, 'student_broj_indeksa');
    }
}
