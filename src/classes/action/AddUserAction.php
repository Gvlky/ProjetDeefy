<?php

namespace iutnc\deefy\action;

class AddUserAction extends Action{
    
    public function __construct()
    {
        parent::__construct();
    }

    
    public function methodeGet(): string
    {
        return <<< HTML
           <form method="post" action="?action=add-user">
            <label for="nom"> Nom : </label>
            <input type='text' name="nom" id="nom" required>
            <label for="email"> Email : </label>
            <input type="email" name="email" id="email" required>
            <label for="age"> Âge : </label>
            <input type="number" name="age" id="age" required>
            <button type="submit"> Connexion </button>
            </form>
HTML;
    }

    
    public function methodePost(): string
    {
        $nom = filter_var($_POST['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_SPECIAL_CHARS);
        $age = filter_var($_POST['age'], FILTER_SANITIZE_SPECIAL_CHARS);
        return <<< HTML
        <p>Nom : $nom, Email : $email, Age : $age ans</p>
HTML;
    }
}