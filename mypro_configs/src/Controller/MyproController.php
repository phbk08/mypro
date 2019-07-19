<?php

namespace Drupal\mypro_configs\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of MyproController
 *
 * @author pankaj
 * 
 * Ref: https://www.drupal.org/docs/8/converting-drupal-7-modules-to-drupal-8/step-4-convert-drupal-7-variables-to-drupal-8
 * https://drupal.stackexchange.com/questions/211095/show-access-denied-in-custom-page-without-permissions-drupal-8
 */
class MyproController extends ControllerBase {

  /**
   * show data of Basic Page node type if correct 'Site API Key' and 'nid' is passed in the URL
   * @param type $site_api_key
   * @param type $nid
   * @return JsonResponse
   * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
   */
  public function pageData($site_api_key, $nid) {
    // As we need 'Basic Page' node type data    
    $node_type = 'Basic page';

    // Get 'Site API Key' value from congfis settings if already saved
    $site_api_saved_key = \Drupal::config('mypro_configs.settings')
      ->get('siteapikey');

    // Check whether Site API Key exists or not
    if ($site_api_key == $site_api_saved_key) {
      // Get data from Service container
      $node_data = \Drupal::service('mypro_configs.site_api_key')->getPageData($nid, $node_type);

      // Check if data is available for given 'nid'
      if (!empty($node_data)) {
        return new JsonResponse($node_data);
      }
    }

    // If no data is found and meet our conditon then throw to Access Deny page
    throw new \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException();
  }

}
