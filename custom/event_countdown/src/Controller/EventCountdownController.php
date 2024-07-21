<?php

namespace Drupal\event_countdown\Controller;

use Drupal\Core\Controller\ControllerBase;

class EventCountdownController extends ControllerBase {

    public $eventStartDate;
    public $eventStartTime;
    public $daysLeft;


    public function geteventStartDate() {
        $node = \Drupal::routeMatch()->getParameter('node');
        $value = $node->field_date[0]->value;
        $timestamp = strtotime($value);
        if(date('I', $timestamp)) {
            $timestamp += 7200;
        } else {
            $timestamp += 3600;
        }
        $date = date("Y-m-d_H:i:s", $timestamp);

        $dateSplit = explode('_', $date);
        $this->eventStartDate = $dateSplit[0];
        $this->eventStartTime = $dateSplit[1];
    }

    public function getDaysLeft() {
        $currentDate = date("Y/m/d");
        $currentTime = date("H");
        $remainingDays = strtotime($this->eventStartDate) - strtotime($currentDate);
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