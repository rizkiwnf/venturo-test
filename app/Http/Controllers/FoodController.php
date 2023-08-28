<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    // public function index(Request $request)
    // {
    //     echo "get";
    //     return view('pages.first_page', [
    //         'year' => $request->year,
    //     ]);
    // }
    public function getYear(Request $request)
    {
        if ($request->year != "") {
            $response_transaksi = Http::get('http://tes-web.landa.id/intermediate/transaksi?tahun=' . $request->year)->json();
            $response_menu = Http::get('https://tes-web.landa.id/intermediate/menu')->json();
            $months = ["01","02","03","04","05","06","07","08","09","10","11","12"];
            

            // dd($response_menu);
            return view('pages.tahunpertama', [
                'months' => $months,
                'menus' => $response_menu,
                'transaksis' => $response_transaksi,
                'year' => $request->year
            ]);
        } else {
            return view('pages.first_page', [
                'year' => $request->year,
            ]);
        }
    }
    // public function getYear(Request $request)
    // {
    //     if($request->year != ""){
    //     echo "post";

    //         $response = Http::get('http://tes-web.landa.id/intermediate/transaksi?tahun=' . $request->year)->json();
    //         $groupedData = collect($response)->groupBy('menu');
    //         $menuVarieties = $groupedData->keys();
    //         // dd($menuVarieties);
    //         return view('pages.tahunpertama', [
    //             'transaksis' => $response,
    //             'year' => $request->year
    //         ]);
    //     }else{
    //         return view('pages.first_page', [
    //             'year' => $request->year,
    //         ]);
    //     }
    // }

    public function getMenu()
    {
        $response = Http::get('https://tes-web.landa.id/intermediate/menu')->json();
        return $response;
    }

    public function getTransaksi($year)
    {
        // $month = []
        $response = Http::get('https://tes-web.landa.id/intermediate/transaksi?tahun=' . $year)->json();
        return $response;
    }

    public function downloadFile($namaFile)
    {
        if (Storage::disk('public')->exists("$namaFile")) {
            $path = Storage::disk('public')->path("$namaFile");
            // $content = file_get_contents($path);
            // return response($content)->withHeaders([
            //     'Content-Type'=>mime_content_type($path)
            // ]);
            return response()->download($path);
        }
        return redirect('/404');
    }

    public function getData(Request $request)
    {
        if ($request->year == '2021') {
            $response = Http::get('http://tes-web.landa.id/intermediate/transaksi?tahun=2021');
        } else {
            $response = Http::get('http://tes-web.landa.id/intermediate/transaksi?tahun=2022');
        }

        if ($response->successful()) {
            $data = $response->json(); // Mengubah respons JSON menjadi array/objek
            return view('pages.show_data', ['data' => $data]);
        } else {
            return "Gagal mengambil data dari API.";
        }
    }
}
