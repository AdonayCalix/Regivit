<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PruebaExcel extends Controller
{
    public function doExcel()
    {
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('excel/SolicitudEmpleo.xlsx'));

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A14', 'Veamos si se cambia');
        $sheet->setCellValue('D14', 'Veamos si se cambia');

        $writer = new Xlsx($spreadsheet);
        $writer->save(public_path('excel/moose_mejorado.xlsx'));
   }
}
