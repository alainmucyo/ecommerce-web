<?php

namespace App\Http\Controllers;

use App\Cell;
use App\District;
use App\Province;
use App\Sector;
use App\Village;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function provinces()
    {
        return Province::get();
    }

    public function districts($province)
    {
        return District::where("province_id", $province)->get();
    }

    public function sectors($district)
    {
        return Sector::where("district_id", $district)->get();
    }

    public function cells($sector)
    {
        return Cell::where("sector_id", $sector)->get();
    }

    public function villages($cell)
    {
        return Village::where("cell_id", $cell)->get();
    }
}
