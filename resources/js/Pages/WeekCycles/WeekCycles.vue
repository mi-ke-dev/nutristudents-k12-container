<template>
  <Head>
  <title>Week Cycles | NutriStudents K-12</title>
  <meta name="description" content="Week Cycles">
  </Head>
  <default-layout>
  <PageTitleLayout>
      <div
        class="w-full flex xl:flex-nowrap flex-wrap justify-end items-center pt-10"
      >
        <div class="xl:w-1/3 w-full mr-auto">
          <h1 class="heading-color xl:text-4xl text-2xl font-bold">Week Cycles</h1>
          
        </div>
        <div class="xl:w-2/3 w-full flex xl:flex-nowrap flex-wrap xl:justify-end justify-start xl:pt-0 pt-6">

<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20" fill="currentColor" @click="textView = true; gridView = false">
<path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
</svg>


<svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 ml-2" viewBox="0 0 20 20" fill="currentColor" @click="textView = false; gridView = true">
<path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
</svg>

         <div class="relative focus:outline-none lg:w-40 md:w-32 w-full md:mr-3 mr-0 xl:mt-0 md:ml-2 ml-0 md:mt-0 mt-4">
            <select
              id="mealTypeFilter"
              name="mealTypeFilter"
              autocomplete=""
              class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="onWeekCycleFilterMethod" v-model="mealTypeFilterVal">
              <option value="">Meal Type</option>
              <option v-for="mealVal in mealtype_data" :value="mealVal.id">{{mealVal.name}}</option>
            </select>
            <div
              class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
            >
              <i class="fa fa-sort-desc" aria-hidden="true"></i>
            </div>
          </div>

         <div class="relative focus:outline-none lg:w-40 md:w-32 w-full md:mr-3 mr-0 xl:mt-0 md:ml-2 ml-0 md:mt-0 mt-4">
            <select
              id="ageRangeFilter"
              name="ageRangeFilter"
              autocomplete=""
              class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="onWeekCycleFilterMethod" v-model="ageRangeFilterVal"
            >
              <option value="">Age Range</option>
              <option v-for="ageVal in agerange_data" :value="ageVal.id">{{ageVal.name}}</option>
            </select>
            <div
              class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
            >
              <i class="fa fa-sort-desc" aria-hidden="true"></i>
            </div>
          </div>


          <div class="relative focus:outline-none lg:w-40 md:w-32 w-full md:mr-3 mr-0 xl:mt-0 md:ml-2 ml-0 md:mt-0 mt-4">
            <select
              id="daysFilter"
              name="daysFilter"
              autocomplete=""
              class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="onWeekCycleFilterMethod" v-model="daysFilterVal">
              <option value="">Days</option>
              <option v-for="daysVal in days_data" :value="daysVal.id">{{daysVal.name}}</option>
            </select>
            <div
              class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
            >
              <i class="fa fa-sort-desc" aria-hidden="true"></i>
            </div>
          </div>




          <div class="relative focus:outline-none lg:w-40 md:w-32 w-full md:mr-3 mr-0 xl:mt-0 md:ml-2 ml-0 md:mt-0 mt-4">

            <select
              id="menuUserFilter"
              name="menuUserFilter"
              autocomplete=""
              class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="onWeekCycleFilterMethod" v-model="menuUserFilterVal"
            >
              <option value="">Author</option>
              <option v-for="menu_user in menu_users" :value="menu_user[0].id">{{menu_user[0].name}}</option>
            </select>
            <div
              class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
            >
              <i class="fa fa-sort-desc" aria-hidden="true"></i>
            </div>
          </div>


          <div class="md:mr-3 mr-0">
          <inertia-link :href="route('menu-cycle-add',{mealtype:mealTypeFilterVal,agerange:ageRangeFilterVal,days:daysFilterVal})" class="button-color text-white font-bold py-3 rounded  px-4 md:mt-0 mt-4 whitespace-nowrap inline-block max-w-max ">
           CREATE NEW CYCLE
           </inertia-link>
          </div>

          <a href="javascript:void(0)" class="flex items-center" @click="clearFilter"><img :src="$page.props.asset_url + '/images/clear-filter.png'" ></a>


        </div>
      </div>
    </PageTitleLayout>
   <TableIndexLayout>
      <div class="-my-2">
        <div class="py-14 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-auto">
            <table
              class="min-w-full shadow rounded-t-lg overflow-hidden table-background"
            >
              <thead>
                <tr class="searching-background-color">
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-lg font-black text-white uppercase tracking-wider"
                  >
                    Monday
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-lg font-black text-white uppercase tracking-wider"
                  >
                    Tuesday
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-lg font-black text-white uppercase tracking-wider"
                  >
                    Wednesday
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-lg font-black text-white uppercase tracking-wider"
                  >
                    Thursday
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-lg font-black text-white uppercase tracking-wider"
                  >
                    Friday
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-lg font-black text-white uppercase tracking-wider"
                  >
                    Saturday
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-lg font-black text-white uppercase tracking-wider"
                  >
                    Sunday
                  </th>
                </tr>
              </thead>
              <tbody>

                <!-- <tr v-if="menu_cycles == first" class="bg-white">
                  <td colspan="7">
                    <table class="w-full table-background">
                  <tr>
                  <td colspan="7" class="pl-2 py-6 text-center">
                  <div class="w-full flex lg:flex-nowrap">
                  <h2 class="week-cycle-fontsize week-cycle-color font-bold pr-6 uppercase">
                  To see Week Cycles, choose a Meal Type and Age Group from the dropdown above!
                  </h2></div></td>
                  </tr>
                    </table>
                  </td>
                </tr> -->

                <tr v-if="!menu_cycles.length" class="bg-white">
                  <td colspan="7">
                    <table class="w-full table-background">
                  <tr>
                  <td colspan="7" class="pl-2 py-6 text-center">
                  <div class="w-full flex lg:flex-nowrap">
                  <h2 class="week-cycle-fontsize week-cycle-color font-bold pr-6 uppercase">
                  To see Week Cycles, choose a Meal Type, Age Range and Days from the dropdown above!
                  </h2></div></td>
                  </tr>
                    </table>
                  </td>
                </tr>

                <!-- Odd row -->
                <tr v-for="(menu_cycle,index) in sortedMenuCycle(menu_cycles)" class="bg-white" v-if="gridView">
                <td colspan="7">
                <table class="w-full table-background">
               <tr>
              <td colspan="7" class="pl-2 py-6">
               <div class="w-full flex lg:flex-nowrap relative">
                <h2
                class="week-cycle-fontsize week-cycle-color font-bold pr-6 uppercase"
              >
                {{menu_cycle.name}} by {{menu_cycle.user_name}} --{{ menu_cycle.is_tenant_admin }} 
              </h2>

            
               <MenuWeek :menuCycleId="menu_cycle.id" 
                :mealtype="mealTypeFilterVal"
                :agerange="ageRangeFilterVal"
                :days="daysFilterVal"
                :menuUserFilterVal="menuUserFilterVal"
                />
     </div>
          </td>
        </tr>

        <tr>

          <td v-for="(menu_cycle_day,index) in menu_cycle.menu_cycle_days" class="border-r-2 p-color bg-white shadow-lg td-width align-top">

            <div v-if="!menu_cycle_day" class="flex w-full h-full">
            <div class="w-full h-full">
              <img :src="$page.props.asset_url + '/images/no-food-sign2.jpg'" class="w-full h-full object-cover">
            </div>
            </div>

            <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length == 1" class="flex w-full h-full mh-135 relative box-type-show">
            <div v-for="(menu_cycle_day_option,index) in menu_cycle_day.menu_cycle_day_options" class="w-full h-full">

              <img v-if="menu_cycle_day_option.photo_store_path" :src="$page.props.storage_image_url +menu_cycle_day_option.photo_store_path" :title="getOptionName(menu_cycle_day_option)" class="w-full h-full">
              <img v-else :src="$page.props.asset_url +'/images/pizza-icon-image.jpg'" class="w-full h-full object-cover" :title="getOptionName(menu_cycle_day_option)">
            </div>
            
            <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length > 0" class=" w-12 h-12 flex items-center justify-center absolute-items box-type-show">
                

            <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length > 0" class="bg-white popup-shadow py-4 absolute-div rounded-md box-border w-60 show-box z-10">
            <ul class="w-full h-full pl-4 space-y-1">

            <li class="flex flex-nowrap items-center" v-for="(menu_cycle_day_option,indexs) in sortArrays(menu_cycle_day.menu_cycle_day_options)"  v-show="indexs == 0">
            
               <p class="flex flex-col px-2 pt-2">
                
                <span class="w-full text-black text-base uppercase option_title">{{getOptionName(menu_cycle_day_option)}}</span>
               </p>
            </li>

            </ul>
            </div>

            </div>
            </div>


            <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length == 2" class="flex flex-wrap h-full mh-135  relative">
              <div v-for="(menu_cycle_day_option,index) in menu_cycle_day.menu_cycle_day_options" class="w-full h-1/2 relative">
              <img v-if="menu_cycle_day_option.photo_store_path" :src="$page.props.storage_image_url +menu_cycle_day_option.photo_store_path" :title="getOptionName(menu_cycle_day_option)" class="w-full h-full">
              <img v-else :src="$page.props.asset_url +'/images/pizza-icon-image.jpg'" class="w-full h-full" :title="getOptionName(menu_cycle_day_option)">
              <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length > 1" class=" w-12 h-12 flex items-center justify-center absolute-items box-type-show">
                

              <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length > 1" class="bg-white popup-shadow py-4 absolute-div rounded-md box-border w-60 show-box z-10">
              <ul class="w-full h-full pl-4">

              <li class="flex flex-nowrap items-center" v-for="(menu_cycle_day_option,indexs) in sortArrays(menu_cycle_day.menu_cycle_day_options)"  v-show="indexs == index">
                
                <p class="flex flex-col px-2 pt-2">
                  
                  <span class="w-full text-black text-base uppercase option_title">{{getOptionName(menu_cycle_day_option)}}</span>
                </p>
              </li>

              </ul>
              </div>

              </div>



              </div>

             
              
            </div>

            <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length == 3" class="flex flex-wrap h-full mh-135 relative ">
              <div v-for="(menu_cycle_day_option,index) in menu_cycle_day.menu_cycle_day_options" :class="(index == 0)?'w-full h-1/2 box-type-show relative':'w-6/12 h-1/2 box-type-show relative'">
              <img v-if="menu_cycle_day_option.photo_store_path" :src="$page.props.storage_image_url +menu_cycle_day_option.photo_store_path" class="w-full h-full" :title="getOptionName(menu_cycle_day_option)">
              <img v-else :src="$page.props.asset_url +'/images/pizza-icon-image.jpg'" class="w-full h-full" :title="getOptionName(menu_cycle_day_option)">
               <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length == 3" class="bg-white popup-shadow py-4 absolute-div rounded-md box-border w-60 show-box z-10">
              <ul class="w-full h-full pl-4">

              <li class="flex flex-nowrap items-center" v-for="(menu_cycle_day_option,indexs) in sortArrays(menu_cycle_day.menu_cycle_day_options)"  v-show="indexs == index">
                
                <p class="flex flex-col px-2 pt-2">
                  
                  <span class="w-full text-black text-base uppercase option_title">{{getOptionName(menu_cycle_day_option)}}</span>
                </p>
              </li>

              </ul>
              </div>
              </div>
             
            
            </div>

            <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length == 4" class="flex flex-wrap h-full mh-135 relative">
              <div v-for="(menu_cycle_day_option,index) in menu_cycle_day.menu_cycle_day_options" class="w-6/12 h-1/2 relative" v-show="index < 4">
              <img v-if="menu_cycle_day_option.photo_store_path" :src="$page.props.storage_image_url +menu_cycle_day_option.photo_store_path" :title="getOptionName(menu_cycle_day_option)" class="w-full h-full">
              <img v-else :src="$page.props.asset_url +'/images/pizza-icon-image.jpg'" class="w-full h-full" :title="getOptionName(menu_cycle_day_option)">
               <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length == 4" class="bg-white popup-shadow py-4 absolute-div rounded-md box-border w-60 show-box z-10">
              <ul class="w-full h-full pl-4">

              <li class="flex flex-nowrap items-center" v-for="(menu_cycle_day_option,indexs) in sortArrays(menu_cycle_day.menu_cycle_day_options)"  v-show="indexs == index">
                
                <p class="flex flex-col px-2 pt-2">
                  
                  <span class="w-full text-black text-base uppercase option_title">{{getOptionName(menu_cycle_day_option)}}</span>
                </p>
              </li>

              </ul>
              </div>
              </div>
          

            </div>




            <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length > 4" class="flex flex-wrap h-full mh-135 relative">
              <div v-for="(menu_cycle_day_option,index) in menu_cycle_day.menu_cycle_day_options" class="w-6/12 h-1/2 relative" v-show="index < 4">
              <img v-if="menu_cycle_day_option.photo_store_path" :src="$page.props.storage_image_url +menu_cycle_day_option.photo_store_path" class="w-full h-full" :title="getOptionName(menu_cycle_day_option)">
              <img v-else :src="$page.props.asset_url +'/images/pizza-icon-image.jpg'" class="w-full h-full" :title="getOptionName(menu_cycle_day_option)">

                <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length > 1" class=" w-12 h-12 flex items-center justify-center absolute-items box-type-show">
                

              <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length > 4" class="bg-white popup-shadow py-4 absolute-div rounded-md box-border w-60 show-box z-10">
              <ul class="w-full h-full pl-4">

              <li class="flex flex-nowrap items-center" v-for="(menu_cycle_day_option,indexs) in sortArrays(menu_cycle_day.menu_cycle_day_options)"  v-show="indexs == index">
                
                <p class="flex flex-col px-2 pt-2">
                  
                  <span class="w-full text-black text-base uppercase option_title">{{getOptionName(menu_cycle_day_option)}}</span>
                </p>
              </li>

              </ul>
              </div>

              </div>



              </div>

              <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length > 4" class="rounded-full add_food_color w-12 h-12 flex items-center justify-center absolute-items box-type-show">
                
              <p class="text-white">+{{menu_cycle_day.menu_cycle_day_options.length - 4}}</p>




            <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length > 4" class="bg-white popup-shadow py-4 absolute-div rounded-md box-border w-60 show-box z-10">
            <ul class="w-full h-full pl-4 space-y-1">

            <li class="flex flex-nowrap items-center" v-for="(menu_cycle_day_option,indexs) in sortArrays(menu_cycle_day.menu_cycle_day_options)"  v-show="indexs >= 4">
              <img v-if="menu_cycle_day_option.photo_store_path" :src="$page.props.storage_image_url +menu_cycle_day_option.photo_store_path" class="w-3 border border-gray-100">
              <img v-else :src="$page.props.asset_url +'/images/pizza-icon-image.jpg'" class="w-3 border border-gray-100">
               <p class="flex flex-col px-2 pt-2">
                
                <span class="w-full text-black text-base uppercase option_title">{{getOptionName(menu_cycle_day_option)}}</span>
               </p>
            </li>

            </ul>
            </div>

            </div>

            </div>

          </td>

         </tr>


      </table>
    </td>
  </tr>

  <!-- <//////second row> -->
        <tr v-for="(menu_cycle,index) in sortedMenuCycle(menu_cycles)" class="bg-white" v-if="textView">
            <td colspan="7">
            <table class="w-full table-background">
                <tr>
                    <td colspan="7" class="pl-2 py-6">
                        <div class="w-full flex lg:flex-nowrap relative">
                                    <h2
                                    class="week-cycle-fontsize week-cycle-color font-bold pr-6 uppercase"
                                >
                                {{menu_cycle.name}} by {{menu_cycle.user_name}} 
                                </h2>

                            <MenuWeek :menuCycleId="menu_cycle.id" 
                            :mealtype="mealTypeFilterVal"
                            :agerange="ageRangeFilterVal"
                            :days="daysFilterVal"
                            :menuUserFilterVal="menuUserFilterVal"
                            :menu_cycle="menu_cycle"
                            />
                        </div>
                    </td>
                </tr>
                <tr>
                    <!-- {{menu_cycle.menuCycleDays}} -->
                    <td v-for="(menu_cycle_day,index) in menu_cycle.menu_cycle_days" class="border-r-2 p-color bg-white shadow-lg td-width align-top relative">

                        <div v-if="!menu_cycle_day" class="flex flex-wrap">
                            <div class="w-full h-full">
                            <ul class="pl-2 h-full w-full">
                                <li class="flex flex-nowrap"><!-- <img :src="$page.props.asset_url + '/images/no-food-sign.jpg'" class="w-3"> -->Not Available!</li>
                            </ul>
                            </div>
                        </div>
                        <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length >= 1" class="flex flex-wrap relative">
                            <div class="w-full h-full">
                                <ul class="pl-2 h-full w-full">
                                    <li v-for="(menu_cycle_day_option,index) in sortArrays(menu_cycle_day.menu_cycle_day_options)" class="flex flex-nowrap" v-show="index < 4">
                                    <p class="flex flex-col px-2 pt-2">
                                        <span class="w-full text-black text-base uppercase option_title">{{getOptionName(menu_cycle_day_option)}}</span>

                                        <span v-for="(mc_option_recipe, index) in sortedArray(menu_cycle_day_option.recipes)" class="w-full title_color hover_font_size  leading-none mb-2">
                                          <a :href="route('recipes-edit', { id: mc_option_recipe.id })" target="_blank">{{mc_option_recipe.name}}</a>
                                        </span>
                                    </p>
                                    </li>
                                </ul>
                            </div>
                            <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length > 4" class="rounded-full add_food_color w-8 h-8 flex items-center justify-center absolute-items2 box-type-show">
                                <p class="text-white">+{{menu_cycle_day.menu_cycle_day_options.length - 4}}</p>

                                <div v-if="menu_cycle_day.menu_cycle_day_options && menu_cycle_day.menu_cycle_day_options.length > 4" class="bg-white popup-shadow py-4  absolute-div rounded-md box-border w-52 show-box z-10">
                                    <ul class="w-full h-full pl-4 space-y-1">
                                        <li v-for="(menu_cycle_day_option,index) in sortArrays(menu_cycle_day.menu_cycle_day_options)" v-show="index > 3" class="flex flex-nowrap items-center">
                                          <!-- <img :src="$page.props.storage_image_url +menu_cycle_day_option.photo_store_path" class="w-3"> -->
                                          <img v-if="menu_cycle_day_option.photo_store_path" :src="$page.props.storage_image_url +menu_cycle_day_option.photo_store_path" class="w-3 border border-gray-100">
                                          <img v-else :src="$page.props.asset_url +'/images/pizza-icon-image.jpg'" class="w-3 border border-gray-100">
                                        <p class="flex flex-col px-2 pt-2"><span class="w-full text-black text-base uppercase option_title">{{getOptionName(menu_cycle_day_option)}}</span>
                                         
                                         </p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            </td>
        </tr>

  </tbody>
  </table>


          </div>

           <div class="w-full ">
           <inertia-link :href="route('menu-cycle-add',{mealtype:mealTypeFilterVal,agerange:ageRangeFilterVal,days:daysFilterVal})" class="float-right text-center button-color w-48 text-white font-bold py-3 rounded mt-4 leading-4">
           CREATE NEW CYCLE
           </inertia-link>
          </div></div></div>
</TableIndexLayout>
</default-layout>
</template>
<script>
import DefaultLayout from "@/Layouts/DefaultLayout";
import PageTitleLayout from "@/Pages/Common/PageTitle";
import TableIndexLayout from "@/Pages/Common/TableIndex";
import MenuWeek from "@/Pages/WeekCycles/MenuWeek";
import WeekCycleDayHover from "@/Pages/WeekCycles/WeekCycleDayHover";
import $ from 'jquery';

export default {
  props:['menu_cycles_data','menu_users','selected_mealtype','selected_agerange','selected_days', 'mealtype_data', 'agerange_data','days_data','menuUserWeek','mealtypeWeek','agerangeWeek','daysWeek'],

  components: {
    DefaultLayout,
    PageTitleLayout,
    TableIndexLayout,
    WeekCycleDayHover,
    MenuWeek,
  },

  data(){
    return {
      textView: true,
      gridView: false,
      menu_cycles:this.menu_cycles_data,
      mealTypeFilterVal:'',
      ageRangeFilterVal:'',
      daysFilterVal:'',
      menuUserFilterVal:"",
      next_page:"",
      form: this.$inertia.form({

      })
    }
  },

  mounted(){ 
  if(this.selected_mealtype != null && this.selected_agerange != null && this.selected_days != null){
     let $this= this;
     this.mealTypeFilterVal = this.selected_mealtype;
     this.ageRangeFilterVal = this.selected_agerange;
     this.daysFilterVal = this.selected_days;
    //  axios.post('/week-cycle-list-filter',{meal:this.mealTypeFilterVal,age_range:this.ageRangeFilterVal, days:this.daysFilterVal})
    //                 .then((response)=>{
    //                    $this.getJsonToData(response.data);
    //                   //  this.menu_cycles = response.data;
    //                  })
    //                 .catch(error => console.error(error));
  }
  if(this.daysWeek || this.agerangeWeek || this.mealtypeWeek  || this.menuUserWeek){
    this.mealTypeFilterVal = this.mealtypeWeek;
    this.ageRangeFilterVal = this.agerangeWeek;
    this.daysFilterVal = this.daysWeek;
    this.menuUserFilterVal = this.menuUserWeek;
  }
    this.onWeekCycleFilterMethod();
    this.getNextWeekCycle();
  },

   methods:{
     clearFilter(){
       this.mealTypeFilterVal = '';
       this.ageRangeFilterVal = '';
       this.daysFilterVal = '';
       this.menuUserFilterVal = '';
       this.menu_cycles = [];
     },
     getJsonToData(json_url){
       let $this= this;
       console.log("getJsonToData");
       $.getJSON(json_url, function(json_data) {
          console.log("getJsonToData json_data", json_data);
            $this.menu_cycles = $this.menu_cycles.concat(json_data.data); 
            $this.next_page = json_data.next_page_url; 
            $this.hideShowLoader('hide');         
        })
        .fail(function() { 
          $this.menu_cycles = []; 
          $this.hideShowLoader('hide'); 
        });
     },

    sortedArray: function(recipe_arrays) {
      console.log("recipe_arrays", recipe_arrays);
      let a= _.orderBy(recipe_arrays, 'name', 'asc');
      a= _.orderBy(a, 'category_sort', 'asc');
      return a;
    },
    sortedMenuCycle: function(recipe_arrays) {
      console.log("recipe_arrays", recipe_arrays);
      // let a= _.orderBy(recipe_arrays, 'name', 'asc');
      // a= _.orderBy(a, 'week_number', 'asc');
      return recipe_arrays;
    },

        getOptionName(mc){
          console.log("mc.name", mc.name, mc);

          if(mc.name == ''){
           return "Option "+ mc.sort_order;
          } else {
            return mc.name;
          }
        },

        sortArrays(arrays) {
            return _.orderBy(arrays, 'sort_order', 'asc');
        },
        hideShowLoader(types){
          if(types == 'show'){
            document.getElementById('full_loader').style.display = 'flex';
          } else {
            document.getElementById('full_loader').style.display = 'none';
          }
        },

        onWeekCycleFilterMethod(){
          let $this= this;
          if(this.mealTypeFilterVal || this.ageRangeFilterVal || this.daysFilterVal || this.menuUserFilterVal){
            this.menu_cycles = [];
            this.hideShowLoader('show');
             axios.post('/week-cycle-list-filter',{meal:this.mealTypeFilterVal,age_range:this.ageRangeFilterVal,days:this.daysFilterVal, user_id:this.menuUserFilterVal})
                    .then((response)=>{
                      $this.getJsonToData(response.data);
                      //  this.menu_cycles = response.data;
                     })
                    .catch(error => console.error(error));
          }else{
            this.menu_cycles = [];
          }
        },

        loadNextWeekCycleData(){
          let $this= this;
          if(this.mealTypeFilterVal || this.ageRangeFilterVal || this.daysFilterVal || this.menuUserFilterVal){
            let np = this.next_page;
            this.next_page = -1;  
            this.hideShowLoader('show');
             axios.post(np,{meal:this.mealTypeFilterVal,age_range:this.ageRangeFilterVal,days:this.daysFilterVal, user_id:this.menuUserFilterVal})
                    .then((response)=>{
                      $this.getJsonToData(response.data);
                      //  this.menu_cycles = response.data;
                     })
                    .catch(error => console.error(error));
          }
        },

        getNextWeekCycle() {
          let $this= this;
          window.onscroll = () => {
            let bottomOfWindow = document.documentElement.scrollTop + window.innerHeight > document.documentElement.offsetHeight;
            // console.log('getNextWeekCycle', document.documentElement.scrollTop + window.innerHeight, document.documentElement.offsetHeight);
            if (bottomOfWindow) {
              // console.log("s donw", this.next_page);
              if(this.next_page && this.next_page != -1){
                this.loadNextWeekCycleData();
              }
              
            }
          }
            // if(this.mealTypeFilterVal || this.ageRangeFilterVal || this.daysFilterVal || this.menuUserFilterVal){
            //   this.hideShowLoader('show');
            //   axios.post('/week-cycle-list-filter',{meal:this.mealTypeFilterVal,age_range:this.ageRangeFilterVal,days:this.daysFilterVal, user_id:this.menuUserFilterVal})
            //           .then((response)=>{
            //             $this.getJsonToData(response.data);
            //             //  this.menu_cycles = response.data;
            //           })
            //           .catch(error => console.error(error));
            // }else{
            //   this.menu_cycles = [];
            // }
        },


        onMenuUserWeekCycleFilterMethod(){
          let $this= this;
          if(this.menuUserFilterVal == ""){
            window.location.reload();
            }else{
            axios.post('/week-cycle-user-list-filter',{user_id:this.menuUserFilterVal})
                    .then((response)=>{
                      $this.getJsonToData(response.data);
                      //  this.menu_cycles = response.data;
                     })
                    .catch(error => console.error(error));
            }
        },

        week_cycle_edit_script(wcid) {


        },
  }
};

</script>
<style>
.font-24 {
  font-size: 24px;
}

.color-24 {
  color: #636363;
}

.p-color {
  color: #969696;
}

.p-size {
  font-size: 15px;
}

.online-color {
  color: #22af4b;
}

.offline-color {
  color: #cb0000;
}

.number-background-color {
  background-color: #cb0000;
}

.online-background-color {
  background-color: #22af4b;
}

.week-cycle-color {
  color: #38558e;
}

.week-cycle-fontsize {
  font-size: 14px;
}
.three-dot-color {
  color: #38558e;
}

.table-background {
  background-color: #f3f3f3;
}

.last-td-background {
  background-color: #f5f5f5;
}

.td-width {
  width: 14.28%;
  height: 135px;
  min-width:170px;
}
.td-width .absolute-div {
    left: 35px;
}
.cart-color {
  color: #f7a53a;
}

.plus-font-size {
  font-size: 20px;
}
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

.w-52 {
    width: 185px;
    width: 185px;
    max-height: 161px;
    overflow: auto;
    overflow-x: hidden;
}

.w-3{
  width: 60px;
  height: 60px;
}
.hover_font_size{
font-size: 13px;
font-weight: bold;
text-decoration: underline;
}
.title_color{
   color: #f7a53a;
}
.popup-shadow {
  box-shadow: 0px 5px 10px #0000005e;
}
.show-box{
display: none;
}

.box-type-show:hover .show-box{
display: block;
}

.absolute-div{
    position: absolute;
    top: 0px;
    left: 50px;
}

.add_food_color{
background-color: #38558e;
}

.absolute-items{
   position: absolute;
    top: 0px;
    right: 0px;
    left: 0px;
    bottom: 0px;
    margin: auto;
}

.absolute-items2{

   position: absolute;
    right: 8px;
    bottom: 8px;
    margin: auto;
}

.text-color-circle-icon{
  color: #38558e;
}
.mh-135{
  height: 215px;
  padding: 4px;
}
.mh-135>div{
  padding: 4px;
}
.mh-135>div img {
    object-fit: cover;
}
span.option_title {
    line-height: 17px;
    padding-bottom: 10px;
}
</style>
