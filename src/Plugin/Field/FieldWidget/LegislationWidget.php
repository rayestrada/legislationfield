<?php
/**
 * @file
 * Contains \Drupal\legislationfield\Plugin\Field\FieldWidget\LegislationWidget.
 */

namespace Drupal\legislationfield\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'legislation' widget.
 *
 * @FieldWidget (
 *   id = "legislation",
 *   label = @Translation("Legislation widget"),
 *   field_types = {
 *     "legislation"
 *   }
 * )
 */
class LegislationWidget extends WidgetBase {
  /**
   * {@inheritdoc}
   */
  public function formElement(
    FieldItemListInterface $items,
    $delta,
    array $element,
    array &$form,
    FormStateInterface $form_state
  ) {
    $element['name'] = array(
      '#type' => 'textfield',
      '#title' => t('Legislation Name'),
      '#default_value' => isset($items[$delta]->name) ? $items[$delta]->name : '',
      '#size' => 60,
    );
    $element['date'] = array(
      '#type' => 'textfield',
      '#title' => t('Action Date'),
      '#default_value' => isset($items[$delta]->date) ? $items[$delta]->date : '',
      '#size' => 60,
    );
    $element['role'] = array(
      '#type' => 'textfield',
      '#title' => t('Member Role'),
      '#default_value' => isset($items[$delta]->role) ? $items[$delta]->role : '',
      '#size' => 60,
    );

    // If cardinality is 1, ensure a label is output for the field by wrapping
    // it in a details element.
    if ($this->fieldDefinition->getFieldStorageDefinition()->getCardinality() == 1) {
      $element += array(
        '#type' => 'fieldset',
        '#attributes' => array('class' => array('container-inline')),
      );
    }

    return $element;
  }
}
