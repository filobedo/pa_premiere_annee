<?php
  include('header.php');
?>

<main>
    <h1 id="titre_contact" class="container-fluid"> Où nous sommes situés : <h1>
    <!-- <h3>À la place de ce texte il y aura l'adresse</h3> -->

    <?php
        $ville = "Puteaux";
        $adresse = '102 Terrasse Boieldieu';

        $ville_url = str_replace(' ', '+', $ville); // remplace espace par +
        $adresse_url = str_replace(' ', '+', $adresse); // remplace espace par +
        $MapCoordsUrl = urlencode($ville_url.'+'.$adresse_url); //url_encode : encodage pour URL
    ?>

    <section id="map">
        <iframe width=80% height="700" src="https://maps.google.fr/maps?q=<?php echo $MapCoordsUrl; ?>&amp;t=h&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" ></iframe>
    </section>

    <section>
        <!-- <label id="horaires" ><h3>Nos horaires: </h3></label> -->
        <!-- <label id="information_complementaire"><h3>Informations complémentaires: </h3></label> -->
    </section>

<?php
  include('footer.php');
?>
