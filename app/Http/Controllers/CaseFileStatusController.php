<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaseFileStatus\IndexCaseFileStatus;
use App\Http\Requests\CaseFileStatus\StoreCaseFileStatus;
use App\Http\Requests\CaseFileStatus\UpdateCaseFileStatus;
use App\Http\Requests\CaseFileStatus\DestroyCaseFileStatus;
use App\Models\CaseFileStatus;
use App\Repositories\CaseFileStatuses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CaseFileStatusController  extends Controller
{
    private CaseFileStatuses $repo;
    public function __construct(CaseFileStatuses $repo)
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
        $this->authorize('viewAny', CaseFileStatus::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("slug")->className('min-desktop-lg'),
            Column::make("name")->className('all'),
            Column::make("active")->className('min-desktop-lg'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('CaseFileStatuses/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CaseFileStatus::class),
                "create" => \Auth::user()->can('create', CaseFileStatus::class),
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
        $this->authorize('create', CaseFileStatus::class);
        return Inertia::render("CaseFileStatuses/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', CaseFileStatus::class),
            "create" => \Auth::user()->can('create', CaseFileStatus::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreCaseFileStatus $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreCaseFileStatus $request)
    {
        try {
            $data = $request->sanitizedObject();
            $caseFileStatus = $this->repo::store($data);
            return \Redirect::route('admin.case-file-statuses.index')->with(['success' => "The CaseFileStatus was created succesfully."]);
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
    * @param CaseFileStatus $caseFileStatus
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, CaseFileStatus $caseFileStatus)
    {
        try {
            $this->authorize('view', $caseFileStatus);
            //Fetch relationships
            

                                        return Inertia::render("CaseFileStatuses/Show", ["model" => $caseFileStatus]);
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
    * @param CaseFileStatus $caseFileStatus
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, CaseFileStatus $caseFileStatus)
    {
        try {
            $this->authorize('update', $caseFileStatus);
            //Fetch relationships
            

                                        return Inertia::render("CaseFileStatuses/Edit", ["model" => $caseFileStatus]);
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
    * @param UpdateCaseFileStatus $request
    * @param {$modelBaseName} $caseFileStatus
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateCaseFileStatus $request, CaseFileStatus $caseFileStatus)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($caseFileStatus)->update($data);
            return \Redirect::route('admin.case-file-statuses.index')->with(['success' => "The CaseFileStatus was updated succesfully."]);
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
    * @param CaseFileStatus $caseFileStatus
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyCaseFileStatus $request, CaseFileStatus $caseFileStatus)
    {
        $res = $this->repo::init($caseFileStatus)->destroy();
        if ($res) {
            return \Redirect::route('admin.case-file-statuses.index')->with(['success' => "The CaseFileStatus was deleted succesfully."]);
        }
        else {
            return \Redirect::route('admin.case-file-statuses.index')->with(['error' => "The CaseFileStatus could not be deleted."]);
        }
    }
}
