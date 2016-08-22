<?php

namespace CUBiM\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reception
 * @package CUBiM\Model
 */
class Reception extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(){
        return $this->belongsTo('CUBiM\Model\Customer', 'customer_id');
    }
}
