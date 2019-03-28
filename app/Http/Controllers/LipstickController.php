<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LipstickColor;

class LipstickController extends Controller
{
    public function getAll() {
        return LipstickColor::all();
    }

    public function getLipstickById($id) {
        return LipstickColor::find($id);
    }
}
