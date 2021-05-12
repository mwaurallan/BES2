<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClientBranch\IndexClientBranch;
use App\Http\Requests\ClientBranch\StoreClientBranch;
use App\Http\Requests\ClientBranch\UpdateClientBranch;
use App\Http\Requests\ClientBranch\DestroyClientBranch;
use App\Models\ClientBranch;
use App\Repositories\ClientBranches;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class ClientBranchController extends Controller
{
    private ClientBranches $repo;

    public function __construct(ClientBranches $repo)
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
        $this->authorize('viewAny', ClientBranch::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("name")->className('all'),
            Column::make("contact_email")->className('min-desktop-lg'),
            Column::make("contact_person")->className('min-desktop-lg'),
            Column::make("contact_phone")->className('min-desktop-lg'),
            Column::make("active")->className('min-desktop-lg'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('ClientBranches/Index', [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', ClientBranch::class),
                "create" => \Auth::user()->can('create', ClientBranch::class),
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
        $this->authorize('create', ClientBranch::class);
        return Inertia::render("ClientBranches/Create", [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', ClientBranch::class),
                "create" => \Auth::user()->can('create', ClientBranch::class),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClientBranch $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreClientBranch $request)
    {
        try {
            $data = $request->sanitizedObject();
            $clientBranch = $this->repo::store($data);
            return \Redirect::route('admin.client-branches.index')->with(['success' => "The ClientBranch was created succesfully."]);
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
     * @param ClientBranch $clientBranch
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function show(Request $request, ClientBranch $clientBranch)
    {
        try {
            $this->authorize('view', $clientBranch);
            //Fetch relationships
            $clientBranch->load([
                'client',
            ]);
            return Inertia::render("ClientBranches/Show", ["model" => $clientBranch]);
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
     * @param ClientBranch $clientBranch
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, ClientBranch $clientBranch)
    {
        try {
            $this->authorize('update', $clientBranch);
            //Fetch relationships
            $clientBranch->load([
                'client',
            ]);
            return Inertia::render("ClientBranches/Edit", ["model" => $clientBranch]);
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
     * @param UpdateClientBranch $request
     * @param {$modelBaseName} $clientBranch
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateClientBranch $request, ClientBranch $clientBranch)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($clientBranch)->update($data);
            return back()->with(['success' => "The ClientBranch was updated succesfully."]);
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
     * @param ClientBranch $clientBranch
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyClientBranch $request, ClientBranch $clientBranch)
    {
        $res = $this->repo::init($clientBranch)->destroy();
        if ($res) {
            return \Redirect::route('admin.client-branches.index')->with(['success' => "The ClientBranch was deleted succesfully."]);
        } else {
            return \Redirect::route('admin.client-branches.index')->with(['error' => "The ClientBranch could not be deleted."]);
        }
    }
}
