<?php

namespace Drupal\event_countdown\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\event_countdown\Controller\EventCountdownController;

/**
 * Provides "EventCountdown" block
 *
 * @Block(
 *  id = "event_countdown_block",
 *  admin_label = @translation("Event Countdown Block"),
 *  category = @Translation("Custom Block for Event Countdown")
 * )
 */

 class EventCountdownBlock extends BlockBase {
    /**
     * {@inheritdoc}
     */


    public function build() {
        $ECC = new EventCountdownController;
        $ECC->getStartDate();

        return [
            '#type' => 'markup',
            '#markup' => $ECC->setMessage(),
            '#cache' => [
                'max-age' => 0,
            ]
        ];
    }

 }