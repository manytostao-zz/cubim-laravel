<?php

namespace CUBiM\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bibliografia
 * @package CUBiM\Model
 */
class Bibliografia extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bibliografia';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function nomencladores()
    {
        return $this->belongsToMany('CUBiM\Model\Nomenclador');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function respuestas(){
        return $this->hasMany('CUBiM\Model\Respuesta');
    }
}
