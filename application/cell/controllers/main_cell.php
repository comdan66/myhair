<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class Main_cell extends Cell_Controller {

  /* render_cell ('main_cell', 'top', array ()); */
  // public function _cache_top () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function top () {
    return $this->setUseCssList (true)->load_view ();
  }

  /* render_cell ('main_cell', 'feature', array ()); */
  // public function _cache_feature () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function feature () {
    return $this->setUseCssList (true)->load_view ();
  }

  /* render_cell ('main_cell', 'banner', array ()); */
  // public function _cache_banner () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function banner () {
    return $this->setUseCssList (true)->load_view ();
  }

  /* render_cell ('main_cell', 'promo', array ()); */
  // public function _cache_promo () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function promo () {
    return $this->setUseJsList (true)->setUseCssList (true)->load_view ();
  }

  /* render_cell ('main_cell', 'keyword', array ()); */
  // public function _cache_keyword () {
  //   return array ('time' => 60 * 60, 'key' => null);
  // }
  public function keyword () {
    return $this->setUseCssList (true)->load_view ();
  }
}