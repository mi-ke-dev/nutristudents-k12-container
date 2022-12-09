<template>
<PageTitleLayout>
    <div class="searching w-full mt-4">
<header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg w-">
 <h2 class="text-white text-lg font-bold w-11/12">Weekly Calculated Totals</h2>
 <i class="fa fa-caret-down text-white mr-auto" aria-hidden="true"></i>
 
  </header>
  </div>
   </PageTitleLayout>

     <TableIndexLayout>
      <div class="-my-2 mt-0-down">
        <div class="py-14 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-auto">
            <table class="min-w-full shadow rounded-t-lg overflow-hidden table-background">
              <thead>
                <tr class="">
                  <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                    MMA
                  </th>
                 <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                    wgr
                  </th>
                     <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                    fru
                  </th>
                    <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                    mlk
                  </th>
                    <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                    veg
                  </th>
                    <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                    dg
                  </th>
                     
                     <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                    r/o
                  </th>
                    <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                    leg
                  </th>
                  <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                    star
                  </th>
                      <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  oth
                  </th>
                    <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  cals
                  </th>
                    <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  sod (mg)
                  </th>
                     <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  fat (g)
                  </th>
                   <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  PROT (g)
                  </th>
                    <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  carb (g)
                  </th>
                </tr>
              </thead>
                <tbody>
                <!-- Odd row -->

                <tr v-if="Object.keys(weeklyAvg) == 0" class="bg-white">
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  <td class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" ><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div>
                  </td>
                  
                </tr>
                <tr v-else>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                   
                  <div :title="showMinMax('weekly_min_usda_componenent_serving_meat', 'weekly_max_usda_componenent_serving_meat')" v-if="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_meat , guideline_data.weekly_max_usda_componenent_serving_meat, parseFloat(weeklyAvg.MMA), 'component') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_meat , guideline_data.weekly_max_usda_componenent_serving_meat, parseFloat(weeklyAvg.MMA), 'component') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    
                    {{ addName(weeklyAvg.MMA)}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_usda_componenent_serving_meat && guideline_data.weekly_max_usda_componenent_serving_meat != 0">/{{guideline_data.weekly_max_usda_componenent_serving_meat}}</span> -->
                  </div>

                  <div v-else :title="showMinMax('weekly_min_usda_componenent_serving_meat', 'weekly_max_usda_componenent_serving_meat')" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{weeklyAvg.MMA}}</div>

                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
             

                  <div :title="showMinMax('weekly_min_usda_componenent_serving_grain', 'weekly_max_usda_componenent_serving_grain')" v-if="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_grain  , guideline_data.weekly_max_usda_componenent_serving_grain, parseFloat(weeklyAvg.WGR), 'component') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_grain  , guideline_data.weekly_max_usda_componenent_serving_grain, parseFloat(weeklyAvg.WGR), 'component') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.WGR)}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_usda_componenent_serving_grain && guideline_data.weekly_max_usda_componenent_serving_grain">/{{guideline_data.weekly_max_usda_componenent_serving_grain}}</span> -->
                  </div>

                  <div v-else :title="showMinMax('weekly_min_usda_componenent_serving_grain', 'weekly_max_usda_componenent_serving_grain')" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.WGR)}}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                 
                  <div :title="showMinMax('weekly_min_usda_componenent_serving_fruit', 'weekly_max_usda_componenent_serving_fruit')" v-if="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_fruit , guideline_data.weekly_max_usda_componenent_serving_fruit, parseFloat(weeklyAvg.FRU), 'component') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_fruit , guideline_data.weekly_max_usda_componenent_serving_fruit, parseFloat(weeklyAvg.FRU), 'component') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{ addName(weeklyAvg.FRU)}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_usda_componenent_serving_fruit && guideline_data.weekly_max_usda_componenent_serving_fruit != 0">/{{guideline_data.weekly_max_usda_componenent_serving_fruit}}</span> -->
                  </div>

                  <div v-else :title="showMinMax('weekly_min_usda_componenent_serving_fruit', 'weekly_max_usda_componenent_serving_fruit')" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ addName(weeklyAvg.FRU) }}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                   
                  <div :title="showMinMax('weekly_min_usda_componenent_serving_milk', 'weekly_max_usda_componenent_serving_milk')" v-if="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_milk  , guideline_data.weekly_max_usda_componenent_serving_milk, parseFloat(weeklyAvg.MLK), 'component') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_milk  , guideline_data.weekly_max_usda_componenent_serving_milk, parseFloat(weeklyAvg.MLK), 'component') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.MLK)}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_usda_componenent_serving_milk && guideline_data.weekly_max_usda_componenent_serving_milk != 0">/{{guideline_data.weekly_max_usda_componenent_serving_milk}}</span> -->
                  </div>

                  <div  :title="showMinMax('weekly_min_usda_componenent_serving_milk', 'weekly_max_usda_componenent_serving_milk')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.MLK)}}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                   
                  <div :title="showMinMax('weekly_min_usda_componenent_serving_veg', 'weekly_max_usda_componenent_serving_veg')" v-if="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_veg  , guideline_data.weekly_max_usda_componenent_serving_veg, parseFloat(weeklyAvg.VEG), 'component') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_veg  , guideline_data.weekly_max_usda_componenent_serving_veg, parseFloat(weeklyAvg.VEG), 'component') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.VEG)}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_usda_componenent_serving_veg && guideline_data.weekly_max_usda_componenent_serving_veg != 0">/{{guideline_data.weekly_max_usda_componenent_serving_veg}}</span> -->
                  </div>

                  <div :title="showMinMax('weekly_min_usda_componenent_serving_veg', 'weekly_max_usda_componenent_serving_veg')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.VEG)}}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                   
                  <div :title="showMinMax('weekly_min_usda_componenent_serving_veggrn', 'weekly_max_usda_componenent_serving_veggrn')" v-if="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_veggrn  , guideline_data.weekly_max_usda_componenent_serving_veggrn, parseFloat(weeklyAvg.DG), 'component') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_veggrn  , guideline_data.weekly_max_usda_componenent_serving_veggrn, parseFloat(weeklyAvg.DG), 'component') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.DG)}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_usda_componenent_serving_veggrn && guideline_data.weekly_max_usda_componenent_serving_veggrn != 0">/{{guideline_data.weekly_max_usda_componenent_serving_veggrn}}</span> -->
                  </div>

                  <div :title="showMinMax('weekly_min_usda_componenent_serving_veggrn', 'weekly_max_usda_componenent_serving_veggrn')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.DG)}}</div>
                  </td>
                  
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                 
                  <div :title="showMinMax('weekly_min_usda_componenent_serving_vegred', 'weekly_max_usda_componenent_serving_vegred')" v-if="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_vegred  , guideline_data.weekly_max_usda_componenent_serving_vegred, parseFloat(weeklyAvg.RO), 'component') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_vegred  , guideline_data.weekly_max_usda_componenent_serving_vegred, parseFloat(weeklyAvg.RO), 'component') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.RO)}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_usda_componenent_serving_vegred && guideline_data.weekly_max_usda_componenent_serving_vegred != 0">/{{guideline_data.weekly_max_usda_componenent_serving_vegred}}</span> -->
                  </div>

                  <div :title="showMinMax('weekly_min_usda_componenent_serving_vegred', 'weekly_max_usda_componenent_serving_vegred')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.RO)}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  
                  <div :title="showMinMax('weekly_min_usda_componenent_serving_vegleg', 'weekly_max_usda_componenent_serving_vegleg')" v-if="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_vegleg  , guideline_data.weekly_max_usda_componenent_serving_vegleg, parseFloat(weeklyAvg.LEG), 'component') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_vegleg  , guideline_data.weekly_max_usda_componenent_serving_vegleg, parseFloat(weeklyAvg.LEG), 'component') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.LEG)}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_usda_componenent_serving_vegleg && guideline_data.weekly_max_usda_componenent_serving_vegleg != 0">/{{guideline_data.weekly_max_usda_componenent_serving_vegleg}}</span> -->
                  </div>

                  <div :title="showMinMax('weekly_min_usda_componenent_serving_vegleg', 'weekly_max_usda_componenent_serving_vegleg')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.LEG)}}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
               
                  <div :title="showMinMax('weekly_min_usda_componenent_serving_vegstar', 'weekly_max_usda_componenent_serving_vegstar')" v-if="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_vegstar , guideline_data.weekly_max_usda_componenent_serving_vegstar, parseFloat(weeklyAvg.STAR), 'component') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_vegstar , guideline_data.weekly_max_usda_componenent_serving_vegstar, parseFloat(weeklyAvg.STAR), 'component') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.STAR)}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_usda_componenent_serving_vegstar && guideline_data.weekly_max_usda_componenent_serving_vegstar != 0">/{{guideline_data.weekly_max_usda_componenent_serving_vegstar}}</span> -->
                  </div>

                  <div :title="showMinMax('weekly_min_usda_componenent_serving_vegstar', 'weekly_max_usda_componenent_serving_vegstar')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.STAR)}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
           
                  <div :title="showMinMax('weekly_min_usda_componenent_serving_vegothr', 'weekly_max_usda_componenent_serving_vegothr')" v-if="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_vegothr , guideline_data.weekly_max_usda_componenent_serving_vegothr, parseFloat(weeklyAvg.OTH), 'component') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_usda_componenent_serving_vegothr , guideline_data.weekly_max_usda_componenent_serving_vegothr, parseFloat(weeklyAvg.OTH), 'component') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.OTH)}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_usda_componenent_serving_vegothr && guideline_data.weekly_max_usda_componenent_serving_vegothr != 0">/{{guideline_data.weekly_max_usda_componenent_serving_vegothr}}</span> -->
                  </div>

                  <div :title="showMinMax('weekly_min_usda_componenent_serving_vegothr', 'weekly_max_usda_componenent_serving_vegothr')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.OTH)}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                   
                  <div :title="showMinMax('weekly_min_nutrition_facts_calories', 'weekly_max_nutrition_facts_calories')" v-if="checkGuildLineVals(guideline_data.weekly_min_nutrition_facts_calories , guideline_data.weekly_max_nutrition_facts_calories, parseFloat(weeklyAvg.CALS), '') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_nutrition_facts_calories , guideline_data.weekly_max_nutrition_facts_calories, parseFloat(weeklyAvg.CALS), '') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.CALS, 'cals')}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_nutrition_facts_calories && guideline_data.weekly_max_nutrition_facts_calories != 0">/{{guideline_data.weekly_max_nutrition_facts_calories}}</span> -->
                    </div>

                  <div :title="showMinMax('weekly_min_nutrition_facts_calories', 'weekly_max_nutrition_facts_calories')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.CALS, 'cals')}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  
                  <div :title="showMinMax('weekly_min_nutrition_facts_sodium', 'weekly_max_nutrition_facts_sodium')" v-if="checkGuildLineVals(guideline_data.weekly_min_nutrition_facts_sodium , guideline_data.weekly_max_nutrition_facts_sodium, parseFloat(weeklyAvg.SOD), '') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_nutrition_facts_sodium , guideline_data.weekly_max_nutrition_facts_sodium, parseFloat(weeklyAvg.SOD), '') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.SOD, 'MG')}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_nutrition_facts_sodium && guideline_data.weekly_max_nutrition_facts_sodium != 0">/{{guideline_data.weekly_max_nutrition_facts_sodium}}</span> -->
                  </div>

                  <div :title="showMinMax('weekly_min_nutrition_facts_sodium', 'weekly_max_nutrition_facts_sodium')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.SOD, 'MG')}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  
                  <div :title="showMinMax('weekly_min_nutrition_facts_totalfat', 'weekly_max_nutrition_facts_totalfat')" v-if="checkGuildLineVals(guideline_data.weekly_min_nutrition_facts_totalfat , guideline_data.weekly_max_nutrition_facts_totalfat, parseFloat(weeklyAvg.FAT), '') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_nutrition_facts_totalfat , guideline_data.weekly_max_nutrition_facts_totalfat, parseFloat(weeklyAvg.FAT), '') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.FAT, 'g')}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_nutrition_facts_totalfat && guideline_data.weekly_max_nutrition_facts_totalfat != 0">/{{guideline_data.weekly_max_nutrition_facts_totalfat}}</span> -->
                    </div>

                  <div :title="showMinMax('weekly_min_nutrition_facts_totalfat', 'weekly_max_nutrition_facts_totalfat')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.FAT, 'g')}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  
                  <div :title="showMinMax('weekly_min_nutrition_facts_protein', 'weekly_max_nutrition_facts_protein')" v-if="checkGuildLineVals(guideline_data.weekly_min_nutrition_facts_protein ,guideline_data.weekly_max_nutrition_facts_protein, parseFloat(weeklyAvg.PROT), '') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_nutrition_facts_protein ,guideline_data.weekly_max_nutrition_facts_protein, parseFloat(weeklyAvg.PROT), '') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.PROT, 'g')}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_nutrition_facts_protein && guideline_data.weekly_max_nutrition_facts_protein != 0">/{{guideline_data.weekly_max_nutrition_facts_protein}}</span> -->
                    </div>

                  <div :title="showMinMax('weekly_min_nutrition_facts_protein', 'weekly_max_nutrition_facts_protein')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.PROT, 'g')}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                
                  <div :title="showMinMax('weekly_min_nutrition_facts_carbs', 'weekly_max_nutrition_facts_carbs')" v-if="checkGuildLineVals(guideline_data.weekly_min_nutrition_facts_carbs , guideline_data.weekly_max_nutrition_facts_carbs, parseFloat(weeklyAvg.CARB), '') != 'gray'" :class="checkGuildLineVals(guideline_data.weekly_min_nutrition_facts_carbs , guideline_data.weekly_max_nutrition_facts_carbs, parseFloat(weeklyAvg.CARB), '') == 'green'?'bg-button-color-green': 'bg-button-color'"  class="rounded min-w-min-button text-center text-white">
                    {{addName(weeklyAvg.CARB, 'g')}}
                    <!-- <span v-if="guideline_data && guideline_data.weekly_max_nutrition_facts_carbs && guideline_data.weekly_max_nutrition_facts_carbs != 0">
                      /{{guideline_data.weekly_max_nutrition_facts_carbs}}
                    </span> -->
                  </div>

                  <div :title="showMinMax('weekly_min_nutrition_facts_carbs', 'weekly_max_nutrition_facts_carbs')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{addName(weeklyAvg.CARB, 'g')}}</div>
                  </td>
                </tr>

                
                
                
  
  </tbody>

  </table>
          </div></div></div>
</TableIndexLayout>
</template>


<script>
import PageTitleLayout from "@/Pages/Common/PageTitle";
import TableIndexLayout from "@/Pages/Common/TableIndex";  
export default {
    
    props:['guideline_data','mc_weekly_avg_prods', 'weeklyAvg'],
    components: {    
    PageTitleLayout,
    TableIndexLayout,
    },
    name: "WeeklyCalculatedTotals",
    data() {
        return {
        
        };
    },

    methods: {
    showMinMax(min, max){
      let gline = this.guideline_data;
      var rText = 'Minimum: ';
      if(gline[min] && gline[min] > 0){
        rText += gline[min];
      } else {
        rText += 'n/a';
      }
      rText += ', Maximum: ';
      if(gline[max] && gline[max] > 0){
        rText += gline[max];
      } else {
        rText += 'n/a';
      }
      return rText;
    },
    roundTwoDecimals(result){
        return (result).toFixed(2);
    },

    addName(vals, name){
        if(vals > 0){
          return vals;
        } else {
          return ' - ';
        }
    },
    checkGuildLineVals(gMin, gMax, cVal, cType){
        console.log("checkGuildLineVals gMin, gMax, cVal  ", this.$helpers.checkGuildLineVals(gMin, gMax, cVal, cType), gMin, gMax, cVal, cType);
        return this.$helpers.checkGuildLineVals(gMin, gMax, cVal, cType);
        // check guildline min or max value for is not null or 0
        if(this.$helpers.checkIntOrNotNull(gMin) || this.$helpers.checkIntOrNotNull(gMax)){
          let returnVal = 'green';
          // check guidline min value is not null or 0
          if(this.$helpers.checkIntOrNotNull(gMin)){
            
            // check guidline min value <= cVal
            if(this.$helpers.checkIntOrNotNull(cVal) && gMin <= cVal){
              // return 'green';
            } else {
              console.log("this.$helpers.checkIntOrNotNull(cVal)", this.$helpers.checkIntOrNotNull(cVal));
              return 'red';
            }
          }

          // check guidline max value is not null or 0
          if(this.$helpers.checkIntOrNotNull(gMax)){
            // check guidline max value <= cVal
            if(this.$helpers.checkIntOrNotNull(cVal) && gMax >= cVal  ){
              // returnVal = 'green';
            } else {
              if(cType == 'component'){
                returnVal = 'gray';
                
              } else {
                 returnVal = 'red'; 
              }
                           
            }
          }
          return returnVal;
        } else {
          return 'gray';
        }
      }
  },


};
</script>