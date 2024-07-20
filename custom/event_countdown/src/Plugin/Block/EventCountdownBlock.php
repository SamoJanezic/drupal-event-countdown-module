<?php

namespace Drupal\event_countdown\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;
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
        \Drupal::cache()->invalidateAll();
        $ECC = new EventCountdownController;
        $ECC->getExpDate();
        $ECC->getErr($ECC->expDate);
        // $ECC->getErr($ECC->calculate());
        // $nid = \Drupal::routeMatch()->getRawParameter('node');
        // $nid = 'Node Id';
        // $node = Node::load($nid);
        // $ECC->getErr($node->title);
        // $t = $node->get('title');
        // $title = $date_field->value;
        // $node = \Drupal::routeMatch()->getParameter('node');
        // $value = $node->field_date[0]->value;
        // $nid = $node->title();
        // $ECC->getErr($value);


        return [
            '#type' => 'markup',
            '#markup' => $ECC->getEndTime(),
            '#cache' => [
                'max-age' => 0,
            ]
        ];
    }

 }