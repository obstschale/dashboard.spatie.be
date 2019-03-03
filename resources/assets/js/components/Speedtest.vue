<template>
    <tile :position="position" modifiers="transparent">
        <section class="speedtest">
            <div class="speedtest__last-test">
                <div class="speedtest__icon h-background-icon"></div>
                <div class="speedtest__upload">{{ speedtest.upload }} <span class="speedtest__mbits">Mbit/s</span></div>
                <div class="speedtest__download">{{ speedtest.download }} <span class="speedtest__mbits">Mbit/s</span></div>
                <div class="speedtest__date">{{ speedtest.date }}</div>
            </div>
        </section>
    </tile>
</template>

<script>
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import saveState from 'vue-save-state';

export default {
    components: {
        Tile,
    },

    mixins: [echo, saveState],

    props: ['position'],

    data() {
        return {
            speedtest: {
                upload: '',
                download: '',
                date: '',
            },
        };
    },

    methods: {
        getEventHandlers() {
            return {
                'Speedtest.SpeedtestFetched': response => {
                    this.speedtest = response.speedtest;
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'speedtest',
            };
        },
    },
};
</script>
