<template>
    <svg id="Ebene_1" class="circle" data-name="Ebene 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 399 399">
        <title>Todoist-prio-icon</title>
        <circle v-bind:class="[priorityColor]" cx="192.5" cy="199" r="160"></circle>
        <path d="M192.5,69.19a129.81,129.81,0,1,1-91.79,38,129,129,0,0,1,91.79-38m0-30.19a160,160,0,1,0,160,160,160,160,0,0,0-160-160Z"></path>
        <g v-bind:class="[priorityColor]">
            <circle cx="192.5" cy="199" r="160"></circle>
        </g>
    </svg>
</template>

<script>
    export default {
        props: ['priority'],

        name: 'PriorityCircle',

        computed: {
            priorityColor() {
                return `priority-${this.priority}`;
            },
        }
    };
</script>

<style scoped>
    .priority-1 {
        fill: white;
    }

    .priority-2 {
        fill: #fcc12b;
    }

    .priority-3 {
        fill: #f8801c;
    }

    .priority-4 {
        fill: #ac0000;
    }

    .circle {
        width: 1vw;
    }
</style>
