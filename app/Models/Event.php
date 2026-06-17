<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    // Campos que podem ser preenchidos via formulário (Segurança mass assignment)
    protected $fillable = [
        'user_id', 
        'category_id', 
        'title', 
        'description', 
        'date_time', 
        'location', 
        'capacity', 
        'banner_path'
    ];

    // RELACIONAMENTO 1: O Evento pertence a um Organizador (Utilizador)
    public function organizer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // RELACIONAMENTO 2: O Evento pertence a uma Categoria
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // RELACIONAMENTO 3: O Evento tem muitos Participantes (Muitos-para-Muitos)
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'event_user')
                    ->withPivot('ticket_code', 'status') // Carrega os campos extras da tabela pivô
                    ->withTimestamps();
    }
}
