<?php

class TMPageMigration extends TMBaseMigration {

  public function __construct() {
    parent::__construct();

    $this->description = t('Import pages.');

    // Create a map object for tracking the relationships between source rows
    $this->map = new MigrateSQLMap($this->machineName,
      array(
        'id' => array(
          'type' => 'int',
          'not null' => TRUE,
        ),
      ),
      MigrateDestinationNode::getKeySchema()
    );

    // Create a MigrateSource object.
    $this->source = new MigrateSourceCSV(
      drupal_get_path('module', 'tm_sample_content') . '/import/pages.csv',
      array(),
      $this->sourceFileOptions()
    );

    // Destination
    $this->destination = new MigrateDestinationNode('page');

    // Field Mappings

    // Title
    $this->addFieldMapping('title', 'title');

    // Body
    $this->addFieldMapping('body', 'body');
    $this->addFieldMapping('body:format')
      ->defaultValue('full_html');

    // Author, default to admin
    $this->addFieldMapping('uid')
      ->defaultValue(1);

  }
  
  public function prepareRow($row) {
  }

  public function complete($entity, $row) {
    $item = array(
      'menu_name' => 'menu-footer-menu',
      'link_path' => 'node/' . $entity->nid,
      'link_title' => $entity->title,
      'customized' => 1
    );
    menu_link_save($item);
  }

}
