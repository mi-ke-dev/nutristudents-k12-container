<template>
    <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 three-dot-color ml-auto"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                @click="is_show = !is_show"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                />
              </svg>
    <div v-if="is_show" v-click-outside="onClickOutside" class="bg-white popup-shadow py-4 absolute right-20 rounded-md box-border z-50">
        <ul class="w-full cursor-default">
           <inertia-link  :href="route('menu-cycle-edit', menuCycleId) +'?menuUser=' +menuUserFilterVal +'&mealtype=' +mealtype+'&agerange=' +agerange+'&days=' +days" ><li class= "px-4 text-black hover:bg-gray-200">Edit Menu Cycle</li></inertia-link>
            
            
            
            <li class= "px-4 text-black hover:bg-gray-200"><button type="button" @click="menuCycle_duplicate_script(menuCycleId)">Duplicate Menu Cycle</button></li>
            <!-- <li class= "px-4 text-black hover:bg-gray-200">Copy Week Cycle</li>
            <li class= "px-4 text-black hover:bg-gray-200">Paste Week Cycle</li>
            <li class= "px-4 text-black hover:bg-gray-200">Import Week Cycle</li> -->
            <li v-if="menu_cycle && menu_cycle.is_tenant_admin" class= "px-4 text-black hover:bg-gray-200"><button type="button" @click="menuCycle_delete_script(menuCycleId)">Remove Menu Cycle</button></li>
        </ul>
    </div>
{{log('mealtype',menuUserFilterVal)}}
</template>
<script>
import vClickOutside from "click-outside-vue3";
export default {
  directives: {
      clickOutside: vClickOutside.directive
  },

  props: ['menuCycleId','mealtype','agerange','days','menuUserFilterVal', 'menu_cycle'],

  components: {
    vClickOutside,
  },

  data() {
    return {
      is_show: 0,
      log:console.log,
      form: this.$inertia.form({
        mealtype: this.mealtype,
        agerange: this.agerange,
        days: this.days,
        menuUserFilterVal: this.menuUserFilterVal
      })
    };
  },

  methods:{
        
    onClickOutside (event) {
        //console.log('Clicked outside. Event: ', event);
        this.is_show = 0;
    },

    menuCycle_delete_script(menuCycleID){
       if(confirm("Are you sure you want to delete this menu cycle?")){
          this.form.post(this.route('week-cycle-delete', menuCycleID), {
                onSuccess: () => {
                  this.$toast.success('Menu Cycle deleted successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
              });
          }
    },


    menuCycle_duplicate_script(menuCycleID){
       if(confirm("Are you sure you want to duplicate this menu cycle?")){
          this.form.post(this.route('week-cycle-duplicate', menuCycleID), {
                onSuccess: () => {
                  this.$toast.success('Menu Cycle duplciated successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
              });
          }
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


</style>