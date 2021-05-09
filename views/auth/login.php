<?php

use Mubangizi\Core\Form\Form;
use Mubangizi\Core\Model\Auth;

/** @var Auth $model */

$form = new Form($model);
?>

<?= $form::open('post') ?>
<div class="d-grid col-md-5 col-lg-4 gap-4 p-4 mx-auto shadow bg-body rounded">
  <h1>Sign in</h1>
  <p>Provide your credentials and access your account.</p>
  <?= $form->field->input('Your email')->name('email')->type('email')->icon('envelope') ?>
  <?= $form->field->input('Password', 'lock')->name('password')->type('password')->icon('lock') ?>
  <a href="/auth/reset-password">Forgot Password?</a>
  <?= $form->field->button('Login')->type('submit') ?>
</div>
<p class="text-center p-3">Are you new here? <a href="/auth/register">Register</a></p>
<?= $form::close() ?>