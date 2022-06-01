<?php

namespace Drupal\form_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure form_module settings for this site.
 */
class UserForm extends FormBase
{

  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'user_form_id';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames()
  {
    return ['form_module.user'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#default_value' => $this->t('Jean_Paul'),
    ];

    $form['telephone'] = [
      '#type' => 'tel',
      '#title' => $this->t('Telephone'),
      '#default_value' => $this->t('555-555-5555')
    ];

    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#default_value' => $this->t('example@email.com')
    ];

    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
    ];

    $form['submit'] = [
      '#type' => 'submit',
      "#default_value" => 'Submit',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state)
  {
    if (empty($form_state->getValue('username'))) {
      $form_state->setErrorByName('username', $this->t('The username is not correct.'));

    } elseif (empty($form_state->getValue('telephone'))) {
      $form_state->setErrorByname('telephone', $this->t('The telephone number is not correct.'));

    } elseif (empty($form_state->getValue('email'))) {
      $form_state->setErrorByname('email', $this->t('The email is not correct.'));

    } elseif (empty($form_state->getValue('password'))) {
      $form_state->setErrorByname('password', $this->t('The password is not correct.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $this->messenger()->addStatus($this->t('Your username is @username', ['@username' => $form_state->getValue('username')]));
    $this->messenger()->addStatus($this->t('Your phone number is @number', ['@number' => $form_state->getValue('telephone')]));
    $this->messenger()->addStatus($this->t('Your email is @email', ['@email' => $form_state->getValue('email')]));
  }

}
