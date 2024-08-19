<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRep extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =[
        'name',
'contact',
'nic'
    ];
    
    /**
     * Get all of the comments for the SalesRep
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoice(): HasMany
    {
        return $this->hasMany(Invoice::class, 'sales_rep_id');
    }
}
