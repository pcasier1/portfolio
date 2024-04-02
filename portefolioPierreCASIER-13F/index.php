<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
header("Content-type: text/HTML; charset=utf-8");


if (isset($_GET["nom"]) && isset($_GET["adresseMail"])) {
    if (($_GET["nom"] != "") && ($_GET["adresseMail"] != "")) {
        require(__DIR__ . "/src/PHPMailer.php"); // Ajoute le fichier contenant le code de la classe PHPMailer
        require(__DIR__ . "/src/SMTP.php"); // le code de la classe SMTP
        require(__DIR__ . "/src/Exception.php"); // le code de la classe Exception
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        // Configuration du serveur SMTP
        $mail->SMTPDebug = 0; // Active/désactive les messages de mise au point
        $mail->isSMTP(); // Utilise le protocole SMTP
        $mail->Host = "smtp.gmail.com"; // Configure le nom du serveur SMTP
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS; // Active le cryptage sécurisé TLS
        $mail->Port = 465; // Configure le numéro de port
        $mail->SMTPAuth = true; // Active le mode authentification
        $mail->Username = "picasier.pro@gmail.com"; // Identifiant du compte SMTP
        $mail->Password = "tvhn ejip dvng emxc "; // Mot de passe du compte SMTP

        // Destinataires
        $mail->setFrom("picasier.pro@gmail.com", "Mailer");
        $mail->addAddress("picasier.pro@gmail.com", "Pierre Casier"); // Ajout du destinataire
        // Contenu du mail
        $mail->isHTML(true);
        $mail->Subject = "Formulaire de contact: " . $_GET["sujet"];
        $mail->Body = $_GET["nom"] . $_GET["prenom"] . " ,vous a envoyé un message <br/>" . $_GET["mess"];
        $mail->CharSet = PHPMailer\PHPMailer\PHPMailer::CHARSET_UTF8;

        $retourMail = "";
        if ($mail->send() != false) {
            $retourMail = "Le message a bien été envoyé.";
        } else {
            echo ("Le message n'a pas été envoyé.\n");
        }
    }
}


if (isset($_GET["parcours"]) == true) {
    $parcours = $_GET["parcours"];
    if ($_GET["parcours"] > 2) {
        $parcours = 0;
    }
} else {
    $parcours = 0;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="portfolio" content="Un portfolio dans lequel je me présente. L'objectif étant de parler 
    de mon parcours jusqu'à aujourd'hui, de mes compétences et de mes passions. En bref, cela vous permettra 
    (futur patron/ patronne) d'en savoir plus sur mon profil !">
    <meta property="og:title" content="Portefolio Pierre CASIER">
    <meta property="og:url" content="http://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/">
    <title>Portfolio | Pierre CASIER</title>
    <link rel="shortcut icon" href="./image/icon-pc.ico" type="images/x-icon">
    <link rel="stylesheet" href="./css/style.css" type="text/css" />
</head>

<body>
    <header>
        <nav>
            <a href="#intro">
                <img src="./image/icon-pc.ico" alt="PC, pour Pierre CASIER">
            </a>
            <ul>
                <li>
                    <a href="#presentation">Présentation</a>
                </li>
                <li>
                    <a href="#projet">Projets</a>
                </li>
                <li>
                    <a href="#competence">Compétences</a>
                </li>
                <li>
                    <a href="#inspi">Inspirations</a>
                </li>
                <li>
                    <a href="#contact">Contact</a>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="intro">
            <div class="intro">
                <div class="textIntro">
                    <h1>Pierre CASIER</h1>
                    <h2>étudiant en 1ère année MMI</h2>
                </div>
                <a href="#presentation" class="flecheIntro">
                    <img src="./image/fleche.svg" alt="fleche pour accéder à la section suivante">
                </a>
            </div>

        </section>

        <section id="presentation">
            <?php
            $lecteur = new SplFileObject("./private/parcours.csv", 'r');
            $compteur = 0;
            $lignecourante = '';
            while (!($lecteur->eof()) &&  $compteur <= $parcours) { ///sélectionner la bonne ligne
                $ligne = $lecteur->fgets();
                $compteur++;
                $lignecourante = $ligne;
            }
            if ($lignecourante != "") {
                $tabParcours = explode(";", $lignecourante);
                $imageParcours = $tabParcours[0];
                $descriptionimg = $tabParcours[1];
                $titreParcours = $tabParcours[2];
                $texteParcours1 = $tabParcours[3];
                $texteParcours2 = $tabParcours[4];
                $texteParcours3 = $tabParcours[5];

            ?>
                <div class="parcours">
                    <img class="imageParcours transition" src="./image/<?php echo ($imageParcours) ?>.webp" alt="<?php echo ($descriptionimg) ?>">
                    <div class="texteParcours">
                        <h2><?php echo ($titreParcours); ?></h2>
                        <p>
                            <?php echo ($texteParcours1); ?>
                        </p>
                        <p>
                            <?php echo ($texteParcours2); ?>
                        </p>
                        <p>
                            <?php echo ($texteParcours3); ?>
                        </p>

                        <a class="bouttonParcours transition" href="?parcours=<?php echo ($parcours + 1) ?>#presentation">En apprendre plus...</a>
                    </div>
                </div>
            <?php


            }
            $lecteur = null;
            ?>

        </section>
        <section id="projet">
            <div class="boxProjet">
                <a href="#projet" class="titreSection">
                    <h2>Mes Projets</h2>
                </a>
            </div>
            <div class="galerieTest">
                <div class="mz-gallery-container">
                    <h2><strong>Extra-</strong>scolaire</h2>
                    <div class="mz-gallery">
                        <?php
                        $lecteur = new SplFileObject("./private/indexGalerie.csv", 'r');
                        while ($lecteur->eof() == false) {
                            $ligne = $lecteur->fgets();
                            if ($ligne != "") {
                                $tabGalerie = explode(";", $ligne);
                                $imageGalerie = $tabGalerie[0];
                                $texteh3 = $tabGalerie[1];
                                $texteh4 = $tabGalerie[2];
                                $nom = $tabGalerie[3];
                                /*if($_GET["nom"]==$nom){}*/
                        ?>
                                <a href="galerie.php?nom=<?php echo ($nom); ?>">
                                    <figure><img src="./image/<?php echo ($imageGalerie) ?>.webp" alt="">
                                        <figcaption>
                                            <h3><?php echo ($texteh3) ?></h3>
                                            <h4><?php echo ($texteh4) ?></h4>
                                        </figcaption>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </figure>
                                </a>
                        <?php
                            }
                        }
                        $lecteur = null;
                        ?>
                    </div>
                </div>
            </div>
            <div class="galerieTest">
                <div class="mz-gallery-container">
                    <h2><strong>Scolaire</strong></h2>
                    <div class="mz-gallery">
                        <?php
                        $lecteur = new SplFileObject("./private/galerieScolaire.csv", 'r');
                        while ($lecteur->eof() == false) {
                            $ligne = $lecteur->fgets();
                            if ($ligne != "") {
                                $tabGalerie = explode(";", $ligne);
                                $imageGalerie = $tabGalerie[0];
                                $texteh3 = $tabGalerie[1];
                                $texteh4 = $tabGalerie[2];
                                $nom = $tabGalerie[3];
                                /*if($_GET["nom"]==$nom){}*/
                        ?>
                                <a href="galerieScolaire.php?nom=<?php echo ($nom); ?>">
                                    <figure><img src="./image/<?php echo ($imageGalerie) ?>.webp" alt="" max-width="350" max-height="350" >
                                        <figcaption>
                                            <h3><?php echo ($texteh3) ?></h3>
                                            <h4><?php echo ($texteh4) ?></h4>
                                        </figcaption>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </figure>
                                </a>
                        <?php
                            }
                        }
                        $lecteur = null;
                        ?>
                    </div>
                </div>
            </div>

        </section>
        <section id="competence">
            <div class="mesCompetence">
                <a href="#competence" class="titreSection">
                    <h2>Mes Compétences</h2>
                </a>
            </div>
            <div class="blockDeCompetence">
                <div class="info-cine">
                    <h3>Informatique</h3>
                    <ul>
                        <?php
                        $lecteur = new SplFileObject("./private/competenceInformatique.csv", 'r');
                        while ($lecteur->eof() == false) {
                            $ligne = $lecteur->fgets();
                            if ($ligne != "") {
                                $tabCompetence = explode(";", $ligne);
                                array_unique($tabCompetence);
                                $nomCompetence = $tabCompetence[0];
                                $numCompetence = $tabCompetence[1];
                        ?>
                                <li>
                                    <h4><?php echo ($nomCompetence) ?></h4>
                                    <progress class="bar" max="100" value="<?php echo ($numCompetence) ?>"></progress>
                            <?php
                            }
                        }
                        $lecteur = null;
                            ?>
                    </ul>
                </div>
                <div class="info-cine">
                    <h3>Audio-visuel</h3>
                    <ul>
                        <?php
                        $lecteur = new SplFileObject("./private/competenceAudioVisuel.csv", 'r');
                        while ($lecteur->eof() == false) {
                            $ligne = $lecteur->fgets();
                            if ($ligne != "") {
                                $tabCompetence = explode(";", $ligne);
                                array_unique($tabCompetence);
                                $nomCompetence = $tabCompetence[0];
                                $numCompetence = $tabCompetence[1];
                        ?>
                                <li>
                                    <h4><?php echo ($nomCompetence) ?></h4>
                                    <progress class="bar" max="100" value="<?php echo ($numCompetence) ?>"></progress>
                                </li>
                        <?php
                            }
                        }
                        $lecteur = null;
                        ?>
                    </ul>
                </div>
            </div>
            <table class="tableauCompetence">
                <thead>
                    <tr>
                        <th colspan="1">Qualités</th>
                        <th colspan="1">Défaults</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Créatif</td>
                        <td>Obstiné</td>
                    </tr>
                    <tr>
                        <td>Investi</td>
                        <td>Honnête</td>
                    </tr>
                    <tr>
                        <td>soucieux de bien faire</td>
                        <td>Arrive pile à l'heure</td>
                    </tr>
                    <tr>
                        <td>Sportif</td>
                        <td>Organisation</td>
                    </tr>
                </tbody>
            </table>
            <div class="einstein">
                <p><cite>"Si la vue d'un bureau encombré évoque un
                        esprit encombré alors que penser de celle d'un bureau
                        vide ?"</cite> Albert Einstein.</p>
            </div>



        </section>
        <section id="inspi">
            <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">

            <div class="mesCompetence">
                <a href="#competence" class="titreSection">
                    <h2>Mes Inspirations</h2>
                </a>
            </div>

            <div class="gallery">
                <div class="gallery__column">
                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/IMG-20231225-WA0047.jpg" alt="Ma famille" class="gallery__image">
                            <figcaption class="gallery__caption">Ma famille</figcaption>
                        </figure>
                    </a>

                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/Caspar_David_Friedrich_-_Wanderer_above_the_sea_of_fog.jpg" alt="Portrait by Oladimeji Odunsi" class="gallery__image">
                            <figcaption class="gallery__caption">Le Voyageur contemplant une mer de nuages - Friedrich
                            </figcaption>
                        </figure>
                    </a>

                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/taransiteweb.jpg" alt="Quentin Tarantino - réalisateur" class="gallery__image">
                            <figcaption class="gallery__caption">Quentin Tarantino - réalisateur</figcaption>
                        </figure>
                    </a>
                </div>

                <div class="gallery__column">
                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/leemage_cor18385-964x967.jpg" alt="Le baisé - Klimt" class="gallery__image">
                            <figcaption class="gallery__caption">Le baisé - Klimt</figcaption>
                        </figure>
                    </a>

                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/dosseh-villeneuve-la-garenne.png" alt="Dosseh rappeur" class="gallery__image">
                            <figcaption class="gallery__caption">Dosseh rappeur</figcaption>
                        </figure>
                    </a>

                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/bramhastra.rt.png" alt="3d - bramhastra.rt" class="gallery__image">
                            <figcaption class="gallery__caption">3D - bramhastra.rt</figcaption>
                        </figure>
                    </a>
                </div>

                <div class="gallery__column">
                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/72d8bf7_30301-jzg2qw.57co9a4i.png" alt="fight club" class="gallery__image">
                            <figcaption class="gallery__caption">F**** C****</figcaption>
                        </figure>
                    </a>

                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/Van_Gogh_-_Starry_Night_-_Google_Art_Project.jpg" alt="Nuit étoilée - Van Gogh" class="gallery__image">
                            <figcaption class="gallery__caption">Nuit étoilée - Van Gogh</figcaption>
                        </figure>
                    </a>


                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/sweater weather.jpg" alt="Sweater Weather" class="gallery__image">
                            <figcaption class="gallery__caption">Sweater Weather</figcaption>
                        </figure>
                    </a>

                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/rencontrer une fille.jpg" alt="J'ai rencontré une fille - stanlefantome" class="gallery__image">
                            <figcaption class="gallery__caption">J'ai rencontré une fille - stanlefantome</figcaption>
                        </figure>
                    </a>
                </div>

                <div class="gallery__column">
                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/thelmaetlouise.jpg" alt="Thelma et Louise - Ridley Scott" class="gallery__image">
                            <figcaption class="gallery__caption">Thelma et Louise - Ridley Scott</figcaption>
                        </figure>
                    </a>

                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/ferrell.jpg" alt="Will Ferrell - Comédien" class="gallery__image">
                            <figcaption class="gallery__caption">Will Ferrell - Comédien</figcaption>
                        </figure>
                    </a>

                    <a href="https://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/?#inspi" target="_blank" class="gallery__link">
                        <figure class="gallery__thumb">
                            <img src="./image/aumilieuriviere.jpg" alt="Au milieu coule une rivière - Redford" class="gallery__image">
                            <figcaption class="gallery__caption">Au milieu coule une rivière - Redford</figcaption>
                        </figure>
                    </a>

                </div>
            </div>



        </section>
        <section id="contact">
            <div class="blockContact transition">
                <div class="titreContact">
                    <h2>Me Contacter !</h2>
                </div>
                <form>
                    <fieldset>

                        <div>
                            <label for="id_nom">Nom</label>
                            <input id="id_nom" type="text" name="nom" size="40" placeholder="Entrez votre nom..." />
                        </div>
                        <div>
                            <label for="id_prenom">Prénom</label>
                            <input id="id_prenom" type="text" name="prenom" size="40" placeholder="Entrez votre prenom..." />
                        </div>

                        <div>
                            <label for="id_email">Email</label>
                            <input id="id_email" type="email" name="adresseMail" size="40" placeholder="Entrez votre e-mail..." required />
                        </div>
                        <div>
                            <label for="id_tel">Téléphone</label>
                            <input id="id_tel" type="tel" name="tel" size="40" placeholder="Entrez votre numéro de téléphone">
                        </div>

                        <div class="sujetContact">
                            <label for="id_sujet">Sujet</label>
                            <input id="id_sujet" type="text" name="sujet" size="40" placeholder="Entrez le sujet...">
                        </div>
                        <div class="sujetContact">
                            <label for="id_mess">Message</label>
                            <textarea class="messContact" id="id_mess" name="mess" placeholder="Entrez votre message"></textarea>
                        </div>


                        <input class="bouttonContact" type="submit" value="envoi" />
                        <input class="bouttonContact" type="reset" value="annulation" />

                    </fieldset>
                </form>
            </div>
        </section>
    </main>
    <footer>
        <div>
            <h3>Mail</h3>
            <p><a href="mailto:picasier.pro@gmail.com">picasier.pro@gmail.com</a></p>
            <p><a href="index.php#contact">Cliquez pour me contacter</a></p>
        </div>
        <div>
            <h3>Réseaux</h3>
            <p><a href="https://www.instagram.com/caill_cs/">Instagram</a></p>
            <p><a href="https://www.facebook.com/pi.casier/">Facebook</a></p>
            <p><a href="https://youtube.com/channel/UC0r3egYcApU1lB9rvucUW-g">Youtube</a></p>
        </div>
    </footer>
    <?php
    if ($retourMail != '') {
    ?>
        <div class="envoie">
            <p>
                <?php
                echo ($retourMail);
                ?>
            </p>
        </div>

    <?php
    }
    ?>

</body>

</html>