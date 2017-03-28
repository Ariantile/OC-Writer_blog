<?php if(isset($msg)) { ?>
    <div class="alert alert-info msg-cont">
        <?= $msg; ?>
    </div>
<?php } ?>
   
<div class="bloc-form">
    <form method="post" class="login-form">
        <?= $form->input('sendforgot', 'Courriel', null, ['required' => true]); ?>
        <?= $form->token($token) ?>
        <?= $form->submit(); ?>
    </form>
</div>
