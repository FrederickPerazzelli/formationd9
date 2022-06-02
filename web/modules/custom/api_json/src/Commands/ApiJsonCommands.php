<?php

namespace Drupal\api_json\Commands;

use Consolidation\OutputFormatters\StructuredData\RowsOfFields;
use Drush\Commands\DrushCommands;

/**
 * A Drush commandfile.
 *
 * In addition to this file, you need a drush.services.yml
 * in root of your module, and a composer.json file that provides the name
 * of the services file to use.
 *
 * See these files for an example of injecting Drupal services:
 *   - http://cgit.drupalcode.org/devel/tree/src/Commands/DevelCommands.php
 *   - http://cgit.drupalcode.org/devel/tree/drush.services.yml
 */
class ApiJsonCommands extends DrushCommands
{

  /**
   * Command description here.
   *
   * @param $arg1
   *   Argument description.
   * @param array $options
   *   An associative array of options whose values come from cli, aliases, config, etc.
   * @option option-name
   *   Description
   * @usage api_json-commandName foo
   *   Usage description
   *
   * @command api_json:commandName
   * @aliases foo
   */
  public function commandName($arg1, $options = ['option-name' => 'default'])
  {
    $this->logger()->success(dt('Achievement unlocked.'));
  }

  /**
   * An example of the table output format.
   *
   * @param array $options An associative array of options whose values come from cli, aliases, config, etc.
   *
   * @field-labels
   *   group: Group
   *   token: Token
   *   name: Name
   * @default-fields group,token,name
   *
   * @command api_json:token
   * @aliases token
   *
   * @filter-default-field name
   * @return \Consolidation\OutputFormatters\StructuredData\RowsOfFields
   */
  public function token($options = ['format' => 'table'])
  {
    $all = \Drupal::token()->getInfo();
    foreach ($all['tokens'] as $group => $tokens) {
      foreach ($tokens as $key => $token) {
        $rows[] = [
          'group' => $group,
          'token' => $key,
          'name' => $token['name'],
        ];
      }
    }
    return new RowsOfFields($rows);
  }


  /**
   * Drush command that displays the given text. - EXAMPLE
   *
   * @param string $text
   *   Argument with message to be displayed.
   * @command api_json:message
   * @aliases d9-message d9-msg
   * @option uppercase
   *   Uppercase the message.
   * @option reverse
   *   Reverse the message.
   * @usage api_json:message --uppercase --reverse drupal8
   */
  public function message(string $text = 'Hello world!', $options = ['uppercase' => FALSE, 'reverse' => FALSE])
  {
    if ($options['uppercase']) {
      $text = strtoupper($text);
    }
    if ($options['reverse']) {
      $text = strrev($text);
    }
    $this->output()->writeln($text);
  }
}
