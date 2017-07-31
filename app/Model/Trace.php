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
}
