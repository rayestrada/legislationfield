<?php

namespace Drupal\legislationfield\Plugin\migrate\process;

use Drupal\migrate\MigrateException;
use Drupal\migrate\MigrateExecutableInterface;
use Drupal\migrate\ProcessPluginBase;
use Drupal\migrate\Row;

/**
 * Convert a date field to the proper format.
 *
 * @MigrateProcessPlugin(
 *   id = "legislation_field",
 * )
 */
class LegislationProcess extends ProcessPluginBase {

  /**
   * {@inheritdoc}
   */
  public function transform($value, MigrateExecutableInterface $migrate_executable, Row $row, $destination_property) {
    if (!empty($value)) {
      $items = explode('|', $value);
      foreach ($items as $key => $item) {
        $item = explode(';', $item);
        $output[$key] = array(
          'name' => $item[0],
          'date' => strtotime($item[1]),
          'role' => $item[2],
        );
      }

      // Sorts the incoming data by date
      usort($output, array($this, "sort_by_date"));

      // Reformats the date to be friendly
      foreach ($output as $key => $item) {
        if (!empty($item['date'])) {
          $output[$key]['date'] = date('F j, Y', $item['date']);
        }
      }

      $value = $output;
    }
    return $value;
  }

  /**
   * @param $a
   * @param $b
   * @return bool
   */
  function sort_by_date($a, $b) {
    return $a['date'] < $b['date'];
  }
}
