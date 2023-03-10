<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
    ];

    protected $with = [
        'workers',
    ];

    /**
     * @return HasMany
     */
    public function workers(): HasMany
    {
        return $this->hasMany(Worker::class);
    }

    /**
     * @return BelongsToMany
     */
    public function workPositionsAtDepartment(): BelongsToMany
    {
        return $this->belongsToMany(WorkPosition::class, 'workers', 'department_id', 'work_position_id')->distinct();
    }
}
