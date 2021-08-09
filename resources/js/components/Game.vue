<template>
    <div>
        <h1>{{game.title}}</h1>
        <p>{{game.description}}</p>
        <img :src="game.image" />
        <button @click="deleteGame()">Delete</button>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        props: ['game'],
        methods: {
            deleteGame() {
                axios.delete("/api/games/" + this.game.id)
                .then(response => {
                    if (response.status === 200) {
                        this.$emit("reloadList");
                    }
                })
                .catch(error => {
                    console.log(error);
                })
            }
        },
    }
</script>
