<?php

namespace framework\controllers;

class SiteController extends Controller {
  
  public function handle_contact_submit(){
    return $this->render('contact', ['message' => 'submitting form'])
  }
}
