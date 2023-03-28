<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    public function produtos() {
        return $this->hasMany(Produto::class, 'id', 'produto_id');
    }
    public function users() {
        return $this->hasMany(User::class, 'id', 'user_id');
    }
}
