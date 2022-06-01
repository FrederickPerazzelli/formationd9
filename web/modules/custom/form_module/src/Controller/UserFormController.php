<?php

namespace Drupal\form_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for form_module routes.
 */
class UserFormController extends ControllerBase
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
   * @return array
   * Build user form
   */
  public function content(): array
  {
    $form['user_form'] = \Drupal::formBuilder()->getForm('\Drupal\form_module\Form\UserForm');
    $form['#theme'] = 'user-form';
    //kint($form);
    return $form;
  }

  /**
   * @return array
   */
  public function test_var()
  {

    return [
      '#theme' => 'my_template',
      '#test_var' => $this->t('Test Value'),
    ];

  }
}
