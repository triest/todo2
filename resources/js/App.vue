<template>
  <div class="container">


  </div>
</template>

<script>

import {mapGetters} from 'vuex';
import {mapActions} from 'vuex';

export default {
    components:{

    },
    data() {
        return {

        }
    },
    computed : {
          getSettings: {
              get: function () {
                  return this.$store.getters.get_settings
              },
              set:function (newValue){
                  this.$store.dispatch('SAVE_SETTINGS',newValue)
              }
          },

    },
    mounted() {
        this.$store.dispatch('GET_SETTINGS')
        this.example()
    },

    methods: {
        ...mapActions('SAVE_SETTINGS'),

        example(){
            console.log("example");

        },
        logout() {
            this.axios
                .post('/logout')
                .then(response => (
                   // this.$router.push({name: 'home'})
                    window.location.href = "/"
                ))
                .catch(err => {
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors;
                    }
                })
                .finally(() => this.loading = false)
        },

    }
}
</script>
<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    width: auto;
    background-color: #f1f1f1;
    position: fixed;
  /*  height: 100%;*/
    margin-top: 5%;
    margin-left: 10%;
    overflow: auto;
}

li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}

li a.active {
    background-color: #04AA6D;
    color: white;
}

li a:hover:not(.active) {
    background-color: #555;
    color: white;
}
</style>

