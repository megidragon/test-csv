<?php

namespace App\Http\Controllers;

use App\Models\LiveStatus;
use App\Repositories\CsvExaminerRepository;
use App\Repositories\LiveStatusRepository;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function __construct(
        private CsvExaminerRepository $csvExaminerRepository,
        private LiveStatusRepository $liveStatusRepository
    )
    {
    }

    public function home()
    {
        return view('home');
    }

    public function upload()
    {
        return view('upload');
    }

    public function list()
    {
        $list = $this->liveStatusRepository->getList();
        return view('list', compact('list'));
    }

    public function details($sid)
    {
        $status = $this->liveStatusRepository->getStatus($sid);
        if ($status !== null && $status !== LiveStatus::$FINISHED)
        {
            abort(401);
            return null;
        }

        $data = $this->csvExaminerRepository->getDetails($sid);

        return view('details', compact('data'));
    }

    public function setRole(Request $request)
    {
        session()->put('role', $request->role);

        return redirect()->route('upload');
    }
}
