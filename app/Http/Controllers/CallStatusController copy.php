<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CallStatus\IndexCallStatus;
use App\Http\Requests\CallStatus\StoreCallStatus;
use App\Http\Requests\CallStatus\UpdateCallStatus;
use App\Http\Requests\CallStatus\DestroyCallStatus;
use App\Models\CallStatus;
use App\Repositories\CallStatuses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CallStatusController  extends Controller
{
    private CallStatuses $repo;
    public function __construct(CallStatuses $repo)
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
        $this->authorize('viewAny', CallStatus::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("slug")->className('min-desktop-lg'),
            Column::make("name")->className('all'),
            Column::make("active")->className('min-desktop-lg'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('CallStatuses/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CallStatus::class),
                "create" => \Auth::user()->can('create', CallStatus::class),
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
        $this->authorize('create', CallStatus::class);
        return Inertia::render("CallStatuses/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', CallStatus::class),
            "create" => \Auth::user()->can('create', CallStatus::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreCallStatus $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreCallStatus $request)
    {
        try {
            $data = $request->sanitizedObject();
            $callStatus = $this->repo::store($data);
            return \Redirect::route('admin.call-statuses.index')->with(['success' => "The CallStatus was created succesfully."]);
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
    * @param CallStatus $callStatus
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, CallStatus $callStatus)
    {
        try {
            $this->authorize('view', $callStatus);
            //Fetch relationships
            

                                        return Inertia::render("CallStatuses/Show", ["model" => $callStatus]);
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
    * @param CallStatus $callStatus
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, CallStatus $callStatus)
    {
        try {
            $this->authorize('update', $callStatus);
            //Fetch relationships
            

                                        return Inertia::render("CallStatuses/Edit", ["model" => $callStatus]);
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
    * @param UpdateCallStatus $request
    * @param {$modelBaseName} $callStatus
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateCallStatus $request, CallStatus $callStatus)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($callStatus)->update($data);
            return \Redirect::route('admin.call-statuses.index')->with(['success' => "The CallStatus was updated succesfully."]);
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
    * @param CallStatus $callStatus
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyCallStatus $request, CallStatus $callStatus)
    {
        $res = $this->repo::init($callStatus)->destroy();
        if ($res) {
            return \Redirect::route('admin.call-statuses.index')->with(['success' => "The CallStatus was deleted succesfully."]);
        }
        else {
            return \Redirect::route('admin.call-statuses.index')->with(['error' => "The CallStatus could not be deleted."]);
        }
    }
}
