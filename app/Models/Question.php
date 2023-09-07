<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\EloquentSortable\Sortable;


class Question extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    protected $fillable = [
        'question',
        'answer',
        'is_active',
    ];
}
