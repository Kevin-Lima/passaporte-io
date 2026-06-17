<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    // O $fillable define que campos o Laravel tem permissão para gravar diretamente
    protected $fillable = ['name'];

    //Uma Categoria tem muitos Evento
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
