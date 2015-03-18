<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author      OA Wu <comdan66@gmail.com>
 * @copyright   Copyright (c) 2015 OA Wu Design
 */

class create extends Site_controller {

  public function __construct () {
    parent::__construct ();
  }

  public function index () {
    $this->load->library ('phpQuery');

    for ($i = 0; $i < 10; $i++)
      if ($get_html_str = str_replace ('&amp;', '&', urldecode (file_get_contents ('http://hair.fashionguide.com.tw/users/' . $i . '/hairs')))) {
        $php_query = phpQuery::newDocument ($get_html_str);
        $img = pq (".user-head.avatar", $php_query);
        $a = pq (".block .user-name a", $php_query);

        $avatar = 'http://hair.fashionguide.com.tw' . $img->eq (0)->attr ('src');
        $name = $a->text ();

        if (verifyCreateOrm ($user = User::create (array ('account' => md5 ($name), 'password' => md5 ($name), 'name' => $name, 'avatar' => $avatar))))
          if (!$user->avatar->put_url ($avatar))
            $user->delete ();
      }
  }
  public function pics () {
    $this->load->library ('phpQuery');
    $user_ids = column_array (User::find ('all', array ('select' => 'id')), 'id');

    if ($get_html_str = str_replace ('&amp;', '&', urldecode (file_get_contents ('http://hair.fashionguide.com.tw/')))) {
      $php_query = phpQuery::newDocument ($get_html_str);
      $box = pq (".box.masonry-brick", $php_query);

      for ($i = 0; $i < $box->count (); $i++) {
        $file_name = str_replace ('pin_', '',$box->eq ($i)->find ('.box-img img')->eq (0)->attr ('src'));
        $title = $introduction = $box->eq ($i)->find ('.single-comment .message')->eq (0)->text ();
        $user_id = $user_ids[array_rand ($user_ids, 1)];
        $pageview = 0;

        if (verifyCreateOrm ($picture = Picture::create (array ('user_id' =>$user_id, 'title' => $title, 'file_name' => $file_name, 'introduction' => $introduction, 'pageview' => $pageview))))
          if (!$picture->file_name->put_url ($file_name))
            $picture->delete ();
      }

      // for ($i = 0; $i < $img->count ();$i++)
      //   str_replace ('pin_', '',$img->eq ($i)->attr ('src'))
    }
  }
}
