<?php

namespace CUBiM\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Internet_Browsing_Service
 * @package CUBiM\Model
 */
class InternetBrowsingService extends Model
{
    /**
     * @var string
     */
    protected $table = 'internet_browsing_services';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer(){
        return $this->belongsTo('CUBiM\Model\Customer', 'customer_id');
    }
}
