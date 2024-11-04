<?php
/** 
 * @version PHP 8.3.7
 */
// Récupérer les paramètres via la méthode post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    echo $nom . "<br>";
    echo $email . "<br>";
    echo $message . "<br>";

    // Si aucun un des champs n'est pas remplis, alors le echo s'affiche

    if (!isset($_POST['nom']) || !isset($_POST['email']) || !isset($_POST['message'])) {
        echo "Les champs doivent être tous remplis.";
        exit;
    }



    // Pour envoyer un mail, spécifier les paramètres (destinataire,sujet...)
    $pour = 'test.ajout@gmaiL.com';
    $sujet = "Nouveau message de contact de $nom";
    $corps = "Nom: $nom\nEmail: $email\nMessage: $message";
    $entete = "Par: $email\r\n";

    if (mail($pour, $sujet, $corps, $entete)) {
        echo "<p>Message envoyé.</p>";
    } else {
        echo "<p>Erreur lors de l'envoi du message.</p>";
    }
} else {
    echo "Accès non autorisé.";
}
?>