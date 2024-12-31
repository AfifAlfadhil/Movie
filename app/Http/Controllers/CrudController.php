<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Crud;

class CrudController extends Controller
{
    public function index()
    {
        $shows = DB::table('shows')->paginate(10); // Ambil data dari tabel
        return view('tabel.index', compact('shows')); // Kirim ke view
    }

    public function create()
    {
        return view('tabel.create'); // Form tambah data
    }

    public function store(Request $request)
    {
        DB::table('shows')->insert([
            'show_id' => $request->show_id,
            'primary_title' => $request->primary_title,
            'adult' => $request->adult,
            'episode_run_time' => $request->episode_run_time,
        ]);

        return redirect()->route('tabel.index')->with('success', 'Show created successfully!');
    }

    public function edit($id)
    {
        $show = DB::table('shows')->where('show_id', $id)->first();
        return view('tabel.edit', compact('show'));
    }

    public function update(Request $request, $id)
    {
        DB::table('shows')->where('show_id', $id)->update([
            'primary_title' => $request->primary_title,
            'adult' => $request->adult,
            'episode_run_time' => $request->episode_run_time,
        ]);

        return redirect()->route('tabel.index')->with('success', 'Show updated successfully!');
    }

    public function destroy($id)
    {
        DB::table('shows')->where('show_id', $id)->delete();
        return redirect()->route('tabel.index')->with('success', 'Show deleted successfully!');
    }
}
