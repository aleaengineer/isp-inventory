<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $fillable = [
        'category_id', 'name', 'mac_address',
        'serial_number', 'stock_quantity', 'unit', 'location',
        'image', 'supplier_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['category_id'] ?? null, fn($q, $v) => $q->where('category_id', $v))
            ->when($filters['search'] ?? null, fn($q, $v) => $q->where(function($q) use ($v) {
                $q->where('name', 'like', "%{$v}%")
                  ->orWhere('serial_number', 'like', "%{$v}%")
                  ->orWhere('mac_address', 'like', "%{$v}%")
                  ->orWhere('location', 'like', "%{$v}%");
            }));
        return $query;
    }
}
