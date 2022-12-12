<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory, UUID;

    protected $fillable = [
        'id',
        'name',
        'address',
        'map',
        'phone',
        'email',
        'wallet_balance',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'youtube'
    ];
}
