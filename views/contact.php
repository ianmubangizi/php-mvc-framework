<?php

/** @var Mubangizi\Models\Contact $model */

use Mubangizi\Core\Form\Form;

$form = new Form($model);

?>
<h1 class="text-center">
  Send us a message
</h1>

<?= $form::open('post') ?>
<div class="d-grid col-12 col-md-6 col-sm-8 gap-3 p-4 mx-auto shadow bg-body rounded">
  <?= $form->field->input('Email')->name('email')->type('email')->icon('envelope') ?>
  <?= $form->field->input('Subject')->name('subject')->icon('question') ?>
  <?= $form->field->textarea('Type your message')->name('message')->placeholder('Something interesting you may want to share with us?') ?>
  <?= $form->field->button('Send Message')->type('submit')->css(["btn", "btn-md", "btn-success"]) ?>
</div>
<?= $form::close() ?>