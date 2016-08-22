<?php

namespace CUBiM\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Nomenclator_Type
 * @package CUBiM\Model
 */
class NomenclatorType extends Model
{
    protected $table = 'nomenclator_types';
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function nomenclators(){
        return $this->hasMany('CUBiM\Nomenclator');
    }
}
