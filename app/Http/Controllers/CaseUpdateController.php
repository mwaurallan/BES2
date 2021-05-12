<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaseUpdate\IndexCaseUpdate;
use App\Http\Requests\CaseUpdate\StoreCaseUpdate;
use App\Http\Requests\CaseUpdate\UpdateCaseUpdate;
use App\Http\Requests\CaseUpdate\DestroyCaseUpdate;
use App\Models\CaseUpdate;
use App\Repositories\CaseUpdates;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CaseUpdateController  extends Controller
{
    private CaseUpdates $repo;
    public function __construct(CaseUpdates $repo)
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
        $this->authorize('viewAny', CaseUpdate::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('CaseUpdates/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CaseUpdate::class),
                "create" => \Auth::user()->can('create', CaseUpdate::class),
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
        $this->authorize('create', CaseUpdate::class);
        return Inertia::render("CaseUpdates/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', CaseUpdate::class),
            "create" => \Auth::user()->can('create', CaseUpdate::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreCaseUpdate $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreCaseUpdate $request)
    {
        try {
            $data = $request->sanitizedObject();
            $caseUpdate = $this->repo::store($data);
            if($caseUpdate->caseFile->status && $caseUpdate->caseFile->status->slug ==='closed') {
                return redirect()->route('my.case-files.index')->with(['success' => "The Case Update was recorded succesfully."]);
            }
            return back()->with(['success' => "The Case Update was recorded succesfully."]);
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
    * @param CaseUpdate $caseUpdate
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, CaseUpdate $caseUpdate)
    {
        try {
            $this->authorize('view', $caseUpdate);
            //Fetch relationships




                                        $caseUpdate->load([

                                            'callStatus',
                                            'caseFile',
                                            'caseNote',
                                            'newStatus',
                                            'nextAction',
                                            'paymentPromise',
                                            'previousStatus',
                                            'updater',

                    ]);
                                        return Inertia::render("CaseUpdates/Show", ["model" => $caseUpdate]);
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
    * @param CaseUpdate $caseUpdate
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, CaseUpdate $caseUpdate)
    {
        try {
            $this->authorize('update', $caseUpdate);
            //Fetch relationships




                                        $caseUpdate->load([

                                            'callStatus',
                                            'caseFile',
                                            'caseNote',
                                            'newStatus',
                                            'nextAction',
                                            'paymentPromise',
                                            'previousStatus',
                                            'updater',

                    ]);
                                        return Inertia::render("CaseUpdates/Edit", ["model" => $caseUpdate]);
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
    * @param UpdateCaseUpdate $request
    * @param {$modelBaseName} $caseUpdate
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateCaseUpdate $request, CaseUpdate $caseUpdate)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($caseUpdate)->update($data);
            return \Redirect::route('admin.case-updates.index')->with(['success' => "The CaseUpdate was updated succesfully."]);
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
    * @param CaseUpdate $caseUpdate
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyCaseUpdate $request, CaseUpdate $caseUpdate)
    {
        $res = $this->repo::init($caseUpdate)->destroy();
        if ($res) {
            return \Redirect::route('admin.case-updates.index')->with(['success' => "The CaseUpdate was deleted succesfully."]);
        }
        else {
            return \Redirect::route('admin.case-updates.index')->with(['error' => "The CaseUpdate could not be deleted."]);
        }
    }
}
