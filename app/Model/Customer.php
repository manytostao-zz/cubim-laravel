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
     * @param $request
     * @param bool $count
     * @return mixed
     * @internal param $columns
     * @internal param $filters
     */
    public function scopeFilter($query, $request, $count = false)
    {
        //Filtering by single search input
        if (isset($request['search']) && $request['search']['value'] != '') {
            $query->select('customers.*')->where(function ($query) use ($request) {
                $query->whereHas('nomenclators', function ($query) use ($request) {
                    $query->where('description', 'like', '%' . $request['search']['value'] . '%');
                })
                    ->orWhere('name', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhere('last_name', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhere('library_card', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhere('id_card', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhere('email', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhere('phone', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhere('experience', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhereRaw('DATE_FORMAT(created_at, "\'%d/%m/%Y") like \'%' . $request['search']['value'] . '%\'')
                    ->orWhere('comments', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhere('topic', 'like', '%' . $request['search']['value'] . '%');
            });
        }

        $filters = $request->session()->has('customer_filters') ? $request->session()->get('customer_filters') : array();
        $orderBy = $request->has('order') ? $request->get('order') : array();
        $columns = $request['columns'];
        SearchApi::applyFilters($filters, $orderBy, $columns, $query);

        if ($request->has('length') && $request->get('length') > 0 and !$count)
            $result = $query->take($request['length'])->skip($request['start']);
        else
            $result = $query;
        return !$count ? $result->get() : $result->get()->count();
    }
}
