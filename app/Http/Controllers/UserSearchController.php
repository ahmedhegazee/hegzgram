<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class UserSearchController extends Controller
{
    public function index(Request $request)
    {
        $results = (new Search())
            ->registerModel(User::class, ['username'])
            ->search($request->input('query'));

        return response()->json($results);
    }
}
