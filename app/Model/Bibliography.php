<?php

namespace CUBiM\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bibliography
 * @package CUBiM\Model
 */
class Bibliography extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bibliography_request';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function nomenclators()
    {
        return $this->belongsToMany('CUBiM\Model\Nomenclator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers(){
        return $this->hasMany('CUBiM\Model\Answer');
    }
}
