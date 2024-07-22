<?php

namespace Drupal\event_countdown\Controller;

use Drupal\Core\Controller\ControllerBase;


class EventCountdownController extends ControllerBase {

    public function getEventStartDate() {
        $node = \Drupal::routeMatch()->getParameter('node');
        $date_value = $node->field_date->value;
        return $date_value;
    }


    public function getMessage() {
        $countdownService = \Drupal::service('eventCountdownTime');
        $daysLeft = $countdownService->getDaysLeft($this->getEventStartDate());
        $hoursLeft = $countdownService->getHoursLeft($this->getEventStartDate());
        if ($daysLeft < 0) {
            return "This event already passed";
        }

        if ($daysLeft == 0) {
            if ($hoursLeft > 0) {
                return "{$hoursLeft} hours left until event starts";
            }
            return "This event is happening today";
        }

        if ($daysLeft == 1) {
            return "{$daysLeft} day left until event starts";
        }

        return "{$daysLeft} days left until event starts";
    }
}