<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Transfer extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_number_from',
        'account_number_to',
        'amount',
        'full_name',
        'description',
        'is_deleted',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function account(){
        return $this->belongsTo(Account::class);
    }
}
