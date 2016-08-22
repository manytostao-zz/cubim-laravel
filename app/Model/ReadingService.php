<?php

namespace CUBiM\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Reading_Service
 * @package CUBiM\Model
 */
class ReadingService extends Model
{
    /**
     * @var string
     */
    protected $table = 'reading_services';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(){
        return $this->belongsTo('CUBiM\Model\Customer', 'customer_id');
    }
}
