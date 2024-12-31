<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class ShowController extends Controller
{
    public function daftar()
    {
        $daftar = DB::select("
            SELECT TOP 10 S.[show_id], S.[primary_title], S.[adult], S.[type_name], S.[genres], V.[vote_average]
            FROM [ShowWithGenres] S
            LEFT JOIN [show_vote] V ON S.[show_id] = V.[show_id]
            WHERE V.[vote_count] > 2000000
            ORDER BY V.[vote_average] DESC;
        ");

        // Kirim data ke view
        return view('/home', ['daftar' => $daftar]);
    }

    public function show(Request $request)
    {
        $genres = DB::table('genre_types')->select('genre_name')->get();

        // Filter berdasarkan genre jika ada input
        $selectedGenre = $request->input('genre');
        $showsQuery = DB::table('ShowWithGenres');

        if ($selectedGenre) {
            $showsQuery->whereRaw("genres LIKE ?", ["%{$selectedGenre}%"]);
        }

        $shows = $showsQuery->paginate(10);

        return view('show', [
            'shows' => $shows,
            'genres' => $genres,
            'selectedGenre' => $selectedGenre,
        ]);
    }
    

    public function detail($show_id)
    {
        // Query untuk mendapatkan detail show berdasarkan ID
        $show_detail = DB::table('ShowWithGenres')->where('show_id', $show_id)->first();

        // Jika data tidak ditemukan, tampilkan 404
        if (!$show_detail) {
            abort(404, 'Show not found');
        }

        // Kirim data ke view
        return view('show-detail', ['shows' => $show_detail]);
    }

    public function tabel()
    {
        $shows = DB::table('shows')->paginate(10);

        // Kirim data ke view
        return view('/tabel', ['shows' => $shows]);
    }

    public function jumlahTayangan()
    {
        // Query SQL langsung untuk jumlah tayangan total
        $count = DB::table('shows')->count();

        // Mengambil data genre dan jumlah tayangan berdasarkan genre
        $data = DB::table('shows as S')
            ->join('genres as G', 'G.show_id', '=', 'S.show_id')
            ->join('genre_types as GT', 'GT.genre_type_id', '=', 'G.genre_type_id')
            ->select('GT.genre_name', DB::raw('COUNT(S.show_id) as jml'))
            ->groupBy('GT.genre_name')
            ->get();

        // Menemukan kategori dengan tayangan terbanyak
        $kategoriTerpopuler = DB::table('shows as S')
            ->join('genres as G', 'G.show_id', '=', 'S.show_id')
            ->join('genre_types as GT', 'GT.genre_type_id', '=', 'G.genre_type_id')
            ->select('GT.genre_name', DB::raw('COUNT(S.show_id) as jml'))
            ->groupBy('GT.genre_name')
            ->orderByDesc('jml')
            ->first()
            ->genre_name ?? 'N/A'; // Menampilkan 'N/A' jika tidak ada data

        // Menghitung rata-rata tayangan per kategori
        $rataRataTayangan = DB::table(DB::raw('(
            SELECT GT.genre_name, COUNT(S.show_id) as jml
            FROM shows as S
            JOIN genres as G ON G.show_id = S.show_id
            JOIN genre_types as GT ON GT.genre_type_id = G.genre_type_id
            GROUP BY GT.genre_name
            ) as subquery'))
            ->select(DB::raw('AVG(jml) as avg'))
            ->value('avg') ?? 0;

        $rataRataTayangan = round($rataRataTayangan);

        // Kirim data ke view
        return view('/pro-dashboard', [
            'count' => $count, 
            'data' => $data,
            'kategoriTerpopuler' => $kategoriTerpopuler,
            'rataRataTayangan' => $rataRataTayangan
        ]);
    }

    public function yearcount(){
        // Ambil data kelahiran
        $birth = DB::select('
            SELECT birthYear, COUNT(*) as birth
            FROM crew
            WHERE birthYear > 2000
            GROUP BY birthYear
            ORDER BY birthYear
        ');
    
        // Ambil data kematian
        $death = DB::select('
            SELECT deathYear, COUNT(*) as death
            FROM crew
            WHERE deathYear > 2000
            GROUP BY deathYear
            ORDER BY deathYear
        ');
    
        // Menghitung total kelahiran dan kematian
        $totalBirth = array_sum(array_column($birth, 'birth'));
        $totalDeath = array_sum(array_column($death, 'death'));
    
        // Menghitung rata-rata kelahiran dan kematian per tahun
        $avgBirth = $totalBirth / count($birth);
        $avgDeath = $totalDeath / count($death);
    
        // Menemukan tahun dengan kelahiran dan kematian terbanyak
        $maxBirth = collect($birth)->max('birth');
        $maxDeath = collect($death)->max('death');

        $maxBirthYear = collect($birth)->firstWhere('birth', $maxBirth)->birthYear;
        $maxDeathYear = collect($death)->firstWhere('death', $maxDeath)->deathYear;
    
        return view('/eks-dashboard', [
            'birth' => $birth,
            'death' => $death,
            'totalBirth' => $totalBirth,
            'totalDeath' => $totalDeath,
            'avgBirth' => $avgBirth,
            'avgDeath' => $avgDeath,
            'maxBirthYear' => $maxBirthYear,
            'maxDeathYear' => $maxDeathYear
        ]);
    }
    

}
