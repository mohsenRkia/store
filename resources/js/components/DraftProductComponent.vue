<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">Draft Product</div>

                    <div class="card-body">
                        I'm an Draft Product.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    //export default {
    //    name: "DraftProduct"
    //}
    new Vue({
        el: '#draft-product' ,
        data:{
            errors:[],
            productName:"",
            productDesc:"",
            originallprice:"",
            offerprice:"",
            quantity:"",
            weight:"",
            images:[],
            subcategory:[],
            user_id:"",
            discount_id:"",
            color:[],
            size:[],

        },
        methods:{
            unSaleable:function(){
                var imagee = this.$refs;
                console.log(imagee);
                axios.post('/admin/product/draft',{
                    name:this.productName,
                    description:this.productDesc,
                    originallprice:this.originallprice,
                    offerprice:this.offerprice,
                    quantity:this.quantity,
                    weight:this.weight,
                    images:this.images,
                    subcategory:this.subcategory,
                    user_id:this.user_id,
                    discount_id:this.discount_id,
                    color:this.color,
                    size:this.size,
                }).then(response=>{



                }).catch(error => {
                    if (error.response.status == 422){
                        this.errors = error.response.data.errors;
                    }
                    this.$forceUpdate();
                });
            },
        }
    })
</script>

<style scoped>

</style>