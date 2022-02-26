<?php
// variables de stockage des erreurs/validations
$erreur = null;
$valide = null;

// si l'utilisateur est déjà connecté
require_once 'function/auth.php';
if (est_connecte()) {
    redirection_role();
}

// instanciation du formulaire
require_once 'class/form.php';
$form = new Form();
// récupération des constantes
require_once 'data/constantes.php';
$choices = CHOICES;

// fichier d'appel de la base de données
require 'function/callPDO.php';

// ENVOI DU FORMULAIRE //
// verification que tous les champs sont remplis
if(!empty($_POST)){
    if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['ine']) && !empty($_POST['date']) && !empty($_POST['option']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['verifypassword'])){ 
        if(preg_match('/^[-a-zA-Zç]+$/', $_POST['firstname'])){
            if(preg_match('/^[-a-zA-Zç]+$/', $_POST['lastname'])){
                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){                   
                    if($_POST['password'] === $_POST['verifypassword']){
                        // connexion à la base de donnes
                        $pdo = getLoginPDO();
                        // vérification que l'email n'est
                        $query3 = $pdo->prepare('SELECT email FROM chopin_user WHERE email = ?');
                        $query3->execute([$_POST['email']]);
                        $email = $query3->fetch();
                        if(empty($email)){  

                            // ajout envoi email de confirmation
                            
                            // hachage du mot de passe
                            $options = [
                                'cost' => 12,
                            ];

                            $hashpass = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

                            // connexion à la base de données
                            $pdo = getRegisterPDO();

                            // ajout de l'utilisateur à la table chopin_user
                            $query1 = $pdo->prepare("INSERT INTO chopin_user(FIRSTNAME, LASTNAME, ROLE, EMAIL, PASSWORD) VALUES(:firstname, :lastname, :role, :email, :password)");
                            $query1->execute([
                                'firstname' => $_POST['firstname'],
                                'lastname' => $_POST['lastname'],
                                'role' => 'student',
                                'email' => $_POST['email'],
                                'password' => $hashpass
                            ]);

                            // ajout de l'utilisateur à la table student
                            $query2 = $pdo->prepare("INSERT INTO student(INE_NUMBER, EMAIL, BIRTHDAY, CLASS, CREATION_DATE, MODIFICATION_DATE, TOKEN) VALUES(:ine, :email, :birthday, :class, :cdate, :mdate, :token)");
                            $query2->execute([
                                'ine' => $_POST['ine'],
                                'email' => $_POST['email'],
                                'birthday' => $_POST['date'],
                                'class' => $_POST['option'],
                                'cdate' => date('Y-m-d H:i:s'),
                                'mdate' => date('Y-m-d H:i:s'),
                                'token' => $token
                            ]);

                            // message pour confirmer que le compte a été créé
                            $valide = "Votre compte a été créé. Vous allez recevoir un mail de confirmation.";
                        } else {
                            $erreur = 'Cet email est déjà utilisé';
                        }
                    }else{
                        $erreur = "Les mots de passe ne correspondent pas.";
                    }
                }else{
                    $erreur = "Veuillez entrer un email valide.";
                }
            }else{
                $erreur = "Veuillez rentrer un nom valide.";
            }
        }else{
            $erreur = "Veuillez rentrer un prénom valide.";
        }
    }else{
        $erreur = "Veuillez remplir tous les champs.";
    }
}

// titre de l'onglet et ajout du header
$title = 'Enregistrement';
require_once 'element/header.php';
?>

<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="alert alert-success text-center">
                <h4>
                Pour simplifier la visite du site, le formulaire d'enregistrement a été désactivé. 
                Vous pouvez choisir selon quel rôle visualiser sur le site en retournant sur la <a href="./login.php">page précédente</a>.
                </h4>
            
            </div>
        </div>

        <div class="col-md-6 mt-2">
            <h4>S'enregistrer</h4>
            <!-- Affichage de l'erreur -->
            <?php if ($erreur): ?>
            <div class="alert alert-danger text-center">
                <?= $erreur ?>
            </div>
            <?php endif; ?>
            <?php if (!empty($valide)): ?>
            <div class="alert alert-success text-center">
                <?= $valide ?>
                <a href="./login.php">Se connecter</a>
            </div>
            <?php endif; ?>
            
                <?php
                echo $form->input('firstname', 'text', 'Prénom');
                echo $form->input('lastname', 'text', 'Nom');
                echo $form->input('ine', 'text', 'Numéro INE');
                echo $form->input('date', 'Date', 'Date de naissance');
                echo $form->select('option', $choices, 'BTS');  
                echo $form->input('email', 'email', 'Email');
                echo $form->input('password', 'password', 'Mot de passe');
                echo $form->input('verifypassword', 'password', 'Confirmer votre mot de passe');
                echo $form->submit('button');
                ?>
        </div>
        <div class="col-md-6 mt-2">
            <h4>Mes informations</h4>
            <p>Les informations récoltées dans ce formulaire d'enregistrement seront consultables seulement par vos enseignants et par l'administration du lycée.</p>
            <p>Pour vous connecter, vous aurez besoin de votre adresse mail et du mot de passe saisi. Un mail de confirmation d'adresse mail vous sera envoyé après l'envoi du formulaire d'enregistrement.</p>
            <p> Vous possédez déjà un compte ? <a href="./login.php">Se connecter</a></p>
            <div class="col-12 mt-5 text-center">
                <img src="image/image-accueil.png" class="img-fluid" width="400" height="auto">
            </div>
        </div>
    </div>
</div>

<?php
require 'element/footer.php';
?>