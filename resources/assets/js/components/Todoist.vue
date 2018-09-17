<template>
    <tile :position="position" modifiers="overflow">
        <section class="github-file">
            <h1 class="github-file__title">{{ teamMember }}</h1>
            <ul>
                <li v-for="task in tasks">
                    {{ task.content }}
                </li>
            </ul>
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

        props: ['teamMember', 'position'],

        data() {
            return {
                tasks: '',
            };
        },

        methods: {
            getEventHandlers() {
                return {
                    'Todoist.TodayTasksFetched': response => {
                        this.tasks = response.tasks[this.teamMember];
                    },
                };
            },

            getSaveStateConfig() {
                return {
                    cacheKey: `tasks-${this.teamMember}`,
                };
            },
        },
    };
</script>
