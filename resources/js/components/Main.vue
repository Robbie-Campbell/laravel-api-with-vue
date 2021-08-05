<template>
    <div>
        <MakeGame />
        <GameList />
    </div>
</template>

<script>
    import GameList from './GameList'
    import MakeGame from './MakeGame'
    export default {
        components: {
            GameList,
            MakeGame,
        }
    }
</script>
