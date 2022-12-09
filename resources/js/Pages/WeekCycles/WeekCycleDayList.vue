<template>
   <svg xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-5 w-5 menu1-icon-color mr-4 icon-position-menu2" viewBox="0 0 20 20" fill="currentColor" @click="is_show = !is_show">
  <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
</svg>

    <div v-if="is_show" class="bg-white popup-shadow py-4  absolute right-5-menu1 top-2-menu1 rounded-md box-border">
        <ul class="w-full">
            <li class= "text-black px-8">Duplicate Component</li>
            <li class= "menu-day-background-menu1 px-8 text-black">Delete Component</li>
        </ul>
    </div>

</template>
<script>

export default {
  data() {
    return {
      is_show: 0 
    };
  },
  components: {}
};
</script>

<style>
.menu-day-background-menu1 {
background-color: #cbcbcb5c;
}
.box-sizing{
width: 100px;
height: 60px;
}

.popup-shadow {
  box-shadow: 0px 5px 10px #0000005e;
}

.right-8-menuoption{
    left: 26rem;
}
.top-4-menuoption{
    bottom: 21rem;
}

.hover-pointer{
cursor: pointer;
}

.right-5-menu1 {
    right: 2.25rem;
}

.top-2-menu1 {
    top: -1.5rem;
}


</style>