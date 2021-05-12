<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerGuarantor\IndexCustomerGuarantor;
use App\Http\Requests\CustomerGuarantor\StoreCustomerGuarantor;
use App\Http\Requests\CustomerGuarantor\UpdateCustomerGuarantor;
use App\Http\Requests\CustomerGuarantor\DestroyCustomerGuarantor;
use App\Models\CustomerGuarantor;
use App\Repositories\CustomerGuarantors;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CustomerGuarantorController  extends Controller
{
    private CustomerGuarantors $repo;
    public function __construct(CustomerGuarantors $repo)
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
        $this->authorize('viewAny', CustomerGuarantor::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("name")->className('all'),
            Column::make("email")->className('min-desktop-lg'),
            Column::make("phone_number")->className('min-desktop-lg'),
            Column::make("postal_address")->className('min-desktop-lg'),
            Column::make("town")->className('min-desktop-lg'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('CustomerGuarantors/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CustomerGuarantor::class),
                "create" => \Auth::user()->can('create', CustomerGuarantor::class),
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
        $this->authorize('create', CustomerGuarantor::class);
        return Inertia::render("CustomerGuarantors/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', CustomerGuarantor::class),
            "create" => \Auth::user()->can('create', CustomerGuarantor::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreCustomerGuarantor $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreCustomerGuarantor $request)
    {
        try {
            $data = $request->sanitizedObject();
            $customerGuarantor = $this->repo::store($data);
            return \Redirect::route('admin.customer-guarantors.index')->with(['success' => "The CustomerGuarantor was created succesfully."]);
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
    * @param CustomerGuarantor $customerGuarantor
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, CustomerGuarantor $customerGuarantor)
    {
        try {
            $this->authorize('view', $customerGuarantor);
            //Fetch relationships
            

                

                                        $customerGuarantor->load([

                                            'customer',
                    
                    ]);
                                        return Inertia::render("CustomerGuarantors/Show", ["model" => $customerGuarantor]);
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
    * @param CustomerGuarantor $customerGuarantor
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, CustomerGuarantor $customerGuarantor)
    {
        try {
            $this->authorize('update', $customerGuarantor);
            //Fetch relationships
            

                

                                        $customerGuarantor->load([

                                            'customer',
                    
                    ]);
                                        return Inertia::render("CustomerGuarantors/Edit", ["model" => $customerGuarantor]);
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
    * @param UpdateCustomerGuarantor $request
    * @param {$modelBaseName} $customerGuarantor
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateCustomerGuarantor $request, CustomerGuarantor $customerGuarantor)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($customerGuarantor)->update($data);
            return \Redirect::route('admin.customer-guarantors.index')->with(['success' => "The CustomerGuarantor was updated succesfully."]);
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
    * @param CustomerGuarantor $customerGuarantor
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyCustomerGuarantor $request, CustomerGuarantor $customerGuarantor)
    {
        $res = $this->repo::init($customerGuarantor)->destroy();
        if ($res) {
            return \Redirect::route('admin.customer-guarantors.index')->with(['success' => "The CustomerGuarantor was deleted succesfully."]);
        }
        else {
            return \Redirect::route('admin.customer-guarantors.index')->with(['error' => "The CustomerGuarantor could not be deleted."]);
        }
    }
}
