<?php 
    require_once 'config.php'; // On inclu la connexion à la bdd

    // Si les variables existent et qu'elles ne sont pas vides
    if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_password']))
    {
        // Patch XSS
        $username = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $confirm_password = htmlspecialchars($_POST['confirm_password']);

        // On vérifie si l'utilisateur existe
        $check = $bdd->prepare('SELECT username, email, password FROM login WHERE email = ?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        $email = strtolower($email); // on transforme toute les lettres majuscule en minuscule pour éviter que Foo@gmail.com et foo@gmail.com soient deux compte différents ..
        
        // Si la requete renvoie un 0 alors l'utilisateur n'existe pas 
        if($row == 0){ 
            if(strlen($username) <= 100){ // On verifie que la longueur du pseudo <= 100
                if(strlen($email) <= 100){ // On verifie que la longueur du mail <= 100
                    if(filter_var($email, FILTER_VALIDATE_EMAIL)){ // Si l'email est de la bonne forme
                        if($password === $confirm_password){ // si les deux mdp saisis sont bon

                            // On hash le mot de passe avec Bcrypt, via un coût de 12
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);
                            
                            // On stock l'adresse IP
                           // $ip = $_SERVER['REMOTE_ADDR']; 

                            // On insère dans la base de données
                            $insert = $bdd->prepare('INSERT INTO login(username, email, password) VALUES(:username, :email, :password)');
                            $insert->execute(array(
                                'username' => $username,
                                'email' => $email,
                                'password' => $password,
                                
                            ));
                            // On redirige avec le message de succès
                            header('Location:signup.php?reg_err=success');
                            die();
                        }else{ header('Location: signup.php?reg_err=password'); die();}
                    }else{ header('Location: signup.php?reg_err=email'); die();}
                }else{ header('Location: signup.php?reg_err=email_length'); die();}
            }else{ header('Location: signup.php?reg_err=username_length'); die();}
        }else{ header('Location: signup.php?reg_err=already'); die();}
    }