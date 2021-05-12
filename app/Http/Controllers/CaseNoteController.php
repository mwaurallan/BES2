<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CaseNote\IndexCaseNote;
use App\Http\Requests\CaseNote\StoreCaseNote;
use App\Http\Requests\CaseNote\UpdateCaseNote;
use App\Http\Requests\CaseNote\DestroyCaseNote;
use App\Models\CaseNote;
use App\Repositories\CaseNotes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CaseNoteController extends Controller
{
    private CaseNotes $repo;

    public function __construct(CaseNotes $repo)
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
        $this->authorize('viewAny', CaseNote::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("created_at")->className('min-tv'),
            Column::make("updated_at")->className('min-tv'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('CaseNotes/Index', [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CaseNote::class),
                "create" => \Auth::user()->can('create', CaseNote::class),
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
        $this->authorize('create', CaseNote::class);
        return Inertia::render("CaseNotes/Create", [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CaseNote::class),
                "create" => \Auth::user()->can('create', CaseNote::class),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCaseNote $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCaseNote $request)
    {
        try {
            $data = $request->sanitizedObject();
            $caseNote = $this->repo::store($data);
            return back()->with(['success' => "The Case Note was recorded succesfully."]);
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
     * @param CaseNote $caseNote
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function show(Request $request, CaseNote $caseNote)
    {
        try {
            $this->authorize('view', $caseNote);
            //Fetch relationships
            $caseNote->load([
                'author',
                'caseFile',
            ]);
            return Inertia::render("CaseNotes/Show", ["model" => $caseNote]);
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
     * @param CaseNote $caseNote
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, CaseNote $caseNote)
    {
        try {
            $this->authorize('update', $caseNote);
            //Fetch relationships


            $caseNote->load([

                'author',
                'caseFile',

            ]);
            return Inertia::render("CaseNotes/Edit", ["model" => $caseNote]);
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
     * @param UpdateCaseNote $request
     * @param {$modelBaseName} $caseNote
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCaseNote $request, CaseNote $caseNote)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($caseNote)->update($data);
            return \Redirect::route('admin.case-notes.index')->with(['success' => "The CaseNote was updated succesfully."]);
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
     * @param CaseNote $caseNote
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyCaseNote $request, CaseNote $caseNote)
    {
        try {
            $res = $this->repo::init($caseNote)->destroy();
            if ($res) {
                return back()->with(['success' => "The CaseNote was deleted succesfully."]);
            } else {
                return back()->with(['error' => "The CaseNote could not be deleted."]);
            }
        } catch (\Throwable $exception) {
            \Log::info($exception);
            return back()->with("error", "A server error occured while deleting the record. Check the logs for more details.");
        }
    }
}
