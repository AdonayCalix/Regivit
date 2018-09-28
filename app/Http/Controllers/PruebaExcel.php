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
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
/*
//load spreadsheet
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(public_path('Excel/SolicitudEmpleo.xlsx'));

//change it
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A14', 'Veamos si se cambia');
        $sheet->setCellValue('D14', 'Veamos si se cambia');

//write it again to Filesystem with the same name (=replace)
        $writer = new Xlsx($spreadsheet);
        $writer->save(public_path('Excel/moose_mejorado.xlsx'));*/
   }
}
