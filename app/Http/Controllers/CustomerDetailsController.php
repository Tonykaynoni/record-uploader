<?php

namespace App\Http\Controllers;

use App\Jobs\UploadCustomersDetailsProcess;

//

class CustomerDetailsController extends Controller
{
    //Upload Data using UI
    public function index()
    {
        return view('upload-file');

    }

    public function upload()
    {
        $data = json_decode(file(request()->myJsonRecord)[0], true);

        //Chunking file
        $chunk = array_chunk($data, 100);
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
        // Read chucked file from directory
        $path = resource_path('temp');
        $files = glob("$path/*.json");

        // Dispatch each file date to queue
        foreach ($files as $file) {

            $data = json_decode(file($file)[0], true);
            UploadCustomersDetailsProcess::dispatch($data);
            unlink($file);
        }

        return "Stored";
    }
}
