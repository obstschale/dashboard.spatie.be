<template>
    <tile :position="position" modifiers="overflow">
        <section class="losung-file">
            <h1 class="losung-file__title">Losung <span v-if="losung.Sonntag">({{ losung.Sonntag }})</span></h1>

            <section class="losung-body">
                <span class="losung-item">
                    <p class="losung-vers">{{ losung.Losungsvers }}</p>
                    {{ losung.Losungstext }}
                </span>

                <span class="losung-item">
                    <p class="losung-vers">{{ losung.Lehrtextvers }}</p>
                    {{ losung.Lehrtext }}
                </span>
            </section>
        </section>
    </tile>
</template>

<script>
    import Tile from './atoms/Tile';
    import echo from '../mixins/echo';
    import saveState from 'vue-save-state';

    export default {
        components: {
            Tile,
        },

        mixins: [echo, saveState],

        props: ['position'],

        data() {
            return {
                losung: '',
            };
        },

        methods: {
            getEventHandlers() {
                return {
                    'Losung.LosungFetched': response => {
                        this.losung = response.losung;
                    },
                };
            },

            getSaveStateConfig() {
                return {
                    cacheKey: `losung`,
                };
            },
        },
    };
</script>

<style scoped>
    .losung-body {
        display: flex;
        font-size: var(--font-size-xs);
    }

    .losung-vers {
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    .losung-item {
        flex: 1 100%;
    }
</style>
