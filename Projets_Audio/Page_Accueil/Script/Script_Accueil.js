let player = document.getElementById("player");
let source = document.getElementById("audio-source");
let audioList = document.getElementById("audio-list");
let toggleButton = document.getElementById("toggle-list");
let isListVisible = true;

function playAudio(audioFile) {
    source.src = audioFile;
    player.load();
    player.play();
}
function play() {
    player.play();
}
function pause() {
    player.pause();
}
function stop() {
    player.pause();
    player.currentTime = 0;
}
function download() {
    if (source.src) {
        let link = document.createElement("a");
        link.href = source.src;
        link.download = source.src.split('/').pop();
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    } else {
        alert("Aucun fichier audio sélectionné !");
    }
}
function toggleList() {
    if (isListVisible) {
        audioList.style.display = "none";
        toggleButton.textContent = "Afficher la liste";
    } else {
        audioList.style.display = "block";
        toggleButton.textContent = "Masquer la liste";
    }
    isListVisible = !isListVisible;
}


const audioPlayer = document.getElementById("player");
const audioProgress = document.getElementById("audio-progress");

audioPlayer.addEventListener('timeupdate', function() {
    const progress = (audioPlayer.currentTime / audioPlayer.duration) * 100;
    audioProgress.value = progress;
});

audioProgress.addEventListener('input', function() {
    const seekTime = (audioProgress.value / 100) * audioPlayer.duration;
    audioPlayer.currentTime = seekTime;
});
