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

    protected $casts = [
        'espb'            => 'int',
        'broj_studenata'  => 'int',
    ];

    public function upisi(): HasMany
    {
        return $this->hasMany(Upis::class, 'predmet_id');
    }
}
