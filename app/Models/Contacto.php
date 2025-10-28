<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'email',
        'telefono',
        'direccion',
    ];

    public function proyectos()
    {
        return $this->belongsToMany(Proyecto::class, 'projects_contacts', 'contacto_id', 'proyecto_id');
    }
}
