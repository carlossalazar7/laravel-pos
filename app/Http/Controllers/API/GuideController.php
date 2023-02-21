<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::all();
        $tabName = '';
        $routeName = '';
        if (isset($_GET['tab_name'])) {
            $tabName = $_GET['tab_name'];
        }
        if (isset($_GET['route_name'])) {
            $routeName = $_GET['route_name'];
        }
        return view('guides.GuidesIndex', ['tab_name' => $tabName, 'route_name' => $routeName]);
    }

    public function guide()
    {
        $tabName = '';
        $routeName = '';
        if (isset($_GET['tab_name'])) {
            $tabName = $_GET['tab_name'];
        }
        if (isset($_GET['route_name'])) {
            $routeName = $_GET['route_name'];
        }
        return view('guides.Guides', ['tab_name' => $tabName, 'route_name' => $routeName]);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
