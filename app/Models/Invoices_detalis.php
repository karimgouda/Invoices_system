<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices_detalis extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'id_Invoice', 'invoice_number', 'product', 'section', 'status', 'value_status', 'note', 'user'
    ];

}
