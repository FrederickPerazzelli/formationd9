<?php

namespace Drupal\form_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides an example block.
 *
 * @Block(
 *   id = "form_module_example",
 *   admin_label = @Translation("Example"),
 *   category = @Translation("form_module")
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
