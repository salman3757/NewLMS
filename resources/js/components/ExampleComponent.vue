<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        I'm an example component.
                        This is Laravel-Vue App.
                        Laravel is used to create REST APIs.
                    </div>
                    <div class="card-body">
                        I'm an example component.
                        This is Laravel-Vue App.
                        Laravel is used to create REST APIs.
                    </div>
                    <div class="card-body">
                        I'm an example component.
                        This is Laravel-Vue App.
                        Laravel is used to create REST APIs - 3.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>
.card-body{
    background-color:rgb(255, 239, 147);
}
</style>
