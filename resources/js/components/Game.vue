<template>
    <div>
        <h1>{{game.title}}</h1>
        <p>{{game.description}}</p>
        <img :src="game.image" />
        <button @click="deleteGame()">Delete</button>
    </div>
</template>

<script>
    export default {
        props: ['game'],
        methods: {
            deleteGame() {
                axios.delete("/api/games/" + this.game.id)
                .then(response => {
                    console.log(response);
                })
                .catch(error => {
                    console.log(error);
                })
            }
        }
    }
</script>
