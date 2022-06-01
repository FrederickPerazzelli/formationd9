<?php

namespace Drupal\api_json\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Returns responses for api_json routes.
 */
class ApiJsonController extends ControllerBase
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
   * @return JsonResponse
   */
  public function index()
  {
    return new JsonResponse(['data' => $this->getData(), 'method' => 'GET', 'status' => 200]);
  }

  /**
   * @return JsonResponse
   */
  public function indexConfig()
  {
    return new JsonResponse(['formData' => $this->getFormconfig(), 'method' => 'GET', 'status' => 200]);
  }

  /**
   * @return JsonResponse
   */
  public function helloJulien()
  {
    return new JsonResponse(['Julien' => 'Hello Julien', 'method' => 'GET', 'status' => 200]);
  }

  /**
   * @return array
   */
  public function getData()
  {

    $result = [];
    $query = \Drupal::entityQuery('node')
      ->condition('type', 'article')
      ->sort('title', 'DESC');
    $nodes_ids = $query->execute();

    if ($nodes_ids) {
      foreach ($nodes_ids as $node_id) {
        $node = \Drupal\node\Entity\Node::load($node_id);
        $result[] = [
          "id" => $node->id(),
          "title" => $node->getTitle(),
        ];
      }
    }
    return $result;
  }

  public function getFormConfig()
  {
    $form['setting-form'] = \Drupal::formBuilder()->getForm('\Drupal\form_module\Form\SettingsForm');;

    $result = [];
    $result[] = [
      'admin' => $form['setting-form']['admin']['#default_value'],
      'id' => $form['setting-form']['admin_id']['#default_value'],
      'email' => $form['setting-form']['email']['#default_value'],
    ];

    return $result;
  }


}
