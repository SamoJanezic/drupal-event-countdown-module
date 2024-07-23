<?php

namespace Drupal\event_countdown\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;

/**
 * Provides "EventCountdown" block
 *
 * @Block(
 *  id = "event_countdown_block",
 *  admin_label = @translation("Event Countdown Block"),
 *  category = @Translation("Custom Block for Event Countdown")
 * )
 */

class EventCountdownBlock extends BlockBase implements ContainerFactoryPluginInterface{

    /**
   * The Event Countdown
   *
   * @var \Drupal\event_countdown\Service\EventCountdownBlock
   */
    protected $eventCountdownTime;
    /**
   * Constructs an EventCountdownBlock object.
   *
   * @param array $configuration
   *   The block configuration.
   * @param string $plugin_id
   *   The ID of the plugin.
   * @param mixed $plugin_definition
   *   The plugin definition.
   * @param \Drupal\event_countdown\Service\EventCountdownTime $EventCountdownTime
   *   Eventcountdown time
   */
    public function __construct(
        array $configuration,
        $plugin_id,
        $plugin_definition,
        $eventCountdownTime
    )
    {
        parent::__construct($configuration, $plugin_id, $plugin_definition);

        $this->eventCountdownTime = $eventCountdownTime;
    }

    /**
     * {@inheritdoc}
     */

    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
        return new static(
          $configuration,
          $plugin_id,
          $plugin_definition,
          $container->get('eventCountdownTime')
        );
    }


    public function getEventStartDate() {
        $node = \Drupal::routeMatch()->getParameter('node');
        $date_value = $node->field_date->value;
        return $date_value;
    }

    public function getMessage() {
        $daysLeft = $this->eventCountdownTime->getDaysLeft($this->getEventStartDate());
        $hoursLeft = $this->eventCountdownTime->getHoursLeft($this->getEventStartDate());
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

    public function build() {

        return [
            '#type' => 'markup',
            '#markup' => $this->getMessage(),
            '#cache' => [
                'max-age' => 0,
            ]
        ];
    }

 }