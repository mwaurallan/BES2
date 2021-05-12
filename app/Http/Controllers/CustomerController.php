<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\IndexCustomer;
use App\Http\Requests\Customer\StoreCustomer;
use App\Http\Requests\Customer\UpdateCustomer;
use App\Http\Requests\Customer\DestroyCustomer;
use App\Models\Customer;
use App\Repositories\Customers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CustomerController extends Controller
{
    private Customers $repo;

    public function __construct(Customers $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return    \Inertia\Response
     * @throws  \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request): \Inertia\Response
    {
        $this->authorize('viewAny', Customer::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("last_name")->className('min-desktop-lg'),
            Column::make("first_name")->className('min-desktop-lg'),
            Column::make("middle_name")->className('min-desktop-lg'),
            Column::make("passport_number")->className('min-desktop-lg'),
            Column::make("id_number")->className('min-desktop-lg'),
            Column::make("kra_pin")->className('min-desktop-lg'),
            Column::make("driving_license")->className('min-desktop-lg'),
            Column::make("town")->className('min-desktop-lg'),
            Column::make("nearby_major_town")->className('min-desktop-lg'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('Customers/Index', [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Customer::class),
                "create" => \Auth::user()->can('create', Customer::class),
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
        $this->authorize('create', Customer::class);
        return Inertia::render("Customers/Create", [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Customer::class),
                "create" => \Auth::user()->can('create', Customer::class),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCustomer $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCustomer $request)
    {
        try {
            $data = $request->sanitizedObject();
            $customer = $this->repo::store($data);
            return back()->with(['success' => "The Customer was created succesfully."]);
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
     * @param Customer $customer
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function show(Request $request, Customer $customer)
    {
        try {
            $this->authorize('view', $customer);
            //Fetch relationships
            $customer->load([
                'clientBranch',
                'client',
                'county',
            ]);
            return Inertia::render("Customers/Show", ["model" => $customer]);
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
     * @param Customer $customer
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, Customer $customer)
    {
        try {
            $this->authorize('update', $customer);
            //Fetch relationships
            $customer->load([
                'clientBranch',
                'client',
                'county',
            ]);
            return Inertia::render("Customers/Edit", ["model" => $customer]);
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
     * @param UpdateCustomer $request
     * @param {$modelBaseName} $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCustomer $request, Customer $customer)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($customer)->update($data);
            return back()->with('success' ,"The Customer was updated succesfully.");
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
     * @param Customer $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyCustomer $request, Customer $customer)
    {
        try {
            $res = $this->repo::init($customer)->destroy();
            if ($res) {
                return back()->with(['success' => "The Customer was deleted succesfully."]);
            } else {
                return back()->with(['error' => "The Customer could not be deleted."]);
            }
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with(['error' => "The Customer could not be deleted."]);
        }
    }
}
