
<template>
    <div class="container" style="margin-top:50px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <input type="text" autocomplete="off" v-model="filter" id="search" class="form-control input-lg" placeholder="Search" v-on:keyup.enter="startsearch"/>
                <div class="card">
                    <div class="card-body" v-for="item in list">
                        <div>
        <div class="module">
            
             
            
            <div class="module-txt">
            	<img v-bind:src="item.image"  class="img-responsive" alt="" style="float: left; margin: 0px 15px 15px 0px;" />
                <h4>{{ item.title }}</h4>
                <h5>ISBN: {{ item.ISBN }}</h5>
                <p v-html="item.description"></p>
            </div>
        </div>
                        </div>
                    </div>
                    <infinite-loading @distance="1" :identifier="infiniteId" @infinite="infiniteHandler"></infinite-loading>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Book Component mounted.')
        },
        data() {
            return {
              list: [],
              page: 1,
              infiniteId: +new Date(),
              filter: '',
            };
          },
          methods: {

            startsearch($state){
              this.page = 1;
              this.list = [];
              this.infiniteId += 1;
            },

            infiniteHandler($state) {
                let vm = this;
                let url = process.env.MIX_APP_URL+'getbooks';
                if(vm.filter.length > 0)
                	{
                	url = process.env.MIX_APP_URL+'getbooks/'+vm.filter+'?page='+vm.page;	
                	}
                console.log(url);	
				 axios.get(url)
                     .then((response)=>{
					 if (response.data.data.length)
                            {
                            var newbooks = response.data.data;
                            vm.list = vm.list.concat(newbooks);
                            $state.loaded();
                            }
                        else 
                            {
                            $state.complete();
                            this.filter = '';
                            }                         	

                     })
                this.page = this.page + 1;
            },
          },
    }
</script>
