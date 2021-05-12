<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerEmployment\IndexCustomerEmployment;
use App\Http\Requests\CustomerEmployment\StoreCustomerEmployment;
use App\Http\Requests\CustomerEmployment\UpdateCustomerEmployment;
use App\Http\Requests\CustomerEmployment\DestroyCustomerEmployment;
use App\Models\CustomerEmployment;
use App\Repositories\CustomerEmployments;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CustomerEmploymentController  extends Controller
{
    private CustomerEmployments $repo;
    public function __construct(CustomerEmployments $repo)
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
        $this->authorize('viewAny', CustomerEmployment::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("postal_address")->className('min-desktop-lg'),
            Column::make("employer")->className('min-desktop-lg'),
            Column::make("postal_code")->className('min-desktop-lg'),
            Column::make("town")->className('min-desktop-lg'),
            Column::make("phone_number")->className('min-desktop-lg'),
            Column::make("email")->className('min-desktop-lg'),
            Column::make("to_date")->className('min-desktop-lg'),
            Column::make("from_date")->className('min-desktop-lg'),
            Column::make("still_employed_here")->className('min-desktop-lg'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('CustomerEmployments/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CustomerEmployment::class),
                "create" => \Auth::user()->can('create', CustomerEmployment::class),
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
        $this->authorize('create', CustomerEmployment::class);
        return Inertia::render("CustomerEmployments/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', CustomerEmployment::class),
            "create" => \Auth::user()->can('create', CustomerEmployment::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreCustomerEmployment $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreCustomerEmployment $request)
    {
        try {
            $data = $request->sanitizedObject();
            $customerEmployment = $this->repo::store($data);
            return \Redirect::route('admin.customer-employments.index')->with(['success' => "The CustomerEmployment was created succesfully."]);
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
    * @param CustomerEmployment $customerEmployment
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, CustomerEmployment $customerEmployment)
    {
        try {
            $this->authorize('view', $customerEmployment);
            //Fetch relationships
            

                

                                        $customerEmployment->load([

                                            'customer',
                    
                    ]);
                                        return Inertia::render("CustomerEmployments/Show", ["model" => $customerEmployment]);
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
    * @param CustomerEmployment $customerEmployment
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, CustomerEmployment $customerEmployment)
    {
        try {
            $this->authorize('update', $customerEmployment);
            //Fetch relationships
            

                

                                        $customerEmployment->load([

                                            'customer',
                    
                    ]);
                                        return Inertia::render("CustomerEmployments/Edit", ["model" => $customerEmployment]);
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
    * @param UpdateCustomerEmployment $request
    * @param {$modelBaseName} $customerEmployment
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateCustomerEmployment $request, CustomerEmployment $customerEmployment)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($customerEmployment)->update($data);
            return \Redirect::route('admin.customer-employments.index')->with(['success' => "The CustomerEmployment was updated succesfully."]);
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
    * @param CustomerEmployment $customerEmployment
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyCustomerEmployment $request, CustomerEmployment $customerEmployment)
    {
        $res = $this->repo::init($customerEmployment)->destroy();
        if ($res) {
            return \Redirect::route('admin.customer-employments.index')->with(['success' => "The CustomerEmployment was deleted succesfully."]);
        }
        else {
            return \Redirect::route('admin.customer-employments.index')->with(['error' => "The CustomerEmployment could not be deleted."]);
        }
    }
}
