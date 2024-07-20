<?php

namespace Drupal\event_countdown\Controller;

use Drupal\Core\Controller\ControllerBase;

class EventCountdownController extends ControllerBase {

    // public $currentDate = date("Y-m-d");
    public $expDate;

    public $myDate;

    public function getExpDate() {
        $node = \Drupal::routeMatch()->getParameter('node');
        $value = $node->field_date[0]->value;
        $this->expDate = $value;
    }


    public function calculate() {
        $date1=date_create("2024-02-27");
        $date2=date_create("2024-03-02");
        $diff=date_diff($date1,$date2);
        return $diff->format("%R%a days");
    }

    public function getEndTime() {
        $now = time();
        $node = \Drupal::routeMatch()->getParameter('node');
        $value = $node->field_date[0]->value;
        $hour = explode('T', $value);
        $days = strtotime($hour[0]);
        $datediff = $days - $now;
        $daysLeft = ceil($datediff / (60 * 60 * 24));

        if ($daysLeft < 0) {
            return "This event already passed";
        }

        if ($daysLeft == 0) {
            return "This event is happening today";
        }

        return "{$daysLeft} days left until event starts";
    }



    public function getErr($name) {
        print '<pre>';
            var_dump($name);
        print '</pre>';
    }
}