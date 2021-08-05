<template>
    <div>
        <div v-for="(game, index) in games" :key="index">
            <Game :game="game"/>
        </div>
    </div>
</template>

<script>
    import Game from './Game'
    export default {
        data: function() {
            return {
                games: []
            }
        },
        components: {
          Game,
        },
        methods: {
            getGames() {
                axios.get('api/games')
                .then(response => {
                    this.games = response.data
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
