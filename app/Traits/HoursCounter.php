<?php

namespace App\Traits;

trait HoursCounter
{
    public function CountHours($data){
        $origin = date_create(date("Y-m-d"));
        $target = date_create($data['date']);

        $interval = date_diff($origin, $target);

        $hours = substr($data['time'], 0, 2);

        return $interval->format("%a") * 24 + (int)$hours;
    }
}
