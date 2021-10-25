<?php

/**
 * @file
 * Contains \Drupal\legislationfield\Plugin\Field\FieldType\Legislation.
 */

namespace Drupal\legislationfield\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'legislation' field type.
 *
 * @FieldType (
 *   id = "legislation",
 *   label = @Translation("Legislation"),
 *   description = @Translation("Stores legislation data"),
 *   default_widget = "legislation",
 *   default_formatter = "legislation"
 * )
 */
class Legislation extends FieldItemBase {
  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'name' => array(
          'type' => 'text',
          'size' => 'tiny',
          'not null' => FALSE,
        ),
        'date' => array(
          'type' => 'text',
          'size' => 'tiny',
          'not null' => TRUE,
        ),
        'role' => array(
          'type' => 'text',
          'size' => 'tiny',
          'not null' => TRUE,
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value1 = $this->get('name')->getValue();
    $value2 = $this->get('date')->getValue();
    $value3 = $this->get('role')->getValue();
    return empty($value1) && empty($value2) && empty($value3);
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    // Add our properties.
    $properties['name'] = DataDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of legislation'));

    $properties['date'] = DataDefinition::create('string')
      ->setLabel(t('Date'))
      ->setDescription(t('The date of action'));

    $properties['role'] = DataDefinition::create('string')
      ->setLabel(t('Role'))
      ->setDescription(t('The role of action'));

    return $properties;
  }
}
