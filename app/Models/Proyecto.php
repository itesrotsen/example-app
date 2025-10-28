<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'presupuesto',
    ];

    public function contactos(){
        return $this->belongsToMany(Contacto::class, 'projects_contacts', 'project_id', 'contacto_id');
    }
}
