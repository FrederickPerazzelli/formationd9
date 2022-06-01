<?php

namespace Drupal\api_json\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure api_json settings for this site.
 */
class SettingsForm extends ConfigFormBase
{

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'api_json_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['api_json.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['example'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Example'),
      '#default_value' => $this->config('api_json.settings')->get('example'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    if ($form_state->getValue('example') != 'example') {
      $form_state->setErrorByName('example', $this->t('The value is not correct.'));
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->config('api_json.settings')
      ->set('example', $form_state->getValue('example'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
