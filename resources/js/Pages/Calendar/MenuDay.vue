<template>
  <svg
    
    xmlns="http://www.w3.org/2000/svg"
    class="h-6 w-6 three-dot-color ml-auto"
    fill="none"
    viewBox="0 0 24 24"
    stroke="currentColor"
    @click="onClickCard(is_show,index)"
    if="(isHoliDay && day_id) || (isHoliDay && isPastDate)"
    
  >
    <path      
      stroke-linecap="round"
      stroke-linejoin="round"
      stroke-width="2"
      d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
    />
    
  </svg>
  <div v-if="is_show" v-click-outside="onClickOutside" class="bg-white popup-shadow py-4  absolute right-8 top-4 rounded-md box-border z-10">
    <ul class="w-full">
      
      <li v-if="isHoliDay && day_id" class="text-black px-4 cursor-pointer hover:bg-gray-200" @click="onClickCopyDay(index)">Copy Day</li>
      <li v-if="isHoliDay && isPastDate" class="text-black px-4 cursor-pointer hover:bg-gray-200" @click="onClickPasteDay(index)">Paste Day</li>
      <li v-if="isHoliDay && day_id && isPastDate" class="text-black px-4 cursor-pointer hover:bg-gray-200">
        <a  class="block" @click="onClickDay(index)" >Clear Meals from Day</a>
      </li>
      <li v-if="isHoliDay && day_id" class="text-black px-4 cursor-pointer hover:bg-gray-200">
       <a  class="block"
          :href="route('download-fpr',{id: this.day_id, curent_date: this.day.date, site_id:searchForm.site})"  
         v-if="searchForm.type != 'group'"
        >Download FPR
        </a>
      </li>
      <li v-if="isHoliDay && this.day_id" class="text-black px-4 cursor-pointer hover:bg-gray-200">
        <a class="block"
          :href="route('download-recipe-card',{id: this.day_id, curent_date: this.day.date,searchForm: this.searchForm})"  
         v-if="searchForm.type != 'group'"
        >Download Recipe Card(s)
        </a>
      </li>
      <li v-if="isHoliDay && this.day_id && is_assembly_instructions " class="text-black px-4 cursor-pointer hover:bg-gray-200">
        <a class="block"
          :href="route('download-assembly-instructions', day_id)" 
           v-if="searchForm.type != 'group'" 
        >Download Assembly Instructions
        </a>
      </li>
      
      <li v-if="isHoliDay && isPastDate"  class="text-black px-4 cursor-pointer hover:bg-gray-200">
        <a class="block"  
          @click="noMealDay(this.day.date)"
           v-if="searchForm.type != 'group'"
        >No Meal Service
        </a>
      </li>
      <li v-else class="text-black px-4 cursor-pointer hover:bg-gray-200">
        <a class="block"  
          @click="addMealDay(this.day.date)"
           v-if="searchForm.type != 'group'"
        >Add Meal Service
        </a>
      </li>
      
    </ul>
  </div>
</template>
<script>
  import vClickOutside from "click-outside-vue3";
  var moment = require('moment');
  var data = {};
  export default {
  directives: {
    clickOutside: vClickOutside.directive
  },
  props : ['day', 'index', 'menuCycle', 'searchForm','cal_days','copiedDataId','week', 'isPastDate', 'isHoliDay', 'is_assembly_instructions'],
  components: {vClickOutside},
    data() {
      return {
        is_show: 0,
        log: console.log ,
        //form: this.$inertia.form({
          copiedData: null,
          prev_index:'',
          day_id:''
        //}),
      };
    },
    computed: {
      showMenu: function () {
        if(!this.isPastDate && !this.isHoliDay){
          return false;
        } else if(!this.isPastDate && !this.day_id){
          return false;
        } else if(this.isPastDate){
          return true;
        } else {
          return true;
        }
      }
    },
    emits: ['copyData','loadCalendar'],  
    methods:{
    // showMenu(){
      
    //   // else if((this.isHoliDay && this.day_id) || (this.isHoliDay && this.isPastDate) || (this.isHoliDay && this.day_id && this.isPastDate) || (this.isHoliDay) || (this.isHoliDay && this.day_id)){
    //   //   return true;
    //   // } 


      
    //   else {
    //     return true;
    //   }
    // },
      
      onClickOutside (event) {  
        // console.log('adsfasdfsadfsafsafdsaf');      
        this.is_show = 0;
      },
      onClickDay(day_index){
         console.log('here',this.menuCycle);
        if(this.menuCycle){
         
          if(this.menuCycle.menu_cycle_days && this.menuCycle.menu_cycle_days.length > 0 ){
            this.menuCycle.menu_cycle_days.forEach(mcdays => {
              if(mcdays.day_of_week_number == day_index){
                if(confirm("Do you really want to clear meals from day?")){
                  axios
                  .post("/menu-cycle-delete-day", {
                      id: mcdays.id,
                      form: this.searchForm,
                      week: this.week,
                      week_number: day_index,
                  })
                  .then((response) => {
                    location.reload();
                  })
                  .catch((error) => console.error(error));
                }
              }
            });
          }
        }
      },
      onClickFpr(day_index){

      },
      onClickCard(is_show,day_index){
        this.is_show = !is_show;
        if(this.menuCycle){
          if(this.menuCycle.menu_cycle_days && this.menuCycle.menu_cycle_days.length > 0 ){
            this.menuCycle.menu_cycle_days.forEach(mcdays => {
              if(mcdays.day_of_week_number == day_index){
                this.day_id = mcdays.id;
              }
            });
          }
        }
      },
      onClickCopyDay(day_index){
        this.is_show = 0;
        if(this.menuCycle){
          if(this.menuCycle.menu_cycle_days && this.menuCycle.menu_cycle_days.length > 0 ){
            this.menuCycle.menu_cycle_days.forEach(mcdays => {
              if(mcdays.day_of_week_number == day_index){
                this.prev_index = day_index;
                this.copiedData = mcdays;
                this.copyData(mcdays.id);
              }
            });
          }else{
             this.copyData('');
          }
        }
      },
      onClickPasteDay(day_index){
        
        this.is_show = 0;
        if(this.copiedDataId != ''){
          axios
          .post("/menu-cycle-day-copy", {
              id: this.copiedDataId,
              week_number: day_index,
              menu_cycle: this.menuCycle,
              week: this.week,
              form: this.searchForm
          })
          .then((response) => {
            this.loadCalendar();
          })
          .catch((error) => console.error(error));
        }
      },
      copyData(data){
        this.$emit('copyData', data);
      },
      loadCalendar(){
        this.$emit('loadCalendar');
      },
      loadExcludedDateDataOnLoad(){
        this.$emit('loadExcludedDateDataOnLoad',this.searchForm.site,this.searchForm.offering_id);
      },
      noMealDay(day){
        if(confirm("Do you really want to add no meal day ?")){
          let date = moment(day).format('YYYY-MM-DD');
            axios
              .post("/no-meal-day", {
                  site: this.searchForm.site,
                  guide_line_id: this.searchForm.guide_line_id,
                  day: date,
                  offering_id:this.searchForm.offering_id
              })
              .then((response) => {
                this.loadExcludedDateDataOnLoad();
                this.loadCalendar();
              })
              .catch((error) => console.error(error));
        }
      }
      ,
      addMealDay(day){
        if(confirm("Do you really want to add meal service for the day?")){
          let date = moment(day).format('YYYY-MM-DD');
            axios
              .post("/add-meal-day", {
                  site: this.searchForm.site,
                  guide_line_id: this.searchForm.guide_line_id,
                  day: date,
                  offering_id:this.searchForm.offering_id
              })
              .then((response) => {
                this.loadExcludedDateDataOnLoad();
                this.loadCalendar();
              })
              .catch((error) => console.error(error));
        }
      }
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