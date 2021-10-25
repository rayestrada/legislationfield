<?php

/**
 * @file
 * Contains \Drupal\legislationfield\Plugin\Field\FieldFormatter\LegislationFormatter.
 */

namespace Drupal\legislationfield\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'legislation' formatter.
 *
 * @FieldFormatter (
 *   id = "legislation",
 *   label = @Translation("Legislation"),
 *   field_types = {
 *     "legislation"
 *   }
 * )
 */
class LegislationFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode = NULL) {
    $elements = array();

    foreach ($items as $delta => $item) {
      // Trim name to 115 characters
      $limit = 115;
      $valuelen = strlen($item->name);
      $name = $limit < $valuelen ? substr($item->name, 0, strrpos($item->name, ' ', $limit - $valuelen)) . '…' : $item->name;

      // Render each element as markup.
      $elements[$delta] = array(
        '#type' => 'markup',
        '#markup' => '<p class="cm-date">' . $item->date . '</p><p>' . $name . '</p>',
      );
    }

    return $elements;
  }
}
