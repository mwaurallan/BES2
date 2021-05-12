<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\CasePayment\IndexCasePayment;
use App\Http\Requests\CasePayment\StoreCasePayment;
use App\Http\Requests\CasePayment\UpdateCasePayment;
use App\Http\Requests\CasePayment\DestroyCasePayment;
use App\Models\CasePayment;
use App\Repositories\CasePayments;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Yajra\DataTables\Html\Column;

class CasePaymentController  extends Controller
{
    private CasePayments $repo;
    public function __construct(CasePayments $repo)
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
        $this->authorize('viewAny', CasePayment::class);
        return Inertia::render('CasePayments/Index',[
            "can" => [
                "viewAny" => \Auth::user()->can('viewAny', CasePayment::class),
                "create" => \Auth::user()->can('create', CasePayment::class),
            ],
            "columns" => $this->repo::dtColumns(),
        ]);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return  \Inertia\Response
    */
    public function create()
    {
        $this->authorize('create', CasePayment::class);
        return Inertia::render("CasePayments/Create",[
            "can" => [
            "viewAny" => \Auth::user()->can('viewAny', CasePayment::class),
            "create" => \Auth::user()->can('create', CasePayment::class),
            ]
        ]);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param StoreCasePayment $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function store(StoreCasePayment $request)
    {
        try {
            $data = $request->sanitizedObject();
            $casePayment = $this->repo::store($data);
            return back()->with(['success' => "The Case Payment was created succesfully."]);
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
    * @param CasePayment $casePayment
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function show(Request $request, CasePayment $casePayment)
    {
        try {
            $this->authorize('view', $casePayment);
            //Fetch relationships
            



        $casePayment->load([
            'caseFile',
            'creator',
            'paymentMode',
        ]);
                        return Inertia::render("CasePayments/Show", ["model" => $casePayment]);
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
    * @param CasePayment $casePayment
    * @return \Inertia\Response|\Illuminate\Http\RedirectResponse
    */
    public function edit(Request $request, CasePayment $casePayment)
    {
        try {
            $this->authorize('update', $casePayment);
            //Fetch relationships
            



        $casePayment->load([
            'caseFile',
            'creator',
            'paymentMode',
        ]);
                        return Inertia::render("CasePayments/Edit", ["model" => $casePayment]);
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
    * @param UpdateCasePayment $request
    * @param {$modelBaseName} $casePayment
    * @return \Illuminate\Http\RedirectResponse
    */
    public function update(UpdateCasePayment $request, CasePayment $casePayment)
    {
        try {
            $data = $request->sanitizedObject();
            $res = $this->repo::init($casePayment)->update($data);
            return back()->with(['success' => "The CasePayment was updated succesfully."]);
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
    * @param CasePayment $casePayment
    * @return \Illuminate\Http\RedirectResponse
    */
    public function destroy(DestroyCasePayment $request, CasePayment $casePayment)
    {
        $res = $this->repo::init($casePayment)->destroy();
        if ($res) {
            return back()->with(['success' => "The CasePayment was deleted succesfully."]);
        }
        else {
            return back()->with(['error' => "The CasePayment could not be deleted."]);
        }
    }
}
