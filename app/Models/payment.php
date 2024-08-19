<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class payment extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'invoice_id',
        'amount',
        'payment_status',
        'reference',
        'date',
        'payment_type',
    ];
}
