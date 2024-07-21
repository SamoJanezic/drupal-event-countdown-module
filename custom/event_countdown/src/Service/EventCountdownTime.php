<?php

namespace Drupal\event_countdown\Service;

use Drupal\Core\Datetime\DrupalDateTime;

class EventCountdownTime {


    public function getDaysLeft($eventStartDate) {
        $date_time = new DrupalDateTime($eventStartDate, new \DateTimeZone('UTC'));
        $timestamp = $date_time->getTimestamp();
        $date = date("Y-m-d_H:i:s", $timestamp);
        $dateSplit = explode('_', $date);
        $startDate = $dateSplit[0];
        $startTime = $dateSplit[1];
        $currentDate = date("Y/m/d");
        // $currentTime = date("H");
        $remainingDays = strtotime($startDate) - strtotime($currentDate);
        return floor((($remainingDays/24)/60)/60);
    }

}