<?php

namespace App\Infrastructure\EloquentModels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Predmet extends Model
{
    protected $table = 'predmeti';

    protected $fillable = [
        'ime', 'espb', 'katedra', 'broj_studenata', 'profesor',
    ];

    // Ako si ostavio predmeti BEZ timestamps u migraciji, otvori sledeću liniju:
    // public $timestamps = false;

    protected $casts = [
        'espb'            => 'integer',
        'broj_studenata'  => 'integer',
    ];

    public function upisi(): HasMany
    {
        return $this->hasMany(EloquentUpisModel::class, 'predmet_id');
    }
}
