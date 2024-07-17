<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'produk_id',
        'qty',
    ];
    public $timestamps = true;

    public function user(){
        return $this->BelongsTo(User::class);
    }
}
