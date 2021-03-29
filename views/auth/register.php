<?php
  
  use Mubangizi\Core\Form\Form;
  
  $form = new Form($model);
?>

<h1 class="text-center">
  Sign up for your account
</h1>

<?= $form::open('post') ?>
  <div class="d-grid col-12 col-md-6 col-sm-8 gap-3 p-2 mx-auto shadow bg-body rounded">
    <?= $form->input('text', 'first_name', 'First name') ?>
    <?= $form->input('text', 'last_name', 'Last name') ?>
    <?= $form->input('email', 'email', 'Your email') ?>
    <?= $form->input('password', 'password', 'Password') ?>
    <?= $form->input('password', 'confirm_password', 'Confirm Password') ?>
    <?= $form->button('submit', 'Register') ?>
  </div>
<?= $form::close() ?>