<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'price'];

    /**
     * The options that belong to the product.
     *
     * @return BelongsToMany
     */
    public function options()
    {
        return $this->belongsToMany(Option::class)->withPivot('value');
    }
}
