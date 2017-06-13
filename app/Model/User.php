<?php

namespace CUBiM\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * Class User
 * @package CUBiM\Model
 */
class User extends Model implements AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'last_name', 'email'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany('CUBiM\Model\Rol', 'role_users', '', 'role_id')->withTimestamps();
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
            $query->select('users.*')->where(function ($query) use ($request) {
                $query->whereHas('roles', function ($query) use ($request) {
                    $query->where('slug', 'like', '%' . $request['search']['value'] . '%');
                })->orWhere('first_name', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhere('last_name', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhere('email', 'like', '%' . $request['search']['value'] . '%')
                    ->orWhereRaw('DATE_FORMAT(created_at, "\'%d/%m/%Y") like \'%' . $request['search']['value'] . '%\'');
            });
        }

        //Filtering by session filters
        $filters = $request->session()->get('users_filters');
        if (isset($filters))
            foreach ($filters as $key => $value) {
                switch ($key) {
                    case 'roles':
                        if (!is_null($value) && $value != '')
                            $query->select('users.*')->where(function ($query) use ($value) {
                                foreach ($value as $v) {
                                    $query->whereHas('roles', function ($query) use ($v) {
                                        $query->where('id', $v);
                                    });
                                }
                            });
                        break;
//                    case 'inactive':
//                        if (!is_null($value) && $value != '' && $value === 'true')
//                            $query->where('activo', '=', 0)->orWhere(function ($query) {
//                                $query->whereNull('activo');
//                            });
//                        break;
                    case 'from_register_date':
                        if (!is_null($value) && $value != '') {
                            $from = new \DateTime('today', new \DateTimeZone('America/Havana'));
                            $from_register_date = explode('/', $value);
                            $from->setDate($from_register_date[2], $from_register_date[1], $from_register_date[0]);
                            $query->where('created_at', '>=', $from);
                        }
                        break;
                    case 'to_register_date':
                        if (!is_null($value) && $value != '') {
                            $to = new \DateTime('today', new \DateTimeZone('America/Havana'));
                            $to_register_date = explode('/', $value);
                            $to->setDate($to_register_date[2], $to_register_date[1], $to_register_date[0] + 1);
                            $query->where('created_at', '<=', $to);
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
                        $query->orderBy($columns[intval($request->get('order')[$i]['column'])], $request->get('order')[$i]['dir'])
                            ->orderBy('last_name', 'ASC');
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
