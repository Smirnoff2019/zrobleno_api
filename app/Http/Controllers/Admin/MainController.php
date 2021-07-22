<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category\Category;
use App\Models\Taxonomy\PortfolioCategoryTaxonomy;

class MainController extends Controller
{

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @method GET
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('admin.home');
    }

}

