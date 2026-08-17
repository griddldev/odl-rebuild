document.addEventListener('DOMContentLoaded', function () {
  var heroes = document.querySelectorAll('.hero-block');

  heroes.forEach(function (hero) {
    var video = hero.querySelector('.hero-video');
    if (!video) return;

    var playBtn = hero.querySelector('.hero-play-btn');
    var muteBtn = hero.querySelector('.hero-mute-btn');

    if (playBtn) {
      playBtn.addEventListener('click', function () {
        if (video.paused) {
          video.play();
          hero.setAttribute('data-playing', 'true');
          playBtn.setAttribute('aria-label', 'Pause video');
        } else {
          video.pause();
          hero.setAttribute('data-playing', 'false');
          playBtn.setAttribute('aria-label', 'Play video');
        }
      });
    }

    if (muteBtn) {
      muteBtn.addEventListener('click', function () {
        video.muted = !video.muted;
        hero.setAttribute('data-muted', video.muted ? 'true' : 'false');
        muteBtn.setAttribute(
          'aria-label',
          video.muted ? 'Unmute video' : 'Mute video',
        );
      });
    }
  });
});
