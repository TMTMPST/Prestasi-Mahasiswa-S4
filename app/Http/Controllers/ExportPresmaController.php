<?php

namespace App\Http\Controllers;

use App\Models\DataPrestasi;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExportPresmaController extends Controller
{
    // Method to export data to Excel
    public function export()
    {
        // Fetch the data (you can add any filtering or sorting here)
        $presmas = DataPrestasi::with('nimMahasiswa', 'dataLomba')->get();
        
        // Create a new spreadsheet instance
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the headings
        $sheet->setCellValue('A1', 'Nama Mahasiswa');
        $sheet->setCellValue('B1', 'Peringkat');
        $sheet->setCellValue('C1', 'Nama Lomba');
        $sheet->setCellValue('D1', 'Sertifikat');
        $sheet->setCellValue('E1', 'Foto Bukti');
        $sheet->setCellValue('F1', 'Foto Poster');
        $sheet->setCellValue('G1', 'Status');

        // Populate data
        $row = 2;
        foreach ($presmas as $presma) {
            $sheet->setCellValue('A' . $row, $presma->nimMahasiswa->nama ?? 'N/A');
            $sheet->setCellValue('B' . $row, $presma->peringkat);
            $sheet->setCellValue('C' . $row, $presma->dataLomba->nama_lomba);
            $sheet->setCellValue('D' . $row, $presma->sertif ? 'Ada' : 'Tidak Ada');
            $sheet->setCellValue('E' . $row, $presma->foto_bukti ? 'Ada' : 'Tidak Ada');
            $sheet->setCellValue('F' . $row, $presma->poster_lomba ? 'Ada' : 'Tidak Ada');
            $sheet->setCellValue('G' . $row, $presma->verifikasi);
            $row++;
        }

        // Write the file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'prestasi_mahasiswa.xlsx';

        // Save the file to the response (this will download the file)
        return response()->stream(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment;filename="prestasi_mahasiswa.xlsx"',
                'Cache-Control' => 'max-age=0',
            ]
        );
    }

    // Method to handle the import
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        // Get the file from the request
        $file = $request->file('excel_file');

        // Load the spreadsheet
        $spreadsheet = IOFactory::load($file);

        // Get the first sheet
        $sheet = $spreadsheet->getActiveSheet();

        // Loop through the rows and insert data into the database
        $rows = $sheet->toArray();
        foreach ($rows as $index => $row) {
            // Skip the header row (index 0)
            if ($index == 0) {
                continue;
            }

            // Insert data into the database
            DataPrestasi::create([
                'nama_mahasiswa' => $row[0],  // Adjust based on column position
                'peringkat' => $row[1],
                'nama_lomba' => $row[2],
                'sertifikat' => $row[3] == 'Ada' ? 1 : 0,
                'foto_bukti' => $row[4] == 'Ada' ? 1 : 0,
                'poster_lomba' => $row[5] == 'Ada' ? 1 : 0,
                'verifikasi' => $row[6],
            ]);
        }

        // Return success message
        return redirect()->back()->with('success', 'Data imported successfully.');
    }
}
