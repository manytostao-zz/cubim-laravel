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
     * @param $request
     * @param bool $count
     * @return mixed
     * @internal param $columns
     * @internal param $filters
     */
    public function scopeFilter($query, $request, $count = false)
    {
        if (isset($request['search']) && $request['search']['value'] != '') {
            $query->select('nomenclators.*')->where(function ($query) use ($request) {
                $query
                    ->where('description', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhereRaw('DATE_FORMAT(created_at, "\'%d/%m/%Y") like \'%' . $request['search']['value'] . '%\'');
            });
        }

        $filters = $request->session()->has('nomenclator_filters') ? $request->session()->get('nomenclator_filters') : array();
        $orderBy = $request->has('order') ? $request->get('order') : array();
        $columns = $request['columns'];
        SearchApi::applyFilters($filters, $orderBy, $columns, $query);

        if ($request->has('length') && $request->get('length') > 0 and !$count)
            $result = $query->where('nomenclator_type_id', $request->get('nomenclator_type_id'))->take($request['length'])->skip($request['start']);
        else
            $result = $query;
        return !$count ? $result->where('nomenclator_type_id', $request->get('nomenclator_type_id'))->get() : $result->where('nomenclator_type_id', $request->get('nomenclator_type_id'))->count();

    }
}
