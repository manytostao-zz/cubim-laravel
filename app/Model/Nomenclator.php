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
}
