<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">listing des etats</div>

                    <div class="card-body">
                        <router-link to="/new_state" class="btn btn-outline-secondary">ajout d'image</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "State"
    }
</script>

<style scoped>

</style>
