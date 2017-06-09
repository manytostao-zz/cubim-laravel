<?php

namespace CUBiM\Http\Controllers;

use CUBiM\Model\User;
use CUBiM\Model\Rol;
use Illuminate\Http\Request;

use CUBiM\Http\Requests;
use CUBiM\Http\Controllers\Controller;

/**
 * Class UserController
 * @package CUBiM\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::all();
        $roles_output = array();
        $roles->each(function ($rol) use (&$roles_output) {
            $roles_output[$rol->id] = $rol->slug;
        });

        return view('users.index')
            ->with('active', array('sup' => ''))
            ->with('roles', $roles_output);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::with('roles')->find($id);
        return view('users.show')
            ->with('active', array('sup' => ''))
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     */
    public function filter(Request $request)
    {
        $request->session()->put('users_filters', $request->get('form'));
    }

    /**
     * @param Request $request
     */
    public function clean(Request $request)
    {
        $request->session()->pull('users_filters');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        $columns = array(
            'id',
            'first_name',
            'last_name',
            'email',
            'roles',
            'created_at',
            'acciones',
        );
        $recordsTotal = intval(User::all()->count());
        $users = User::with('roles')->filter($request, $columns);
        try {
            $recordsFiltered = intval(User::filter($request, $columns, true));
        } catch (\ErrorException $e) {
            $recordsFiltered = 0;
        }

        $output = array(
            "draw" => intval($request->get('draw')),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => array()
        );

        foreach ($users as $aRow) {
            $row = array();
            for ($i = 0; $i < count($columns); $i++) {
                switch ($columns[$i]) {
                    case 'roles':
                        $roles = $aRow->roles->map(function ($rol) {
                            return ' ' . $rol->slug;
                        });
                        $row[] = $roles;
                        break;
                    case 'created_at':
                        $date = strtotime($aRow->created_at);
                        $row[] = date('d/m/Y', $date);
                        break;
                    default:
                        if ($columns[$i] != ' ') {
                            /* General output */
                            $row[] = $aRow[$columns[$i]];
                        }
                        break;
                }
            }
            $output['data'][] = $row;
        }
        return response()->json($output);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function json(Request $request)
    {
        $users = null;
        $params = $request->get('q');
        $result = [];
        $result['total_count'] = 0;
        $result['items'] = [];
        $query = User::orderBy('last_name', 'ASC');
        if (array_key_exists('description', $params) && $params['description'] != '')
            $query->where('first_name', 'like', '%' . $params['description'] . '%')
                ->orWhere('last_name', 'like', '%' . $params['description'] . '%');
        $result['total_count'] = $query->get()->count();
        $users = $query->take(intval($params['pageCount']))
            ->skip(intval($params['page']) > 0 ? intval($params['pageCount'] * ($params['page'] - 1)) : null)
            ->get();
        for ($i = 0; $i < count($users); $i++) {
            $result['items'][$i]['id'] = $users[$i]->id;
            $result['items'][$i]['text'] = $users[$i]->first_name . ' ' . $users[$i]->last_name;
        }
        if (intval($params['page']) == 1)
            array_unshift($result['items'], ['id' => -1, 'text' => 'Sin especificar...']);
        $result['incomplete_results'] = false;

        return response()->json($result);
    }

    public function roles(Request $request)
    {
        $roles = null;
        $params = $request->get('q');
        $result = [];
        $result['total_count'] = 0;
        $result['items'] = [];
        $query = User::orderBy('last_name', 'ASC');
        if (array_key_exists('description', $params) && $params['description'] != '')
            $query->where('slug', 'like', '%' . $params['description'] . '%');
        $result['total_count'] = $query->get()->count();
        $roles = $query->take(intval($params['pageCount']))
            ->skip(intval($params['page']) > 0 ? intval($params['pageCount'] * ($params['page'] - 1)) : null)
            ->get();
        for ($i = 0; $i < count($roles); $i++) {
            $result['items'][$i]['id'] = $roles[$i]->id;
            $result['items'][$i]['text'] = $roles[$i]->slug;
        }
        if (intval($params['page']) == 1)
            array_unshift($result['items'], ['id' => -1, 'text' => 'Sin especificar...']);
        $result['incomplete_results'] = false;

        return response()->json($result);
    }

    public function login()
    {
        return view('users.login');
    }
}
