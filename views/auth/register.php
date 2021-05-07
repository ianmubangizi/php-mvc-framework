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
  <?= $form->field->input('First name')->name('first_name') ?>
  <?= $form->field->input('Last name')->name('last_name') ?>
  <?= $form->field->input('Your email')->name('email')->type('email')->icon('envelope') ?>
  <?= $form->field->input('Password')->name('password')->type('password')->icon('lock') ?>
  <?= $form->field->input('Confirmation')->name('confirm_password')->type('password')->icon('lock') ?>
  <p>Already got an account? <a href="/auth/login">Login</a></p>
  <?= $form->field->button('Register')->type('submit') ?>
</div>
<?= $form::close() ?>