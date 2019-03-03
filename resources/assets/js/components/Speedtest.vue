<template>
    <tile :position="position" modifiers="transparent">
        <section class="speedtest">
            <div class="speedtest__last-test">
                <div class="speedtest__icon h-background-icon"></div>
                <div class="speedtest__upload" v-bind:class="[uploadColor]">{{ speedtest.upload }} <span class="speedtest__mbits">Mbit/s</span></div>
                <div class="speedtest__download" v-bind:class="[downloadColor]">{{ speedtest.download }} <span class="speedtest__mbits">Mbit/s</span></div>
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

    computed: {
        uploadColor() {
            if (Number(this.speedtest.upload) >= 20) {
                return 'speedtest__good'
            }

            if (Number(this.speedtest.upload) < 10) {
                return 'speedtest__bad'
            }

            return 'speedtest__warning'
        },

        downloadColor() {
            if (Number(this.speedtest.download) >= 75) {
                return 'speedtest__good'
            }

            if (Number(this.speedtest.download) < 25) {
                return 'speedtest__bad'
            }

            return 'speedtest__warning'
        },
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
