<?php

namespace CUBiM\Http\Controllers;

use CUBiM\Helpers\DataTableHelper;
use CUBiM\Repositories\Interfaces\INomenclatorsRepository;
use CUBiM\Repositories\Interfaces\INomenclatorTypesRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

/**
 * Class NomenclatorController
 * @package CUBiM\Http\Controllers
 */
class NomenclatorController extends Controller
{
    /**
     * @var INomenclatorsRepository
     */
    private $nomenclatorsRepository;

    /**
     * @var INomenclatorTypesRepository
     */
    private $nomenclatorTypesRepository;


    /**
     * NomenclatorController constructor.
     * @param INomenclatorsRepository $nomenclatorsRepository
     * @param INomenclatorTypesRepository $nomenclatorTypesRepository
     */
    public function __construct(INomenclatorsRepository $nomenclatorsRepository, INomenclatorTypesRepository $nomenclatorTypesRepository)
    {
        $this->nomenclatorsRepository = $nomenclatorsRepository;
        $this->nomenclatorTypesRepository = $nomenclatorTypesRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $nomenclator_type_id
     * @return \Illuminate\View\View
     * @internal param $id
     */
    public function index($nomenclator_type_id)
    {
        $nomenclator_type = $this->nomenclatorTypesRepository->find($nomenclator_type_id);
        return view('nomenclators.index')->with('nomenclator_type', $nomenclator_type)->with('active', array('sup' => ''));
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->nomenclatorsRepository->update(['description' => $request->get('description')], $id);

        $nomenclator = $this->nomenclatorsRepository->find($id);

        $request->session()->put('traceComments', 'Tipo de Nomenclador: ' . $nomenclator->nomenclator_type->description . '. Descripción:' . $nomenclator->description . '.');

        return \Redirect::route('nomenclators.index',
            array($nomenclator->nomenclator_type_id))->with('message', "Valor de nomenclador actualizado correctamente.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, $id)
    {
        $nomenclator = $this->nomenclatorsRepository->find($id);

        $request->session()->put('traceComments', 'Tipo de Nomenclador: ' . $nomenclator->nomenclator_type->description . '. Descripción:' . $nomenclator->description . '.');

        $nomenclator_type_id = $nomenclator->nomenclator_type_id;
        try {
            $this->nomenclatorsRepository->delete($id);

            return \Redirect::route('nomenclators.index',
                array($nomenclator_type_id))->with('message', 'Valor de nomenclador eliminado correctamente.');
        } catch (QueryException $e) {
            $this->nomenclatorsRepository->update(['active' => false], $nomenclator->id);

            return \Redirect::route('nomenclators.index',
                array($nomenclator->nomenclator_type_id))->with('message', 'El valor está en uso y no se pudo eliminar; en lugar de ello se desactivó.');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activate(Request $request)
    {
        $nomenclator = $this->nomenclatorsRepository->find($request->get('id'));
        if (is_null($nomenclator->active) || $nomenclator->active == 0) {
            $this->nomenclatorsRepository->update(['active' => true], $nomenclator->id);
            $message = 'Se ha activado el valor del nomenclador.';
            $value = true;
        } else {
            $this->nomenclatorsRepository->update(['active' => false], $nomenclator->id);
            $message = 'Se ha inactivado el valor del nomenclador.';
            $value = false;
        }
        $data['message'] = $message;
        $data['value'] = $value;

        $request->session()->put('traceComments', 'Tipo de Nomenclador: ' . $nomenclator->nomenclator_type->description . '. Descripción:' . $nomenclator->description . '.');

        return response()->json($data);
    }

    /**
     * Returns a json list to use in select2 droppable list.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function json(Request $request)
    {
        $nomenclators = null;
        $params = $request->get('q');
        $result = [];
        $result['total_count'] = 0;
        $result['items'] = [];
        $criterias = ['nomenclator_type' => $params['nomenclator_type_id']];

        if (array_key_exists('description', $params) && $params['description'] != '')
            $criterias = array_add($criterias, 'description', $params['description']);
        if (array_key_exists('id', $params) && $params['id'] != '')
            $criterias = array_add($criterias, 'id', $params['id']);

        $filters['criterias'] = $criterias;

        $result['total_count'] = $this->nomenclatorsRepository->countWhere($filters);

        $nomenclators = $this->nomenclatorsRepository->paginateWhere(
            intval($params['pageCount']),
            ['id', 'description'],
            $params['page'],
            $filters
        );

        for ($i = 0; $i < count($nomenclators); $i++) {
            $result['items'][$i]['id'] = $nomenclators[$i]->id;
            $result['items'][$i]['text'] = $nomenclators[$i]->description;
        }

        if (intval($params['page']) == 1 && ($params['extra_field'] == 'true'))
            array_unshift($result['items'], ['id' => -1, 'text' => 'Sin especificar...']);

        $result['incomplete_results'] = false;

        return response()->json($result);
    }

    /**
     * Returns a json list to use in datatables
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        $nomenclatorFilters['nomenclator_type'] = $request->get('nomenclator_type_id');
        $request->session()->set('nomenclator_filters', $nomenclatorFilters);

        /*Extract filters from request and session vars*/
        $filters = DataTableHelper::extractRequestFilters($request, 'nomenclator_filters');

        $columnNames = array();

        foreach ($filters['columns'] as $column) {
            switch ($column['name']) {
                case '':
                    break;
                default:
                    array_push($columnNames, $column['name']);
                    break;
            }
        }

        /*Extract filters from request and session vars*/
        $filters = DataTableHelper::extractRequestFilters($request, 'nomenclator_filters');

        $recordsTotal = intval($this->nomenclatorsRepository->countWhere(['criterias' => ['nomenclator_type_id' => $request->get('nomenclator_type_id')]]));
        $nomenclators = $this->nomenclatorsRepository->paginateWhere($filters['length'], $columnNames, ($filters['start'] / $filters['length']) + 1, $filters);
        try {
            $recordsFiltered = intval($this->nomenclatorsRepository->countWhere($filters));
        } catch (\ErrorException $e) {
            $recordsFiltered = 0;
        }

        $output = array(
            "draw" => intval($request->get('draw')),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => array()
        );

        $columnNames[] = 'actions';

        foreach ($nomenclators as $aRow) {
            $row = array();
            for ($i = 0; $i < count($columnNames); $i++) {
                switch ($columnNames[$i]) {
                    case 'created_at':
                        $date = strtotime($aRow->created_at);
                        if ($date != '')
                            $row[] = date('d/m/Y', $date);
                        else
                            $row[] = 'No definida';
                        break;
                    default:
                        if ($columnNames[$i] != ' ') {
                            /* General output */
                            $row[] = $aRow[$columnNames[$i]];
                        }
                        break;
                }
            }
            $output['data'][] = $row;
        }
        return response()->json($output);
    }
}
