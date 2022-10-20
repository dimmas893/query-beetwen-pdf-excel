<?php

namespace App\Http\Controllers;

use App\Exports\BeetwenImport;
use App\Models\Beetwen;
// use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportUser;
use App\Imports\BeetwenImportaku;
use App\Imports\UsersImport;
use PDF;
use Excel;
use Illuminate\Http\Request;
// use PDF;

class BeetwenController extends Controller
{
    public function index(Request $request)
    {
        $beetwen = Beetwen::whereBetween('tanggal', [$request->awal, $request->akhir])->get();
        return response()->json([
            'data' => $beetwen
        ]);
    }

    public function wherebulantahun(Request $request)
    {
        if (empty($request->year) && empty($request->month)) {
            $tahunbulan = Beetwen::whereYear('tanggal', '=', \Carbon\Carbon::now()->format('Y'))->whereMonth('tanggal', '=', \Carbon\Carbon::now()->format('m'))->get();
            return response()->json([
                'total' => $tahunbulan->count(),
                'data' => $tahunbulan
            ]);
        }

        if(empty($request->month)){
            if($request->year){
                $tahunbulan = Beetwen::whereYear('tanggal', '=', $request->year)->get();
                return response()->json([
                    'total' => $tahunbulan->count(),
                    'data' => $tahunbulan
                ]);
            }
        }
        
        if(empty($request->year)){
            $tahunbulan = Beetwen::whereMonth('tanggal', '=', $request->month)->get();
            return response()->json([
                'total' => $tahunbulan->count(),
                'data' => $tahunbulan
            ]);
        }


        if ($request->year && $request->month) {
            $tahunbulan = Beetwen::whereYear('tanggal', '=', $request->year)->whereMonth('tanggal', '=', $request->month)->get();
            return response()->json([
                'total' => $tahunbulan->count(),
                'data' => $tahunbulan
            ]);
        }
    }

    public function pdf(Request $request)
    {

        if ($request->awal && $request->akhir) {
            $tahunbulan = Beetwen::whereBetween('tanggal', [$request->awal, $request->akhir])->get();
            $pdf = PDF::loadview('Beetwen', compact('tahunbulan'));
            return $pdf->download('laporan-pegawai-pdf');
        }

        if (empty($request->year) && empty($request->month)) {
            $tahunbulan = Beetwen::whereYear('tanggal', '=', \Carbon\Carbon::now()->format('Y'))->whereMonth('tanggal', '=', \Carbon\Carbon::now()->format('m'))->get();
            $pdf = PDF::loadview('Beetwen', compact('tahunbulan'));
            return $pdf->download('laporan-pegawai-pdf');
        }

        if (empty($request->month)) {
            if ($request->year) {
                $tahunbulan = Beetwen::whereYear('tanggal', '=', $request->year)->get();
                $pdf = PDF::loadview('Beetwen', compact('tahunbulan'));
                return $pdf->download('laporan-pegawai-pdf');
            }
        }

        if (empty($request->year)) {
            $tahunbulan = Beetwen::whereMonth('tanggal', '=', $request->month)->get();
            $pdf = PDF::loadview('Beetwen', compact('tahunbulan'));
            return $pdf->download('laporan-pegawai-pdf');
        }


        if ($request->year && $request->month) {
            $tahunbulan = Beetwen::whereYear('tanggal', '=', $request->year)->whereMonth('tanggal', '=', $request->month)->get();
            $pdf = PDF::loadview('Beetwen', compact('tahunbulan'));
            return $pdf->download('laporan-pegawai-pdf');
        }
    }

    public function excelexport()
    {
        return Excel::download(new BeetwenImport, 'beetwen.xlsx',);
        // return (new BeetwenImport)->download('beetwen.csv', Excel::CSV, [
        //     'Content-Type' => 'text/csv',
        // ]);
    }

    public function excelimport(Request $request)
    {
        // Excel::import(new BeetwenImport, request()->file('file'));
        // Excel::import(new BeetwenImport, 'a.xlsx');

        // dd($request->file);
        Excel::import(new BeetwenImportaku, $request->file);

        return back();
    }
}
