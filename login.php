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
    if (!empty($_POST['student'])) {
        // CONNEXION ETUDIANT
        // stockage de la requete de récupération des logins de l'utilisateur selon son l'email rentré
        $query = $pdo->prepare('SELECT PASSWORD, ROLE, EMAIL FROM chopin_user WHERE EMAIL = :email');
        $query->execute([
            'email' => 'student@outlook.fr'
        ]);
        // stockage des données récupérées
        $utilisateur = $query->fetchAll();

        session_start();
        $_SESSION['connecte'] = 1;
        $_SESSION['email'] = $utilisateur[0]['EMAIL'];
        $_SESSION['role'] = $utilisateur[0]['ROLE'];
        redirection_role();
        
        exit();

    } elseif (!empty($_POST['professor'])) {
        // CONNEXION PROFESSEUR
        // stockage de la requete de récupération des logins de l'utilisateur selon son l'email rentré
        $query = $pdo->prepare('SELECT PASSWORD, ROLE, EMAIL FROM chopin_user WHERE EMAIL = :email');
        $query->execute([
            'email' => 'professor@outlook.fr'
        ]);
        // stockage des données récupérées
        $utilisateur = $query->fetchAll();

        session_start();
        $_SESSION['connecte'] = 1;
        $_SESSION['email'] = $utilisateur[0]['EMAIL'];
        $_SESSION['role'] = $utilisateur[0]['ROLE'];
        redirection_role();
        
        exit();

    } elseif (!empty($_POST['admin'])) {
        // CONNEXION ADMINISTRATEUR LYCEE
        // stockage de la requete de récupération des logins de l'utilisateur selon son l'email rentré
        $query = $pdo->prepare('SELECT PASSWORD, ROLE, EMAIL FROM chopin_user WHERE EMAIL = :email');
        $query->execute([
            'email' => 'admin@outlook.fr'
        ]);
        // stockage des données récupérées
        $utilisateur = $query->fetchAll();

        session_start();
        $_SESSION['connecte'] = 1;
        $_SESSION['email'] = $utilisateur[0]['EMAIL'];
        $_SESSION['role'] = $utilisateur[0]['ROLE'];
        redirection_role();
        
        exit();

    } elseif (!empty($_POST['grandest'])) {
        // CONNEXION GRANDEST
        // stockage de la requete de récupération des logins de l'utilisateur selon son l'email rentré
        $query = $pdo->prepare('SELECT PASSWORD, ROLE, EMAIL FROM chopin_user WHERE EMAIL = :email');
        $query->execute([
            'email' => 'grandest@outlook.fr'
        ]);
        // stockage des données récupérées
        $utilisateur = $query->fetchAll();

        session_start();
        $_SESSION['connecte'] = 1;
        $_SESSION['email'] = $utilisateur[0]['EMAIL'];
        $_SESSION['role'] = $utilisateur[0]['ROLE'];
        redirection_role();
        
        exit();

    }
}

// titre de l'onglet et ajout du header
$title= 'Connexion';
require 'element/header.php';
?>

<div class="container">
    <div class="row">

        <!-- Boutons pour chaque rôle utilisateur -->
        <div class="col-md-12">
            <div class="alert alert-success text-center">
                <h4>
                Pour simplifier la visite du site, le formulaire de connexion a été désactivé. 
                Vous pouvez cependant choisir selon quel rôle visualiser sur le site.
                </h4>
                <form action="" method="POST">
                    <input type="submit" class="btn btn-info" name ="student" value="Etudiant">
                    <input type="submit" class="btn btn-info" name ="professor" value="Professeur">
                    <input type="submit" class="btn btn-info" name ="admin" value="Administrateur lycée">
                    <input type="submit" class="btn btn-info" name ="grandest" value="Grand-Est">
                </form>
            </div>
        </div>
        <div class="col-md-6 mt-4">
            <h4>Se connecter</h4>

            <!-- Affichage de l'erreur -->
            <?php if ($erreur): ?>
            <div class="alert alert-danger text-center">
                <?= $erreur ?>
            </div>
            <?php endif; ?>

            <!-- Formulaire de connexion -->
            <div class="form-group">  
                <input class="form-control" type="text" name="mail" placeholder="Adresse mail">
            </div>
            <div class="form-group">
                <input class="form-control" type="password" name="motdepasse" placeholder="Mot de passe">
            </div>
            <button type="submit" class="btn btn-info">Se connecter</button>              
            
        </div>

        <div class="col-md-6 mt-4">
        <!-- Description -->
            <h4>Nouveau sur le site ?</h4>
            <h5>Étudiants</h5>
            <p>Vous pouvez dés à présent vous créer un compte en remplissant le formulaire d'enregistrement disponible sur le lien ci-dessous.</p>
            <a href="./register.php">S'enregistrer</a>
            <br><br><h5>Enseignants</h5>
            <p>En tant qu'enseignant, pour consulter les informations sur l'équipement informatique de vos élèves vous devez disposer d'un compte préalablement créé par votre l'administrateur de ce site.</p>
            <p>Si ce n'est pas le cas, vous pouvez contacter l'association ASCI à l'adresse suivante : <a href="mailto:asci-asso@outlook.fr">asci-asso@outlook.fr</a>.</p>

            <div class="alert alert-success text-center">
                <p>
                    Dans l'utilisation de ce site, il est prévu que les professeurs, les administrateurs lycée et le personnel Grand-Est auraient un compte déjà créé.
                </p>
            </div>
        </div>
        <div class="col-12 text-center">
            <img src="image/image-accueil.png" class="img-fluid" width="400" height="auto">
        </div>
    </div> 
</div>

<?php require 'element/footer.php'; ?>