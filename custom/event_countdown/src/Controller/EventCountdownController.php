<?php

namespace Drupal\event_countdown\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DrupalDateTime;

class EventCountdownController extends ControllerBase {

    //premik ure konec MARCA in konec OKTOBRA
    public $startDate;
    public $startTime;
    public $daysLeft;


    public function getStartDate() {
        /** @var Drupal\Core\Datetime\DateFormatterInterface $date_formatter */
        $date_formatter = \Drupal::service('date.formatter');
        $node = \Drupal::routeMatch()->getParameter('node');
        $date_value = $node->field_date->value;
        $date_time = new DrupalDateTime($date_value, new \DateTimeZone('UTC'));
        $timestamp = $date_time->getTimestamp();

        $date = date("Y-m-d_H:i:s", $timestamp);
        var_dump($date);

        $dateSplit = explode('_', $date);
        $this->startDate = $dateSplit[0];
        $this->startTime = $dateSplit[1];
    }

    public function getDaysLeft() {
        $currentDate = date("Y/m/d");
        $currentTime = date("H");
        $remainingDays = strtotime($this->startDate) - strtotime($currentDate);
        $this->daysLeft = floor((($remainingDays/24)/60)/60);
    }

    public function setMessage() {
        $this->getDaysLeft();

        if ($this->daysLeft < 0) {
            return "This event already passed";
        }

        if ($this->daysLeft == 0) {
            return "This event is happening today";
        }

        if ($this->daysLeft == 1) {
            return "{$this->daysLeft} day left until event starts";
        }

        return "{$this->daysLeft} days left until event starts";
    }
}