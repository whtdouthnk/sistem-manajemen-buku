<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Buku extends Model 
{
    use HasFactory;

    protected $guarded = [];

    protected $fillable = [
        'judul',
        'pengarang',
        'tahun_terbit',
        'kategori_id',
        'penerbit_id',
        'cover',
        'deskripsi',
        'slug', 
    ];
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($buku) {
            $buku->slug = Str::slug($buku->judul);
            
            $originalSlug = $slug = Str::slug($buku->judul);
            $count = 1;
            
            while (static::where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
            
            $buku->slug = $slug;
        });

        static::updating(function ($buku) {
            if ($buku->isDirty('judul')) {
                $buku->slug = Str::slug($buku->judul);
                
                $originalSlug = $slug = Str::slug($buku->judul);
                $count = 1;
                
                while (static::where('slug', $slug)->where('id', '!=', $buku->id)->exists()) {
                    $slug = $originalSlug . '-' . $count++;
                }
                
                $buku->slug = $slug;
            }
        });
    }

    public function getSlugAttribute($value)
    {
        if (empty($value) && !empty($this->judul)) {
            return Str::slug($this->judul);
        }
        return $value;
    }

    public function penerbit(): BelongsTo
    {
        return $this->belongsTo(Penerbit::class);
    }

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjaman()
    {
        return $this->belongsToMany(Peminjaman::class, 'peminjaman_bukus');
    }

    public function getCoverUrlAttribute()
    {
        if ($this->cover) {
            return Storage::url($this->cover);
        }
        return asset('img/coverbuku.webp'); 
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('judul', 'like', '%'.$search.'%')
                    ->orWhere('pengarang', 'like', '%'.$search.'%')
                    ->orWhere('tahun_terbit', 'like', '%'.$search.'%')
                    ->orWhere('slug', 'like', '%'.$search.'%');
    }
}