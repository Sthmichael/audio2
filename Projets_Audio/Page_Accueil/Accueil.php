<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";  // Remplacez par votre utilisateur MySQL
$password = "";  // Remplacez par votre mot de passe
$dbname = "audio";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Récupération des filtres de recherche
$annee = isset($_GET['annee']) ? (int)$_GET['annee'] : null;
$mois = isset($_GET['mois']) ? (int)$_GET['mois'] : null;
$jour = isset($_GET['jour']) ? (int)$_GET['jour'] : null;
$numerota = isset($_GET['numerota']) ? trim($_GET['numerota']) : null;
$qualification = isset($_GET['qualification']) ? trim($_GET['qualification']) : null;

// Construction de la requête SQL
$sql = "SELECT * FROM audio WHERE 1=1";

if (!empty($annee)) {
    $sql .= " AND YEAR(JOUR) = $annee";
}
if (!empty($mois)) {
    $sql .= " AND MONTH(JOUR) = $mois";
}
if (!empty($jour)) {
    $sql .= " AND DAY(JOUR) = $jour";
}
if (!empty($numerota)) {
    $sql .= " AND NUMEROTA LIKE '%" . $conn->real_escape_string($numerota) . "%'";
}
if (!empty($qualification)) {
    $sql .= " AND QUALIFICATION LIKE '%" . $conn->real_escape_string($qualification) . "%'";
}

$sql .= " ORDER BY date_ajout_serveur DESC"; // Trie du plus récent au plus ancien
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecteur Audio</title>
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'><link rel="stylesheet" href="css/Style_Accueil.css" > 
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css'><link rel="stylesheet" href="css/Style_Musique.scss" > 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

</head>
<body>
    <button id="toggle-list" onclick="toggleList()">Masquer la liste</button>
    <div id="audio-list">
        <br><br><br><br>
        <h3>Liste des Audios</h3>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['QUALIFICATION2'] ?></td>
               <td>
                <td>
    <div class="audio-player">
        <button type="button" onclick="playAudio('<?= htmlspecialchars($row['urls']) ?>')">Écouter</button>
    </div>
</td>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
    </div>
   
    <div class="container">
        
  <div class="iphone neu">
    <div class="title">
      <div><i class="fas fa-chevron-left"></i></div>
      <div>NOW PLAYING</div>
      <div><i class="fas fa-ellipsis-v"></i></div>
    </div>
    <div class="album-cover">
    <div class="image-container">
        <img src="https://www.voxens.fr/wp-content/uploads/2024/04/Voxens_madagascar.png" alt="Voxens Madagascar">
    </div>
      <h2 class="song-title">
        Redbone
      </h2>
      <h3 class="artist-title">
        Childish Gambino
      </h3>
    </div>
    <div class="buttons">
          <button onclick="download()" class="btn lg red neu"><i class="fas fa-download"></i></button>
          <button class="btn lg neu"><i class="fas fa-backward"></i></button>
          <button class="btn lg neu"><i class="fas fa-play"></i></button>
          <button   class="btn lg neu"><i class="fas fa-forward"></i></button>
      </div>
    
    <audio id="player" controls="false">
    <source id="audio-source" src="votre-audio.mp3" type="audio/mp3">
</audio>
<div class="audio-container">
    <div class="track-bar">
        <input type="range" id="audio-progress" value="0" max="100" step="1" />
    </div>


      <div></div>
    </div>
    
  </div>
</div>
<script src="Script/Script_Accueil.js"></script>
</body>
</html>
<script>
    function playAudio(audioUrl) {
        // Sélectionne le lecteur audio
        var player = document.getElementById("player");
        var audioSource = document.getElementById("audio-source");

        // Met à jour la source du lecteur audio
        audioSource.src = "Ecouter.php?file=" + encodeURIComponent(audioUrl);
        
        // Recharge et joue l'audio
        player.load();
        player.play();
    }
</script>



