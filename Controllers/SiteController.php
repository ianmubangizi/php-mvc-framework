<?php

namespace Mubangizi\Controllers;

use Mubangizi\Core\Request;
use Mubangizi\Core\Response;
use Mubangizi\Core\Controller;
use Mubangizi\Models\Contact;

class SiteController extends Controller {
  
  public function index(){
    return $this->render('home');
  } 
  
  public function contact(Request $request){
    $form = new Contact;
    if($request->is('post')) {
      $form->data($request->body());
      $form->validate();
    }
    
    return $this->render('contact', [
      'model' => $form
    ]);
  }
}