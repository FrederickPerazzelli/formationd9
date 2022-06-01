<?php

namespace Drupal\form_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for form_module routes.
 */
class FormModuleController extends ControllerBase
{

  /**
   * Builds the response.
   */
  public function build()
  {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

  /**
   * Build config form
   */
  public function content()
  {
    $form['setting-form'] = \Drupal::formBuilder()->getForm('\Drupal\form_module\Form\SettingsForm');
    return $form;
  }

}
