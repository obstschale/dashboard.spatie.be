<template>
    <tile :position="position" modifiers="transparent">
        <section class="corona">
            <h1 class="corona__title">Corona Daten</h1>
            <div class="corona__data">
                    <div class="corona__grid-all big-red">{{ formatNumber(all.cases) }}</div>
                    <div class="corona__grid-all-deaths">
                        <span>{{ formatNumber(all.deaths) }}</span>
                    </div>
                    <div class="corona__grid-all-recovered">
                        <span>{{ formatNumber(all.recovered) }}</span>
                    </div>

                    <div class="corona__grid-germany-all big-red">{{ formatNumber(germany.cases) }}</div>
                    <div class="corona__grid-germany-deaths">
                        <span>{{ formatNumber(germany.deaths) }}</span>
                    </div>
                    <div class="corona__grid-germany-recovered">
                        <span>{{ formatNumber(germany.recovered) }}</span>
                    </div>

                    <div class="corona__grid-date">{{ coronaDate }}</div>
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
        formatNumber(number) {
            return (number).toLocaleString('de');
        },

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
<style scoped>
    .corona__title {
        color: var(--blue-light);
        text-transform: uppercase;
        font-size: var(--font-size-m);
    }

    .corona__data {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 3fr 2fr 2fr 5fr;
        grid-template-areas:
            "all gAll"
            "allDeaths gDeaths"
            "allRecovered gRecovered"
            "date date";
        grid-gap: 5px;
    }

    .big-red {
        font-size: xx-large;
        color: var(--red);
        text-align: center;
    }

    .corona__grid-all,
    .corona__grid-all-deaths,
    .corona__grid-all-recovered {
        text-align: left;
    }

    .corona__grid-germany-all,
    .corona__grid-germany-deaths,
    .corona__grid-germany-recovered {
        text-align: right;
    }

    .corona__grid-all {
        grid-area: all;
    }

    .corona__grid-all-deaths {
        grid-area: allDeaths;
    }

    .corona__grid-all-recovered {
        grid-area: allRecovered;
    }

    .corona__grid-all-deaths span,
    .corona__grid-all-recovered span,
    .corona__grid-germany-deaths span,
    .corona__grid-germany-recovered span {
        padding: 0 10px;
        border: 2px solid;
        border-radius: 12px;
        font-weight: bold;
    }

    .corona__grid-all-deaths span,
    .corona__grid-germany-deaths span {
        color: var(--red);
        border-color: var(--red);
    }

    .corona__grid-all-recovered span,
    .corona__grid-germany-recovered span {
        color: var(--green);
        border-color: var(--green);
    }

    .corona__grid-germany-all {
        grid-area: gAll;
    }

    .corona__grid-germany-deaths {
        grid-area: gDeaths;
    }

    .corona__grid-germany-recovered {
        grid-area: gRecovered;
    }

    .corona__grid-date {
        grid-area: date;
        font-size: 65%;
        align-self: end;
        text-align: right;
        color: var(--gray);
    }
</style>
