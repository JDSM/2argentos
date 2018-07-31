<?php

namespace sis2Argentos;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table='venta';
    protected $primaryKey='idventa';
    public $timestamps=false;

    protected $fillable=[
    	'idcliente',
    	'tipo_comprobante',
    	'serie_comprobante',
    	'num_comprobante',
    	'fecha_hora',
        'fecha_hora2',
        'fecha_hora3',
        'fecha_hora4',
        'fecha_pago',
        'detalle',
        'detalle2',
    	'impuesto',
    	'total_venta',
    	'estado',
        'responsable',
        'responsable2',
        'responsable3',
        'responsable4',
        'aporte',
        'cartera',
        'debe'

    ];
    protected $guarded= [

    ];
}
