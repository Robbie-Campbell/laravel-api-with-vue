<template>
    <div>
        <div v-for="(game, index) in games" :key="index">
            <Game v-on:reloadList="$emit('reloadList')"  :game="game"/>
        </div>
    </div>
</template>

<script>
    import Game from './Game';
    export default {
        props: ['games'],
        components: {
          Game,
        },
    }
</script>
