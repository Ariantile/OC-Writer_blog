<?php if($error): ?>
    <div class="alert alert-danger">
        Identifiant incorrect
    </div>
<?php endif; ?>
   

<div class="bloc-form">
    <form method="post" class="login-form">
        <?= $form->input('username', 'Pseudo'); ?>
        <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
        <?= $form->submit(); ?>
    </form>
</div>
