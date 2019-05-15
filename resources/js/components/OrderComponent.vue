<template>
    <div>
        <div class="row row-pb-sm">
            <div class="col-md-4">
                <div class="input-group">
                <span class="input-group-btn">
                    <button @click="minusQuantity" type="button" class="quantity-left-minus btn"  data-type="minus" data-field="">
                        <i class="icon-minus2"></i>
                    </button>
                </span>
                    <input type="text" id="quantity" name="quantity" class="form-control input-number"  min="1" max="100" v-model="quantity">
                    <span class="input-group-btn">
                    <button @click="plusQuantity" type="button" class="quantity-right-plus btn" data-type="plus" data-field="">
                        <i class="icon-plus2"></i>
                    </button>
                </span>
                </div>
            </div>
        </div>

    </div>

</template>

<script>
    export default {
        data(){
            return{
                quantity:0,
            }
        },
        methods:{
            addtobasket:function ($id) {
                console.log($id);
            },
            plusQuantity:function () {
                this.quantity++;
            },
            minusQuantity:function () {
                if (this.quantity > 0){
                    this.quantity--;
                }else if(this.quantity <= 0){
                    this.quantity = 0;
                }
            }
        }
    }
</script>

<style scoped>

</style>