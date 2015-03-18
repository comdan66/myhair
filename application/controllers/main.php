<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Main extends Site_controller {

  public function __construct () {
    parent::__construct ();
  }

  public function index () {
    $this
      ->add_hidden (array ('id' => 'get_pictures_url', 'value' => base_url ($this->get_class (), 'get_pictures')))
      ->add_js (base_url ('resource', 'javascript', 'masonry_v3.1.2', 'masonry.pkgd.min.js'))
      ->add_js (base_url ('resource', 'javascript', 'imagesloaded_v3.1.8', 'imagesloaded.pkgd.min.js'))
      ->add_js (base_url ('resource', 'javascript', 'jquery-timeago_v1.3.1', 'jquery.timeago.js'))
      ->add_js (base_url ('resource', 'javascript', 'jquery-timeago_v1.3.1', 'locales', 'jquery.timeago.zh-TW.js'))
      ->load_view (null);
  }

  public function get_pictures () {
    if (!$this->is_ajax (false))
      return show_error ("It's not Ajax request!<br/>Please confirm your program again.");

    $limit = 5;
    $next_id = $this->input_post ('next_id');

    $conditions = $next_id ? array ('id <= ?', $next_id) : array ();
    $pictures = Picture::find ('all', array ('order' => 'created_at DESC, id DESC', 'limit' => $limit + 1, 'include' => array ('user'), 'conditions' => $conditions));

    $next_id = ($next_id = ($next_id = array_slice ($pictures, $limit, 1)) ? $next_id[0] : null) ? $next_id->id : -1;

    $that = $this;
    $pictures = array_map (function ($picture) use ($that) {
      return $that->set_method ('picture')->load_content (array ('picture' => $picture), true);
    }, array_slice ($pictures, 0, $limit));

    return $this->output_json (array ('status' => true, 'pictures' => $pictures, 'next_id' => $next_id));
  }
}
