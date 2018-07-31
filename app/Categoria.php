<?php

namespace sis2Argentos;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table='categoria';
    protected $primaryKey='idcategoria';
    public $timestamps=false;

    protected $fillable=[
    	'nombre',
    	'descricripcion',
    	'condicion'
    ];
    protected $guarded= [

    ];
}
