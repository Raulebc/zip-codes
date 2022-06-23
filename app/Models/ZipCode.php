<?php

namespace App\Models;

use PHPUnit\Util\Json;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ZipCode extends Model
{
    use HasFactory;

    // deactivate the autoincrement
    public $incrementing = false;

    /**
     *  Massively assignable attributes.
     *
     *  @var array
     */
    protected $fillable = [
        'id',
        'locality',
        'federal_entity',
        'settlements',
        'municipality',
    ];

    /**
     *  To be treated as a JSON string.
     */
    protected $casts = [
        'federal_entity' => 'array',
        'settlements'    => 'array',
        'municipality'   => 'array',
    ];
}
