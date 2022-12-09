<template>   

          <td v-if="day.type == 'next'"
            class="border-r-2 p-color last-td-background shadow-lg pb-16 td-width align-top relative box-hover"
          >
            <div class="flex lg:flex-nowrap pl-2 py-2">
              <h2 class="week-cycle-fontsize week-cycle-color font-bold pr-6">
                {{ day.date }}
              </h2>
              <MenuDay 
                :day="day"
                :menuCycle="menuCycle"
                :searchForm="searchForm"
                :index="index"
                :cal_days="cal_days"
                @copyData="copyData"
                :copiedDataId="copiedDataId"
                :isPastDate="(moment().isBefore(day.date) === true) || (moment().format('MM-DD-YYYY') === day.date)"
                :isHoliDay="verifyExcludeDay(day.date) === false"
                if="(((moment().isBefore(day.date) === true) || (moment().format('MM-DD-YYYY') === day.date)) && verifyExcludeDay(day.date) === false)"
                @loadCalendar="loadCalendar"
                :week="week"
                @loadExcludedDateDataOnLoad="loadExcludedDateDataOnLoad"
                v-if="isMenuPlanner"
              />
              
            </div>
            <div v-if="products.length == 0" class="flex justify-center flex-col items-center w-full -ml-2 mt-5">
                <!-- <img src="/vendor/nutristudents/image/not-in-session.png" alt=""> -->
                <span class="italic text-xs mt-1">Not Available!</span>
              </div>
            <p class="color-24 text-sm block pl-2" v-if="products.length > 0">
              <ul>
                  <li v-for="product in products">{{ getOptionName(product) }}</li>
              </ul>
            </p>
          </td>


          <td v-else class="border-r-2 p-color shadow-lg pb-16 td-width align-top relative box-hover"
          :class="(((moment().isBefore(day.date) === false) && (moment().format('MM-DD-YYYY') != day.date)) || verifyExcludeDay(day.date) === true) ? 'bg-grey' : 'bg-white'" 
          >
            <div class="flex lg:flex-nowrap pl-2 py-2">
              <h2 class="week-cycle-fontsize week-cycle-color font-bold pr-6">
                {{ day.date }} &nbsp;
                <span
                  v-if="cal_days"
                  class="h-2 w-2 rounded-full inline-block"
                  :class="(cal_days && cal_days.is_guidline)?'online-background-color':'offline-background-color'"
                ></span>
              </h2>
              <MenuDay 
                :day="day"
                :menuCycle="menuCycle"
                :searchForm="searchForm"
                :index="index"
                :cal_days="cal_days"
                @copyData="copyData"
                :copiedDataId="copiedDataId"
                :isPastDate="(moment().isBefore(day.date) === true) || (moment().format('MM-DD-YYYY') === day.date)"
                :isHoliDay="verifyExcludeDay(day.date) === false"
                if="(((moment().isBefore(day.date) === true) && (moment().format('MM-DD-YYYY') === day.date)) && verifyExcludeDay(day.date) === false )"
                @loadCalendar="loadCalendar"
                :week="week"
                @loadExcludedDateDataOnLoad="loadExcludedDateDataOnLoad"
                :is_assembly_instructions="is_assembly_instructions"
                v-if="isMenuPlanner"
              />

              
              
            </div>
            <p v-if="verifyExcludeDay(day.date) === false"  class="color-24 text-sm block pl-2">
              <ul>
                  <li v-for="product in products"> {{ getOptionName(product) }}

                    <span class="float-right pr-2"  v-if="searchForm.type != 'group'">{{ getOptionStudentCount(product) }}</span>
                  </li>
              </ul>
            </p>
            
            <div class="w-full absolute button-none">
              <AddToFoodOrder v-if="day.add_food_order" />
              <RemoveFromFoodOrder v-if="day.remove_food_order" />
            </div>
            <FoodOrderCartIcon v-if="day.is_cart" />
              <span v-if="verifyExcludeDay(day.date) === true" 
              class="italic text-xs mb-1 bottom-0.5 left-0 right-0 absolute m-auto text-center">Not in session!</span>
          </td>
    {{log('excludeDays',excludeDays)}} 
</template>

<script>
import AddToFoodOrder from "@/Pages/Calendar/AddToFoodOrder";
import RemoveFromFoodOrder from "@/Pages/Calendar/RemoveFromFoodOrder";
import FoodOrderCartIcon from "@/Pages/Calendar/FoodOrderCartIcon";
import MenuDay from "@/Pages/Calendar/MenuDay";
var moment = require('moment');

export default {
 props : ['day', 'index', 'menuCycle','searchForm', 'copyData','copiedDataId','week','excludeDays', 'isMenuPlanner'],
  components: {
      AddToFoodOrder,
      RemoveFromFoodOrder,
      FoodOrderCartIcon,
      MenuDay
  },
  data() {
    return {
      log:console.log,
      cal_days:null,
      moment: moment,
      is_assembly_instructions : false
    }
  },
  computed: {
    products: function () {
      this.cal_days = null;
      let $this = this;
      if(this.menuCycle){
        let options = [];
        this.menuCycle.menu_cycle_days.forEach(mcdays => {
          if(mcdays.day_of_week_number == $this.index){
            $this.is_assembly_instructions = mcdays.is_assembly_instructions;
            options = mcdays.options;
            $this.cal_days = mcdays;
          }
        });
        // console.log("products options", options);
        // let a= _.orderBy(options, 'name', 'asc');
        // a= _.orderBy(a, 'category_sort', 'asc');
        return options;
      } else {
        $this.is_assembly_instructions = false;
        return [];
      }
    },

     
  },
  methods:{
    copyData(id){
      this.$emit('copyData', id);
    },
    getOptionName(mc){
   

      if(mc.name == ''){
        return "Option "+ mc.sort_order;
      } else {
        return mc.name;
      }
    },
    loadCalendar(){
      this.$emit('loadCalendar');
    },
    loadExcludedDateDataOnLoad(site,guide_line_id){
      this.$emit('loadExcludedDateDataOnLoad',site,guide_line_id);
    },
    getOptionStudentCount(e){
      let sc = 0;
      
      e.menu_cycle_day_option_components.forEach(el => {
        if(el.student_count){
          if(sc < el.student_count)
           sc =el.student_count;
          // sc.push(el.student_count);
        }
      });
      return sc;
    },
    verifyExcludeDay(current_date){
      if(this.excludeDays){
        var new_date = moment(current_date).format('MM/DD/YYYY');
        let obj = this.excludeDays.find(o => o.date === new_date);
        if(obj){
          return true;
        }else{
          return false;
        }
      }
      return false;
      
    }
  }
};
</script>
<style scoped>
.button-none{
bottom: -100%;
z-index: 10;
}

/* .box-hover{
overflow: hidden;
} */
.box-hover:hover .button-none{ 
bottom: 0;
}
</style>