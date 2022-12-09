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
                  <ul class="w-full">
                      <li class="text-black px-4 cursor-pointer hover:bg-gray-200" >
                        
                        <inertia-link :href="route('menu-cycle-edit', menuCycle.id) +'?month=' +searchForm.month +'&year=' +searchForm.year+'&mealtype=' +searchForm.meal_type+'&agerange=' +searchForm.age_grade_offering+'&guide_line_id=' +searchForm.guide_line_id+'&offering_id=' +searchForm.offering_id+'&site=' +searchForm.site+'&days=' +searchForm.day+'&weekDate='+week_date+'&weekNumber=' +week+'&type=' +searchForm.type+'&is_update=1'" >Edit Week Menu</inertia-link>
                      </li>

                      <li class="text-black px-4 cursor-pointer hover:bg-gray-200" >
                        <inertia-link onclick="return confirm('Are you sure want to delete week menu?')" :href="route('menu-cycle-delete', menuCycle.id) +'?month=' +searchForm.month + '&id=' + menuCycle.id + '&year=' +searchForm.year+'&mealtype=' +searchForm.meal_type+'&agerange=' +searchForm.age_grade_offering+'&days=' +searchForm.day+'&weekNumber=' +week+'&guide_line_id=' +searchForm.guide_line_id+'&site=' +searchForm.site+'&type=' +searchForm.type" >Delete Week Menu</inertia-link>
                      </li>             
                      
                      <!-- <li @click="importWeekCycleModalOpen" class="hover:bg-gray-200 px-4 text-black cursor-pointer">Import Week Cycle</li> -->
                  </ul>
              </div>

{{log(searchForm)}}
</template>
<script>
import vClickOutside from "click-outside-vue3";
import JetDialogModal from '@/Jetstream/DialogModal';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';  

export default {

directives: {
      clickOutside: vClickOutside.directive
},

props:['menuCycle', 'searchForm','week_date','week'],

  components: {
    vClickOutside,
    JetDialogModal,
    JetSecondaryButton
  },

  data() {
    return {
      is_show: 0,
      importWeekCycleModal:false,
      
      siteFilterImport:'',
      graderangeFilterImport:'',
      mealFilterImport:'',
      currentWeek:'',
      meal_types:[],
      log : console.log
    };
  },
  mounted() {
    let date = new Date();
    //this.currentWeek = date.getWeek();
  },

  methods:{

  onClickOutside (event) {        
        this.is_show = 0;
  },

  importWeekCycleModalOpen(){      
      this.importWeekCycleModal = true;
      this.is_show = 0;
  },


    onSiteChangeCalendarFilterImport(){
      if(this.siteFilterImport == ""){
      this.$inertia.reload();
      }
    },


    onGradeRangeChangeCalendarFilterImport(){
      if(this.graderangeFilterImport == ""){
      this.$inertia.reload();
      }else{ 
            axios.post('/menu-cycle-get-meal-types',{grade_range:this.graderangeFilterImport})
                    .then((response)=>{    
                       this.meal_types = response.data;
                     })
                    .catch(error => console.error(error));           
            }
    },


    onMealChangeCalendarFilterImport(){
      if(this.mealFilterImport == ""){
      this.$inertia.reload();
      }
    },


    importWeekCycleFilterMethod(){
      if(this.siteFilterImport == ""){
        this.$toast.warning('Select Site Value!');
      }else if(this.graderangeFilterImport == ""){
        this.$toast.warning('Select Grade Range Value!');
      }else if(this.mealFilterImport == ""){
        this.$toast.warning('Select Meal Value!');
      }else{
        
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