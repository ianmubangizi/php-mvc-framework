<?php

namespace framework\controllers;

use framework\core\Request;

class SiteController extends Controller {
  
  public function handle_contact_submit(Request $request){
      echo '<pre>';
      var_dump($request->get_body());
      echo '</pre>';
      exit;
    return $this->render('contact', ['message' => 'submitting form']);
  }
}
