require('./bootstrap');

if ('serviceWorker' in navigator) {
    window.addEventListener('load', function() {
        navigator.serviceWorker.register('/service-worker.js');
    });
}

window.Vue = require('vue');

import Symptoms from './components/Symptoms'
import Minutes from './components/Minutes'

const app = new Vue({
    el: '#app',
    data: {

    },
    components: {
        Symptoms, Minutes
    },
    methods: {

    }
});