<?php

namespace App\Infrastructure\EloquentModels;

class Upis
{
    protected $table = 'upisi';

    protected $fillable = [
        'student_id', 'predmet_id', 'status', 'ocena',
    ];

    protected $casts = [
        'student_id' => 'integer',
        'predmet_id' => 'integer',
        'ocena'      => 'integer',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(EloquentStudentModel::class, 'student_id');
    }

    public function predmet(): BelongsTo
    {
        return $this->belongsTo(EloquentPredmetModel::class, 'predmet_id');
    }
}
