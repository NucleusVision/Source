<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Investor;
use App\Models\Entries;

class IndexController extends Controller
{
    //
    public function index() {
        return view('admin.dashboard')->with('iInvestors', Investor::get()->count())->with('iEntries', Entries::get()->count());
    }
}
