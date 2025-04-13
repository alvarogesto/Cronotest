<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
        'description',
        'user_id',
        'category_id',
        'language_id'
    ];

    //ESta función se usa para filtrar los test que aparecen como resultado
    public function scopeFilter($query, array $filters) {
        // Si se proporciona un término de búsqueda, se aplica el filtro
        $query->when($filters['buscar'] ?? false, fn($query, $search) =>
            $query->where('title', 'like', '%' . $search . '%'));

        // Si se proporciona una categoría, se aplica el filtro
        $query->when($filters['category'] ?? false, fn($query, $category) =>
            $query->whereHas('category', fn ($query) =>
            $query->whereIn('slug', $category)));

        // Si se proporciona un idioma, se aplica el filtro
        $query->when($filters['language'] ?? false, fn($query, $language) =>
            $query->whereHas('language', fn ($query) =>
            $query->whereIn('slug', $language)));
    }

    // Establece una relación entre Test y User
    public function author() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Establece una relación entre Test y Category
    public function category() {
        return $this->belongsTo(Category::class);
        
    }

    // Establece una relación entre Test y Language
    public function language() {
        return $this->belongsTo(Language::class);
        
    }

    // Establece una relación entre Test y User
    public function creator() {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Establece una relación entre Test y Question
    public function question() {
        return $this->hasMany(Question::class);
    }

    // Establece una relación entre Test y Answer
    public function answer( ) {
        return $this->hasManyThrough(Answer::class, Question::class);
    }

    // Establece una relación entre Test y Ratings
    public function ratings() {
        return $this->hasMany(Rating::class);
    }

    /* Establece una relación entre Test y TestResult 
    seleccionando directamente los resultados del usuario autentificado */
    public function results() {
        return $this->hasMany(TestResult::class)->where('user_id', auth()->id());
    }
}
