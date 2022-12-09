<template>
    <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 three-dot-color ml-auto hover-pointer"
                fill="none" 
                viewBox="0 0 24 24"
                stroke="currentColor"
                @click="is_show = !is_show"
              >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
              </svg>

    <div v-if="is_show" v-click-outside="onClickOutside" class="bg-white popup-shadow py-3  absolute right-5 top-2 rounded-md box-border z-10">
    <ul class="w-full cursor-default">
        <li class="text-black px-4 hover:bg-gray-200"><button type="button" @click="addRecipeEditChild">Edit Option</button></li>
        <li class="text-black px-4 hover:bg-gray-200"><button type="button" @click="addRecipeCopyChild">Copy Option</button></li>
        <li class="px-4 text-black hover:bg-gray-200"><button type="button" @click="addRecipePasteChild">Paste Option</button></li>
        <li class="px-4 text-black hover:bg-gray-200"><button type="button" @click="addRecipeDuplicateChild">Duplicate Option</button></li>
        <li class="px-4 text-black hover:bg-gray-200"><button type="button" @click="addRecipeDeleteChild">Delete Option</button></li>
    </ul>
    </div>

</template>
<script>
import vClickOutside from "click-outside-vue3";
export default {
directives: {
      clickOutside: vClickOutside.directive
},

props:[],

components: {vClickOutside},

  data() {
    return {
      is_show: 0 
    };
  },

  methods: {
    onClickOutside () {        
        this.is_show = 0;
    },
    addRecipeEditChild() {
       this.$emit('messageFromChildEdit');
    },
    addRecipeCopyChild() {
       this.$emit('messageFromChildCopy');
    },
    addRecipePasteChild() {
       this.$emit('messageFromChildPaste');
    },
    addRecipeDuplicateChild() {
       this.$emit('messageFromChildDuplicate');
    },
    addRecipeDeleteChild() {
       this.$emit('messageFromChildDelete');
    },
  },
};
</script>

<style>
.menu-day-background {
background-color: #cbcbcb;
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


</style>