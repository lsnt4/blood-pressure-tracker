<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function records()
    {
        return $this->hasMany(Record::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleted(function ($profile) {
            $profile->records()->delete();
        });
    }
}
