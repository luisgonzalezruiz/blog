require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// esto es para hacer que no se refresque la pagina al rutear
var Turbolinks = require("turbolinks")
Turbolinks.start()
