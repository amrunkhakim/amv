<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = [
        'user_id',
        'invoice_number',
        'client_name',
        'client_email',
        'amount',
        'issued_date',
        'due_date',
        'status',
        'items',
        'verification_token',
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'items' => 'array',
        'issued_date' => 'date',
        'due_date' => 'date',
    ];
}
