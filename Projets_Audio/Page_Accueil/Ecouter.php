<?php

// Vérifier si le paramètre 'file' est passé dans l'URL
if (isset($_GET['file'])) {
    $file = $_GET['file']; // Récupérer le nom du fichier audio passé en paramètre

    
    $dossier = $file;
    $dossier_modifie = str_replace("/", "\\\\", $dossier);
    
 playAudioFromSource($dossier);
 
} else {
    echo "Erreur : Aucun fichier spécifié.";
}

function playAudioFromSource($source) {
   
    // Concatenation du chemin complet du fichier audio
    $sourcePath = $source;

    // Vérifier si le fichier source existe
    if (file_exists($sourcePath)) {
        // Spécifier les en-têtes pour l'audio
        header("Content-Type: audio/wav");
        header("Content-Disposition: inline; filename=\"" . basename($source) . "\"");

        // Ouvrir le fichier source en mode lecture binaire
        $file = fopen($sourcePath, "rb");

        // Lire et envoyer le contenu du fichier en morceaux (par exemple, 8 Ko à la fois)
        while (!feof($file)) {
            echo fread($file, 8192); // 8 Ko par bloc
        }

        // Fermer le fichier après l'envoi
        fclose($file);
    } else {
        // Si le fichier n'existe pas, afficher un message d'erreur
        echo "Erreur : Le fichier n'existe pas ❌";
    }
}



?>
