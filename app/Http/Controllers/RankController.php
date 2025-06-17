<?php

namespace App\Http\Controllers;

use App\Models\RankSystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RankController extends Controller
{
    public function index()
    {
        // Fetch all rankig systems from the database
        $ranking = RankSystem::select(
            'Nick',
            DB::raw('SUM(Kills) as total_kills'),
            DB::raw('SUM(Deaths) as total_deaths'),
            DB::raw('SUM(Assists) as total_assists'),
            DB::raw('SUM(Headshots) as total_headshots'),
            DB::raw('SUM(MVP) as total_mvp'),
            DB::raw('SUM("Rounds Won") as total_rounds_won'),
            DB::raw('SUM(Stolen) as total_stolen'),
            DB::raw('SUM(Recupered) as total_recupered'),
            DB::raw('SUM(Captured) as total_captured'),
            DB::raw('SUM(XP) as total_xp')
        )->groupBy('Nick')
            ->orderByRaw('(SUM(Kills) - SUM(Deaths)) DESC')
            ->orderByRaw('SUM(Assists) DESC')
            ->orderByRaw('SUM(Headshots) DESC')
            ->orderByRaw('SUM(MVP) DESC')
            ->orderByRaw('SUM("Rounds Won") DESC')
            ->orderByRaw('SUM(Stolen) DESC')
            ->orderByRaw('SUM(Recupered) DESC')
            ->orderByRaw('SUM(Captured) DESC')
            ->orderByRaw('SUM(XP) DESC')
            ->orderBy('Nick', 'ASC')
            ->get();
        

        return $ranking;
    }

}
