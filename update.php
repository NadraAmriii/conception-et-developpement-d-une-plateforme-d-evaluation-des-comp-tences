<?php
    
    require "database.php";
    $id = null;
    if( !empty($_GET['id'])){
        $id = $_REQUEST['id'];
    }

    if( null==$id){
        header("Location: add.php");
    }

    if ( !empty($_POST)){
        // les erreurs de validation
        $nameError = null;
        $emailError = null;
        $passwordError = null;

        // les valeurs du champ du formulaire
        $pseudo = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // validation des champs
        // validation du champs name
        $valid = true;
        if (empty($pseudo)){
            $nameError = 'Please enter Name';
            $valid = false;
        }

        //validation du champ email vide et respct de la symptaxe email
        if (empty($email)){
            $emailError = 'Please enter Email Address';
            $valid = false;
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }

        // validation du champs mobile
        if (empty($password)) {
            $passwordError = 'Please enter the password';
            $valid = false;
        }

        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE utilisateurs  set pseudo = ?, email = ?, password =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($pseudo,$email,$password,$id));
            Database::disconnect();
            header("Location: add.php");
        }
    }
    else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM utilisateurs where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $pseudo = $data['pseudo'];
        $email = $data['email'];
        $password = $data['password'];
        Database::disconnect();
    }
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Create user!</title>
</head>
<body>

<br><br>
<div class="container">
    <div class="row">
        <h1>Update a user</h1>
    </div>
    <br>
     <form class="form-horizontal" action="update.php?id=<?php echo $id?>" method="post">

        <div class="form-group <?php echo !empty($nameError)?'error':'';?>">
            <label class="control-label">Name</label>
            <div class="form-group">
                <input class="form-control" name="name" type="text"  placeholder="Name" value="<?php echo !empty($pseudo)?$pseudo:'';?>" style="width: 500px">
                <?php if (!empty($nameError)): ?>
                    <span class="help-inline"><?php echo $nameError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?php echo !empty($emailError)?'error':'';?>">
            <label class="control-label">Email Address</label>
            <div class="form-group">
                <input class="form-control" name="email" type="text"  placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>" style="width: 500px">
                <?php if (!empty($emailError)): ?>
                    <span class="help-inline"><?php echo $emailError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-group <?php echo !empty($passwordError)?'error':'';?>">
            <label class="control-label">Password</label>
            <div class="form-group">
                <input class="form-control" name="password" type="text"  placeholder="Password" value="<?php echo !empty($password)?$password:'';?>" style="width: 500px">
                <?php if (!empty($passwordError)): ?>
                    <span class="help-inline"><?php echo $passwordError;?></span>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-success">Update</button>
            <a class="btn btn-primary" href="add.php">Back</a>
        </div>
    </form>
</div> <!-- /container -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="js/jquery-3.3.1.slim.min.js" ></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>