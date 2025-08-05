<?php

namespace App\Http\Controllers\Yin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class YinIndexController extends Controller
{
    public function yinIndex()
    {
        return view('gx_ai.index');
    }
    public function yinLearningCoatch()
    {
        return view('gx_ai.Learning_coach');
    }
    public function yinSavedInfo()
    {
        return view('gx_ai.SavedInfo');
    }
}
