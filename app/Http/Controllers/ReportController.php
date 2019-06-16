<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    
/**
     * This class is used to create system reports.
     * 
     */


     /**
      * This method is the construct of the class
      */
      public function _construct()
      {
          $this->middleware('guest');
      }
  
      /**
       * This method generate the report
       */
      public function generate()
      {
          $clients=\DB::table('clients')
          ->select(['id', 'type', 'name', 'address', 'identification', 'active_flag'])
          ->get();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML(view('admin/reports/report', compact('clients'))->render());
          return $pdf->stream('informe'.'.pdf');
          //return view('admin/reports/report');
      }
}
