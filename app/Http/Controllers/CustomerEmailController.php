<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerEmail\IndexCustomerEmail;
use App\Http\Requests\CustomerEmail\StoreCustomerEmail;
use App\Http\Requests\CustomerEmail\UpdateCustomerEmail;
use App\Http\Requests\CustomerEmail\DestroyCustomerEmail;
use App\Models\CustomerEmail;
use App\Repositories\CustomerEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CustomerEmailController  extends Controller
{
    private CustomerEmails $repo;
    public function __construct(CustomerEmails $repo)
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
        $this->authorize('viewAny', CustomerEmail::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("email")->className('min-desktop-lg'),
            Column::make("active")->className('min-desktop-lg'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('CustomerEmails/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CustomerEmail::class),
                "create" => \Auth::user()->can('create', CustomerEmail::class),
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
        $this->authorize('create', CustomerEmail::class);
        return Inertia::render("CustomerEmails/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', CustomerEmail::class),
            "create" => \Auth::user()->can('create', CustomerEmail::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreCustomerEmail $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreCustomerEmail $request)
    {
        try {
            $data = $request->sanitizedObject();
            $customerEmail = $this->repo::store($data);
            return \Redirect::route('admin.customer-emails.index')->with(['success' => "The CustomerEmail was created succesfully."]);
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
    * @param CustomerEmail $customerEmail
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, CustomerEmail $customerEmail)
    {
        try {
            $this->authorize('view', $customerEmail);
            //Fetch relationships
            

                

                                        $customerEmail->load([

                                            'customer',
                    
                    ]);
                                        return Inertia::render("CustomerEmails/Show", ["model" => $customerEmail]);
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
    * @param CustomerEmail $customerEmail
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, CustomerEmail $customerEmail)
    {
        try {
            $this->authorize('update', $customerEmail);
            //Fetch relationships
            

                

                                        $customerEmail->load([

                                            'customer',
                    
                    ]);
                                        return Inertia::render("CustomerEmails/Edit", ["model" => $customerEmail]);
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
    * @param UpdateCustomerEmail $request
    * @param {$modelBaseName} $customerEmail
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateCustomerEmail $request, CustomerEmail $customerEmail)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($customerEmail)->update($data);
            return \Redirect::route('admin.customer-emails.index')->with(['success' => "The CustomerEmail was updated succesfully."]);
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
    * @param CustomerEmail $customerEmail
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyCustomerEmail $request, CustomerEmail $customerEmail)
    {
        $res = $this->repo::init($customerEmail)->destroy();
        if ($res) {
            return \Redirect::route('admin.customer-emails.index')->with(['success' => "The CustomerEmail was deleted succesfully."]);
        }
        else {
            return \Redirect::route('admin.customer-emails.index')->with(['error' => "The CustomerEmail could not be deleted."]);
        }
    }
}
