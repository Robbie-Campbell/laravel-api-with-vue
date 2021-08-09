<template>
    <div>
        <MakeGame v-on:reloadList="getGames" />
        <GameList v-on:reloadList="getGames" :games="games" />
    </div>
</template>

<script>
    import GameList from './GameList'
    import MakeGame from './MakeGame'
    import axios from "axios";
    export default {
        components: {
            GameList,
            MakeGame,
        },
        data() {
            return {
                games: []
            }
        },
        methods: {
            getGames() {
                axios.get('api/games')
                    .then(response => {
                        this.games = response.data;
                    })
                    .catch(error => {
                        console.log(error);
                    })
            }
        },
        created() {
            this.getGames();
        }
    }
</script>
