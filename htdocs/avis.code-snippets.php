<!--
Nom : avis
Rôle : formulaire d'avis pour ma page WordPress
Auteur : Louane Caris
Version : V1 du 25/03/2026
Licence : Réalisé dans le cadre du cours d'Informatique fondamentale
Compilation : code-snippets / WordPress
-->

<?php

function shortcode_avis() {

    // Activation de la mise en mémoire tampon
    ob_start();
    ?>
    <div class="table_avis">
        <h3>Avis</h3>
        
        <?php
        try {
            // Connexion à la base de données avec PDO
            $pdo = new PDO("mysql:host=localhost;dbname=bd_wp_blog;charset=utf8mb4", "root", "");

            // Active les erreurs PDO en mode exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Variables pour les messages utilisateurs
            $success = $error = "";
            
            // Permet de vérifier si le formulaire a été soumis (avec la méthode POST)
            if ($_SERVER["REQUEST_METHOD"] === "POST") {

                // On récupère et nettoie les données
                $nom = trim($_POST["nom"] ?? "");
                $email = trim($_POST["email"] ?? "");
                $date_visite = trim($_POST["date_visite"] ?? "");
                $note = (int)($_POST["note"] ?? 0);
                $message = trim($_POST["message"] ?? "");

                // Permet de vérifier la longueur du nom
                if (strlen($nom) === 0 || strlen($nom) > 100) {
                    $error = "Nom : 1-100 caractères max";
                
                // Permet de vérifier si l'email est valide
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 150) {
                    $error = "Email invalide (max 150 caractères)";

                // Permet de vérifier le format de la date
                } elseif (!DateTime::createFromFormat('Y-m-d', $date_visite)) {
                    $error = "Date invalide (AAAA-MM-JJ)";

                // Permet de vérifier que la note est bien entre 1 et 10
                } elseif ($note < 1 || $note > 10) {
                    $error = "Note : 1-10";

                // Permet de vérifier que le message est non vide
                } elseif (strlen($message) === 0) {
                    $error = "Message obligatoire";

                } else {

                    // Permet de vérifier pour savoir si le nom existe déjà 
                    $check = $pdo->prepare("SELECT nom FROM avis WHERE nom = ?");
                    $check->execute([$nom]);

                    if ($check->rowCount() > 0) {
                        $error = "Ce nom existe déjà";

                    } else {
                        
                        // La requête est préparée pour éviter les injections SQL
                        $stmt = $pdo->prepare("INSERT INTO avis (nom, email, date_visite, note, message) VALUES (?, ?, ?, ?, ?)");

                        // Exécute l'insertion
                        if ($stmt->execute([$nom, $email, $date_visite, $note, $message])) {
                            $success = '<div class="alert alert-success mb-3">✅ Avis enregistré !</div>';
                        } else {
                            $error = "Erreur insertion";
                        }
                    }
                }
            }
        } catch (PDOException $e) {
            // Permet de gérer les erreurs de base de données
            $error = "Erreur DB : " . $e->getMessage();
        }
        ?>

        <!-- Affichage des messages -->
        <?php if ($success): echo $success; endif; ?>
        <?php if ($error): echo '<div class="alert alert-danger mb-3">' . $error . '</div>'; endif; ?>
        
        <!-- Formulaire -->
        <form method="POST" class="row g-3 mb-4">

            <!-- Nom -->
            <div class="col-md-3">
                <input class="form-control" name="nom" placeholder="Nom (max 100)" maxlength="100" required>
            </div>

            <!-- Email -->
            <div class="col-md-3">
                <input class="form-control" name="email" type="email" placeholder="Email" maxlength="150" required>
            </div>

            <!-- Date -->
            <div class="col-md-2">
                <input class="form-control" name="date_visite" type="date" required>
            </div>

            <!-- Note -->
            <div class="col-md-2">
                <select class="form-select" name="note" required>
                    <option value="">Note</option>

                    <!-- Permet de générer de façon dynamique, les notes de 1 à 10 -->
                    <?php for($i=1; $i<=10; $i++): ?>
                        <option value="<?=$i?>"><?=$i?>⭐</option>
                    <?php endfor; ?>
                </select>
            </div>

            <!-- Message -->
			<div class="col-md-3">
                <textarea class="form-control" name="message" placeholder="Message..." rows="6" style="min-height: 140px; resize: vertical; max-height: 250px;" required></textarea>
            </div>

            <!-- Bouton -->
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Envoyer</button>
            </div>
        </form>
        
        <!-- Affichage des avis -->

        <!-- Nombre total d'avis -->
        <h5>Avis reçus (<?= $pdo ? $pdo->query("SELECT COUNT(*) FROM avis")->fetchColumn() : 0 ?>):</h5>

        <?php if (isset($pdo)): 

            // Permet de récupérer les 10 derniers avis
            $avis = $pdo->query("SELECT * FROM avis ORDER BY date_visite DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
            
            if ($avis):

                // On parcourt les avis
                foreach($avis as $a): ?>

                    <div class="border p-3 mb-2 bg-light rounded">

                        <!-- Nom + date -->
                        <div class="d-flex justify-content-between">
                            <strong><?=htmlspecialchars($a['nom'])?></strong>
                            <span class="badge bg-info"><?=htmlspecialchars($a['date_visite'])?></span>
                        </div>

                        <!-- Message sécurisé -->
                        <div><?=nl2br(htmlspecialchars($a['message']))?></div>

                        <!-- Affichage des étoiles -->
                        <div class="mt-2">
                            <?php for($i=1; $i<=10; $i++): ?>
                                <?= ($i <= $a['note']) ? '<span class="text-warning">⭐</span>' : '<span class="text-muted">☆</span>' ?>
                            <?php endfor; ?>

                            <small class="text-muted">(<?=$a['note']?>/10)</small>
                        </div>

                    </div>

                <?php endforeach;

            else: ?>

                <!-- Aucun avis -->
                <div class="alert alert-info">Soyez le premier à donner votre avis !</div>
            <?php endif;

        endif; ?>
    </div>

    <!-- CSS -->
    <style>

        /* Styles des messages */
        .alert { padding: 12px; margin-bottom: 15px; border-radius: 5px; border: none; }
        .alert-success { background: #d4edda; color: #155724; }
        .alert-danger { background: #f8d7da; color: #721c24; }
        .alert-info { background: #d1ecf1; color: #0c5460; }

        /* Style des champs */
	    .table_avis .form-control {
    	    border-radius: 8px;
	    }

        /* Style textarea */
	    .table_avis textarea {
    	    font-family: inherit;
    	    font-size: 14px;
    	    line-height: 1.5;
	    }

    </style>

    <?php

    // Retourne tout le contenu HTML généré
    return ob_get_clean();
}

// Enregistre le shortcode WordPress [avis]
add_shortcode('avis', 'shortcode_avis');
