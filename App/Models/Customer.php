<?php

namespace App\Models;

use App\Models\Model;

class Customer extends Model {

    public $table = 'customers';

    public $fillables = [
        'id',
        'name',
        'email',
        'phone'
    ];
}