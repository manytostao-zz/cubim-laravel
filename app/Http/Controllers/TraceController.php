<?php

namespace CUBiM\Http\Controllers;

use CUBiM\Helper\Helper;
use CUBiM\Model\Trace;
use CUBiM\Repositories\Interfaces\ITracesRepository;
use ErrorException;
use Illuminate\Http\Request;

class TraceController extends Controller
{
    protected $tracesRepository;

    function __construct(ITracesRepository $tracesRepository)
    {
        $this->tracesRepository = $tracesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        return view("traces.index")->with('active', array('sup' => ''));
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $session = $request->session()->get('traces_filters');
        foreach ($request->get('form') as $key => $formValue)
            $session[$key] = $formValue;
        $request->session()->put('traces_filters', $session);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        $filters = Helper::extractDatatableFiltersFromRequest($request, 'traces_filters');

//        $recordsTotal = intval(Trace::all()->count());
//        $traces = Trace::with('user')->filter($request, $columns);
        $recordsTotal = $this->tracesRepository->findByFilters([], [], true);
        try {
            $recordsFiltered = intval(Trace::filter($request, $columns, true));
        } catch (ErrorException $e) {
            $recordsFiltered = 0;
        }
        $columns = array(
            'id',
            'operation',
            'object',
            'comments',
            'module',
            'created_at',
            'user',
        );

        $output = array(
            "draw" => intval($request->get('draw')),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => array()
        );

        foreach ($traces as $aRow) {
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
                    case 'user':
                        $row[] = $aRow->user->first_name . ' ' . $aRow->user->last_name;
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
}
