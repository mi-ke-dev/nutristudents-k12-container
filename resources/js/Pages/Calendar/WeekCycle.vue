<template>
  <tr class="bg-white">
    <td colspan="7">
      <table class="w-full table-background">
        <tr>
          <td colspan="7" class="pl-2 py-6">
            <div class="w-full flex lg:flex-nowrap relative">
           
              <h2
                class="
                  week-cycle-fontsize week-cycle-color
                  font-bold
                  pr-6
                  uppercase
                "
              >
                <i
                  class="fa fa-circle  h-2 w-2"
                  v-if="weeks.menuCycle"
                  :class="(weeks.menuCycle && weeks.menuCycle.is_guidline)?'online-color':'offline-color'"
                  aria-hidden="true"
                ></i
                >&nbsp;&nbsp;Week of {{weeks.days[0].date}} 
                <a class="ml-5 underline arrow-color" target='_blank' v-if="weeks.menuCycle && weeks.menuCycle.source != null" :href="route('menu-cycle-edit', weeks.menuCycle.source_id) +'?month=' +searchForm.month +'&year=' +searchForm.year+'&mealtype=' +searchForm.meal_type+'&agerange=' +searchForm.age_grade_offering+'&site=' +searchForm.site+'&type=' +searchForm.type+'&days=' +searchForm.day + '&is_update=' +1 + '&weekDate=' + weeks.days[0].date">  {{weeks.menuCycle.source.name}} </a>
              </h2>
              <a href="javascript:void(0)" v-if="showImport && isMenuPlanner" @click="isShowImportData=true" class="underline p-color p-size"
                >Import Week Cycle</a>
              
              <inertia-link v-if="showImport && isMenuPlanner" :href="route('menu-cycle-add') +'?month=' +searchForm.month +'&year=' +searchForm.year+'&mealtype=' +searchForm.meal_type+'&agerange=' +searchForm.age_grade_offering+'&days=' +searchForm.day+'&site=' +searchForm.site+'&guide_line_id=' +searchForm.guide_line_id+'&weekNumber=' +index+'&type=' +searchForm.type+ '&weekDate=' + weeks.days[0].date+ '&offering_id=' + searchForm.offering_id" class="pl-4 underline p-color p-size">Add Meals to Week</inertia-link>
              
              <!-- <a href="javascript:void(0)" v-if="!weeks.menuCycle"  class="pl-4 underline p-color p-size"
                >Add Meals to Week</a> -->
                <ImportWeekCycle v-if="isShowImportData"   @loadCalendar="loadCalendar" @loadMenuCycle="loadMenuCycle" @closeModal="isShowImportData=false" :daysImport="daysImport" :mealTypeImport="mealTypeImport" :graderangesImport="graderanges" :weeks="weeks" :searchForm="searchForm" :weekIndex="index" :sites="sites" :users="users" />
              <MenuWeek :week="this.index" :week_date="weeks.days[0].date" v-if="weeks.menuCycle" :searchForm="searchForm" :menuCycle="weeks.menuCycle"  />
              
            </div>
          </td>
        </tr>
        <tr>
          <calendar-day
            v-for="(day, index) in weeks.days"
            :day="day"
            :index="index"
            :menuCycle="weeks.menuCycle"
            :searchForm="searchForm"
            @copyData="copyData"
            :copiedDataId="copiedDataId"
            @loadCalendar="loadCalendar"
            :week="this.index"
            :excludeDays="excludeDays"
            @loadExcludedDateDataOnLoad="loadExcludedDateDataOnLoad"
            :isMenuPlanner="isMenuPlanner"
          ></calendar-day>
        </tr>
      </table>
    </td>    
  </tr>
  
</template>
<script>
import CalendarDay from "@/Pages/Calendar/CalendarDay";
import MenuWeek from "@/Pages/Calendar/MenuWeek";
import ImportWeekCycle from "@/Pages/Calendar/Elements/ImportWeekCycle";

export default {
  props: ["weeks", "searchForm", "index", "daysImport", "graderanges", "mealTypeImport","copiedDataId","excludeDays", "isMenuPlanner", "users"],
  components: {
    CalendarDay,
    MenuWeek,
    ImportWeekCycle
  },
  computed: {
    showImport: function () {
      if(this.weeks.days[6].is_past){
        if(!this.weeks.menuCycle){
          return true;
        } else {
          return false;
        }        
      } else {
        return false;
      }
    }
  },
  data() {
    return {
      isShowImportData:false,
      log: console.log
    }
  },
  methods:{
    
    loadCalendar(){
      this.$emit('loadCalendar');
    },
    loadExcludedDateDataOnLoad(site,guide_line_id){
      this.$emit('loadExcludedDateDataOnLoad',site,guide_line_id);
    },
    copyData(id){
      this.$emit('copyData', id);
    }
    
  }
};
</script>