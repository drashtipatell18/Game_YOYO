<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OutTeam extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "our_teams";

   protected $fillable = [
        'image',
        'name',
        'designation'
    ];
}
