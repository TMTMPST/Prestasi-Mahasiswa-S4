<?php

namespace App\Http\Controllers;

use App\Models\Bimbingan;
use App\Models\DataLomba;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
    {
        // Fetch upcoming competitions (those that are still open)
        $upcomingCompetitions = DataLomba::where('tgl_ditutup', '>=', now())
            ->orderBy('tgl_dibuka')
            ->take(6)
            ->get();
            
        // Fetch recent bimbingan requests
        $recentBimbingan = Bimbingan::latest()->take(3)->get();
        
        // Compute statistics
        $stats = [
            'totalCompetitions' => DataLomba::count(),
            'nationalCompetitions' => DataLomba::where('tingkat', 3)->count(),
            'internationalCompetitions' => DataLomba::where('tingkat', 4)->count(),
            'pendingRequests' => Bimbingan::where('status', 'Pending')->count(),
            'acceptedRequests' => Bimbingan::where('status', 'Accepted')->count(),
        ];
        
        // Competitions by category (jenis)
        $categoryCounts = DataLomba::select('jenis', DB::raw('count(*) as count'))
            ->groupBy('jenis')
            ->get();
            
        return view('welcome', compact(
            'upcomingCompetitions',
            'recentBimbingan',
            'stats',
            'categoryCounts'
        ));
    }
}
