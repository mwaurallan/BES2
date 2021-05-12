<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\County\StoreCounty;
use App\Http\Requests\County\UpdateCounty;
use App\Http\Requests\County\DestroyCounty;
use App\Models\County;
use App\Repositories\Counties;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CountyController  extends Controller
{
    private Counties $repo;
    public function __construct(Counties $repo)
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
        $this->authorize('viewAny', County::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("name")->className('all'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('Counties/Index', [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', County::class),
                "create" => \Auth::user()->can('create', County::class),
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
        $this->authorize('create', County::class);
        return Inertia::render("Counties/Create", [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', County::class),
                "create" => \Auth::user()->can('create', County::class),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCounty $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCounty $request)
    {
        try {
            $data = $request->sanitizedObject();
            $county = $this->repo::store($data);
            return back()->with(['success' => "The County was created succesfully."]);
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
     * @param County $county
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function show(Request $request, County $county)
    {
        try {
            $this->authorize('view', $county);
            //Fetch relationships


            return Inertia::render("Counties/Show", ["model" => $county]);
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
     * @param County $county
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, County $county)
    {
        try {
            $this->authorize('update', $county);
            //Fetch relationships


            return Inertia::render("Counties/Edit", ["model" => $county]);
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
     * @param UpdateCounty $request
     * @param {$modelBaseName} $county
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCounty $request, County $county)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($county)->update($data);
            return \Redirect::route('admin.counties.index')->with(['success' => "The County was updated succesfully."]);
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
     * @param County $county
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyCounty $request, County $county)
    {
        $res = $this->repo::init($county)->destroy();
        if ($res) {
            return \Redirect::route('admin.counties.index')->with(['success' => "The County was deleted succesfully."]);
        } else {
            return \Redirect::route('admin.counties.index')->with(['error' => "The County could not be deleted."]);
        }
    }
}
