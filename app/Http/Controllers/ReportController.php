<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use DB;

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
        return view('admin/reports/report');
          //custom message if this methods throw an exception
		\Session::put('errorOrigin', " actualizando el estado");	

		//custom route to REDIRECT redirect('x') if there's an error
        \Session::put('errorRoute', "states");
          $clients=\DB::table('clients')
          ->select(['id', 'type', 'name', 'address', 'identification', 'active_flag'])
          ->get();
          $pdf = \App::make('dompdf.wrapper');
          $pdf->loadHTML(view('admin/reports/report', compact('clients'))->render()); 
          return $pdf->stream('informe'.'.pdf');
          //return view('admin/reports/report');
      }

      /**
       * This method generate an specific order report
       */
      public function selectOrder($id)
      {
            //custom message if this methods throw an exception
		\Session::put('errorOrigin', " actualizando el estado");	

		//custom route to REDIRECT redirect('x') if there's an error
        \Session::put('errorRoute', "states");
        DB::beginTransaction();//starts database transaction. If there´s no commit no transaction
            //will be made. Also, all transactions can be rollbacked.
            $newOrder= new Order();
            $order=$newOrder->model->find($id);
            return $order;
            return $pdf->stream('informe'.'.pdf');
      }
}
