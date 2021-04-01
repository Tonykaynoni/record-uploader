<?php

namespace App\Http\Controllers;

use App\Jobs\UploadCustomersDetailsProcess;
use Carbon\Carbon;
use Throwable;

//

class CustomerDetailsController extends Controller
{
    //
    public function index()
    {
        return view('upload-file');

    }

    public function checkDate()
    {
        $age = 0;

        try {
            $date = date_create("1955-12-05 00:00:00");
            $newDate = date_format($date, "Y/d/m H:i:s");
            // $newDate = $date->format("Y/d/m");

            $date1 = Carbon::parse('now');
            $date2 = Carbon::createMidnightDate(Carbon::parse($newDate)->toDateTimeString());
            $age = $date1->diffInYears($date2);
        } catch (Throwable $e) {
            return $age;
        }

        return $age;
    }
    public function dateFormat()
    {
        $date_format['d.m.Y'] = 'd.m.Y';
        $date_format['d.m.y'] = 'd.m.y';
        $date_format['d-m-Y'] = 'd-m-Y';
        $date_format['d-m-y'] = 'd-m-y';
        $date_format['d/m/Y'] = 'd/m/Y';
        $date_format['d/m/y'] = 'd/m/y';

        return $date_format;
    }

    public function upload()
    {
        $data = json_decode(file(request()->myJsonRecord)[0], true);
        // $data = file(request()->myJsonRecord)[0];
        //Chunking file

        $chunk = array_chunk($data, 100);
        // dd($chunk);
        $uniqueKey = 0;
        foreach ($chunk as $key => $value) {

            $name = "/tmp{$uniqueKey}.json";
            $path = resource_path('temp');
            file_put_contents($path . $name, json_encode($value));
            $uniqueKey++;
        }

        return "File Uploaded";

    }

    public function storeData()
    {

        $path = resource_path('temp');
        $files = glob("$path/*.json");

        foreach ($files as $file) {
            $data = json_decode(file($file)[0], true);
            UploadCustomersDetailsProcess::dispatch($data);
            unlink($file);
        }

        return "Stored";
    }
}
