<template>
    <form @submit.prevent="addGame" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Game Title</label>
            <input type="text" name="title" class="form-control" id="title" placeholder="Enter Game Title" v-model="title">
        </div>

        <div class="form-group">
            <label for="description">Game Description</label>
            <textarea name="description" class="form-control" v-model="description"></textarea>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" name="picture" class="form-control-file" id="image" @change="onFileChange">
        </div>
        <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview"/>
        <div class="form-group">
            <input type="submit" class="btn btn-success" />
        </div>
    </form>
</template>

<script>
    import axios from 'axios';
    export default {
        data: function() {
            return {
                title: "",
                description: "",
                image: null,
                imagePreview: null,
                showPreview: false,
            }
        },
        methods: {
            onFileChange(event){
                this.image = event.target.files[0];
                let reader  = new FileReader();
                reader.addEventListener("load", function () {
                    this.showPreview = true;
                    this.imagePreview = reader.result;
                }.bind(this), false);
                if( this.image ){
                    if ( /\.(jpe?g|png|gif)$/i.test( this.image.name ) ) {
                        reader.readAsDataURL( this.image );
                    }
                }
            },
            addGame(){
                let formData = new FormData();
                if (this.title === "" || this.description === "" || this.image === "") {
                    return
                }
                formData.append("image", this.image);
                formData.append("title", this.title);
                formData.append("description", this.description);
                axios.post('api/games/', formData)
                .then(response => {
                    console.log(response.status);
                    if (response.status === 200) {
                        this.title = "";
                        this.description = "";
                        this.imagePreview = null;
                        this.showPreview = false;
                        this.$emit("reloadList");
                    }
                })
                .catch(error => {
                    console.log(error);
                });
            }
        }

    }
</script>
