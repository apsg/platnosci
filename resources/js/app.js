require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.copyToClipboard = function copyToClipboard(id) {
    document.getElementById(id).select();
    document.execCommand('copy');
}
