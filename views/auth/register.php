<?php

/** @var Mubangizi\Models\User $model */

use Mubangizi\Core\Form\Form;

$form = new Form($model);
?>

<?= $form::open('post', '', ['py-2', 'm-3']) ?>
<div class="d-grid col-md-5 col-lg-4 gap-3 p-4 mx-auto shadow bg-body rounded">
  <h1>
    Register
  </h1>
  <p>Start using the application with an account</p>
  <?= $form->input('First name', 'first_name') ?>
  <?= $form->input('Last name', 'last_name') ?>
  <?= $form->input('Your email', 'email', 'email', 'envelope') ?>
  <?= $form->input('Password', 'password', 'password', 'lock') ?>
  <?= $form->input('Confirmation', 'confirm_password', 'password', 'lock') ?>
  <p>Already got an account? <a href="/auth/login">Login</a></p>
  <?= $form->button('Register', 'submit') ?>
</div>
<?= $form::close() ?>