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

    /**
     * @param $query
     * @param $filters
     * @param bool $countOnly
     * @param bool $queryOnly
     * @return mixed
     * @internal param $columns
     * @internal param $filters
     */
    public function scopeFilter($query, $filters, $countOnly = false, $queryOnly = false)
    {
        //Filter by single search input
        if (isset($filters['search']) && $filters['search']['value'] != '') {
            $query->select('customers.*')->where(function ($query) use ($filters) {
                $query->whereHas('nomenclators', function ($query) use ($filters) {
                    $query->where('description', 'like', '%' . $filters['search']['value'] . '%');
                })
                    ->orWhere('name', 'like', '%' . $filters['search']['value'] . '%')
                    ->orWhere('last_name', 'like', '%' . $filters['search']['value'] . '%')
                    ->orWhere('library_card', 'like', '%' . $filters['search']['value'] . '%')
                    ->orWhere('id_card', 'like', '%' . $filters['search']['value'] . '%')
                    ->orWhere('email', 'like', '%' . $filters['search']['value'] . '%')
                    ->orWhere('phone', 'like', '%' . $filters['search']['value'] . '%')
                    ->orWhere('experience', 'like', '%' . $filters['search']['value'] . '%')
                    ->orWhereRaw('DATE_FORMAT(created_at, "\'%d/%m/%Y") like \'%' . $filters['search']['value'] . '%\'')
                    ->orWhere('comments', 'like', '%' . $filters['search']['value'] . '%')
                    ->orWhere('topic', 'like', '%' . $filters['search']['value'] . '%');
            });
        }

        SearchApi::applyFilters($filters, $query);

        if (isset($filters['length']) && !is_null($filters['length']) && $filters['length'] > 0 and !$countOnly)
            $query->take($filters['length'])->skip($filters['start']);

        if ($queryOnly) return $query;

        if ($countOnly) return $query->get()->count();

        return $query->get();
    }
}
