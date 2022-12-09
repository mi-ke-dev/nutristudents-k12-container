<template>
  <div>
   <a class="cursor-pointer text-white text-base font-bold  text-sm  py-3  mr-1 mb-1 ease-linear transition-all duration-150"  v-on:click="toggleModal()">
     {{model_string}}
    </a>

    <div v-if="showModal" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none flex">
       <div class="relative w-auto  mx-auto xl:max-w-5xl lg:max-w-4xl md:max-w-2xl sm:max-w-xl max-w-xs">
        <!--content-->
        <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none mt-10 h-screen-95">
          <!--header-->
          <div class="sm:flex sm:items-start sm:justify-between py-5 pr-5 border-b border-solid border-blueGray-200 rounded-t">
            <h3 class="sm:text-xl text-xl font-semibold text-gray-600 pl-6">
             Add/Review Headcount 
            </h3>
             <div class = "sm:w-48 sm:flex w-full">
              <button type="button" class="ml-2 rounded-md font-bold px-4 py-2 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40 w-full" v-on:click="toggleModal()">
              Cancel
            </button>
            <button @click="saveStudentCount" type="button" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase button-color text-white  focus:outline-none  sm:w-40 mt-3 sm:mt-0 ml-2">
              Save 
            </button>
           </div>
      
          </div>
          <!--body-->
          <div class="relative p-6 flex-auto flex">
            <label class="text-gray-800 text-xl mr-10">Show:</label>
            <div class="form-check mr-8">
              <input  v-model="this.search_val" @change="check($event)" value="1" name="search" class="search_count form-check-input appearance-none h-6 w-6 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio">
              <label class="form-check-label inline-block text-gray-800 text-xs font-bold pt-2" for="flexCheckDefault">
                Days Awaiting Counts
              </label>
            </div>
            <div class="form-check mr-8">
              <input  v-model="this.search_val" @change="check($event)" value="2" name="search" class="search_count form-check-input appearance-none h-6 w-6 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio">
              <label class="form-check-label inline-block text-gray-800 text-xs font-bold pt-2" for="flexCheckChecked">
                Days With Counts
              </label>
            </div>
            <div class="form-check mr-8">
              <input  v-model="this.search_val" @change="check($event)" value="3" name="search" class="search_count form-check-input appearance-none h-6 w-6 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="radio">
              <label class="form-check-label inline-block text-gray-800 text-xs font-bold pt-2" for="flexCheckChecked">
                All Days
              </label>
            </div>
          </div>
          <div class="relative p-6 flex-auto h-screen-95 overflow-auto">
            <div v-if="getOptions.length == 0" class="text-gray-700 text-center pb-2" >
              No data found
            </div>
            <div v-for="(menu_cycle_days, index)  in getOptions">
              <div v-if="moment().isBefore(menu_cycle_days.date.date) === true">
               <!-- <div > -->
                <h3 class="text-left searching-background-color py-2 rounded-md rounded-b-none text-white font-bold text-lg px-4">{{ menu_cycle_days.date.date }} </h3>
             

                <div class="flex flex-col mb-6">
                  <div class="overflow-x-auto">
                    <div class="align-middle inline-block min-w-full">
                      <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
                        <!-- Heading -->
                        <div class="bg-gray-50 flex justify-between">
                          <div class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase w-24">&nbsp;</div>
                          <div class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase w-48">Menu Items</div>
                          <div class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase w-24">Favorite</div>
                          <div class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase w-32">Prev Count</div>
                          <div class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase w-36">Headcount</div>
                          <div class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase w-28">Apply Prev</div>
                        </div>

                        <!-- Body Option -->
                        <div v-for="(options,key) in menu_cycle_days.options">
                            <div class="flex justify-between">
                                <div  class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase w-24 whitespace-nowrap" >Option {{key +1}}</div>
                                <div class="px-3 py-3 text-sm text-gray-500 w-48 text-left">
                                  <div 
                                  class="text-left text-sm font-extrabold text-gray-600 uppercase w-24 pb-2 whitespace-nowrap" >{{ options.name }}</div> 
                                </div>
                                <div >
                                <div  class="flex justify-center w-24 padding-top-icon text-center pb-2 align-bottom h-full items-end">
                                  <svg v-if="options.is_favorite"   xmlns="http://www.w3.org/2000/svg" class="h-8 w-6 cart-color" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                  </svg>
                                  <svg  v-else xmlns="http://www.w3.org/2000/svg" class="h-8 w-6 cart-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                  </svg> 
                                  
                                </div>
                                <div   class="flex justify-center w-24 padding-top-icon text-center">&nbsp;</div>
                              </div>
                              <div class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-center w-32 align-bottom items-end pb-3 flex justify-center">&nbsp;</div>
                              <div class="px-3 py-1 whitespace-nowrap text-sm text-gray-500 text-center flex justify-center w-36 align-bottom items-end pb-3 flex justify-center"> </div>
                              <div class="px-3 py-1 whitespace-nowrap text-center w-28 align-bottom items-end pb-3 flex justify-center">
                                 
                              </div>
                            </div>
                            <div v-for="(option_components, inx) in sortedArray(options.recipes)" class="flex justify-between">
                                
                                
                              
                              <div class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase w-24" >&nbsp;</div>

                              <div class="px-3 py-3 text-sm text-gray-500 w-48 text-left">
                                  
                                  {{ option_components.name }}
                                </div>
                              <div >
                                <div  class="flex justify-center w-24 padding-top-icon text-center pb-2 align-bottom h-full items-end">

                                  <svg v-if="!is_fav[option_components.id]"  @click="is_fav[option_components.id] = true" xmlns="http://www.w3.org/2000/svg" class="h-8 w-6 cart-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                  </svg>
                                  
                                  
                                  <svg v-if="is_fav[option_components.id]" @click="is_fav[option_components.id] = false"   xmlns="http://www.w3.org/2000/svg" class="h-8 w-6 cart-color" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                  </svg>
                                </div>
                                 
                              </div>
                            
                              <div class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-center w-32 align-bottom items-end pb-3 flex justify-center">{{studentCount[option_components.option_component_id]['old_student_count']}}</div>
                              <div class="px-3 py-1 whitespace-nowrap text-sm text-gray-500 text-center flex justify-center w-36 align-bottom items-end pb-3 flex justify-center"><input v-model="studentCount[option_components.option_component_id]['student_count']" type="number" min="0" oninput="validity.valid||(value='');" class="shadow-sm focus:outline-none block w-24  px-0 h-10 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center"></div>
                              <div class="px-3 py-1 whitespace-nowrap text-center w-28 align-bottom items-end pb-3 flex justify-center">
                                <input @change="onChange(studentCount[option_components.option_component_id]['old_student_count'], studentCount[option_components.option_component_id])"  type="checkbox" :value="studentCount[option_components.option_component_id]['old_student_count']" class="w-5 h-5 appearance-none checked:bg-blue-600 rounded-sm bg-gray-100 border-gray-300 focus:ring-0 focus:ring-offset-0 cursor-pointer">
                              </div>
                            </div>
                        </div>                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
<!------------------------end------------->
          </div>
          <!--footer-->
          <div class="flex items-center justify-end p-6 border-t border-solid border-blueGray-200 rounded-b">
            <button type="button" class=" rounded-md font-bold px-4 py-2 uppercase bg-gray-500 text-white  focus:outline-none sm:w-24 w-full" v-on:click="toggleModal()">
              Cancel
            </button>
            <button @click="saveStudentCount" type="button" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase button-color text-white  focus:outline-none  sm:w-24 w-full  sm:mt-0 ml-2">
              Save
            </button>
          </div>
        </div>
      </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
  </div>
</template>

<script>
import DefaultLayout from "@/Layouts/DefaultLayout";
import Welcome from "@/Jetstream/Welcome";
import  WeekCycleDayList from "@/Pages/WeekCycles/WeekCycleDayList"; 
var moment = require('moment');

export default {

props: [
'model_string', 'calenderdays', 'meal_type_id','site_id','age_range_id', 'day', 'month', 'year', 'guide_line_id', 'offering_id'
, 'excludedDates'],
 
 components: {
    DefaultLayout,
    Welcome,
    WeekCycleDayList,
   
   
  },
  name: "large-modal",
  data() {
    return {
      showModal: false,
      studentCount:{},
      is_fav:{},
      log : console.log,
      moment: moment,
      search_val: 1
    }
  },
  computed: {
    getOptions: function () {
      let $this = this;
      let optionsArray = [];

      console.log("this.calenderdays.weeks", this.calenderdays.weeks);
      
      this.calenderdays.weeks.forEach(element => {
        if(element.menuCycle && element.menuCycle.is_guidline === true){
          if(element.menuCycle && element.menuCycle.menu_cycle_days){ 
            element.menuCycle.menu_cycle_days.forEach(el => {
              
              if(el.is_guidline === true){
                let date_diff = this.excludedDates.includes(moment(el.date.date).format('MM/DD/YYYY'));
                if(el.date.type != "next" && date_diff === false){
                  
                  el.options.forEach(option => {
                    console.log("getOptions el.date", el.date);
                  
                    if(option.menu_cycle_day_option_components){ 
                      
                      option.menu_cycle_day_option_components.forEach(oc => {
                        
                        if(this.search_val == 2 && oc.student_count != null && oc.student_count > 0){
                          optionsArray.push(el);
                        }
                        if(this.search_val == 1 && (oc.student_count == null || oc.student_count == '')){
                          optionsArray.push(el);
                        }
                        if(this.search_val == 3){
                          optionsArray.push(el);
                        }
                      });
                    }
                  });
                }
              }             
            });                   
          }
        }
      });
      return this.sortedArrayDate(optionsArray.filter(this.onlyUnique));
    }
  },
  emits: ['loadExcludedDates'], 
  methods: {
    sortedArray: function(recipe_arrays) {
      console.log("recipe_arrays", recipe_arrays);
      let a= _.orderBy(recipe_arrays, 'name', 'asc');
      a= _.orderBy(a, 'category_sort', 'asc');
      return a;
    },

    sortedArrayDate: function(recipe_arrays) {
      console.log("date", recipe_arrays);
      let a= _.orderBy(recipe_arrays, 'date.date', 'asc');
      return a;
    },

    toggleModal: function(){      
      this.showModal = !this.showModal;
      if(this.showModal){
          this.getStudentCount();
          this.getIsFav();
          this.loadExcludedDate();
      }
    },
    onlyUnique: function(value, index, self){
       return self.indexOf(value) === index;
    },
    check: function(e) {
		 this.search_val = e.target.value;
    },
    saveStudentCount(wcId){
      this.hideShowLoader('show');
      let $this = this;
      axios.post('/menu-planner/save-student-count', {studentCount:this.studentCount, fav:this.is_fav})
          .then((response)=>{
               if(response.data){
                 $this.$emit('loadCalendar');
                 $this.toggleModal();
               }
                        
            })
          .catch(error => console.error(error));
    },
    hideShowLoader(types){
      if(types == 'show'){
        document.getElementById('full_loader').style.display = 'flex';
      } else {
        document.getElementById('full_loader').style.display = 'none';
      }
    },
    getIsFav(){
      let $this = this;this.calenderdays.weeks.forEach(element => {
        if(element.menuCycle && element.menuCycle.menu_cycle_days){ 
          element.menuCycle.menu_cycle_days.forEach(el => {
            if(el.options){
              if(el.date.type != "next"){
                el.options.forEach(option => { 
                 option.recipes.forEach(recipe => { 
                  if($this.is_fav[recipe.id]){
                      $this.is_fav[recipe.id] = recipe.is_favorite;
                  } else {
                    $this.is_fav[recipe.id] ={};
                    $this.is_fav[recipe.id] = recipe.is_favorite;
                  }
                });
              });
            }
          }
        });         
          
        }
      });
    },
    getStudentCount(){
      let $this = this;
      this.calenderdays.weeks.forEach(element => {
        if(element.menuCycle && element.menuCycle.menu_cycle_days){ 
          element.menuCycle.menu_cycle_days.forEach(el => {
            if(el.options){
              if(el.date.type != "next"){
                
                el.options.forEach(option => {  
                  console.log("getStudentCount menu_cycle_day_option_components", option.menu_cycle_day_option_components);              
                if(option.menu_cycle_day_option_components){

                  option.menu_cycle_day_option_components.forEach(oc => {
                    console.log("menu_cycle_day_option_components", oc);
                    if($this.studentCount[oc.id]){
                      $this.studentCount[oc.id]['student_count'] = oc.student_count;
                      $this.studentCount[oc.id]['recipe_id'] = oc.recipe_id;
                      $this.studentCount[oc.id]['option_id'] = oc.menu_cycle_day_option_id;
                      $this.studentCount[oc.id]['meal_type_id'] = this.meal_type_id;
                      $this.studentCount[oc.id]['site_id'] = this.site_id;
                      $this.studentCount[oc.id]['age_range_id'] = this.age_range_id;
                      if(oc.food_order_student_count){
                         $this.studentCount[oc.id]['old_student_count'] = oc.food_order_student_count.student_count;
                      }else{
                         $this.studentCount[oc.id]['old_student_count'] = 0;
                      }                     

                    } else {
                      $this.studentCount[oc.id] ={};
                      $this.studentCount[oc.id]['student_count'] = oc.student_count;
                      $this.studentCount[oc.id]['recipe_id'] = oc.recipe_id;
                      $this.studentCount[oc.id]['option_id'] = oc.id;
                      $this.studentCount[oc.id]['meal_type_id'] = this.meal_type_id;
                      $this.studentCount[oc.id]['site_id'] = this.site_id;
                      $this.studentCount[oc.id]['age_range_id'] = this.age_range_id;
                      if(oc.food_order_student_count){
                         $this.studentCount[oc.id]['old_student_count'] = oc.food_order_student_count.student_count;
                      }else{
                         $this.studentCount[oc.id]['old_student_count'] = 0;
                      }
                     
                    }                   
                  });                  
                }
              });
              }
              
            }
          });    
        }
      });
    },
    onChange(value,object){
      object.student_count = value;
    },
    is_fav_click(object,value){
      value = value ? false : true;
      object.is_favorite = value;
    },
    loadExcludedDate(){
      axios
      .post("/excluded-date", {
        site_id: this.site_id,
        offering_id: this.offering_id
      })
      .then((response) => {
        // if(response != false){
          this.$emit('loadExcludedDates', response.data);
        // }
      })
      .catch((error) => console.error(error));
    }   
  }
 
}
</script>
<style>
.h-screen-95{
height: 95vh;
}
</style>