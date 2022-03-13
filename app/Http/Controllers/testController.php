<?php

namespace App\Http\Controllers;

use App\Models\Emps;
use App\Models\User;
use App\Traits\CSVExporter;
use App\Traits\CSVReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class testController extends Controller
{
    use CSVExporter, CSVReader;
    public function index(Request $request){
//        $emps=DB::table('emps')->where('id',3)->first();
//        $array_test = [];
//        $array_test[]=$emps;
//        while ($emps->m_id){
//            $emps=DB::table('emps')->where('id',$emps->m_id)->first();
//            $array_test[] = $emps;
//        }
//        return $array_test;

        return $emp_hirarchy=Emps::find(4)->parent()->get();
        $data=DB::table('users')->get();
//        return $this->export_array_data_to_csv($data, array_keys(get_object_vars($data[0])), 'file');
    }
}
