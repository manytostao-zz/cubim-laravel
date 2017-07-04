<?php

namespace CUBiM\Model;

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

    /**
     * @param $query
     * @param $request
     * @param $columns
     * @param bool $count
     * @return mixed
     */
    public function scopeFilter($query, $request, $columns, $count = false)
    {
        //Filtering by single search input
        if (isset($request['search']) && $request['search']['value'] != '') {
            $query->select('traces.*')->where(function ($query) use ($request) {
                $query->whereHas('user', function ($query) use ($request) {
                    $query->where('first_name', 'like', '%' . $request['search']['value'] . '%')
                        ->orWhere('last_name', 'like', '%' . $request['search']['value'] . '%');
                })->orWhere('operation', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhere('object', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhere('comments', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhere('module', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhereRaw('DATE_FORMAT(created_at, "\'%d/%m/%Y") like \'%' . $request['search']['value'] . '%\'');
            });
        }

        //Filtering by session filters
        $filters = $request->session()->get('traces_filters');
        if (isset($filters))
            foreach ($filters as $key => $value) {
                switch ($key) {
                    case 'from_creation_date':
                        if (!is_null($value) && $value != '') {
                            $from = new \DateTime('today', new \DateTimeZone('America/Havana'));
                            $from_creation_date = explode('/', $value);
                            $from->setDate($from_creation_date[2], $from_creation_date[1], $from_creation_date[0]);
                            $query->where('created_at', '>=', $from);
                        }
                        break;
                    case 'to_creation_date':
                        if (!is_null($value) && $value != '') {
                            $to = new \DateTime('today', new \DateTimeZone('America/Havana'));
                            $to_creation_date = explode('/', $value);
                            $to->setDate($to_creation_date[2], $to_creation_date[1], $to_creation_date[0] + 1);
                            $query->where('created_at', '<=', $to);
                        }
                        break;
                    case 'user':
                        if (!is_null($value) && $value != '') {
                            $query->where('user_id', $value);
                        }
                        break;
                    default:
                        if (!is_null($value) && $value != '')
                            $query->where($key, 'like', '%' . $value . '%');
                        break;
                }
            }
        //Ordering
        if ($request->has('order')) {
            for ($i = 0; $i < intval($request->get('order')); $i++) {
                switch ($columns[intval($request->get('order')[$i]['column'])]) {
                    default:
                        $query->orderBy($columns[intval($request->get('order')[$i]['column'])], $request->get('order')[$i]['dir']);
                        break;

                }
            }
        }

        if ($request->has('length') && $request->get('length') > 0 and !$count)
            $result = $query->take($request['length'])->skip($request['start']);
        else
            $result = $query;
        return !$count ? $result->get() : $result->get()->count();
    }
}
