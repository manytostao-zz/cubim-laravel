<?php

namespace CUBiM\Model;

use CUBiM\Apis\SearchApi\SearchApi;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Nomenclator
 * @package CUBiM\Model
 */
class Nomenclator extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'description',
        'active'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function nomenclator_type()
    {
        return $this->belongsTo('CUBiM\Model\NomenclatorType', 'nomenclator_type_id');
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
            $query->select('nomenclators.*')->where(function ($query) use ($filters) {
                $query
                    ->where('description', 'like', '%' . $filters['search']['value'] . '%')
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
