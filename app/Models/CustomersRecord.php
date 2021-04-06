<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class CustomersRecord extends Eloquent
{
    use HasFactory;
// Rule::unique('admins','email')
    protected $connection = 'mongodb';
    protected $collection = 'customers_records';
    protected $primaryKey = 'name';
    protected $guarded = [];

}
