////-- JAVASCRIPT FOR PLAYING BG MUSIC

// Set isPlaying to false
var isPlaying = false;

// Music Button
var musicBtn = document.getElementById("toggleMusic");

// BG Music Audio
var music = document.getElementById("bg_music");

// Volume Input Range Type
var volume = document.getElementById("volume");


// Toggle Music Function
function toggleMusic() {

    // Check if isPlaying is true
    if (isPlaying) {

        // Puase Music
        music.pause();

        // Set Music Button Source to Mute
        musicBtn.src = "assets/mute.png";

        // Set isPlaying to false
        isPlaying = false;
    }

    // isPlaying must be false
    else {

        // Play Music
        music.play();

        // Set Music Button Source to Unmute
        musicBtn.src = "assets/unmute.png";

        // Set isPlaying to true
        isPlaying = true;
    }
}

// Event listener when volume input is changed
volume.addEventListener("input", function(e) {

    // Set music volume to the value of the current target
    music.volume = e.currentTarget.value / 100;
})