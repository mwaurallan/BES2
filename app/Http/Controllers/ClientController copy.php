<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\IndexClient;
use App\Http\Requests\Client\StoreClient;
use App\Http\Requests\Client\UpdateClient;
use App\Http\Requests\Client\DestroyClient;
use App\Models\Client;
use App\Models\ClientBranch;
use App\Repositories\Clients;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class ClientController extends Controller
{
    private Clients $repo;

    public function __construct(Clients $repo)
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
        $this->authorize('viewAny', Client::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("name")->className('all'),
            Column::make("active")->className('min-desktop-lg'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('Clients/Index', [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Client::class),
                "create" => \Auth::user()->can('create', Client::class),
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
        $this->authorize('create', Client::class);
        return Inertia::render("Clients/Create", [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', Client::class),
                "create" => \Auth::user()->can('create', Client::class),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreClient $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreClient $request)
    {
        try {
            $data = $request->sanitizedObject();
            $client = $this->repo::store($data);
            return \Redirect::route('admin.clients.index')->with(['success' => "The Client was created succesfully."]);
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
     * @param Client $client
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function show(Request $request, Client $client)
    {
        try {
            $this->authorize('view', $client);
            //Fetch relationships
            return Inertia::render("Clients/Show", ["model" => $client]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with([
                'error' => $exception->getMessage(),
            ]);
        }
    }

    /**
     * @param Request $request
     * @param Client $client
     * @return \Illuminate\Http\RedirectResponse|\Inertia\Response
     */
    public function showManage(Request $request, Client $client)
    {
        try {
            $this->authorize('manage', $client);
            $client->load("branches");
            //Fetch relationships
            return Inertia::render("Clients/Manage", ["model" => $client]);
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
     * @param Client $client
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, Client $client)
    {
        try {
            $this->authorize('update', $client);
            //Fetch relationships


            return Inertia::render("Clients/Edit", ["model" => $client]);
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
     * @param UpdateClient $request
     * @param {$modelBaseName} $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateClient $request, Client $client)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($client)->update($data);
            return \Redirect::route('admin.clients.index')->with(['success' => "The Client was updated succesfully."]);
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
     * @param Client $client
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyClient $request, Client $client)
    {
        $res = $this->repo::init($client)->destroy();
        if ($res) {
            return \Redirect::route('admin.clients.index')->with(['success' => "The Client was deleted succesfully."]);
        } else {
            return \Redirect::route('admin.clients.index')->with(['error' => "The Client could not be deleted."]);
        }
    }
    public function createBranch(Request $request, Client $client): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            "name" =>           "required|string",
            "contact_email" =>  ["nullable", "email"],
            "contact_person" => ["required", "string"],
            "contact_phone" =>  ["required", "string", "max:13"],
            "active" =>         ["required", "boolean"]
        ]);
        try {
            $this->authorize("create", ClientBranch::class);
            $this->repo::init($client)->createBranch($request);
            return back();
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with(["error", $exception->getMessage()]);
        }
    }
}
