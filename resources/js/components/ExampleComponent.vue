<template>
    <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="">
                  <div v-for="product in products" class="col-md-8 offset-md-2">
                    <div class="card mb-4 shadow-sm">
                      <img v-bind:src="product.image" width="100%" height="350"/>
                      <div class="card-body">
                        <a v-bind:href="'/product'+product.id" target="_blanc"><p>{{product.title}}</p></a>
                        <p class="card-text">{{product.description}}</p>
                        <div class="d-flex justify-content-between align-items-center">
                          <div class="btn-group">
                            <!-- <a v-bind:href="'/product'+product.id" target="_blanc"><button type="button" class="btn btn-sm btn-outline-secondary">View</button></a> -->
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <infinite-loading @distance="1" @infinite="infiniteHandler"></infinite-loading>

              </div>
          </div>
      </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data(){
         return {
             products: [],
             page: 1
         }
        },

        methods: {
          infiniteHandler($state){
              let vm = this;
              this.$http.get('/products?page='+this.page)
                         .then(response =>{
                           return response.json();
                         }).then(newResponse=>{
                           $.each(newResponse.data, function(key,value) {
                             vm.products.push(value);
                           });
                           if (newResponse.data.length) {
                              this.page += 1;
                              $state.loaded();
                            } else {
                              $state.complete();
                            }
                         });
          }
        }
    }
</script>
