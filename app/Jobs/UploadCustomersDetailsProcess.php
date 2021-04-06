<?php

namespace App\Jobs;

use App\Models\CustomersRecord;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class UploadCustomersDetailsProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        foreach ($this->data as $info) {

            $age = 0;
            try {
                $date = date_create($info['date_of_birth']);
                $newDate = date_format($date, "Y/m/d H:i:s");

                $date1 = Carbon::parse('now');
                $date2 = Carbon::createMidnightDate(Carbon::parse($newDate)->toDateTimeString());
                $age = $date1->diffInYears($date2);

            } catch (Throwable $e) {
                // return $age;
            }

            if ($this->filterData($age)) {
                if (!CustomersRecord::find(($info['name']))) {

                    CustomersRecord::create($info);

                }
            }

        }

    }

    public function filterData($age)
    {
        $clean = false;
        if ($age >= 18 && $age <= 65) {
            $clean = true;
        }
        return $clean;

    }
}
