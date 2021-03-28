<?php

namespace Mubangizi\controllers;

use Mubangizi\Core\Controller;

use Mubangizi\Core\Request;

class SiteController extends Controller {
  
  public function index(){
    return $this->render('home');
  } 
  
  public function contact(Request $request){
    $data = $request->get_method() === 'post'? ['message' => 'submitting form'] : [];
    return $this->render('contact', $data);
  }
}