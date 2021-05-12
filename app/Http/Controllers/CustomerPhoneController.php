<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerPhone\IndexCustomerPhone;
use App\Http\Requests\CustomerPhone\StoreCustomerPhone;
use App\Http\Requests\CustomerPhone\UpdateCustomerPhone;
use App\Http\Requests\CustomerPhone\DestroyCustomerPhone;
use App\Models\CustomerPhone;
use App\Repositories\CustomerPhones;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CustomerPhoneController extends Controller
{
    private CustomerPhones $repo;

    public function __construct(CustomerPhones $repo)
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
        $this->authorize('viewAny', CustomerPhone::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("phone")->className('min-desktop-lg'),
            Column::make("active")->className('min-desktop-lg'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('CustomerPhones/Index', [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CustomerPhone::class),
                "create" => \Auth::user()->can('create', CustomerPhone::class),
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
        $this->authorize('create', CustomerPhone::class);
        return Inertia::render("CustomerPhones/Create", [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CustomerPhone::class),
                "create" => \Auth::user()->can('create', CustomerPhone::class),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCustomerPhone $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCustomerPhone $request)
    {
        try {
            $data = $request->sanitizedObject();
            $customerPhone = $this->repo::store($data);
            return back()->with(['success' => "The Customer Phone was created succesfully."]);
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
     * @param CustomerPhone $customerPhone
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function show(Request $request, CustomerPhone $customerPhone)
    {
        try {
            $this->authorize('view', $customerPhone);
            //Fetch relationships
            $customerPhone->load([
                'customer',
            ]);
            return Inertia::render("CustomerPhones/Show", ["model" => $customerPhone]);
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
     * @param CustomerPhone $customerPhone
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, CustomerPhone $customerPhone)
    {
        try {
            $this->authorize('update', $customerPhone);
            //Fetch relationships


            $customerPhone->load([
                'customer',
            ]);
            return Inertia::render("CustomerPhones/Edit", ["model" => $customerPhone]);
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
     * @param UpdateCustomerPhone $request
     * @param {$modelBaseName} $customerPhone
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCustomerPhone $request, CustomerPhone $customerPhone)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($customerPhone)->update($data);
            return back()->with(['success' => "The Customer Phone was updated succesfully."]);
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
     * @param CustomerPhone $customerPhone
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyCustomerPhone $request, CustomerPhone $customerPhone)
    {
        $res = $this->repo::init($customerPhone)->destroy();
        if ($res) {
            return back()->with(['success' => "The Customer Phone was deleted succesfully."]);
        } else {
            return back()->with(['error' => "The Customer Phone could not be deleted."]);
        }
    }
}
