<?php

namespace App\Models;

use App\Models\Model;

class Customer extends Model {

    protected $table = 'customers';

    protected $fillable = [
        'id',
        'name',
        'email',
        'phone'
    ];

    public function getPhone()
    {
        $phone= $this->phone ? "(".substr($this->phone,0,2).") ".substr($this->phone,2,-4)."-".substr($this->phone,-4) : null;
        return $phone;
    }
}