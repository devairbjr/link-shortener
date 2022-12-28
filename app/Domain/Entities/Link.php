<?php

namespace App\Domain\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Validator;
use Carbon\Carbon;

class Link extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['short_url', 'long_url', 'expires_at'];


    public function isActive($link)
    {
        $now = Carbon::now()->toDateString();
        if ($link && $link->expires_at >= $now) {
            return $link->short_url;
        }
        return;
    }
}
