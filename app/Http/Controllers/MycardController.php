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

    public function show(Request $request)
    {

        return view('mykadfp');
 
    }

    public function read_mykad(Request $request)
    {   

        exec(storage_path('app\mykad\mykad.exe'), $output, $retval);
        
        if(!empty($output)){

            $array_mycard = explode("|", $output[0]);

            // $this->save_to_file_mykad($request->path,$array_mycard);

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
            $responce->citizenship = $array_mycard[14];
            $responce->photo = $array_mycard[15];
            return json_encode($responce);


        }else{
            $responce = new stdClass();
            $responce->status = 'failed';
            $responce->reason = 'Other';
            return json_encode($responce);
        }
    }

    public function read_mykid(Request $request)
    {   


        exec(storage_path('app\mykid\mykid.exe'), $output, $retval);
        
        if(!empty($output)){

            $array_mycard = explode("|", $output[0]);

            // $this->save_to_file_mykid($request->path,$array_mycard);

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
            $responce->religion = $array_mycard[5];
            $responce->sex = $array_mycard[6];
            $responce->race = $array_mycard[7];
            $responce->addr1 = $array_mycard[8];
            $responce->addr2 = $array_mycard[9];
            $responce->addr3 = $array_mycard[10];
            $responce->postcode = $array_mycard[11];
            $responce->city = $array_mycard[12];
            $responce->state = $array_mycard[13];
            return json_encode($responce);


        }else{
            $responce = new stdClass();
            $responce->status = 'failed';
            $responce->reason = 'Other';
            return json_encode($responce);
        }
    }

    public function save_to_file_mykad($path,$array_mycard){
        $myfile = fopen($path."\mykad\mykad.txt", "a") or die("Unable to open file!");
        $text=$array_mycard[0];
        foreach ($array_mycard as $key => $value) {
            if($key<14 && $key>0){
                $text = $text .'|'. $value;
            }
        }
        fwrite($myfile, "\n".$text);
        fclose($myfile);
    }

    public function save_to_file_mykid($path,$array_mycard){
        $myfile = fopen($path."\mykad\mykid.txt", "a") or die("Unable to open file!");
        $text=$array_mycard[0];
        foreach ($array_mycard as $key => $value) {
            if($key>0){
                $text = $text .'|'. $value;
            }
        }
        fwrite($myfile, "\n".$text);
        fclose($myfile);
    }

}