<?php

namespace App\Http\Controllers;

use App\HomeSection;
use App\Http\Resources\HomeSectionResource;
use Illuminate\Http\Request;

class HomeSectionController extends Controller
{
    public function getHomeSection()
    {
        return view("admin.home_sections.home_sections");
    }

    public function index()
    {
        return HomeSectionResource::collection(HomeSection::where("status", 1)->orderBy("name")->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            "name" => "required"
        ]);
        if ($request['discount'] && $request['discount'] == true) {
            $request['discount_time'] = $request['discount_end_date'] . " " . $request['discount_end_time'];
        }
        unset($request['discount_end_date']);
        unset($request['discount_end_time']);
        return new HomeSectionResource(HomeSection::create($request->all()));
    }

    public function update(Request $request, HomeSection $homeSection)
    {
        $request->validate([
            "name" => "required"
        ]);
        if ($request['discount'] && $request['discount'] == true) {
            $request['discount_time'] = $request['discount_end_date'] . " " . $request['discount_end_time'];
        }
        unset($request['discount_end_date']);
        unset($request['discount_end_time']);

        $homeSection->update($request->all());
        return new HomeSectionResource($homeSection);
    }

    public function destroy(HomeSection $homeSection)
    {

        $homeSection->update(["status" => 0]);
    }

}
