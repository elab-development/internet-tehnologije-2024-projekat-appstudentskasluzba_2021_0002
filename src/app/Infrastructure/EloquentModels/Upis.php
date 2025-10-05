<?php

namespace App\Infrastructure\EloquentModels;

class Upis
{
    protected $table = 'upisi';

    protected $fillable = [
        'student_broj_indeksa', 'predmet_id', 'status', 'ocena',
    ];

    protected $casts = [
        'student_id' => 'int',
        'predmet_id' => 'int',
        'ocena'      => 'int',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_broj_indeksa');
    }

    public function predmet(): BelongsTo
    {
        return $this->belongsTo(Predmet::class, 'predmet_id');
    }
}
