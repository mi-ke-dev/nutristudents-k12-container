<template>
    
<div class="searching xl:px-10 px-5 md:pt-10 pt-8 w-full">

<header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
  <div class="relative md:w-56">
    <input class="border-2 border-gray-300 bg-white h-10 px-3 pr-10 rounded-lg text-sm focus:outline-none w-full" type="search" name="top_search" placeholder="Search" v-model="top_search" @keyup.enter="topSearchScript" >
    <button type="submit" class="absolute right-0 top-0 mt-2 mr-4 outline-none" @click="topSearchScript"><i class="fa fa-search" aria-hidden="true"></i></button>
  </div>

<!-- <svg class="mr-3 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
</svg> -->
</header>

</div>
   
</template>

<script>
  
export default {

  props: ['searchVal'],

  components: {
  },

  
  data(){
    return {
      top_search:this.searchVal,
    }
  },
  methods: {
        topSearchScript() {
          this.$emit('messageFromChild',this.top_search);
        }
    },
  
};

</script>