<?php
/**
 * @file
 * tm_users.default_field_validation_rules.inc
 */

/**
 * Implements hook_default_field_validation_rule().
 */
function tm_users_default_field_validation_rule() {
  $export = array();

  $rule = new stdClass();
  $rule->disabled = FALSE; /* Edit this to true to make a default rule disabled initially */
  $rule->api_version = 2;
  $rule->rulename = 'Friendly URL characters';
  $rule->name = 'friendly_url_user_characters';
  $rule->field_name = 'field_friendly_url';
  $rule->col = 'value';
  $rule->entity_type = 'user';
  $rule->bundle = 'user';
  $rule->validator = 'field_validation_regex_validator';
  $rule->settings = array(
    'data' => '^[-\\sa-zA-Z]+$',
    'bypass' => 0,
    'roles' => array(
      1 => 0,
      2 => 0,
      3 => 0,
    ),
    'errors' => 0,
  );
  $rule->error_message = 'The friendly url may only contain letters, numbers, hyphens and underscores.';
  $export['friendly_url_user_characters'] = $rule;

  $rule = new stdClass();
  $rule->disabled = FALSE; /* Edit this to true to make a default rule disabled initially */
  $rule->api_version = 2;
  $rule->rulename = 'Friendly URL unique';
  $rule->name = 'friendly_url_user_unique';
  $rule->field_name = 'field_friendly_url';
  $rule->col = 'value';
  $rule->entity_type = 'user';
  $rule->bundle = 'user';
  $rule->validator = 'field_validation_unique_validator';
  $rule->settings = array(
    'data' => 'global',
    'per_user' => 0,
    'bypass' => 0,
    'roles' => array(
      1 => 0,
      2 => 0,
      3 => 0,
    ),
    'errors' => 0,
  );
  $rule->error_message = 'This friendly URL is already taken by [existing-entity-link].';
  $export['friendly_url_user_unique'] = $rule;

  return $export;
}