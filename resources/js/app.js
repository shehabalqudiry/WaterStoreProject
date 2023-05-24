import './bootstrap';
import Alpine from 'alpinejs';
import Vue from 'vue';



window.Vue = Vue;
window.Alpine = Alpine;

Vue.component('agora-chat', require('./components/AgoraChat.vue').default);

const app = new Vue({
    el: '#app',
});
Alpine.start();

