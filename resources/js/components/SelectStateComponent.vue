<template>
    <div class="container">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="feInputState">Country</label>
                <select id="feInputStatee" @change="selectState" class="form-control" v-model="countryId">
                    <option value="">{{defaultCountry}}</option>
                    <template v-for="(value,key) in listCountries">
                    <option :value="key">{{ value }}</option>
                    </template>

                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="feInputState">State</label>
                <select id="feInputState" class="form-control" name="state">
                    <option :value="defaultStateValue">{{defaultStateName}}</option>
                    <option value="">----</option>
                    <template v-for="state in states">
                        <option v-for="s in state" :value="s.id">{{ s.name }}</option>
                    </template>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" name="zipcode" class="form-control" id="inputZip" :value="zipCode">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {defaultCountry:String,defaultStateName:String,defaultStateValue:String,zipCode:String,listCountries:Array},
        el: '#selectState',
        data() {
            return {
                countryId:"",
                states:[],
            };
        },
        methods:{
            selectState:function(){
                this.states = [];
                axios.post('/admin/profile/getstate',{
                    id: this.countryId
                }).then(response=>{
                    this.states.push(response.data);
                    this.$forceUpdate();
                });

            },
        }
    }
</script>

<style scoped>

</style>