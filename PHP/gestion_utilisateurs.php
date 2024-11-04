<?php
/** 
 * @version PHP 8.3.7
 */
// Chemin du fichier JSON
$fichierjson = '../JSON/utilisateurs.json';

// Montrer tous les utilsateurs contenus dans utlisateurs.json
function montrerUtilisateurs($fichierjson)
{
    if (file_exists($fichierjson)) {
        $donnees = file_get_contents($fichierjson);
        $donneesdecode = json_decode($donnees, true);
        return $donneesdecode['utilisateurs'];
    }
    return [];
}

// Ajouter les paramètres dans le fichier JSON
function ajouterUtilisateurs($fichierjson, $utilisateurs)
{
    $donnees = ['utilisateurs' => $utilisateurs];
    file_put_contents($fichierjson, json_encode($donnees, JSON_PRETTY_PRINT));
}

// Ajouter un utilisateur
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];

    // Ajouter les paramètres dans la liste des utilisateurs
    $utilisateurs = montrerUtilisateurs($fichierjson);
    $utilisateurs[] = ["nom" => $nom, "prenom" => $prenom, "email" => $email];
    ajouterUtilisateurs($fichierjson, $utilisateurs);
}

// Inscrire l'email de l'utilisateur pour le supprimer
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['supprimer'])) {
    $emailASupprimer = $_POST['emailasupprimer'];

    $utilisateurs = montrerUtilisateurs($fichierjson);
    $utilisateurs = array_filter($utilisateurs, function ($user) use ($emailASupprimer) {
        return $user['email'] !== $emailASupprimer;
    });

    ajouterUtilisateurs($fichierjson, $utilisateurs);
}

// La variable $utilisateurs permet maintenant de montrer les utilisateurs du fichier json
$utilisateurs = montrerUtilisateurs($fichierjson);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gestion des utilisateurs</title>
</head>

<body>
    <!-- Afficher tous les utilsateurs (leurs paramètres) sous forme de tableau -->
    <h1>Liste des utilisateurs</h1>
    <table>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
        </tr>
        <?php foreach ($utilisateurs as $utilisateur): ?>
            <tr>
                <td><?php echo htmlspecialchars($utilisateur['nom']); ?></td>
                <td><?php echo htmlspecialchars($utilisateur['prenom']); ?></td>
                <td><?php echo htmlspecialchars($utilisateur['email']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <!-- Formulaire pour ajouter un utilisateur via son nom, son prénom et son email -->
    <h2>Ajouter un utilisateur</h2>
    <form method="POST">
        <input type="text" name="nom" placeholder="Nom" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="ajouter">Ajouter</button>
    </form>
    <!-- Formulaire pour supprimer un utilisateur via son email -->
    <h2>Supprimer un utilisateur</h2>
    <form method="POST">
        <input type="email" name="emailasupprimer" placeholder="Email de l'utilisateur à supprimer" required>
        <button type="submit" name="supprimer">Supprimer</button>
    </form>
</body>

</html>