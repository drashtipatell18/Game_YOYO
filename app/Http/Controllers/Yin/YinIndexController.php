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
    public function yinPublicLink()
    {
        return view('gx_ai.Public_Links');
    }
    public function yinExploreGem()
    {
        return view('gx_ai.Explore_Gem');
    }
    public function yinNewGem()
    {
        return view('gx_ai.NewGem');
    }
}
