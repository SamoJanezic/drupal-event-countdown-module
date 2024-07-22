<?php

namespace Drupal\event_countdown\Service;

use Drupal\Core\Datetime\DrupalDateTime;

class EventCountdownTime {


    public function getDaysLeft($eventStartDate) {
        $date_time = new DrupalDateTime($eventStartDate, new \DateTimeZone('UTC'));
        $timestamp = $date_time->getTimestamp();
        $startDate = date("Y-m-d", $timestamp);
        $currentDate = date("Y/m/d");
        $remainingDays = strtotime($startDate) - strtotime($currentDate);
        return floor((($remainingDays/24)/60)/60);
    }
}