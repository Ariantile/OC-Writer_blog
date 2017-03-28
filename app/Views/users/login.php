<?php if($error): ?>
    <div class="alert alert-danger msg-cont">
        Identifiant incorrect
    </div>
<?php endif; ?>
   
<?php if(isset($msg)) { ?>
    <div class="alert alert-info msg-cont">
        <?= $msg; ?>
    </div>
<?php } ?>

<div class="bloc-form">
    <form method="post" class="login-form">
        <?= $form->input('username', 'Pseudo'); ?>
        <?= $form->input('password', 'Mot de passe', null ,['type' => 'password']); ?>
        <p>Mot de passe oublié? Veuillez <a href="/writer/web/oublie">cliquer ici</a>.</p>
        <?= $form->submit(); ?>
        <p>Vous n'avez pas encore de compte? Veuillez <a href="/writer/web/inscription">cliquer ici</a> pour vous inscrire.</p>
    </form>
</div>
