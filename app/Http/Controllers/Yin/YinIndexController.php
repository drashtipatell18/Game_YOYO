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
    public function yinSearch()
    {
        return view('gx_ai.Search');
    }
    public function CareerGuide()
    {
        return view('gx_ai.Career_guide');
    }
    public function yinUpgrade()
    {
        return view('gx_ai.Upgrad');
    }
    public function ChessChamp()
    {
        return view('gx_ai.Chess_champ');
    }

    public function Brainstormer()
    {
        return view('gx_ai.Brainstormer');
    }
    public function yinLogin()
    {
        return view('gx_ai.Login');
    }
    public function yinSignUp()
    {
        return view('gx_ai.SignUp');
    }

    public function CodingPartner()
    {
        return view('gx_ai.Coding_partner');
    }
    public function writingEditor()
    {
        return view('gx_ai.Writing_editor');
    }
}
