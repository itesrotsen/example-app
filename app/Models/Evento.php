<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Evento extends Model
{
    use HasFactory;

    protected $table = 'eventos';

    protected $fillable = [
        'nombre_evento',
        'descripcion',
        'fecha_inicio',
        'fecha_fin',
        'ubicacion',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
    ];

    // Scope para obtener eventos de un mes específico
    public function scopeDelMes($query, $year, $month)
    {
        return $query->whereYear('fecha_inicio', $year)
                     ->whereMonth('fecha_inicio', $month);
    }

    // Scope para obtener eventos futuros
    public function scopeFuturos($query)
    {
        return $query->where('fecha_inicio', '>=', now());
    }

    // Scope para obtener eventos pasados
    public function scopePasados($query)
    {
        return $query->where('fecha_inicio', '<', now());
    }

    // Accessor para obtener la duración del evento
    public function getDuracionAttribute()
    {
        if (!$this->fecha_fin) {
            return null;
        }
        
        return $this->fecha_inicio->diffInHours($this->fecha_fin);
    }

    // Verificar si el evento está en curso
    public function enCurso()
    {
        $ahora = now();
        return $this->fecha_inicio <= $ahora && 
               ($this->fecha_fin ? $this->fecha_fin >= $ahora : false);
    }
}
