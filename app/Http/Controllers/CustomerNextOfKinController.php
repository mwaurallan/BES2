<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerNextOfKin\IndexCustomerNextOfKin;
use App\Http\Requests\CustomerNextOfKin\StoreCustomerNextOfKin;
use App\Http\Requests\CustomerNextOfKin\UpdateCustomerNextOfKin;
use App\Http\Requests\CustomerNextOfKin\DestroyCustomerNextOfKin;
use App\Models\CustomerNextOfKin;
use App\Repositories\CustomerNextOfKins;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CustomerNextOfKinController  extends Controller
{
    private CustomerNextOfKins $repo;
    public function __construct(CustomerNextOfKins $repo)
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
        $this->authorize('viewAny', CustomerNextOfKin::class);

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
        return Inertia::render('CustomerNextOfKins/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CustomerNextOfKin::class),
                "create" => \Auth::user()->can('create', CustomerNextOfKin::class),
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
        $this->authorize('create', CustomerNextOfKin::class);
        return Inertia::render("CustomerNextOfKins/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', CustomerNextOfKin::class),
            "create" => \Auth::user()->can('create', CustomerNextOfKin::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreCustomerNextOfKin $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreCustomerNextOfKin $request)
    {
        try {
            $data = $request->sanitizedObject();
            $customerNextOfKin = $this->repo::store($data);
            return \Redirect::route('admin.customer-next-of-kins.index')->with(['success' => "The CustomerNextOfKin was created succesfully."]);
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
    * @param CustomerNextOfKin $customerNextOfKin
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, CustomerNextOfKin $customerNextOfKin)
    {
        try {
            $this->authorize('view', $customerNextOfKin);
            //Fetch relationships
            

                

                                        $customerNextOfKin->load([

                                            'customer',
                    
                    ]);
                                        return Inertia::render("CustomerNextOfKins/Show", ["model" => $customerNextOfKin]);
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
    * @param CustomerNextOfKin $customerNextOfKin
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, CustomerNextOfKin $customerNextOfKin)
    {
        try {
            $this->authorize('update', $customerNextOfKin);
            //Fetch relationships
            

                

                                        $customerNextOfKin->load([

                                            'customer',
                    
                    ]);
                                        return Inertia::render("CustomerNextOfKins/Edit", ["model" => $customerNextOfKin]);
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
    * @param UpdateCustomerNextOfKin $request
    * @param {$modelBaseName} $customerNextOfKin
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateCustomerNextOfKin $request, CustomerNextOfKin $customerNextOfKin)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($customerNextOfKin)->update($data);
            return \Redirect::route('admin.customer-next-of-kins.index')->with(['success' => "The CustomerNextOfKin was updated succesfully."]);
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
    * @param CustomerNextOfKin $customerNextOfKin
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyCustomerNextOfKin $request, CustomerNextOfKin $customerNextOfKin)
    {
        $res = $this->repo::init($customerNextOfKin)->destroy();
        if ($res) {
            return \Redirect::route('admin.customer-next-of-kins.index')->with(['success' => "The CustomerNextOfKin was deleted succesfully."]);
        }
        else {
            return \Redirect::route('admin.customer-next-of-kins.index')->with(['error' => "The CustomerNextOfKin could not be deleted."]);
        }
    }
}
