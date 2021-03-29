<?php

namespace Mubangizi\Controllers;

use Mubangizi\Core\Controller;

use Mubangizi\Core\Request;
use Mubangizi\Core\Response;
use Mubangizi\Core\Controller;

class SiteController extends Controller {
  
  public function index(){
    return $this->render('home');
  } 
  
  public function contact(Request $request){
    $data = $request->is('post') ? ['message' => 'submitting form'] : [];
    return $this->render('contact', $data);
  }
}