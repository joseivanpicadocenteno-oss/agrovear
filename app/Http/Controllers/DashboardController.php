<?php

namespace App\Http\Controllers;

use App\Models\Farm;
use App\Models\Animal;
use App\Models\Product;
use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $farmsCount = Farm::where('user_id', $userId)->count();

        $animalsCount = Animal::whereHas('farm', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        $productsCount = Product::whereHas('farm', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        $recipesCount = Recipe::whereHas('farm', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->count();

        return view('dashboard.index', compact(
            'farmsCount',
            'animalsCount',
            'productsCount',
            'recipesCount'
        ));
    }
}
