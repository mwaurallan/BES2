<?php

namespace App\Http\Controllers\Admin;

use App\Exports\CaseFileTemplateExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\CaseFile\IndexCaseFile;
use App\Http\Requests\CaseFile\StoreCaseFile;
use App\Http\Requests\CaseFile\UpdateCaseFile;
use App\Http\Requests\CaseFile\DestroyCaseFile;
use App\Imports\CaseFileImport;
use App\Imports\MultiSheetCaseFileImport;
use App\Models\CaseFile;
use App\Models\Client;
use App\Models\User;
use App\Repositories\CaseFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Maatwebsite\Excel\Excel;
use Yajra\DataTables\Html\Column;

class CaseFileController extends Controller
{
    private CaseFiles $repo;

    public function __construct(CaseFiles $repo)
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
        $this->authorize('viewAny', CaseFile::class);

        $columns = [
            Column::make('id')->title('ID')->className('all text-right'),
            Column::make("loan_account_number")->className('min-desktop-lg'),
            Column::make("updated_at")->className('min-tv'),
            Column::make("created_at")->className('min-tv'),
            Column::make("principal")->className('min-desktop-lg'),
            Column::make("paybill_number")->className('min-desktop-lg'),
            Column::make("interest")->className('min-desktop-lg'),
            Column::make("overdraft")->className('min-desktop-lg'),
            Column::make("batch_number")->className('min-desktop-lg'),
            Column::make('actions')->className('min-desktop text-right')->orderable(false)->searchable(false),
        ];
        return Inertia::render('CaseFiles/Index', [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CaseFile::class),
                "create" => \Auth::user()->can('create', CaseFile::class),
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
        $this->authorize('create', CaseFile::class);
        return Inertia::render("CaseFiles/Create", [
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CaseFile::class),
                "create" => \Auth::user()->can('create', CaseFile::class),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCaseFile $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCaseFile $request)
    {
        try {
            $data = $request->sanitizedObject();
            $caseFile = $this->repo::store($data);
            return back()->with(['success' => "The CaseFile was created succesfully."]);
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
     * @param CaseFile $caseFile
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function show(Request $request, CaseFile $caseFile)
    {
        try {
            $this->authorize('view', $caseFile);
            //Fetch relationships
            $caseFile->load([

                'clientBranch',
                'client',
                'creator',
                'customer',
                'debtCategory',
                'debtType',
                'officer',
                'priority',
                'productType',
                'status',

            ]);
            $caseFile->append('loan_balance',"paid_amount");
            return Inertia::render("CaseFiles/Show", ["model" => $caseFile]);
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
     * @param CaseFile $caseFile
     * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, CaseFile $caseFile)
    {
        try {
            $this->authorize('update', $caseFile);
            //Fetch relationships
            $caseFile->load([
                'clientBranch',
                'client',
                'creator',
                'customer',
                'debtCategory',
                'debtType',
                'officer',
                'priority',
                'productType',
                'status',
            ]);
            return Inertia::render("CaseFiles/Edit", ["model" => $caseFile]);
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
     * @param UpdateCaseFile $request
     * @param {$modelBaseName} $caseFile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCaseFile $request, CaseFile $caseFile)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($caseFile)->update($data);
            return back()->with(['success' => "The CaseFile was updated succesfully."]);
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
     * @param CaseFile $caseFile
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DestroyCaseFile $request, CaseFile $caseFile)
    {
        $res = $this->repo::init($caseFile)->destroy();
        if ($res) {
            return back()->with(['success' => "The CaseFile was deleted succesfully."]);
        } else {
            return back()->with(['error' => "The CaseFile could not be deleted."]);
        }
    }
    public function downloadImportTemplate(Request $request) {
        return \Excel::download(new CaseFileTemplateExport,"CASE_FILE_IMPORT_TEMPLATE.xlsx",Excel::XLSX);
    }
    public function import(Request $request) {
        try {
            $validated = $request->validate([
                "officer" => ["required", "array"],
                "import_file" =>["required","file", "mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel"]
            ]);
            $officer = User::findOrFail($validated["officer"]["id"]);
            \Excel::import(new MultiSheetCaseFileImport($officer,\Auth::id()),$request->file("import_file"));
            return back()->with(["success" => "Import Successful"]);
        } catch (\Throwable $exception) {
            \Log::error($exception);
            return back()->with(["error" => $exception->getMessage()]);
        }
    }
}
