<?php

/**
 * @var Mubangizi\Models\User $model
 */

use Mubangizi\Core\Form\Form;

$form = new Form($model);
?>



<?= $form::open('post') ?>
<div class="d-grid col-md-5 col-lg-4 gap-4 p-4 mx-auto shadow bg-body rounded">
  <h1>
    Sign in
  </h1>
  <p>Provide your credentials and access your account.</p>
  <?= $form->input('Your email', 'email', 'email', 'envelope') ?>
  <?= $form->input('Password', 'password', 'password', 'lock') ?>
  <a href="/auth/reset-password">Forgot Password?</a>
  <?= $form->button('Login', 'submit') ?>
</div>
<p class="text-center p-3">Are you new here? <a href="/auth/register">Register</a></p>
<?= $form::close() ?>