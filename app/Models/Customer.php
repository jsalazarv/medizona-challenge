<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static paginate($get)
 */
class Customer extends Model
{
    use HasFactory;

    public function note() {
        return $this->hasMany(Note::class);
    }
}
