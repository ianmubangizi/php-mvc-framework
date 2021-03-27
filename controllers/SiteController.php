<?php

namespace framework\controllers;

use framework\core\Request;

class SiteController extends Controller {
  
  public function handle_contact_submit(Request $request){
    return $this->render('contact', ['message' => 'submitting form']);
  }
}