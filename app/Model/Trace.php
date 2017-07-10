<?php

namespace CUBiM\Model;

use CUBiM\Apis\SearchApi\SearchApi;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Trace
 * @package CUBiM\Model
 */
class Trace extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['operation', 'object', 'comments', 'module', 'user_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'traces';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('CUBiM\Model\User');
    }

    /**
     * @param $query
     * @param $filters
     * @param bool $countOnly
     * @param bool $queryOnly
     * @return mixed
     */
    public function scopeFilter($query, $filters, $countOnly = false, $queryOnly = false)
    {
        //Filter by single search input
        if (isset($filters['search']) && $filters['search']['value'] != '') {
            $query->select('traces.*')->where(function ($query) use ($filters) {
                $query->whereHas('user', function ($query) use ($filters) {
                    $query->where('first_name', 'like', '%' . $filters['search']['value'] . '%')
                        ->orWhere('last_name', 'like', '%' . $filters['search']['value'] . '%');
                })->orWhere('operation', 'like', '%' . $filters['search']['value'] . '%')
                    ->orWhere('object', 'like', '%' . $filters['search']['value'] . '%')
                    ->orWhere('comments', 'like', '%' . $filters['search']['value'] . '%')
                    ->orWhere('module', 'like', '%' . $filters['search']['value'] . '%')
                    ->orWhereRaw('DATE_FORMAT(created_at, "\'%d/%m/%Y") like \'%' . $filters['search']['value'] . '%\'');
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
