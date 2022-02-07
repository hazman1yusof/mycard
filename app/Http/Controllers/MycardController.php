<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use stdClass;
use DB;
use File;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Storage;
use Image;

class MycardController extends Controller
{   

    public function __construct()
    {

    }

    public function get_data(Request $request)
    {   


        exec(storage_path('app\mykad\mykad.exe'), $output, $retval);
        
        if(!empty($output)){

            $array_mycard = explode("|", $output[0]);

            if($array_mycard[0] == 'Smart card reader fail to connect.'){
                $responce = new stdClass();
                $responce->status = 'failed';
                $responce->reason = 'Smart card reader fail to connect.';
                return json_encode($responce);
            }

            $responce = new stdClass();
            $responce->status = 'success';
            $responce->ic = $array_mycard[0];
            $responce->dob = $array_mycard[1];
            $responce->birthplace = $array_mycard[2];
            $responce->name = $array_mycard[3];
            $responce->oldic = $array_mycard[4];
            $responce->religion = $array_mycard[5];
            $responce->sex = $array_mycard[6];
            $responce->race = $array_mycard[7];
            $responce->addr1 = $array_mycard[8];
            $responce->addr2 = $array_mycard[9];
            $responce->addr3 = $array_mycard[10];
            $responce->postcode = $array_mycard[11];
            $responce->city = $array_mycard[12];
            $responce->state = $array_mycard[13];
            $responce->photo = $array_mycard[14];
            return json_encode($responce);


        }else{
            $responce = new stdClass();
            $responce->status = 'failed';
            $responce->reason = 'Other';
            return json_encode($responce);
        }

        // dd(storage_path('app\mykad32bit\mykad.exe'));
        // $process = new Process('C:\laragon\www\msoftweb\app\Http\Controllers\util\runbarcode.bat');
    
        // // executes after the command finishes
        // if ($process->isSuccessful()) {

        //     // throw new ProcessFailedException($process);
        //     $contents = File::get(storage_path('app\mykad32bit\mykad.txt'));

        //     $array_mycard = explode("|",$contents);
        //     if(empty($array_mycard[1])){
                
        //         $responce = new stdClass();
        //         $responce->status = 'failed';
        //         $responce->reason = $array_mycard[0];
        //     }else{
                
        //         $responce = new stdClass();
        //         $responce->status = 'success';
        //         $responce->ic = $array_mycard[0];
        //         $responce->dob = $array_mycard[1];
        //         $responce->birthplace = $array_mycard[2];
        //         $responce->name = $array_mycard[3];
        //         $responce->oldic = $array_mycard[4];
        //         $responce->religion = $array_mycard[5];
        //         $responce->sex = $array_mycard[6];
        //         $responce->race = $array_mycard[7];
        //         $responce->addr1 = $array_mycard[8];
        //         $responce->addr2 = $array_mycard[9];
        //         $responce->addr3 = $array_mycard[10];
        //         $responce->postcode = $array_mycard[11];
        //         $responce->city = $array_mycard[12];
        //         $responce->state = $array_mycard[13];

        //         $img = Image::make(storage_path('app\mykad32bit\myphotov1.jpg'));

        //         // $file = File::get(storage_path('app\mykad32bit\myphotov1.jpg'));
        //         // dd((string) $img->encode('data-url'));
        //         $responce->mykad_photo = (string) $img->encode('data-url');
        //     }
        // }else{

        //     // throw new ProcessFailedException($process);
        //     $responce = new stdClass();
        //     $responce->status = 'failed';
        //     $responce->reason = 'Other';
        // }

        // return json_encode($responce);
    }

}