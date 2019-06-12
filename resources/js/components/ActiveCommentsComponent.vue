<template>
    <div class="container">
        <div class="form-row">
            <div class="row">
                <div class="col text-center view-report">
                    <div class="blog-comments__actions">
                        <div class="btn-group btn-group-sm">
                            <button v-if="status == 0" type="button" class="btn btn-white" @click="activeCm(commentId)">
                        <span class="text-success">
                            <i class="material-icons">check</i>
                        </span> Active
                            </button>
                            <button v-if="status == 1" type="button" class="btn btn-white" @click="deactiveCm(commentId)">
                        <span class="text-danger">
                            <i class="material-icons">clear</i>
                        </span> Deactive
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props:{commentId:Number,status:Number},
        name: "ActiveCommentsComponent",
        data(){
            return {

            }
        },
        methods:{
            activeCm:function ($id) {
                axios.post('/admin/satisfied/active/'+ $id, {
                    status : 1
                }).then(response=>{
                    this.status = response.data;
                })
            },

            deactiveCm:function ($id) {
                axios.post('/admin/satisfied/active/'+ $id, {
                    status : 0
                }).then(response=>{
                    this.status = response.data;
                })
            }
        }
    }
</script>

<style scoped>

</style>