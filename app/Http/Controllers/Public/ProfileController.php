<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  public function index($tab = 'semua')
  {
    $user = Auth::user();

    if (request()->ajax()) {
      return view('public.profile.tabs.' . $tab, compact('user'));
    }

    return view('public.profile.index', [
      'tab' => $tab,
      'user' => $user
    ]);
  }

}
