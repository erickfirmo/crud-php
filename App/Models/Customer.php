<?php

namespace App\Models;

use App\Models\Model;

class Customer extends Model {

    public $table = 'customers';

    public $fillable = [
        'id',
        'name',
        'email',
        'phone'
    ];

    public function getPhone()
    {
        $phone= "(".substr($this->phone,0,2).") ".substr($this->phone,2,-4)."-".substr($this->phone,-4);
        return $phone;
    }
}