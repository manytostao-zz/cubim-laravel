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

        $columnNames = array();

        foreach ($filters['columns'] as $column) {
            switch ($column['name']) {
                case 'user':
                    array_push($columnNames, 'user_id');
                    break;
                default:
                    array_push($columnNames, $column['name']);
                    break;
            }
        }

        $recordsTotal = $this->tracesRepository->count();

        $traces = $this->tracesRepository->paginateWhere($filters['length'], $columnNames, ($filters['start'] / $filters['length']) + 1, $filters);

        try {
            $recordsFiltered = $this->tracesRepository->countWhere($filters);
        } catch (ErrorException $e) {
            $recordsFiltered = 0;
        }

        $output = array(
            "draw" => intval($request->get('draw')),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => array()
        );

        foreach ($traces as $aRow) {
            $row = array();
            for ($i = 0; $i < count($filters['columns']); $i++) {
                switch ($filters['columns'][$i]['name']) {
                    case 'created_at':
                        $date = strtotime($aRow->created_at);
                        $row[] = date('d/m/Y', $date);
                        break;
                    case 'user':
                        $row[] = $aRow->user->first_name . ' ' . $aRow->user->last_name;
                        break;
                    default:
                        if ($filters['columns'][$i]['name'] != ' ') {
                            /* General output */
                            $row[] = $aRow[$filters['columns'][$i]['name']];
                        }
                        break;
                }
            }
            $output['data'][] = $row;
        }
        return response()->json($output);
    }
}
