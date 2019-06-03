<template>
    <div class="container">
        <div class="form-row">
    <div class="row">
        <div class="col text-center view-report">
            <div class="blog-comments__actions">
                <div class="btn-group btn-group-sm">
                    <button v-if="sent == 0" type="button" class="btn btn-white" @click="approveSend(factorId)">
                        <span class="text-success">
                            <i class="material-icons">check</i>
                        </span> Approve
                    </button>
                    <button v-if="sent == 1" type="button" class="btn btn-white" @click="rejectSend(factorId)">
                        <span class="text-danger">
                            <i class="material-icons">clear</i>
                        </span> Reject
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
        props:{sent:Number,factorId:Number},
        name: "SendProductComponent",
        data(){
          return {

          }
        },
        methods:{
            approveSend:function ($id) {
                axios.post('/admin/factor/approve/'+ $id, {
                    sent : 1
                }).then(response=>{
                    this.sent = response.data;
                })
            },

            rejectSend:function ($id) {
                axios.post('/admin/factor/approve/'+ $id, {
                    sent : 0
                }).then(response=>{
                    this.sent = response.data;
                })
            }
        }
    }
</script>

<style scoped>

</style>