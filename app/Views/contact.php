<?php if(isset($msg)) { ?>
    <div class="alert alert-info msg-cont">
        <?= $msg; ?>
    </div>
<?php } ?>
   
<div class="bloc-form">
    <div class="contact-title">
        <i class="fa fa-envelope fa-2x" aria-hidden="true"></i>
    </div>
    <form method="post" class="contact-form">
        <?= $form->input('emailContact', 'Courriel', null, ['required' => true]); ?>
        <?= $form->textarea('contact', 'Message', null ,['type' => 'contact', 'required' => true]); ?>
        <?= $form->token($token) ?>
        <?= $form->submit(); ?>
    </form>
</div>
