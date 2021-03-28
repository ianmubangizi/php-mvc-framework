<?php

namespace Mubangizi\controllers;

use Mubangizi\Core\Controller;

use Mubangizi\Core\Request;

class SiteController extends Controller {
  
  public function handle_contact_submit(Request $request){
    return $this->render('contact', ['message' => 'submitting form']);
  }
}