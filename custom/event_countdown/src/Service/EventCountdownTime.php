<?php

namespace Drupal\event_countdown\Service;

use Drupal\Core\Datetime\DrupalDateTime;

class EventCountdownTime {

    private function getDrupalDate($date) {
        $date_time = new DrupalDateTime($date, new \DateTimeZone('UTC'));
        return $date_time->getTimestamp();
    }
    public function getDaysLeft($eventStartDate) {
        // $date_time = new DrupalDateTime($eventStartDate, new \DateTimeZone('UTC'));
        // $timestamp = $date_time->getTimestamp();
        $timestamp = $this->getDrupalDate($eventStartDate);
        $startDate = date("Y-m-d", $timestamp);
        $currentDate = date("Y-m-d");
        $remainingDays = strtotime($startDate) - strtotime($currentDate);
        return floor((($remainingDays/24)/60)/60);
    }

    public function getHoursLeft($eventStartDate) {
        $timestamp = $this->getDrupalDate($eventStartDate);
        $startTime = date("H", $timestamp);
        $currentTime = date("H");
        $remainingTime = $startTime - $currentTime;
        return $remainingTime;
    }
}