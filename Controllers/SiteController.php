<?php

namespace Mubangizi\Controllers;

use Mubangizi\Core\Request;
use Mubangizi\Core\Controller;
use Mubangizi\Models\Contact;

class SiteController extends Controller
{

  public function index()
  {
    return $this->render('home');
  }

  public function contact(Request $request)
  {
    $form = new Contact;
    if ($request->is('post')) {
      $form->data($request->body());
      if ($form->is_valid()) {
      }
    }

    return $this->render('contact', [
      'model' => $form
    ]);
  }
}
