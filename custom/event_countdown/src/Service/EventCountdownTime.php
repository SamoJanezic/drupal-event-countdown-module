<?php

namespace Drupal\event_countdown\Service;

use Drupal\Core\Datetime\DrupalDateTime;

class EventCountdownTime {

    private function getDrupalDate($date) {
        $date_time = new DrupalDateTime($date, new \DateTimeZone('UTC'));
        return $date_time->getTimestamp();
    }
    public function getDaysLeft($eventStartDate) {
        $timestamp = $this->getDrupalDate($eventStartDate);
        $startDate = new \DateTime(date("Y-m-d", $timestamp));
        $currentDate = new \DateTime(date("Y-m-d"));
        $remainingDays = date_diff($currentDate, $startDate);
        return $remainingDays->format("%r%a");
    }

    public function getHoursLeft($eventStartDate) {
        $timestamp = $this->getDrupalDate($eventStartDate);
        $startTime = date("H", $timestamp);
        $currentTime = date("H");
        $remainingTime = $startTime - $currentTime;
        return $remainingTime;
    }
}