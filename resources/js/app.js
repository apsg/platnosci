require('./bootstrap');

import Alpine from 'alpinejs';
import {initFlowbite} from "flowbite";

window.Alpine = Alpine;

Alpine.start();

initFlowbite();

window.copyToClipboard = function copyToClipboard(id) {
    document.getElementById(id).select();
    document.execCommand('copy');
}
