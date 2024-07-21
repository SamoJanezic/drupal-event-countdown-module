<?php

namespace Drupal\event_countdown\Controller;

use Drupal\Core\Controller\ControllerBase;

class EventCountdownController extends ControllerBase {

    //premik ure konec MARCA in konec OKTOBRA
    // public $currentDate = date("Y-m-d");
    public $startDate;
    public $startTime;
    public $daysLeft;
    public $currentTime;


    public function getStartDate() {
        $node = \Drupal::routeMatch()->getParameter('node');
        $value = $node->field_date[0]->value;


        $dateSplit = explode('T', $value);
        $this->startDate = $dateSplit[0];
        $this->startTime = $dateSplit[1];

        // var_dump($this->startTime);

    }


    // public function getTimeOffset() {
    //     return date('P');
    // }

    public function getDaysLeft() {
        $currentDate = date("Y/m/d");
        $this->currentTime = date("H");
        // var_dump($this->startTime, $this->startDate);
        $remaining = strtotime($this->startDate) - strtotime($currentDate);
        $this->daysLeft = ceil((($remaining/24)/60)/60);
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
        // return $this->currentTime;
    }



    public function getErr($name) {
        print '<pre>';
            var_dump($name);
        print '</pre>';
    }
}