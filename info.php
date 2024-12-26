<?php
// Variable pour stocker la liste des élèves pour chaque option
$eleves = [
    1 => ['Etud AA', 'Etud BB', 'Etud CC'],
    2 => ['Etud DD', 'Etud EE', 'Etud FF'],
    3 => ['Etud GG', 'Etud HH', 'Etud II'],
    4 => ['Etud JJ', 'Etud KK', 'Etud LL'],
    5 => ['Etud MM', 'Etud NN', 'Etud OO'],
    6 => ['Etud PP', 'Etud QQ', 'Etud RR'],
    7 => ['Etud SS', 'Etud TT', 'Etud UU'],
    8 => ['Etud VV', 'Etud WW', 'Etud XX']
];

// Variable pour l'emploi du temps
$emploi_du_temps = [
    'Lundi' => '',
    'Mardi' => '',
    'Mercredi' => '',
    'Jeudi' => '',
    'Vendredi' => ''
];

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $choix = $_POST['choix']; // Choix de l'utilisateur (listes ou emploi du temps)
    
    if ($choix === 'eleves') {
        // Si l'utilisateur veut consulter les élèves, on demande un nombre entre 1 et 8
        $numero_groupe = (int)$_POST['groupe'];

        // Vérifier si le groupe est valide
        if ($numero_groupe >= 1 && $numero_groupe <= 8) {
            $eleves_du_groupe = $eleves[$numero_groupe];
        } else {
            $message = "Veuillez entrer un nombre valide entre 1 et 8.";
        }
    } elseif ($choix === 'emploi') {
        // Si l'utilisateur veut voir l'emploi du temps, afficher l'emploi du temps vide
        $emploi_du_temps_affiche = $emploi_du_temps;
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter les élèves ou l'emploi du temps</title>
</head>
<body>

    <h1>Bienvenue sur la page de consultation</h1>

    <form action="info.php" method="POST">
        <label for="choix">Que voulez-vous consulter ?</label><br>
        <input type="radio" id="eleves" name="choix" value="eleves" required>
        <label for="eleves">Les listes de mes élèves</label><br>
        
        <input type="radio" id="emploi" name="choix" value="emploi" required>
        <label for="emploi">Mon emploi du temps</label><br><br>
        
        <input type="submit" value="Valider">
    </form>

    <?php if (isset($choix)): ?>
        <?php if ($choix === 'eleves'): ?>
            <h2>Consulter la liste des élèves</h2>
            <form action="info.php" method="POST">
                <label for="groupe">Entrez un numéro de groupe (1 à 8) :</label><br>
                <input type="number" id="groupe" name="groupe" min="1" max="8" required><br><br>
                <input type="hidden" name="choix" value="eleves">
                <input type="submit" value="Voir les élèves">
            </form>

            <?php if (isset($eleves_du_groupe)): ?>
                <h3>Liste des élèves du groupe <?php echo $numero_groupe; ?> :</h3>
                <ul>
                    <?php foreach ($eleves_du_groupe as $eleve): ?>
                        <li><?php echo $eleve; ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php elseif (isset($message)): ?>
                <p style="color: red;"><?php echo $message; ?></p>
            <?php endif; ?>

        <?php elseif ($choix === 'emploi'): ?>
            <h2>Emploi du temps</h2>
            <h3>Voici votre emploi du temps (Lundi à Vendredi) :</h3>
            <table border="1">
                <tr>
                    <th>Jour</th>
                    <th>Emploi du temps</th>
                </tr>
                <?php foreach ($emploi_du_temps_affiche as $jour => $emploi): ?>
                    <tr>
                        <td><?php echo $jour; ?></td>
                        <td><?php echo $emploi ?: 'Vide'; ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php endif; ?>
    <?php endif; ?>

</body>
</html>
