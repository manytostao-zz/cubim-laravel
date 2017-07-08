<?php

namespace CUBiM\Http\Controllers;

use CUBiM\Helper\Helper;
use CUBiM\Http\Requests\CustomerFormRequest;
use CUBiM\Model\Customer;
use CUBiM\Repositories\Interfaces\ICustomersRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

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
    public function index(Request $request)
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

        $customer = new Customer(
            array('name' => $request->get('name'),
                'last_name' => $request->get('last_name'),
                'id_card' => $request->get('id_card'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone') != 0 ? $request->get('phone') : null,
                'topic' => $request->get('topic'),
                'comments' => $request->get('comments'),
                'experience' => $request->get('experience') != 0 ? $request->get('experience') : null,
                'library_card' => $request->get('library_card') != 0 ? $request->get('library_card') : null,
                'active' => 1)
        );

        $this->customersRepository->save($customer);
        $this->customersRepository->syncNomenclators($customer, $nomenclators);

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
        $customer = $this->customersRepository->findById($id, ['nomenclators', 'user']);
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
        $customer = $this->customersRepository->findById($id, ['nomenclators', 'user']);

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
        $customer = $this->customersRepository->findById($id);
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

        $this->customersRepository->update($customer, [
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
        ]);

        $this->customersRepository->syncNomenclators($customer, $nomenclators);

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
        $customer = $this->customersRepository->findById($id);

        $request->session()->put('traceComments', 'Nombre(s) y Apellido(s): ' . $customer->name . ' ' . $customer->last_name . '.');

        try {
            $this->customersRepository->delete($id);

            return \Redirect::route('customers.index')
                ->with('message', 'Se ha eliminado correctamente el usuario.');
        } catch (QueryException $e) {
            $this->customersRepository->update($customer, [
                'active' => false
            ]);

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
        $customer = $this->customersRepository->findById($request->get('id'));
        if (is_null($customer->banned) || $customer->banned == 0) {
            $customer->banned = 1;
            $message = 'Se ha restringido al usuario el acceso al centro.';
            $value = true;
        } else {
            $customer->banned = 0;
            $message = 'Se ha concedido al usuario el acceso al centro.';
            $value = false;
        }
        $this->customersRepository->save($customer);

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
        $customer = $this->customersRepository->findById($request->get('id'));
        if (is_null($customer->active) || $customer->active == 0) {
            $customer->active = 1;
            $message = 'Se ha activado el usuario.';
            $value = true;
        } else {
            $customer->active = 0;
            $message = 'Se ha inactivado el usuario.';
            $value = false;
        }
        $this->customersRepository->save($customer);

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
        $filters = Helper::extractDatatableFiltersFromRequest($request, 'customer_filters');

        $recordsTotal = intval($this->customersRepository->findByFilters([], [], true));

        $customers = $this->customersRepository->findByFilters($filters, ['nomenclators', 'user']);

        try {
            $recordsFiltered = intval($this->customersRepository->findByFilters($filters, [], true));
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
                        $row[] = Helper::getCustomerNomenclator($aRow, 11);
                        break;
                    case 'professional_type':
                        $row[] = Helper::getCustomerNomenclator($aRow, 1);
                        break;
                    case 'institution':
                        $row[] = Helper::getCustomerNomenclator($aRow, 5);
                        break;
                    case 'specialty':
                        $row[] = Helper::getCustomerNomenclator($aRow, 2);
                        break;
                    case 'profession':
                        $row[] = Helper::getCustomerNomenclator($aRow, 3);
                        break;
                    case 'dedication':
                        $row[] = Helper::getCustomerNomenclator($aRow, 6);
                        break;
                    case 'occupational_category':
                        $row[] = Helper::getCustomerNomenclator($aRow, 8);
                        break;
                    case 'scientific_category':
                        $row[] = Helper::getCustomerNomenclator($aRow, 10);
                        break;
                    case 'investigative_category':
                        $row[] = Helper::getCustomerNomenclator($aRow, 9);
                        break;
                    case 'teaching_category':
                        $row[] = Helper::getCustomerNomenclator($aRow, 7);
                        break;
                    case 'country':
                        $row[] = Helper::getCustomerNomenclator($aRow, 12);
                        break;
                    case 'position':
                        $row[] = Helper::getCustomerNomenclator($aRow, 4);
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
        $lastLibraryCardNumber = $this->customersRepository->getLastAssignedLibraryCardNumber($customerType);

        return response()->json($lastLibraryCardNumber + 1);
    }
}
