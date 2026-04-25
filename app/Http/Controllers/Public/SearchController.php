<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
  public function users(Request $request)
  {
    $search = $request->q;

    $users = User::query()->where('id', '!=', Auth::id())->when($search, function($query) use ($search) {
      $query->where(function ($q) use ($search){
        $q->where('first_name', 'ilike', '%' . $search . '%')
          ->orWhere('last_name', 'ilike', '%' . $search . '%');
      });
    })->limit(5)->get(['id', 'first_name', 'last_name']);

    return response()->json($users);
  }
}
