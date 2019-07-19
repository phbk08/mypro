<?php

/**
 * Ref: From my previous experience
 */

namespace Drupal\mypro_configs;

use Drupal\node\Entity\Node;

class SiteDataManager {

  /**
   * Get Page Node Type data
   * @param type $nid
   * @param type $type
   * @return type
   */
  public function getPageData($nid, $type) {

    // Load node data
    // [OR] we can write query to get specific data from the node field
    $node = Node::load($nid);

    // Check if node type is expected node type
    if ($node->type->entity->label() == $type) {
      // If yes then
      return ['nid' => $nid, 'type' => $type];
    }
  }

}
