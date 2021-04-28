<?php

/** @var Mubangizi\Models\Contact $model */

use Mubangizi\Core\Form\Form;

$form = new Form($model);

?>
<h1 class="text-center">
  Send us a message
</h1>

<?= $form->open('post') ?>
<div class="d-grid col-12 col-md-6 col-sm-8 gap-3 p-2 mx-auto shadow bg-body rounded">
  <?= $form->input('Email', 'email', 'email', 'envelope') ?>
  <?= $form->input('Subject', 'subject', 'text', 'question') ?>
  <?= $form->textarea('Type your message', 'message', 'Something interesting you may want to share with us?') ?>
  <?= $form->button('Send Message', 'submit', ["btn", "btn-md", "btn-success"]) ?>
</div>
<?= $form->close() ?>