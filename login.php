<?php 
// stockage de l'erreur en cas d'erreur d'identifiant
$erreur = null;

// si l'utilisateur est déjà connecté
require_once 'function/auth.php';
if (est_connecte()) {
    redirection_role();
}

require_once 'function/callPDO.php';
$pdo = getLoginPDO('login');

if(is_string($pdo)){
    // si la connexion à la base de données à échouée
    $erreur = $pdo;
} else {
    if (!empty($_POST['mail'])) {    
        // stockage de la requete de récupération des logins de l'utilisateur selon son l'email rentré
        $query = $pdo->prepare('SELECT PASSWORD, ROLE, EMAIL FROM chopin_user WHERE EMAIL = :email');
        $query->execute([
            'email' => $_POST['mail']
        ]);
        // stockage des données récupérées
        $utilisateur = $query->fetchAll();

        if (empty($utilisateur)) {
            // si l'email n'est pas dans la base de données
            $erreur = "Identifiants incorrects";
        } else {
            // vérification du mot de passe puis redirection vers la page de l'utilisateur
            if (password_verify($_POST['motdepasse'], $utilisateur[0]['PASSWORD'])) {
                session_start();
                $_SESSION['connecte'] = 1;
                $_SESSION['email'] = $utilisateur[0]['EMAIL'];
                $_SESSION['role'] = $utilisateur[0]['ROLE'];
                redirection_role();
                
                exit();
            } else {
                // si le mdp est faux
                $erreur = "Identifiants incorrects";
            }  
        }
    }
}

// titre de l'onglet et ajout du header
$title= 'Connexion';
require 'element/header.php';
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 mt-4">
            <h4>Se connecter</h4>
            <!-- Affichage de l'erreur -->
            <?php if ($erreur): ?>
            <div class="alert alert-danger text-center">
                <?= $erreur ?>
            </div>
            <?php endif; ?>

            <!-- Formulaire de connexion -->
            <form action="" method="post">
                <div class="form-group">  
                    <input class="form-control" type="text" name="mail" placeholder="Adresse mail">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" name="motdepasse" placeholder="Mot de passe">
                </div>
                <button type="submit" class="btn btn-info">Se connecter</button>              
            </form>
        </div>
        <div class="col-md-6 mt-4">
            <h4>Nouveau sur le site ?</h4>
            <h5>Étudiants</h5>
            <p>Vous pouvez dés à présent vous créer un compte en remplissant le formulaire d'enregistrement disponible sur le lien ci-dessous.</p>
            <a href="./register.php">S'enregistrer</a>
            <br><br><h5>Enseignants</h5>
            <p>En tant qu'enseignant, pour consulter les informations sur l'équipement informatique de vos élèves vous devez disposer d'un compte préalablement créé par votre l'administrateur de ce site.</p>
            <p>Si ce n'est pas le cas, vous pouvez contacter l'association ASCI à l'adresse suivante : <a href="mailto:asci-asso@outlook.fr">asci-asso@outlook.fr</a>.</p>
        </div>
        <div class="col-12 text-center">
            <img src="image/image-accueil.png" class="img-fluid" width="400" height="auto">
        </div>
    </div>
    

    
</div>

<?php require 'element/footer.php'; ?>