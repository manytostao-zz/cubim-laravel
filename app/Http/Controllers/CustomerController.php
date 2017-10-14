<?php

namespace CUBiM\Http\Controllers;

use CUBiM\Helpers\DataTableHelper;
use CUBiM\Http\Requests\CustomerFormRequest;
use CUBiM\Repositories\Interfaces\ICustomersRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Class CustomerController
 * @package CUBiM\Http\Controllers
 */
class CustomerController extends Controller
{
    /**
     * @var ICustomersRepository
     */
    private $customersRepository;

    /**
     * CustomerController constructor.
     * @param ICustomersRepository $customersRepository
     */
    public function __construct(ICustomersRepository $customersRepository)
    {
        $this->customersRepository = $customersRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('customers.index')->with('active', array('sup' => 'registry'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('customers.create')->with('active', array('sup' => 'registry'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerFormRequest|Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CustomerFormRequest $request)
    {
        $nomenclators = array();
        if ($request->get('country') != '')
            $nomenclators[] = $request->get('country');
        if ($request->get('professional_type') != '')
            $nomenclators[] = $request->get('professional_type');
        if ($request->get('profession') != '')
            $nomenclators[] = $request->get('profession');
        if ($request->get('specialty') != '')
            $nomenclators[] = $request->get('specialty');
        if ($request->get('position') != '')
            $nomenclators[] = $request->get('position');
        if ($request->get('institution') != '')
            $nomenclators[] = $request->get('institution');
        if ($request->get('dedication') != '')
            $nomenclators[] = $request->get('dedication');
        if ($request->get('teaching_category') != '')
            $nomenclators[] = $request->get('teaching_category');
        if ($request->get('investigative_category') != '')
            $nomenclators[] = $request->get('investigative_category');
        if ($request->get('scientific_category') != '')
            $nomenclators[] = $request->get('scientific_category');
        if ($request->get('occupational_category') != '')
            $nomenclators[] = $request->get('occupational_category');
        if ($request->get('customer_type') != '')
            $nomenclators[] = $request->get('customer_type');

        $customer = $this->customersRepository->create(
            array('name' => $request->get('name'),
                'last_name' => $request->get('last_name'),
                'id_card' => $request->get('id_card'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone') != 0 ? $request->get('phone') : null,
                'topic' => $request->get('topic'),
                'comments' => $request->get('comments'),
                'experience' => $request->get('experience') != 0 ? $request->get('experience') : null,
                'library_card' => $request->get('library_card') != 0 ? $request->get('library_card') : null,
                'active' => 1
            )
        );

        return \Redirect::route('customers.edit',
            array($customer->id))->with('message', 'Datos de usuario almacenados correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $customer = $this->customersRepository->with(['nomenclators', 'user'])->find($id);

        if (!$customer->active) {
            Session::flash('message', 'Se ha inactivado el usuario.');
        }

        if ($customer->banned) {
            Session::flash('message', 'Se ha restringido al usuario el acceso al centro.');
        }
        return view('customers.show')->with('customer', $customer)->with('active', array('sup' => 'registry'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $customer = $this->customersRepository->with(['nomenclators', 'user'])->find($id);

        if (!$customer->active) {
            Session::flash('message', 'Se ha inactivado el usuario.');
        }

        if ($customer->banned) {
            Session::flash('message', 'Se ha restringido al usuario el acceso al centro.');
        }

        return view('customers.edit')->with('customer', $customer)->with('active', array('sup' => 'registry'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomerFormRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CustomerFormRequest $request, $id)
    {
        $customer = $this->customersRepository->find($id);
        $nomenclators = array();
        if ($request->get('country') != '')
            $nomenclators[] = $request->get('country');
        if ($request->get('professional_type') != '')
            $nomenclators[] = $request->get('professional_type');
        if ($request->get('profession') != '')
            $nomenclators[] = $request->get('profession');
        if ($request->get('specialty') != '')
            $nomenclators[] = $request->get('specialty');
        if ($request->get('position') != '')
            $nomenclators[] = $request->get('position');
        if ($request->get('institution') != '')
            $nomenclators[] = $request->get('institution');
        if ($request->get('dedication') != '')
            $nomenclators[] = $request->get('dedication');
        if ($request->get('teaching_category') != '')
            $nomenclators[] = $request->get('teaching_category');
        if ($request->get('investigative_category') != '')
            $nomenclators[] = $request->get('investigative_category');
        if ($request->get('scientific_category') != '')
            $nomenclators[] = $request->get('scientific_category');
        if ($request->get('occupational_category') != '')
            $nomenclators[] = $request->get('occupational_category');
        if ($request->get('customer_type') != '')
            $nomenclators[] = $request->get('customer_type');

        $this->customersRepository->update(
            array(
                'name' => $request->get('name'),
                'last_name' => $request->get('last_name'),
                'id_card' => $request->get('id_card'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone') != 0 ? $request->get('phone') : null,
                'topic' => $request->get('topic'),
                'comments' => $request->get('comments'),
                'experience' => $request->get('experience') != 0 ? $request->get('experience') : null,
                'library_card' => $request->get('library_card') != 0 ? $request->get('library_card') : null,
                'student' => $request->get('student') == 'on' ? 1 : 0,
            ),
            $customer->id);

        $this->customersRepository->sync($customer->id, ['nomenclators' => $nomenclators]);

        $request->session()->put('traceComments', 'Nombre(s) y Apellido(s): ' . $customer->name . ' ' . $customer->last_name . '.');

        return \Redirect::route('customers.edit',
            array($customer->id))->with('message', 'Datos de usuario actualizados correctamente.');
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
        $customer = $this->customersRepository->find($id);

        $request->session()->put('traceComments', 'Nombre(s) y Apellido(s): ' . $customer->name . ' ' . $customer->last_name . '.');

        try {
            $this->customersRepository->delete($id);

            return \Redirect::route('customers.index')
                ->with('message', 'Se ha eliminado correctamente el usuario.');
        } catch (QueryException $e) {
            $this->customersRepository->update(
                array('active' => false),
                $customer->id
            );

            return \Redirect::route('customers.index')
                ->with('message', 'El usuario posee registros asociados y no se pudo eliminar; en lugar de ello se desactivó.');
        }
    }

    /**
     * Ban or unban the specified resource from the system
     * @param Request $request
     * @return mixed
     */
    public function ban(Request $request)
    {
        $customer = $this->customersRepository->find($request->get('id'));
        if (is_null($customer->banned) || $customer->banned == false) {
            $this->customersRepository->update(array('banned' => true), $customer->id);
            $message = 'Se ha restringido al usuario el acceso al centro.';
            $value = true;
        } else {
            $this->customersRepository->update(array('banned' => false), $customer->id);
            $message = 'Se ha concedido al usuario el acceso al centro.';
            $value = false;
        }

        $request->session()->put('traceComments', 'Nombre(s) y Apellido(s): ' . $customer->name . ' ' . $customer->last_name . '.');

        $data['message'] = $message;
        $data['value'] = $value;

        return response()->json($data);


    }

    /**
     * Activate or deactivate the specified resource in the system
     * @param Request $request
     * @return mixed
     */
    public function activate(Request $request)
    {
        $customer = $this->customersRepository->find($request->get('id'));
        if (is_null($customer->active) || $customer->active == false) {
            $this->customersRepository->update(array('active' => true), $customer->id);
            $message = 'Se ha activado el usuario.';
            $value = true;
        } else {
            $this->customersRepository->update(array('active' => false), $customer->id);
            $message = 'Se ha inactivado el usuario.';
            $value = false;
        }

        $request->session()->put('traceComments', 'Nombre(s) y Apellido(s): ' . $customer->name . ' ' . $customer->last_name . '.');

        $data['message'] = $message;
        $data['value'] = $value;

        return response()->json($data);


    }

    /**
     * Return a json list to use in datatables
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function datatable(Request $request)
    {
        /*Extract filters from request and session vars*/
        $filters = DataTableHelper::extractRequestFilters($request, 'customer_filters');

        $columnNames = array();

        foreach ($filters['columns'] as $column) {
            switch ($column['name']) {
                case '':
                case 'attended_by':
                case 'customer_type':
                case 'professional_type':
                case 'institution':
                case 'specialty':
                case 'profession':
                case 'dedication':
                case 'occupational_category':
                case 'scientific_category':
                case 'investigative_category':
                case 'teaching_category':
                case 'country':
                case 'position':
                    break;
                default:
                    array_push($columnNames, $column['name']);
                    break;
            }
        }

        $recordsTotal = intval($this->customersRepository->count());

        $customers = $this->customersRepository->with(['nomenclators'])->paginateWhere($filters['length'], $columnNames, ($filters['start'] / $filters['length']) + 1, $filters);

        try {
            $recordsFiltered = intval($this->customersRepository->countWhere($filters));
        } catch (\ErrorException $e) {
            $recordsFiltered = 0;
        }

        $output = array(
            "draw" => intval($request->get('draw')),
            "recordsTotal" => $recordsTotal,
            "recordsFiltered" => $recordsFiltered,
            "data" => array()
        );

        $columns = array(
            'id',
            'name',
            'last_name',
            'id_card',
            'phone',
            'email',
            'customer_type',
            'professional_type',
            'institution',
            'library_card',
            'specialty',
            'profession',
            'dedication',
            'occupational_category',
            'scientific_category',
            'investigative_category',
            'teaching_category',
            'country',
            'position',
            'topic',
            'comments',
            'attended_by',
            'student',
            'active',
            'experience',
            'created_at',
            'actions',
        );

        foreach ($customers as $aRow) {
            $row = array();
            for ($i = 0; $i < count($columns); $i++) {
                switch ($columns[$i]) {
                    case 'created_at':
                        $date = strtotime($aRow->created_at);
                        $row[] = date('d/m/Y', $date);
                        break;
                    case 'attended_by':
                        if (!is_null($aRow->attended_by_id))
                            $row[] = $aRow->user->first_name . ' ' . $aRow->user->last_name;
                        else
                            $row[] = '';
                        break;
                    case 'customer_type':
                        $row[] = DataTableHelper::getCustomerNomenclator($aRow, 11);
                        break;
                    case 'professional_type':
                        $row[] = DataTableHelper::getCustomerNomenclator($aRow, 1);
                        break;
                    case 'institution':
                        $row[] = DataTableHelper::getCustomerNomenclator($aRow, 5);
                        break;
                    case 'specialty':
                        $row[] = DataTableHelper::getCustomerNomenclator($aRow, 2);
                        break;
                    case 'profession':
                        $row[] = DataTableHelper::getCustomerNomenclator($aRow, 3);
                        break;
                    case 'dedication':
                        $row[] = DataTableHelper::getCustomerNomenclator($aRow, 6);
                        break;
                    case 'occupational_category':
                        $row[] = DataTableHelper::getCustomerNomenclator($aRow, 8);
                        break;
                    case 'scientific_category':
                        $row[] = DataTableHelper::getCustomerNomenclator($aRow, 10);
                        break;
                    case 'investigative_category':
                        $row[] = DataTableHelper::getCustomerNomenclator($aRow, 9);
                        break;
                    case 'teaching_category':
                        $row[] = DataTableHelper::getCustomerNomenclator($aRow, 7);
                        break;
                    case 'country':
                        $row[] = DataTableHelper::getCustomerNomenclator($aRow, 12);
                        break;
                    case 'position':
                        $row[] = DataTableHelper::getCustomerNomenclator($aRow, 4);
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
     * Set session filter for the resource
     * @param Request $request
     */
    public function filter(Request $request)
    {
        $request->session()->put('customer_filters', $request->get('form'));
    }

    /**
     * Remove session filter for the resource
     * @param Request $request
     */
    public function clean(Request $request)
    {
        $request->session()->pull('customer_filters');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function lastLibraryCardNumber(Request $request)
    {
        $customerType = $request->get('customer_type');

        $lastLibraryCardNumber = $this->customersRepository->maxWhere('library_card', ['customerType' => $customerType]);

        return response()->json($lastLibraryCardNumber + 1);
    }
}
