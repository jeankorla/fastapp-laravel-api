<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';

    protected $fillable = [
        'id',
        'created_at',
        'updated_at',
        'id_bank_account',
        'type',
        'amount',
        'description',
        'transaction_at',
        'id_transaction_category',
        'id_transaction_method',
        'id_transaction_type',
    ];
    
    protected $guarded = [];

    // Relacionamentos, acessores, mutators e outros métodos da model podem ser adicionados aqui
}
