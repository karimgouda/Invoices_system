<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'id',
        'invoice_number',
        'invoice_Date',
        'due_date',
        'product',
        'section_id',
        'Amount_collection',
        'Amount_commission',
        'discount',
        'value_vat',
        'rate_vat',
        'total',
        'status',
        'value_status',
        'note',
        'payment_date',
                     
    ];
    protected $dates = ['deleted_at'];
    
    public function section()
    {
        return $this->belongsTo(section::class);
    }
}
