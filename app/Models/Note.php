<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static paginate($get)
 * @method static find(int $id)
 * @method static findOrFail($id)
 */
class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'date',
        'total',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function items() {
        return $this->belongsToMany(Item::class, 'note_items');
    }
}
