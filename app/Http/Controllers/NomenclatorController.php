<?php

namespace CUBiM\Http\Controllers;

use CUBiM\Model\Nomenclator;
use CUBiM\Model\NomenclatorType;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use CUBiM\Http\Requests;

/**
 * Class NomencladorController
 * @package CUBiM\Http\Controllers
 */
class NomenclatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $nomenclator_type_id
     * @return \Illuminate\Http\Response
     * @internal param $id
     */
    public function index($nomenclator_type_id)
    {
        $nomenclator_type = NomenclatorType::find($nomenclator_type_id);
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $nomenclator = Nomenclator::find($id);

        $nomenclator->update([
            'description' => $request->get('description'),
        ]);

        return \Redirect::route('nomenclators.index',
            array($nomenclator->nomenclator_type_id))->with('message', 'Valor de nomenclador actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nomenclator = Nomenclator::find($id);
        $nomenclator_type_id = $nomenclator->nomenclator_type_id;
        try {
            Nomenclator::destroy($id);

            return \Redirect::route('nomenclators.index',
                array($nomenclator_type_id))->with('message', 'Valor de nomenclador eliminado correctamente.');
        } catch (QueryException $e) {
            $nomenclator->update([
                'active' => false,
            ]);

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
        $customer = Customer::find($request->get('id'));
        if (is_null($customer->active) || $customer->active == 0) {
            $customer->active = 1;
            $message = 'Se ha activado el usuario.';
            $value = true;
        } else {
            $customer->active = 0;
            $message = 'Se ha inactivado el usuario.';
            $value = false;
        }
        $customer->save();
        $data['message'] = $message;
        $data['value'] = $value;

        return response()->json($data);


    }

    /**
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
        $query = Nomenclator::where('nomenclator_type_id', $params['nomenclator_type_id'])->orderBy('description', 'ASC');
        if (array_key_exists('description', $params) && $params['description'] != '')
            $query->where('description', 'like', '%' . $params['description'] . '%');
        if (array_key_exists('id', $params) && $params['id'] != '')
            $query->where('id', '=', $params['id']);
        $result['total_count'] = $query->get()->count();
        $nomenclators = $query
            ->take(intval($params['pageCount']))
            ->skip(intval($params['page']) > 0 ? intval($params['pageCount'] * ($params['page'] - 1)) : null)
            ->get();
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
        $columns = $request->get('columns');
        $filters = $request->session()->has('nomenclator_filters') ? $request->session()->get('customer_filters') : array();
        $filters['nomenclator_type_id'] = $request->get('nomenclator_type_id');
        $request->session()->set('nomenclator_filters', $filters);
        $recordsTotal = Nomenclator::where('nomenclator_type_id', $request->get('nomenclator_type_id'))->count();
        $nomenclators = Nomenclator::filter($request);
        try {
            $recordsFiltered = intval(Nomenclator::filter($request, true));
        } catch (\ErrorException $e) {
            $recordsFiltered = 0;
        }

        $output = array(
            "draw" => intval($request->get('draw')),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => array()
        );

        foreach ($nomenclators as $aRow) {
            $row = array();
            for ($i = 0; $i < count($columns); $i++) {
                switch ($columns[$i]['name']) {
                    case 'created_at':
                        $date = strtotime($aRow->created_at);
                        if ($date != '')
                            $row[] = date('d/m/Y', $date);
                        else
                            $row[] = 'No definida';
                        break;
                    default:
                        if ($columns[$i]['name'] != ' ') {
                            /* General output */
                            $row[] = $aRow[$columns[$i]['name']];
                        }
                        break;
                }
            }
            $output['data'][] = $row;
        }
        return response()->json($output);
    }
}
