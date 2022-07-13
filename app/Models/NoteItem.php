<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class NoteItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'note_id',
        'item_id',
        'quantity',
        'total',
    ];
}
