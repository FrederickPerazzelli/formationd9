<?php

namespace Drupal\form_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure form_module settings for this site.
 */
class SettingsForm extends ConfigFormBase
{

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'form_module_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['form_module.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {

    $config = $this->config('form_module.settings');

    $form['admin'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Admin'),
      '#default_value' => $config->get('admin')
    ];

    $form['admin_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Id'),
      '#default_value' => $config->get('admin_id')
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#default_value' => $config->get('email')
    ];

    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#default_value' => $config->get('password')
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    if (empty($form_state->getvalue('admin'))) {
      $form_state->setErrorByName('admin', $this->t('The admin field is empty.'));

    } elseif (empty($form_state->getvalue('admin_id'))) {
      $form_state->setErrorByName('admin_id', $this->t('The id field is empty.'));

    } elseif (strlen($form_state->getvalue('admin_id')) != 8) {
      $form_state->setErrorByName('admin_id', $this->t('The id 8 char long.'));

    } elseif (empty($form_state->getValue('email'))) {
      $form_state->setErrorByName('email', $this->t('The email field is empty.'));

    } elseif (empty($form_state->getValue('password'))) {
      $form_state->setErrorByName('password', $this->t('The password field is empty.'));
    }

    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public
  function submitForm(array &$form, FormStateInterface $form_state)
  {

    $this->messenger()->addStatus($this->t('Your admin name is @admin', ['@admin' => $form_state->getValue('admin')]));
    $this->messenger()->addStatus($this->t('Your id is @id', ['@id' => $form_state->getValue('admin_id')]));
    $this->messenger()->addStatus($this->t('Your email is @email', ['@email' => $form_state->getValue('email')]));

    $this->config('form_module.settings')
      ->set('admin', $form_state->getValue('admin'))
      ->set('admin_id', $form_state->getValue('admin_id'))
      ->set('email', $form_state->getValue('email'))
      ->set('password', $form_state->getValue('password'))
      ->save();
    parent::submitForm($form, $form_state);
  }

  /**
   * Return config
   */
  function getConfig()
  {
    return $this->config('form_module.setting');
  }
}
