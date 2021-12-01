 particlesJS("particles-js", {
     "particles": {
       "number": {
         "value": 160,
         "density": {
           "enable": true,
           "value_area": 800
         }
       },
       "color": {
         "value": "#666"
       },
       "shape": {
         "type": "image",
         "stroke": {
           "width": 2,
           "color": "#000000"
         },
         "polygon": {
           "nb_sides": 5
         },
         "image": {
           "src": "https://emojipedia-us.s3.dualstack.us-west-1.amazonaws.com/thumbs/120/google/274/star_2b50.png",
           "width": 100,
           "height": 100
         },
       },
       "opacity": {
         "value": 0.2,
         "random": true,
         "anim": {
           "enable": true,
           "speed": 1,
           "opacity_min": 0,
           "sync": false
         }
       },
       "size": {
         "value": 10,
         "random": true,
         "anim": {
           "enable": false,
           "speed": 4,
           "size_min": 0.3,
           "sync": false
         }
       },
       "line_linked": {
         "enable": true,
         "distance": 60,
         "color": "#ffffff",
         "opacity": 0.5,
         "width": 1
       },
       "move": {
         "enable": true,
         "speed": 1,
         "direction": "none",
         "random": true,
         "straight": false,
         "out_mode": "out",
         "bounce": false,
         "attract": {
           "enable": false,
           "rotateX": 600,
           "rotateY": 600
         }
       }
     },
     "interactivity": {
       "detect_on": "window",
       "events": {
         "onhover": {
           "enable": true,
           "mode": "grab"
         },
         "onclick": {
           "enable": false,
           "mode": "bubble"
         },
         "resize": true
       },
       "modes": {
         "grab": {
           "distance": 400,
           "line_linked": {
             "opacity": 0.2
           }
         },
         "bubble": {
           "distance": 400,
           "size": 10,
           "duration": 2,
           "opacity": 1,
           "speed": 3
         },
         "repulse": {
           "distance": 80,
           "duration": 0.4
         },
         "push": {
           "particles_nb": 4
         },
         "remove": {
           "particles_nb": 2
         }
       }
     },
     "retina_detect": true
   });
 var count_particles, stats, update;
 stats = new Stats;
 stats.setMode(0);
 stats.domElement.style.position = 'absolute';
 stats.domElement.style.left = '0px';
 stats.domElement.style.top = '0px';
 document.body.appendChild(stats.domElement);
 count_particles = document.querySelector('.js-count-particles');
 update = function() {
     stats.begin();
     stats.end();
     if (window.pJSDom[0].pJS.particles && window.pJSDom[0].pJS.particles.array) {
         count_particles.innerText = window.pJSDom[0].pJS.particles.array.length;
     }
     requestAnimationFrame(update);
 };
 requestAnimationFrame(update);;

