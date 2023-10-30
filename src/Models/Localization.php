<?php

namespace Centrust\NovaLocalization\Models;

use Illuminate\Database\Eloquent\Model;

class Localization extends Model
{

    protected $table = 'nova-localizations';
    protected $fillable = [
        'group',
        'term',
        'en',
        'ar',

    ];

    protected $casts = [

    ];

    public function scopeGroup($query, $group)
    {
        return $query->where('group', $group);
    }

    public function scopeTerm($query, $term)
    {
        return $query->where('term', $term);
    }



}
