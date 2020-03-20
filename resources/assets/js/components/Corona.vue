<template>
    <tile :position="position" modifiers="transparent">
        <section class="corona">
            <div class="corona__last-test">
                <div class="corona__icon h-background-icon"></div>
                <ul>
                    <li>All: {{ all.cases }}</li>
                    <li>Deaths: {{ all.deaths }}</li>
                    <li>Recovered: {{ all.recovered }}</li>
                </ul>
                <br>
                <strong>Deutschland</strong>
                <ul>
                    <li>Cases: {{ germany.cases }}</li>
                    <li>Deaths: {{ germany.deaths }}</li>
                    <li>Recovered: {{ germany.recovered }}</li>
                </ul>
                <div class="corona__date">{{ coronaDate }}</div>
            </div>
        </section>
    </tile>
</template>

<script>
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import saveState from 'vue-save-state';
import moment from 'moment';

export default {
    components: {
        Tile,
    },

    mixins: [echo, saveState],

    props: ['position'],

    data() {
        return {
            all: {
                "cases": 256069,
                "deaths": 10496,
                "recovered": 89918,
                "updated": 1584717550303
            },
            germany: {
                "country": "Germany",
                "cases": 17776,
                "todayCases": 2456,
                "deaths": 48,
                "todayDeaths": 4,
                "recovered": 180,
                "active": 17548,
                "critical": 2,
                "casesPerOneMillion": 212
            },
        };
    },

    computed: {
        coronaDate() {
            return moment(this.all.updated)
                .utcOffset(2)
                .format('DD. MMMM YYYY HH:mm')
        }
    },

    methods: {
        getEventHandlers() {
            return {
                'Corona.CoronaDataFetched': response => {
                    console.log(response);
                    this.all = response.coronaData.all;
                    this.germany = response.coronaData.germany;
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'corona',
            };
        },
    },
};
</script>
