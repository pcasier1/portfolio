<?php
ini_set('display_errors', 0);
error_reporting(E_ALL);
header("Content-type: text/HTML; charset=utf-8");
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="portfolio" content="Page rélié à mon portfolio, présentant chacun de mes projets individuellement">
    <meta property="og:title" content="page projet portefolio Pierre CASIER">
    <meta property="og:url" content="http://perso.univ-lemans.fr/~i2300569/portefolioPierreCASIER-13F/galerie.php?nom=la-toile">
    <title>Projets Portfolio | Pierre CASIER</title>
    <link rel="shortcut icon" href="./image/icon-pc.ico" type="images/x-icon">
    <link rel="stylesheet" href="./css/style.css" type="text/css" />
</head>

<body>
    <header class="position">
        <nav class="navGalerie">
            <a href="index.php#projet" class="flecheNav"><img src="./image/fleche.svg" alt="fleche directionnelle"></a>
            <h1>Projet</h1>
            <a href="#intro">
                <img src="./image/icon-pc.ico" alt="PC, pour Pierre CASIER">
            </a>
        </nav>
    </header>
    <main>
        <section class="sectionGaleriePhp">
            <div class="blockConteneur">
                <?php
                $lecteur = new SplFileObject("./private/indexGalerie.csv", 'r');
                while ($lecteur->eof() == false) {
                    $ligne = $lecteur->fgets();
                    if ($ligne != "") {

                        $tabGalerie = explode(";", $ligne);
                        $imageGalerie = $tabGalerie[0];
                        $titre1 = $tabGalerie[1];
                        $titre2 = $tabGalerie[2];
                        $nom = $tabGalerie[3];
                        $titreDesTextes1 = $tabGalerie[4];
                        $texte1 = $tabGalerie[5];
                        $texte2 = $tabGalerie[6];
                        $texte3 = $tabGalerie[7];
                        $photo1 = $tabGalerie[8];
                        $photo2 = $tabGalerie[9];
                        $photo3 = $tabGalerie[10];
                        $description1 = $tabGalerie[11];
                        $description2 = $tabGalerie[12];
                        $description3 = $tabGalerie[13];
                        //3 images
                        if ($_GET["nom"] == $nom) {
                ?>
                            <div class="titreGaleriePhp">
                                <h2><?php echo ($titre1) ?></h2>
                                <h3><?php echo ($titre2) ?></h3>
                            </div>
                            <div class="contenuGaleriePhp">
                                <div class="texteGaleriePhp">
                                    <h4><?php echo ($titreDesTextes1) ?></h4>
                                    <p><?php echo ($texte1) ?></p>
                                </div>
                                <div>
                                    <?php
                                    if ($_GET["nom"] == "la-toile") {
                                        echo ('<iframe width="600" height="338" src="https://www.youtube.com/embed/aq5-E4HmvKA?si=ib35acfGC9lczzXa" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>');
                                    } else if ($_GET["nom"] == "les-des-sont-jetes") {
                                        echo ('<iframe width="600" height="338" src="https://www.youtube.com/embed/T3SGTfNn3UE?si=WApBEIPHlVpV_fHo" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen ></iframe>');
                                    } else if ($_GET["nom"] == "multi-edit") {
                                        echo ('<video width="600" height="338" preload="metadata" controls poster="Arcane.webp" alt="echo($photo1)">
                                        <source src="./video/arcaneVideo.mp4">
                                    </video>');
                                    } else {
                                    ?>
                                        <img class="imageGaleriePhp" src="./image/<?php echo ($photo1) ?>.webp" alt="<?php echo ($description1) ?>">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="contenuGaleriePhp">
                                <div>
                                    <img class="imageGaleriePhp" src="./image/<?php echo ($photo2) ?>.webp" alt="<?php echo ($description2) ?>">
                                </div>
                                <div class="texteGaleriePhp">
                                    <h4>Présentation détaillée</h4>
                                    <p><?php echo ($texte2) ?></p>
                                </div>
                            </div>
                            <div class="contenuGaleriePhp">
                                <div class="texteGaleriePhp">
                                    <h4>Les outils utilisés</h4>
                                    <p><?php echo ($texte3) ?></p>
                                </div>
                                <div>
                                    <img class="imageGaleriePhp" src="./image/<?php echo ($photo3) ?>.webp" alt="<?php echo ($description3) ?>">
                                </div>
                            </div>


                <?php
                        } //  else {
                        //     echo ("erreur 404, essayer de revenir en arrirère !");
                        // }
                    }
                }
                $lecteur = null;
                ?>
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

</body>

</html>