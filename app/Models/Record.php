<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Record extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function getSystoleColorAttribute()
    {
        $value = $this->systole;

        if ($value < 90) {
            $color = 'bg-red-700';
        } elseif ($value >= 90 && $value < 120) {
            $color = 'bg-green-700';
        } elseif ($value >= 120 && $value < 130) {
            $color = 'bg-yellow-400';
        } elseif ($value >= 130 && $value < 140) {
            $color = 'bg-yellow-500';
        } elseif ($value >= 140 && $value < 180) {
            $color = 'bg-yellow-600';
        } elseif ($value >= 180) {
            $color = 'bg-red-700';
        }
        return $color;
    }

    public function getDiastoleColorAttribute()
    {
        $value = $this->diastole;

        if ($value < 60) {
            $color = 'bg-red-700';
        } elseif ($value >= 60 && $value <= 79) {
            $color = 'bg-green-700';
        } elseif ($value >= 80 && $value <= 89) {
            $color = 'bg-yellow-500';
        } elseif ($value >= 90 && $value <= 119) {
            $color = 'bg-yellow-600';
        } elseif ($value >= 120) {
            $color = 'bg-red-700';
        }
        return $color;
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
