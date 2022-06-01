<?php

namespace Drupal\api_json\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "api_json_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("api_json")
 * )
 */
class ExampleBlock extends BlockBase
{

  /**
   * {@inheritdoc}
   */
  public function build()
  {
    $build['content'] = [
      '#markup' => $this->t('It works!'),
    ];
    return $build;
  }

}
