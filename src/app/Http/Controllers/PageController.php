<?php

namespace App\Http\Controllers;

use App\Repositories\CsvExaminerRepository;

class PageController extends Controller
{
    public function __construct(
        private CsvExaminerRepository $csvExaminerRepository
    )
    {
    }

    public function home()
    {
        return view('home');
    }

    public function details()
    {
        return view('details');
    }
}
