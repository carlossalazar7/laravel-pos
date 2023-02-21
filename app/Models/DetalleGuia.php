<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleGuia extends BaseModel
{
    use HasFactory;
    
    protected $table = 'detalle_guia';
    protected $fillable = ['guide_id', 'order_id'];
}
