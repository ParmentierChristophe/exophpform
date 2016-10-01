<?php
// variable nom
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$ville = htmlspecialchars($_POST['ville']);

// variable msg
$message = '';

if(isset($_POST["valider"]))
{
  // Le nom est-il rempli ?
  if(empty($_POST['nom']))
  {
    $message = '<p class="title">- *Veuillez indiquer votre nom svp ! -</p>';
  }
    // Le prenom est-il rempli ?
    elseif(empty($_POST['prenom']))
  {
    $message = '<p class="title">- *Veuillez indiquer votre prénom svp ! -</p>';
  }
    // Le sexe est-il rempli ?
    elseif(empty($_POST['sexe']))
  {
    $message = '<p class="title">- *Veuillez indiquer votre sexe svp ! -</p>';
  }
    // La ville est elle complété ?
    elseif(empty($_POST['ville']))
  {
    $message = '<p class="title">- *Indiquez votre Ville svp ! -</p>';
  }
  // cochez au moins 1 case ?

    elseif(empty($_POST['case']))
    {
      $message = '<p class="title">- *Indiquez au min. 1 loisir svp ! -</p>';

  }
  // validation du fichier envoyé
    elseif($_FILES["monfichier"]["error"] == 4) {
//means there is no file uploaded

      $message = '<p class="title">- *vous n\'avez pas envoyé votre cv ! -</p>';

    }

    elseif (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
    {
            // Testons si le fichier n'est pas trop gros
            if ($_FILES['monfichier']['size'] <= 1000000)
            {
                    // Testons si l'extension est autorisée
                    $infosfichier = pathinfo($_FILES['monfichier']['name']);
                    $extension_upload = $infosfichier['extension'];
                    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
                    if (in_array($extension_upload, $extensions_autorisees))
                    {
                            // On peut valider le fichier et le stocker définitivement
                      $message = '<p class="title2">- Merci ! L\'envoi a bien été effectué ! -</p>';
                    }else {
                      $message = '<p class="title">- *Je n\'accepte que les jpg, jpeg, gif, png -</p>';
                    }
            }
    }else {
      $message = '<p class="title">- *le fichier est trop volumineux (>1mb) ou n\'a pas le bon format (jpg,jpeg, gif, png) -</p>';
    }
}

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Formulaire</title>
    <link rel="stylesheet" href="style.css" media="screen">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700" rel="stylesheet">
  </head>
  <body>
<div class="back">

<div class="container">


      <form action="formulaire.php" method="POST" enctype="multipart/form-data">
      <p>
          <p><input type="text" name="nom" value="<?php if(isset($_POST['nom'])){ echo $_POST['nom'];} ?>" placeholder="Nom"/></p>

          <p><input type="text" name="prenom" value="<?php if(isset($_POST['prenom'])){ echo $_POST['prenom'];} ?>" placeholder="Prénom" /></p>

          <p>Votre âge:<br> <select name="age">
            <option value="age1">18 ans</option>
            <option value="age2">19 ans</option>
            <option value="age3">20 ans</option>
            <option value="age4">21 ans</option>
            <option value="age5">22 ans</option>
            <option value="age6">23 ans</option>
            <option value="age7">24 ans</option>
            <option value="age8">25 ans</option>
            <option value="age9">26 ans</option>
            <option value="age10">27 ans</option>
            <option value="age11">28 ans</option>
            <option value="age12">29 ans</option>
            <option value="age13">30 ans</option>
            <option value="age14">31 ans</option>
            <option value="age15">32 ans</option>
            <option value="age16">33 ans</option>
            <option value="age17">34 ans</option>
            <option value="age18">35 ans</option>
            <option value="age19">36 ans</option>
            <option value="age20">37 ans</option>
            <option value="age21">38 ans</option>
            <option value="age22">39 ans et + ...</option>
          </select></p>

          <p>Sexe:
            <input type="radio" name="sexe" value="oui" id="oui" /> <label for="oui">Homme</label>
            <input type="radio" name="sexe" value="non" id="non" /> <label for="non">Femme</label>
            <input type="radio" name="sexe" value="autres" id="autres" /> <label for="autres">autre</label>
          </p>

          <p><input type="text" name="ville" value="<?php if(isset($_POST['ville'])){ echo $_POST['ville'];} ?>" placeholder="Ville"/></p>

          <p>Loisirs:

          <input type="checkbox" name="case" id="sport" />
            <label for="sport">Sports</label>
          <input type="checkbox" name="case" id="art" />
            <label for="art">Arts</label>
          <input type="checkbox" name="case" id="tech" />
            <label for="tech">Technologies</label>
          <input type="checkbox" name="case" id="livre" />
            <label for="livre">Livres</label>
          <input type="checkbox" name="case" id="music" />
            <label for="music">Musiques</label>
          <input type="checkbox" name="case" id="autre" />
            <label for="autre">Autres</label>
          </p>

            <p>
                    Votre fichier:
                    <input type="file" name="monfichier"/>
            </p>

          <input type="submit" value="Valider" name="valider" class="button" />
      </p>
          </form>

          <?php
      		if(isset($message))
      		{
      			echo $message;
      		}
      		?>
        </div>
      </div>
  </body>
</html>
