import './bootstrap.js';

import Echo from 'laravel-echo';
import Vue from 'vue';

import Dashboard from './components/Dashboard';
import Calendar from './components/Calendar';
import Github from './components/Github';
import InternetConnection from './components/InternetConnection';
import Music from './components/Music';
import Npm from './components/Npm';
import Packagist from './components/Packagist';
import Tasks from './components/Tasks';
import Todoist from './components/Todoist';
import TimeWeather from './components/TimeWeather';
import Twitter from './components/Twitter';
import Uptime from './components/Uptime';
import Losung from './components/Losung';
import Speedtest from './components/Speedtest';
import Corona from './components/Corona';

new Vue({
    el: '#dashboard',

    components: {
        Dashboard,
        Calendar,
        Github,
        InternetConnection,
        Music,
        Npm,
        Packagist,
        Tasks,
        Todoist,
        TimeWeather,
        Twitter,
        Uptime,
        Losung,
        Speedtest,
        Corona
    },

    created() {
        let options = {
            broadcaster: 'pusher',
            key: window.dashboard.pusherKey,
            cluster: window.dashboard.pusherCluster,
        };

        if (window.dashboard.usingNodeServer) {
            options = {
                broadcaster: 'socket.io',
                host: 'http://dashboard.spatie.be:6001',
            };
        }

        this.echo = new Echo(options);
    },
});
