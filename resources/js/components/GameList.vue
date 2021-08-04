<template>
    <div>
        <div v-for="(game, index) in games" :key="index">
            <h1>{{game.title}}</h1>
            <p>{{game.description}}</p>
            <img :src="game.image" />
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                games: []
            }
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
