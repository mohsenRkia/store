<template>
    <div class="container">
        <div id="firstList" class="card-body">
            <template v-for="img in images" v-if="firstimage">
                <div style="position: relative;display: inline-block;margin-left: 3px;">
                    <a @click="deleteImage(img.id,productId)" style="position: absolute;bottom: 0;padding: 5px;margin: 5px" class="btn btn-danger">
                    <span class="text-white"><i class="fa fa-trash-alt"></i></span>
                    </a>
                    <img :src="'/uploads/images/products/' + img.url" alt="" width="100" height="100">
                </div>
            </template>
            <template v-if="secondimage">
                <template v-for="list in secondList">
                    <template v-for="newimg in list">
                        <div style="position: relative;display: inline-block;margin-left: 3px;">
                            <a @click="deleteImage(newimg.id,productId)" style="position: absolute;bottom: 0;padding: 5px;margin: 5px" class="btn btn-danger">
                                <span class="text-white"><i class="fa fa-trash-alt"></i></span>
                            </a>
                            <img :src="'/uploads/images/products/' + newimg.url" alt="" width="100" height="100">
                        </div>
                    </template>
                </template>
            </template>
        </div>
    </div>
</template>

<script>
    export default {
        props:{productImages:Array,productId:Number},
        el: '#imagecomponent',
        data() {
            return {
                images:this.productImages,
                firstimage:true,
                secondimage:false,
                secondList:[],
            }
        },
        methods:{
            deleteImage:function ($id,$pid) {
                axios.post('/admin/product/image/delete/'+$id).then(response=>{
                    this.firstimage = false;
                    this.secondimage = true;
                    axios.post('/admin/product/image/getlist/' + $pid).then(response=>{
                        this.secondList = [];
                        this.secondList.push(response.data);
                        this.$forceUpdate();
                    })
                });
            }

        }
    }

    //new Vue({
    //
    //})
</script>

<style scoped>

</style>