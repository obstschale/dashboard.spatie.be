<template>
    <tile :position="position" modifiers="overflow">
        <section class="todoist">
            <h1 class="todoist__title">{{ teamMember }}</h1>
            <ul v-if="tasks.length > 0">
                <li v-for="task in tasks">
                    <priority-circle :priority="task.priority"></priority-circle>
                    {{ task.content }}
                </li>
            </ul>
            <div v-else>
                <div class="todoist__zero">
                    <img src="images/svg/beach.svg" alt="TodoistZero">
                </div>

                <p class="todoist__zero-quote">{{ quote.content }}</p>
                <p class="todoist__zero-author">~{{ quote.author }}</p>
            </div>

        </section>
    </tile>
</template>

<script>
    import echo from '../mixins/echo';
    import Tile from './atoms/Tile';
    import PriorityCircle from './atoms/PriorityCircle';
    import saveState from 'vue-save-state';
    import axios from 'axios';

    export default {
        components: {
            Tile,
            PriorityCircle,
        },

        mixins: [echo, saveState],

        props: ['teamMember', 'position'],

        data() {
            return {
                tasks: '',
                quote: {
                    content: '',
                    author: '',
                },
            };
        },

        created() {
            this.fetchQuote();
            setInterval(this.fetchQuote, 30 * 60 * 1000);
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

            fetchQuote() {
                const endpoint = "http://quotesondesign.com/wp-json/posts?filter[orderby]=rand&filter[posts_per_page]=1";
                axios.get(endpoint).then(res => {
                    this.quote.content = this.strip(res.data[0].content);
                    this.quote.author = this.strip(res.data[0].title);
                });
            },

            strip(html) {
                const tmp = document.createElement("DIV");
                tmp.innerHTML = html;
                return tmp.textContent || tmp.innerText || "";
            },
        },
    };
</script>
