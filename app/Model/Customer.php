<?php

namespace CUBiM\Model;

use Illuminate\Database\Eloquent\Model;
use CUBiM\Apis\SearchApi\SearchApi;

/**
 * Class Customer
 * @package CUBiM\Model
 */
class Customer extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'id_card',
        'email',
        'phone',
        'topic',
        'comments',
        'experience',
        'library_card',
        'student',
        'active'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function nomenclators()
    {
        return $this->belongsToMany('CUBiM\Model\Nomenclator', 'customer_nomenclators')->withTimestamps();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Cartalyst\Sentinel\Users\EloquentUser', 'attended_by_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reception()
    {
        return $this->hasMany('CUBiM\Model\Reception');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function internet_browsing_service()
    {
        return $this->hasMany('CUBiM\Model\InternetBrowsingService');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reading_service()
    {
        return $this->hasMany('CUBiM\Model\ReadingService');
    }
}
