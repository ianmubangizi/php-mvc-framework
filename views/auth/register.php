<?php
  /** @var Mubangizi\Models\User $model */
  use Mubangizi\Core\Form\Form;
  
  $form = new Form($model);
?>

<h1 class="text-center">
  Sign up for your account
</h1>

<?= $form::open('post', '', ['py-2', 'm-3']) ?>
  <div class="d-grid col-12 col-md-6 col-sm-8 gap-3 p-4 mx-auto shadow bg-body rounded">
    <?= $form->input('First name', 'first_name') ?>
    <?= $form->input('Last name', 'last_name') ?>
    <?= $form->input('Your email', 'email', 'email', 'envelope') ?>
    <?= $form->input('Password', 'password', 'password', 'lock') ?>
    <?= $form->input('Confirmation', 'confirm_password', 'password', 'lock') ?>
    <?= $form->button('Register', 'submit') ?>
  </div>
<?= $form::close() ?>