<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerAddress\IndexCustomerAddress;
use App\Http\Requests\CustomerAddress\StoreCustomerAddress;
use App\Http\Requests\CustomerAddress\UpdateCustomerAddress;
use App\Http\Requests\CustomerAddress\DestroyCustomerAddress;
use App\Models\CustomerAddress;
use App\Repositories\CustomerAddresses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CustomerAddressController  extends Controller
{
    private CustomerAddresses $repo;
    public function __construct(CustomerAddresses $repo)
    {
        $this->repo = $repo;
    }

    /**
    * Display a listing of the resource.
    *
    * @param  Request $request
    * @return    \Inertia\Response
    * @throws  \Illuminate\Auth\Access\AuthorizationException
    */
    public function index(Request $request): \Inertia\Response
    {
        $this->authorize('viewAny', CustomerAddress::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("postal_address")->className('min-desktop-lg'),
            Column::make("postal_code")->className('min-desktop-lg'),
            Column::make("town")->className('min-desktop-lg'),
            Column::make("active")->className('min-desktop-lg'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('CustomerAddresses/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CustomerAddress::class),
                "create" => \Auth::user()->can('create', CustomerAddress::class),
            ],
            "columns" => $columns,
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return  \Inertia\Response
    */
    public function create()
    {
        $this->authorize('create', CustomerAddress::class);
        return Inertia::render("CustomerAddresses/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', CustomerAddress::class),
            "create" => \Auth::user()->can('create', CustomerAddress::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreCustomerAddress $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreCustomerAddress $request)
    {
        try {
            $data = $request->sanitizedObject();
            $customerAddress = $this->repo::store($data);
            return \Redirect::route('admin.customer-addresses.index')->with(['success' => "The CustomerAddress was created succesfully."]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
    * Display the specified resource.
    *
    * @param Request $request
    * @param CustomerAddress $customerAddress
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, CustomerAddress $customerAddress)
    {
        try {
            $this->authorize('view', $customerAddress);
            //Fetch relationships
            

                

                                        $customerAddress->load([

                                            'customer',
                    
                    ]);
                                        return Inertia::render("CustomerAddresses/Show", ["model" => $customerAddress]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
    * Show Edit Form for the specified resource.
    *
    * @param Request $request
    * @param CustomerAddress $customerAddress
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, CustomerAddress $customerAddress)
    {
        try {
            $this->authorize('update', $customerAddress);
            //Fetch relationships
            

                

                                        $customerAddress->load([

                                            'customer',
                    
                    ]);
                                        return Inertia::render("CustomerAddresses/Edit", ["model" => $customerAddress]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
    * Update the specified resource in storage.
    *
    * @param UpdateCustomerAddress $request
    * @param {$modelBaseName} $customerAddress
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateCustomerAddress $request, CustomerAddress $customerAddress)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($customerAddress)->update($data);
            return \Redirect::route('admin.customer-addresses.index')->with(['success' => "The CustomerAddress was updated succesfully."]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param CustomerAddress $customerAddress
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyCustomerAddress $request, CustomerAddress $customerAddress)
    {
        $res = $this->repo::init($customerAddress)->destroy();
        if ($res) {
            return \Redirect::route('admin.customer-addresses.index')->with(['success' => "The CustomerAddress was deleted succesfully."]);
        }
        else {
            return \Redirect::route('admin.customer-addresses.index')->with(['error' => "The CustomerAddress could not be deleted."]);
        }
    }
}
