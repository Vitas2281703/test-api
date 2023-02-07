<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkPosition extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return HasMany
     */
    public function workers(): HasMany
    {
        return $this->hasMany(Worker::class);
    }

    public function departmentsAtWorkPosition(): BelongsToMany
    {
        return $this->belongsToMany(Department::class, 'workers', 'work_position_id', 'department_id');
    }
}
