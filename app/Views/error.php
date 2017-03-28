<h1 class="title-error">Le server a renvoyé une erreur <?= http_response_code(); ?></h1> 

<div class="bloc-error">
    <p>
        <?= $error_msg ?>
        <br>
        <br>
        Si vous souhaitez retourner sur la page d'accueil, veuillez <a href="/writer/web/accueil">cliquer ici</a>.
    </p>
</div>
