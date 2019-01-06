
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    
    data:{
        countryId:"",
        states:[],
        
    },
    methods:{
        selectUserState:function(){
            this.states = [];
            axios.post('/user/profile/getstate',{
                id: this.countryId
            }).then(response=>{
                this.states.push(response.data);
                this.$forceUpdate();
            });

        },
        selectState:function(){
            this.states = [];
            axios.post('/admin/profile/getstate',{
                id: this.countryId
            }).then(response=>{
                this.states.push(response.data);
                this.$forceUpdate();
            });

        },
        deleteRow:function ($id,$name) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this " + $name +"!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.post('/admin/' + $name + '/delete/'+$id).then(response=>{
                            swal("Your " + $name + " has deleted successfully!", {
                                icon: "success",
                            }).then(response=>{
                                location.reload();
                            });
                        });
                    } else {
                        swal("Your " + $name + " hasn't deleted!!");
                    }
                });
        },

        deleteRowDouble:function ($id,$name,$route) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this " + $name +"!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        axios.post('/admin/' + $route + '/delete/'+$id).then(response=>{
                            swal("Your " + $name + " has deleted successfully!", {
                                icon: "success",
                            }).then(response=>{
                                location.reload();
                            });
                        });
                    } else {
                        swal("Your " + $name + " hasn't deleted!!");
                    }
                });
        }

    }
});
