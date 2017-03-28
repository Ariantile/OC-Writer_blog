<?php if(isset($msg)) { ?>
    <div class="alert alert-info msg-cont">
        <?= $msg; ?>
    </div>
<?php } ?>
   
<div class="bloc-form">
    <form method="post" class="login-form">
        <?= $form->input('username', 'Pseudo', null, ['required' => true]); ?>
        <?= $form->input('email', 'Courriel', null, ['required' => true]); ?>
        <?= $form->input('emailConfirm', 'Confirmation courriel', null, ['required' => true]); ?>
        <?= $form->input('password', 'Mot de passe', null ,['type' => 'password', 'required' => true]); ?>
        <?= $form->input('passwordConfirm', 'Confirmation mot de passe', null ,['type' => 'password', 'required' => true]); ?>
        <?= $form->token($token) ?>
        <?= $form->submit(); ?>
    </form>
</div>
