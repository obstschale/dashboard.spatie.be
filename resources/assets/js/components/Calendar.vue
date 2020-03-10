<template>
    <tile :position="position" modifiers="overflow">
        <section class="calendar">
            <h1 class="calendar__title">Kalender</h1>
            <ul class="calendar__events">
                <li v-for="event in events" class="calendar__event">
                    <h2 class="calendar__event__title">{{ event.name }}</h2>
                    <div class="calendar__event__date" :class="color(event.color)">{{ formatDate(event.startdate, event.enddate) }}</div>
                </li>
            </ul>
        </section>
    </tile>
</template>

<script>
import echo from '../mixins/echo';
import Tile from './atoms/Tile';
import saveState from 'vue-save-state';
import { relativeDate } from '../helpers';
import moment from 'moment';

export default {
    components: {
        Tile,
    },

    mixins: [echo, saveState],

    props: ['position'],

    data() {
        return {
            events: [],
        };
    },

    methods: {
        relativeDate,

        formatDate(start, end) {
            const startDate = moment(start);
            const endDate = moment(end);

            if (moment().isSame(startDate, 'd') ||
                moment().isBetween(startDate, endDate)) {
                return 'Heute';
            }

            if (moment().add(1, 'day').isSame(startDate, 'd')) {
                return 'Morgen';
            }

            if (startDate.isBetween(moment().add(1, 'day'), moment().add(8, 'days'), 'day')) {
                return startDate.fromNow();
            }

            if (startDate.isSame(endDate, 'd')) {
                return startDate.format('D. MMM');
            }

            return startDate.format('D. MMM') + ' bis ' + endDate.format('D. MMM');
        },

        getEventHandlers() {
            return {
                'Calendar.EventsFetched': response => {
                    this.events = response.events;
                },
            };
        },

        getSaveStateConfig() {
            return {
                cacheKey: 'calendar',
            };
        },

        color(calendarColor) {
            return `calendar__event__color__${calendarColor}`
        },
    },
};
</script>
