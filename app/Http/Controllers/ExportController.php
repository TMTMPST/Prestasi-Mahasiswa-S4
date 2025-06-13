<?php

namespace App\Http\Controllers;

use App\Models\DataLomba;
use App\Models\Mahasiswa;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function mahasiswa(Request $request)
    {
        // Get the filter parameters from the request (e.g., 'angkatan')
        $angkatan = $request->input('angkatan');

        // Fetch the Mahasiswa data with applied filter
        $mahasiswaQuery = Mahasiswa::query();

        if ($angkatan) {
            // Apply the 'angkatan' filter if provided
            $mahasiswaQuery->where('angkatan', $angkatan);
        }

        // Get the filtered data
        $mahasiswa = $mahasiswaQuery->get();

        // Create a new Spreadsheet instance
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headings for the Excel file
        $sheet->setCellValue('A1', 'Nama');
        $sheet->setCellValue('B1', 'NIM');
        $sheet->setCellValue('C1', 'Level');
        $sheet->setCellValue('D1', 'Angkatan');
        $sheet->setCellValue('E1', 'Program Studi');

        // Add the Mahasiswa data to the sheet
        $row = 2; // Start from row 2, because row 1 is for headings
        foreach ($mahasiswa as $item) {
            $sheet->setCellValue('A' . $row, $item->nama);
            $sheet->setCellValue('B' . $row, $item->nim);
            $sheet->setCellValue('C' . $row, $item->level);
            $sheet->setCellValue('D' . $row, $item->angkatan);
            $sheet->setCellValue('E' . $row, $item->prodi);
            $row++;
        }

        // Create a writer and set headers for file download
        $writer = new Xlsx($spreadsheet);
        $fileName = 'data_mahasiswa.xlsx';

        // Download the file
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }

    public function lomba(Request $request)
    {
        // Get the filter parameters from the request
        // $status = $request->input('status', 'Accepted');

        // Fetch the Lomba data with applied filter (only status)
        $lombaQuery = DataLomba::query();

        // Apply the 'status' filter if provided
        // if ($status) {
        //     $lombaQuery->where('verifikasi', $status);
        // }

        // Fetch filtered data
        $lombas = $lombaQuery->get();

        // Create a new Spreadsheet instance
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headings for the Excel file
        $sheet->setCellValue('A1', 'Nama Lomba');
        $sheet->setCellValue('B1', 'Tingkat');
        $sheet->setCellValue('C1', 'Jenis');
        $sheet->setCellValue('D1', 'Tingkat Penyelenggara');
        $sheet->setCellValue('E1', 'Biaya Pendaftaran');
        $sheet->setCellValue('F1', 'Hadiah');
        $sheet->setCellValue('G1', 'Tanggal Mulai');
        $sheet->setCellValue('H1', 'Tanggal Selesai');
        $sheet->setCellValue('I1', 'Alamat');
        $sheet->setCellValue('J1', 'Link Lomba');

        // Add the Lomba data to the sheet
        $row = 2; // Start from row 2, because row 1 is for headings
        foreach ($lombas as $lomba) {
            $sheet->setCellValue('A' . $row, $lomba->nama_lomba);
            $sheet->setCellValue('B' . $row, $lomba->tingkatRelasi->nama_tingkat ?? 'N/A');
            $sheet->setCellValue('C' . $row, $lomba->jenisRelasi->nama_jenis ?? 'N/A');
            $sheet->setCellValue('D' . $row, $lomba->tingkat_penyelenggara);
            $sheet->setCellValue('E' . $row, $lomba->biaya == 0 ? 'Gratis' : 'Rp' . number_format($lomba->biaya, 0, ',', '.'));
            $sheet->setCellValue('F' . $row, $lomba->hadiah);

            // Format dates safely, now that 'tgl_dibuka' and 'tgl_ditutup' are Carbon instances
            $sheet->setCellValue('G' . $row, $lomba->tgl_dibuka ? $lomba->tgl_dibuka : 'N/A');
            $sheet->setCellValue('H' . $row, $lomba->tgl_ditutup ? $lomba->tgl_ditutup : 'N/A');
            $sheet->setCellValue('I' . $row, $lomba->alamat);
            $sheet->setCellValue('J' . $row, $lomba->link_lomba);
            $row++;
        }

        // Create a writer and set headers for file download
        $writer = new Xlsx($spreadsheet);
        $fileName = 'data_lomba.xlsx';

        // Download the file
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="' . $fileName . '"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }
}
