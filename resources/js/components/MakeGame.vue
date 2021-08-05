<template>
    <div>
        <input type="text" v-model="title" />
        <input type="text" v-model="description" />
        <div class="col-md-3" v-if="image">
            <img :src="image" class="img-responsive" height="70" width="90">
        </div>
        <input type="file" name="image" v-on:change="imageChanged" />
        <button type="submit" @click="addGame">Add Game</button>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                title: "",
                description: "",
                image: "",
            }
        },
        methods: {
            imageChanged(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.createImage(files[0]);
            },
            createImage(file) {
                let reader = new FileReader();
                let vm = this;
                reader.onload = (e) => {
                    vm.image = e.target.result;
                };
                reader.readAsDataURL(file);
            },
            addGame(){
                if (this.title === "" || this.description === "" || this.image === "") {
                    return
                }

                axios.post('api/games/', {
                    title: this.title,
                    description: this.description,
                    image: this.image
                })
                .then(response => {
                    if (response.status === 201) {
                        this.title = "";
                        this.description = "";
                    }
                })
                .catch(error => {
                    console.log(error);
                });
            }
        }

    }
</script>
