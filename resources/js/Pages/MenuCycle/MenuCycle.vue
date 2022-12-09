<template>
  <Head>
  <title>Add Menu Cycle | NutriStudents K-12</title>
  <meta name="description" content="Add Menu Cycle">
  </Head>
  <default-layout>

<form action="#" @submit.prevent="false">
   <PageTitleLayout>
      <div
        class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center pt-10"
      >
        <div class="w-full mr-auto">
          <h1 class="heading-color xl:text-3xl text-2xl font-bold">{{ menuName }}</h1>
         
        </div>
        <div class="flex lg:flex-nowrap flex-wrap lg:justify-end md:justify-end justify-start">
            <button v-if="(this.guide_line_id != '' && this.guide_line_id != null)" @click="changeMonthYearModalOpen()" class="md:w-60 w-full button-color text-white font-bold py-3 rounded md:mt-0 mt-4 px-4 md:mr-2 ml-0 leading-4 uppercase">Save as New Week Cycle</button>

            <div>
            <inertia-link 
                v-if="this.offering_id != ''" 
                :href="
                  $page.props.site_url +
                  '/menu-planner' +
                  '?month=' +
                  month +
                  '&year=' +
                  year +
                  '&type=' +
                  type +
                  '&site=' +
                  form.site +
                  '&guide_line_id=' +
                  form.guideline_id +
                  '&offering_id=' +
                  form.offering_id
                "
                class="md:w-24 w-full button-color text-white font-bold py-3 rounded lg:mt-0 sm:mt-4 px-4 cancel-background-color leading-4 inline-block"
               >CANCEL
               </inertia-link>
            <inertia-link v-if="this.offering_id === ''" :href="route('week-cycles')" class="md:w-24 w-full button-color text-white font-bold py-3 rounded lg:mt-0 sm:mt-4 px-4 cancel-background-color max-w-max inline-block leading-4">
            CANCEL
            </inertia-link>
            </div>

            <button type="submit" @click="menucycle_add_save_script" class="md:w-24 w-full button-color text-white font-bold py-3 rounded md:mt-0 mt-4 px-4 md:ml-2 ml-0 leading-4">SAVE</button>
        </div>
      </div>
     </PageTitleLayout>

     <PageTitleLayout  v-if="(this.guide_line_id === '' || this.guide_line_id === null)">
       <div
        class="w-full pt-4 pb-8 mt-4 font-bold bg-white white-shadow-box">
      <div
        class="flex lg:flex-nowrap flex-wrap font-bold items-center w-full">
        <div class="flex mt-6 ml-4  md:w-40 w-full">
        <label>Name*</label>
        </div>
        <div class="flex mt-4 ml-4 lg:w-4/5 md:w-3/5 w-full">
        <div class="relative focus:outline-none md:w-3/5 w-full mr-3 xl:mt-0 md:ml-2 ml-0">
                <input type="text" placeholder="Week1" id="mc_name" name="mc_name" v-model="form.mc_name" class="w-full shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg w-full select-menu-height input-background">
                <div v-if="form.errors.mc_name" class="validation_error_msg">{{ form.errors.mc_name }}</div>
              </div>
        </div>
      </div>


      <div
        class="flex lg:flex-nowrap flex-wrap font-bold items-center w-full">
        <div class="flex mt-6 ml-4  md:w-40 w-full">
        <label>Week Number</label>
        </div>
        <div class="flex mt-4 ml-4 lg:w-4/5 md:w-3/5 w-full">
        <div class="relative focus:outline-none md:w-3/5 w-full mr-3 xl:mt-0 md:ml-2 ml-0">
                <input type="number" min="0" placeholder="Week number"  v-model="form.week_number" class="w-full shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg w-full select-menu-height input-background">
                <div v-if="form.errors.week_number" class="validation_error_msg">{{ form.errors.week_number }}</div>
              </div>
        </div>
      </div>


     <div class="flex lg:flex-nowrap flex-wrap font-bold">
     <div class="flex mt-6 ml-4 md:w-40 w-full">
     <label class="">Meal Type*</label>
     </div>
     <div class="flex mt-4 ml-4 lg:w-56 md:w-40 w-full">
    <div class="relative focus:outline-none lg:w-56 md:w-40 w-full mr-3 xl:mt-0 md:ml-2 ml-0">
          
            <select :disabled="!is_fav_show ? true: false" id="meal_type_id" name="meal_type_id" v-model="form.meal_type_id"
              class="input-background shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="updateGuidelineValues">
              <option value="">Select</option>
              <option v-for="mealVal in mealtype_data" :value="mealVal.id">{{mealVal.name}}</option>
            </select>
            <div
              class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
            >
              <i class="fa fa-sort-desc" aria-hidden="true"></i>
            </div>
            <div v-if="form.errors.meal_type_id" class="validation_error_msg">{{ form.errors.meal_type_id }}</div>
          </div>
     </div>
     </div>

     <div class="flex lg:flex-nowrap flex-wrap font-bold">
     <div class="flex mt-6 ml-4 md:w-40 w-full">
     <label class="">Age Range*</label>
     </div>
     <div class="flex mt-4 ml-4 lg:w-56 md:w-40 w-full">
    <div class="relative focus:outline-none lg:w-56 md:w-40 w-full mr-3 xl:mt-0 md:ml-2 ml-0">
        
            <select :disabled="!is_fav_show ? true: false" id="age_grade_id" name="age_grade_id" v-model="form.age_grade_id"
              class="input-background shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="updateGuidelineValues">
              <option value="">Select</option>
              <option v-for="ageVal in agerange_data" :value="ageVal.id">{{ageVal.name}}</option>
            </select>
            <div
              class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
            >
              <i class="fa fa-sort-desc" aria-hidden="true"></i>
            </div>
            <div v-if="form.errors.age_grade_id" class="validation_error_msg">{{ form.errors.age_grade_id }}</div>
          </div>
     </div>
     </div>

     <div class="flex lg:flex-nowrap flex-wrap font-bold">
     <div class="flex mt-6 ml-4 md:w-40 w-full">
     <label class="">Days*</label>
     </div>
     <div class="flex mt-4 ml-4 lg:w-56 md:w-40 w-full">
    <div class="relative focus:outline-none lg:w-56 md:w-40 w-full mr-3 xl:mt-0 md:ml-2 ml-0">
            <select :disabled="!is_fav_show  ? true: false" id="days_id" name="days_id" v-model="form.days_id"
              class="input-background shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="updateGuidelineValues">
              <option value="">Select</option>
              <option v-for="daysVal in days_data" :value="daysVal.id">{{daysVal.name}}</option>
            </select>
            <div
              class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
            >
              <i class="fa fa-sort-desc" aria-hidden="true"></i>
            </div>
            <div v-if="form.errors.days_id" class="validation_error_msg">{{ form.errors.days_id }}</div>
          </div>
     </div>
     </div>

     <div class="flex lg:flex-nowrap flex-wrap font-bold items-center w-full">
      <div class="flex mt-6 ml-4 md:w-40 w-full">
        <label>Guideline*</label>
      </div>
      <div class="flex mt-4 ml-4 lg:w-56 md:w-40 w-full">
      <div class="relative focus:outline-none lg:w-56 md:w-40 w-full mr-3 xl:mt-0 md:ml-2 ml-0">
             
              <select :disabled="!is_fav_show  ? true: false" id="guideline" name="guideline_id" class="input-background shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" v-model="form.guideline_id" @change="getComponentTotalsAsPerOffering($event)">
                <option value="">Select</option>
                <option v-for="(guideline, index) in guidelines" :value="guideline.id">{{guideline.name}}</option>
              </select>
              <div
                class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
              >
                <i class="fa fa-sort-desc" aria-hidden="true"></i>
              </div>

              <div v-if="form.errors.guideline_id" class="validation_error_msg">{{ form.errors.guideline_id }}</div>
            </div>
      </div>
     </div>
     
     <div v-if="this.guide_line_id != null" class="flex lg:flex-nowrap flex-wrap font-bold items-center w-full">
      <div class="flex mt-6 ml-4 md:w-40 w-full">
        <label>Save This for Future</label>
      </div>
      <div class="flex mt-4 ml-4 lg:w-56 md:w-40 w-full">
      <div class="relative focus:outline-none lg:w-56 md:w-40 w-full mr-3 xl:mt-0 md:ml-2 ml-0">
              <input type="checkbox" class="w-5 h-5 appearance-none checked:bg-blue-600 rounded-sm bg-gray-100 border-gray-300 focus:ring-0 focus:ring-offset-0 cursor-pointer" v-model="form.is_template" >
              
            </div>
      </div>
     </div>

   </div>


     </PageTitleLayout>


     <!-- <PageTitleLayout>
      <div class="w-full pt-4 mt-4 pb-4 mb-4 font-bold bg-white white-shadow-box">

     </div>
     </PageTitleLayout> -->

<WeeklyCalculatedTotals :guideline_data="guideline_data" :mc_weekly_avg_prods="mc_weekly_avg_prods" :weeklyAvg="weeklyAvg" />




<!-- Week Days starts from here... -->

<div class="w-full xl:px-10 px-5 pb-10 overflow-x-auto">
  <div class="flex flex-nowrap pt-0 pb-10 overflow-x-auto items-start">


<div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_mon)">Monday</h2>

  <a href="#" @click="addRecipeOptionMenuCycle(1)">
    <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>

  <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white pt-2 pr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
  </svg> -->

  </header>

            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_mon" />

                <div v-if="!mc_final_options_mon.length" class="w-full flex flex-wrap items-center justify-center py-4">
                 <div>
                   <div class="text-center pl-8">
                     <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'"></div>
                     <p class="pt-4 pl-2">Nothing Here Yet</p>
                     <a href="#" @click="addRecipeOptionMenuCycle(1)" class="underline text-center block">Add A Menu Option</a>
                     <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_mon.length, 1)" class="underline text-center block">Paste Menu Option</button>
                   </div>
                 </div>

                <div v-else class="">
                <div v-for="(mc_option, index) in sortArrays(mc_final_options_mon)" class="px-4 py-4">
                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase "><div class=" cursor-pointer" :title="$helpers.getByName(mc_option.total_val)">{{ mc_option.name }} <!-- <i class="fa fa-star icon-star-color" aria-hidden="true"></i> --></div>
                        <div>
                          <MenuOption @messageFromChildEdit="addOptionEditScript(mc_option, index, 1)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_mon.length, 1)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_mon.length, 1)" @messageFromChildDelete="addOptionDeleteScript(index, 1)" />
                        </div>
                      </li>

                      <li v-for="(mc_option_recipe, index) in sortedArray(mc_option.recipes)" class="flex flex-nowrap justify-between pb-4 cursor-pointer" :title="$helpers.getByName(mc_option_recipe.total_val)">
                        <div  class="text-sm font-bold text-color-first-li">
                          <a target="_blank" :href="route('recipes-edit', { id: mc_option_recipe.id })">{{mc_option_recipe.name}}</a>
                          </div>
                         

                        <div class="text-sm">{{ $helpers.getByFirstName(mc_option_recipe.total_val)}}</div>

                      </li>
                    </ul>
                  </div>
                </div>
                </div>


</div>


 <div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_tue)">Tuesday</h2>

  <a href="#" @click="addRecipeOptionMenuCycle(2)">
    <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>
 <!-- <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-white pt-2 pr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"

              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                />
              </svg> -->
  </header>


            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_tue" />

                <div v-if="!mc_final_options_tue.length" class="w-full flex flex-wrap items-center justify-center py-4">
                 <div>
                   <div class="text-center pl-8">
                     <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'"></div>
                     <p class="pt-4 pl-2">Nothing Here Yet</p>
                     <a href="#" @click="addRecipeOptionMenuCycle(2)" class="underline text-center block">Add A Menu Option</a>
                     <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_tue.length, 2)" class="underline text-center block">Paste Menu Option</button>
                   </div>
                 </div>


                 <div v-else v-for="(mc_option, index) in sortArrays(mc_final_options_tue)" class="px-4 py-4">
                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase"><div :title="$helpers.getByName(mc_option.total_val)" class=" cursor-pointer">{{ mc_option.name }} <!-- <i class="fa fa-star icon-star-color" aria-hidden="true"></i> --></div>
                        <div>
                          <MenuOption @messageFromChildEdit="addOptionEditScript(mc_option, index, 2)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_tue.length, 2)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_tue.length, 2)" @messageFromChildDelete="addOptionDeleteScript(index, 2)" />
                        </div>
                      </li>

                      <li v-for="(mc_option_recipe, index) in sortedArray(mc_option.recipes)" class="flex flex-nowrap justify-between pb-4 cursor-pointer" :title="$helpers.getByName(mc_option_recipe.total_val)">

                        <div  class="text-sm font-bold text-color-first-li">
                          <a target="_blank" :href="route('recipes-edit', { id: mc_option_recipe.id })">{{mc_option_recipe.name}}</a>
                          </div>

                        <div class="text-sm">{{ $helpers.getByFirstName(mc_option_recipe.total_val)}}</div>

                      </li>
                    </ul>
                  </div>
                </div>

</div>


<div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_wed)">Wednesday</h2>

  <a href="#" @click="addRecipeOptionMenuCycle(3)">
   <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>

 <!-- <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-white pt-2 pr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"

              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                />
              </svg> -->
  </header>


            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_wed" />

                <div v-if="!mc_final_options_wed.length" class="w-full flex flex-wrap items-center justify-center py-4">
                 <div>
                   <div class="text-center pl-8">
                    <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'"></div>
                    <p class="pt-4 pl-2">Nothing Here Yet</p>
                    <a href="#" @click="addRecipeOptionMenuCycle(3)" class="underline text-center block">Add A Menu Option</a>
                    <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_wed.length, 3)" class="underline text-center block">Paste Menu Option</button>
                  </div>
                </div>


                <div v-else v-for="(mc_option, index) in sortArrays(mc_final_options_wed)" class="px-4 py-4">
                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase"><div :title="$helpers.getByName(mc_option.total_val)" class=" cursor-pointer">{{ mc_option.name }} <!-- <i class="fa fa-star icon-star-color" aria-hidden="true"></i> --></div>
                        <div>
                          <MenuOption @messageFromChildEdit="addOptionEditScript(mc_option, index, 3)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_wed.length, 3)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_wed.length, 3)" @messageFromChildDelete="addOptionDeleteScript(index, 3)" />
                        </div>
                      </li>

                      <li v-for="(mc_option_recipe, index) in sortedArray(mc_option.recipes)" class="flex flex-nowrap justify-between pb-4 cursor-pointer" :title="$helpers.getByName(mc_option_recipe.total_val)">

                        <div  class="text-sm font-bold text-color-first-li">
                          <a target="_blank" :href="route('recipes-edit', { id: mc_option_recipe.id })">{{mc_option_recipe.name}}</a>
                          </div> 
                        <div class="text-sm">{{ $helpers.getByFirstName(mc_option_recipe.total_val)}}</div>

                      </li>
                    </ul>
                  </div>
                </div>



</div>

<!-----------------fourth------>
<div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_thu)">Thursday</h2>
  <a href="#" @click="addRecipeOptionMenuCycle(4)">
   <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>
 <!-- <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-white pt-2 pr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"

              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                />
              </svg> -->
  </header>


            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_thu" />


                <div v-if="!mc_final_options_thu.length" class="w-full flex flex-wrap items-center justify-center py-4">
                 <div>
                   <div class="text-center pl-8">
                    <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'"></div>
                    <p class="pt-4 pl-2">Nothing Here Yet</p>
                    <a href="#" @click="addRecipeOptionMenuCycle(4)" class="underline text-center block">Add A Menu Option</a>
                    <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_thu.length, 4)" class="underline text-center block">Paste Menu Option</button>
                  </div>
                </div>


                <div v-else v-for="(mc_option, index) in sortArrays(mc_final_options_thu)" class="px-4 py-4">
                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase"><div :title="$helpers.getByName(mc_option.total_val)" class=" cursor-pointer">{{ mc_option.name }} <!-- <i class="fa fa-star icon-star-color" aria-hidden="true"></i> --></div>
                        <div>
                          <MenuOption @messageFromChildEdit="addOptionEditScript(mc_option, index, 4)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_thu.length, 4)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_thu.length, 4)" @messageFromChildDelete="addOptionDeleteScript(index, 4)" />
                        </div>
                      </li>

                      <li v-for="(mc_option_recipe, index) in sortedArray(mc_option.recipes)" class="flex flex-nowrap justify-between pb-4 cursor-pointer" :title="$helpers.getByName(mc_option_recipe.total_val)">

                        <div  class="text-sm font-bold text-color-first-li">
                          <a target="_blank" :href="route('recipes-edit', { id: mc_option_recipe.id })">{{mc_option_recipe.name}}</a>
                          </div> 
                        <div class="text-sm">{{ $helpers.getByFirstName(mc_option_recipe.total_val)}}</div>

                      </li>
                    </ul>
                  </div>
                </div>



</div>
<!--------fivth----->
<div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_fri)">Friday</h2>
  <a href="#" @click="addRecipeOptionMenuCycle(5)">
    <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>
 <!-- <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-white pt-2 pr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"

              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                />
              </svg> -->
  </header>


            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_fri" />


                <div v-if="!mc_final_options_fri.length" class="w-full flex flex-wrap items-center justify-center py-4">
                 <div>
                   <div class="text-center pl-8">
                    <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'"></div>
                    <p class="pt-4 pl-2">Nothing Here Yet</p>
                    <a href="#" @click="addRecipeOptionMenuCycle(5)" class="underline text-center block">Add A Menu Option</a>
                    <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_fri.length, 5)" class="underline text-center block">Paste Menu Option</button>
                  </div>
                </div>


                <div v-else v-for="(mc_option, index) in sortArrays(mc_final_options_fri)" class="px-4 py-4">
                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase"><div :title="$helpers.getByName(mc_option.total_val)" class=" cursor-pointer">{{ mc_option.name }} <!-- <i class="fa fa-star icon-star-color" aria-hidden="true"></i> --></div>
                        <div>
                          <MenuOption @messageFromChildEdit="addOptionEditScript(mc_option, index, 5)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_fri.length, 5)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_fri.length, 5)" @messageFromChildDelete="addOptionDeleteScript(index, 5)" />
                        </div>
                      </li>

                      <li v-for="(mc_option_recipe, index) in sortedArray(mc_option.recipes)" class="flex flex-nowrap justify-between pb-4 cursor-pointer" :title="$helpers.getByName(mc_option_recipe.total_val)">

                       <div  class="text-sm font-bold text-color-first-li">
                          <a target="_blank" :href="route('recipes-edit', { id: mc_option_recipe.id })">{{mc_option_recipe.name}}</a>
                          </div>

                        <div   class="text-sm">{{ $helpers.getByFirstName(mc_option_recipe.total_val)}}</div>

                      </li>
                    </ul>
                  </div>
                </div>



</div>
<!------------------six----------->
<div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_sat)">Saturday</h2>
  <a href="#" @click="addRecipeOptionMenuCycle(6)">
   <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>
 <!-- <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-white pt-2 pr-2"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"

              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                />
              </svg> -->
  </header>


            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_sat" />


                <div v-if="!mc_final_options_sat.length" class="w-full flex flex-wrap items-center justify-center py-4">
                 <div>
                   <div class="text-center pl-8">
                    <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'">
                    </div>
                    <p class="pt-4 pl-2">Nothing Here Yet</p>
                    <a href="#" @click="addRecipeOptionMenuCycle(6)" class="underline text-center block">Add A Menu Option</a>
                    <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_sat.length, 6)" class="underline text-center block">Paste Menu Option</button>
                  </div>
                </div>


                <div v-else v-for="(mc_option, index) in sortArrays(mc_final_options_sat)" class="px-4 py-4">
                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase"><div :title="$helpers.getByName(mc_option.total_val)" class=" cursor-pointer">{{ mc_option.name }} <!-- <i class="fa fa-star icon-star-color" aria-hidden="true"></i> --></div>
                        <div>
                          <MenuOption @messageFromChildEdit="addOptionEditScript(mc_option, index, 6)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_sat.length, 6)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_sat.length, 6)" @messageFromChildDelete="addOptionDeleteScript(index, 6)" />
                        </div>
                      </li>

                      <li v-for="(mc_option_recipe, index) in sortedArray(mc_option.recipes)" class="flex flex-nowrap justify-between pb-4 cursor-pointer" :title="$helpers.getByName(mc_option_recipe.total_val)">

                      <div  class="text-sm font-bold text-color-first-li">
                          <a target="_blank" :href="route('recipes-edit', { id: mc_option_recipe.id })">{{mc_option_recipe.name}}</a>
                          </div>

                        <div  class="text-sm">{{ $helpers.getByFirstName(mc_option_recipe.total_val)}}</div>

                      </li>
                    </ul>
                  </div>
                </div>



</div>
<!--------seven------->
<div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_sun)">Sunday</h2>
  <a href="#" @click="addRecipeOptionMenuCycle(7)">
   <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>
  </header>


            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_sun" />


                <div v-if="!mc_final_options_sun.length" class="w-full flex flex-wrap items-center justify-center py-4">
                 <div>
                   <div class="text-center pl-8">
                    <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'"></div>
                    <p class="pt-4 pl-2">Nothing Here Yet</p>
                    <a href="#" @click="addRecipeOptionMenuCycle(7)" class="underline text-center block">Add A Menu Option</a>
                    <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_sun.length, 7)" class="underline text-center block">Paste Menu Option</button>
                  </div>
                </div>


                <div v-else v-for="(mc_option, index) in sortArrays(mc_final_options_sun)" class="px-4 py-4">
                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded">

                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase"><div :title="$helpers.getByName(mc_option.total_val)" class=" cursor-pointer">{{ mc_option.name }} <!-- <i class="fa fa-star icon-star-color" aria-hidden="true"></i> --></div>
                        <div>
                          <MenuOption @messageFromChildEdit="addOptionEditScript(mc_option, index, 7)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_sun.length, 7)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_sun.length, 7)" @messageFromChildDelete="addOptionDeleteScript(index, 7)"/>
                        </div>
                      </li>

                      <li v-for="(mc_option_recipe, index) in sortedArray(mc_option.recipes)" class="flex flex-nowrap justify-between pb-4 cursor-pointer" :title="$helpers.getByName(mc_option_recipe.total_val)">

                      <div  class="text-sm font-bold text-color-first-li">
                          <a target="_blank" :href="route('recipes-edit', { id: mc_option_recipe.id })">{{mc_option_recipe.name}}</a>
                          </div>

                        <div   class="text-sm">{{ $helpers.getByFirstName(mc_option_recipe.total_val)}}</div>

                      </li>
                    </ul>
                  </div>
                </div>

</div>

 </div>
  </div>

</form>
<WeekCycleDayHover v-if="addRecipesOptionModal" :addRecipesOptionModal="addRecipesOptionModal" :dayNumber="day_number" :optionNumber="option_number" :editOptionData="editOptionData" :categories="categories" @closeModal="closeOptionsModal" @closeEditModal="closeEditOptionsModal" :name="name" :is_fav_show="is_fav_show" :mass_measurements="mass_measurements" :volume_measurements="volume_measurements" :unit_measurements="unit_measurements" />
</default-layout>


<jet-dialog-modal
    :show="changeMonthYearModal"
    @close="changeMonthYearModal = false"
  >
  
    <template #title>
      <div class="flex justify-between items-center">Week Cycle</div>
    </template>
     <template #content>
        <div class="row">
          <div class="flex mt-6 ml-4 lg:w-4/5 md:w-3/5 w-full">
           <label>Name*</label>
            <div class="relative focus:outline-none md:w-3/5 w-full mr-3 xl:mt-0 md:ml-2 ml-0">
              <input type="text" placeholder="Week1" id="mc_name" name="mc_name" v-model="form.mc_name" class="w-full shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg w-full select-menu-height input-background">
              <div v-if="form.errors.mc_name" class="validation_error_msg">{{ form.errors.mc_name }}</div>
            </div>
          </div>
        </div>
     </template>
   

    <template #footer>
       <button type="submit" @click="saveAsTemplate" class="md:w-24 w-full button-color text-white font-bold py-3 rounded md:mt-0 mt-4 px-4 md:ml-2 ml-0 text-xs mr-2">SAVE</button>
      <jet-secondary-button @click="changeMonthYearModal = false"
        class="py-3">Close</jet-secondary-button
      >
    </template>
  </jet-dialog-modal>
</template>
<script>
import DefaultLayout from "@/Layouts/DefaultLayout";
import PageTitleLayout from "@/Pages/Common/PageTitle";
import TableIndexLayout from "@/Pages/Common/TableIndex";
import MenuOption from "@/Pages/MenuCycle/MenuOption";
import BreadcrumLayout from "@/Pages/Common/Breadcrumbs";
import JetButton from '@/Jetstream/Button';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import JetDialogModal from '@/Jetstream/DialogModal';
import WeekCycleDayHover from "@/Pages/WeekCycles/WeekCycleDayHover";
import WeeklyCalculatedTotals from "@/Pages/MenuCycle/WeeklyCalculatedTotals";
import WeekDayTotals from "@/Pages/MenuCycle/WeekDayTotals";

export default {
  props:['selected_mealtype','selected_agerange','selected_days', 'mealtype_data', 'agerange_data','days_data', 'categories', 'month', 'year', 'weekNumber','site','guide_line_id', 'menuName', 'is_template', 'is_fav_show', "mass_measurements", "volume_measurements", "unit_measurements","type",'offering_id'],
  components: {
    DefaultLayout,
    PageTitleLayout,
    TableIndexLayout,
    BreadcrumLayout,
    MenuOption,
    JetButton,
    JetSecondaryButton,
    JetDialogModal,
    WeekCycleDayHover,
    WeeklyCalculatedTotals,
    WeekDayTotals
  },

  data(){
    return {

      // meal_types : this.meal_types_data,
      // guideline_data:'',
      // offering_site:[],
      log: console.log,
      changeMonthYearModal: false,
      name:'',
      guidelines:[],
      guideline_data:[],

      mc_final_options_mon: [],
      mc_final_options_tue: [],
      mc_final_options_wed: [],
      mc_final_options_thu: [],
      mc_final_options_fri: [],
      mc_final_options_sat: [],
      mc_final_options_sun: [],

      mc_recipes_mon:[],
      mc_recipes_tue:[],
      mc_recipes_wed:[],
      mc_recipes_thu:[],
      mc_recipes_fri:[],
      mc_recipes_sat:[],
      mc_recipes_sun:[],

      mc_recipe_prefer_prod_mon:[],
      mc_recipe_prefer_prod_tue:[],
      mc_recipe_prefer_prod_wed:[],
      mc_recipe_prefer_prod_thu:[],
      mc_recipe_prefer_prod_fri:[],
      mc_recipe_prefer_prod_sat:[],
      mc_recipe_prefer_prod_sun:[],

      mc_daily_sum_prod_mon:[],
      mc_daily_sum_prod_tue:[],
      mc_daily_sum_prod_wed:[],
      mc_daily_sum_prod_thu:[],
      mc_daily_sum_prod_fri:[],
      mc_daily_sum_prod_sat:[],
      mc_daily_sum_prod_sun:[],

      mc_daily_sum_prod_mon_all_data:[],
      mc_daily_sum_prod_tue_all_data:[],
      mc_daily_sum_prod_wed_all_data:[],
      mc_daily_sum_prod_thu_all_data:[],
      mc_daily_sum_prod_fri_all_data:[],
      mc_daily_sum_prod_sat_all_data:[],
      mc_daily_sum_prod_sun_all_data:[],

      mc_weekly_avg_prods:[],

      day_number:0,
      option_number:0,
      editOptionData:[],

      addRecipesOptionModal:false,

      copied_option_data:'',

      sum_products_daily:[],
      avg_products_weekly:[],
      avg_products_weekly_all_data:[[],[],[],[],[],[],[]],
      todal_days:0,

      form: this.$inertia.form({
        is_template: this.is_template,
        mc_name : '',
        mc_meal_type : '',
        mc_grade_range : '',
        week_number:'',

        meal_type_id : '',
        age_grade_id : '',
        days_id : '',
        guideline_id: this.guide_line_id,
        site: this.site,
        type: this.type,
        offering_id: this.offering_id,
        month:this.month,
        year:this.year,
        weekNumber:this.weekNumber,
        mealtype:'',
        agerange:'',
        days:'',

        mc_options_mon: [],
        mc_options_tue: [],
        mc_options_wed: [],
        mc_options_thu: [],
        mc_options_fri: [],
        mc_options_sat: [],
        mc_options_sun: [],
      })
    }
  },

  computed: {
    // a computed getter
    weeklyAvg: function () {
      // `this` points to the vm instance
      let totalWeekDays = [];
      if( this.mc_daily_sum_prod_mon != null &&  Object.entries(this.mc_daily_sum_prod_mon).length > 0){
        totalWeekDays.push(this.mc_daily_sum_prod_mon);
      }

      if( this.mc_daily_sum_prod_tue != null &&  Object.entries(this.mc_daily_sum_prod_tue).length > 0){
        totalWeekDays.push(this.mc_daily_sum_prod_tue);
      }

      if( this.mc_daily_sum_prod_wed != null &&  Object.entries(this.mc_daily_sum_prod_wed).length > 0){
        totalWeekDays.push(this.mc_daily_sum_prod_wed);
      }
      if( this.mc_daily_sum_prod_thu != null &&  Object.entries(this.mc_daily_sum_prod_thu).length > 0){
        totalWeekDays.push(this.mc_daily_sum_prod_thu);
      }
      if( this.mc_daily_sum_prod_fri != null &&  Object.entries(this.mc_daily_sum_prod_fri).length > 0){
        totalWeekDays.push(this.mc_daily_sum_prod_fri);
      }
      if( this.mc_daily_sum_prod_sat != null &&  Object.entries(this.mc_daily_sum_prod_sat).length > 0){
        totalWeekDays.push(this.mc_daily_sum_prod_sat);
      }
      if( this.mc_daily_sum_prod_sun != null &&  Object.entries(this.mc_daily_sum_prod_sun).length > 0){
        totalWeekDays.push(this.mc_daily_sum_prod_sun);
      }      
      // totalWeekDays.push(this.mc_daily_sum_prod_tue);
      // totalWeekDays.push(this.mc_daily_sum_prod_wed);
      // totalWeekDays.push(this.mc_daily_sum_prod_thu);
      // totalWeekDays.push(this.mc_daily_sum_prod_fri);
      // totalWeekDays.push(this.mc_daily_sum_prod_sat);
      // totalWeekDays.push(this.mc_daily_sum_prod_sun);
      return this.$helpers.getWeeklyAvg(totalWeekDays, this.todal_days);
      // return {}
    }
  },

  mounted(){

  if(this.selected_mealtype != null){
      this.form.meal_type_id = this.selected_mealtype;
      this.form.mealtype = this.selected_mealtype;
  }
  if(this.selected_agerange != null){
      this.form.age_grade_id = this.selected_agerange;
      this.form.agerange = this.selected_agerange;
  }
  if(this.selected_days != null){
      this.form.days_id = this.selected_days;
      this.form.days = this.selected_days;
  }

  if(!this.is_fav_show){
    this.form.mc_name = this.menuName;
  }
  

  this.updateGuidelineValues();
  },

  methods:{
     changeMonthYearModalOpen() {
      this.changeMonthYearModal = true;
    },

    sortedArray: function(recipe_arrays) {
      console.log("recipe_arrays", recipe_arrays);
      let a= _.orderBy(recipe_arrays, 'name', 'asc');
      a= _.orderBy(a, 'category_sort', 'asc');
      return a;
    },

    changeDays(){
      let day_id = this.form.days_id;
      if(day_id != ''){
        let dd = this.days_data.find(x => x.id === day_id);
        console.log('dd', dd);
        if(dd){
          this.todal_days = dd.total_days;
        } else {
          this.todal_days = 0;
        }
      } else {
        this.todal_days = 0;
      }
    },

    updateGuidelineValues(){
         if(this.form.meal_type_id && this.form.age_grade_id && this.form.days_id){
          axios.post('/site-offering-get-guidelines',{
                         meal_type:this.form.meal_type_id,
                         age_range:this.form.age_grade_id,
                         days:this.form.days_id,
                       }).then((response)=>{
                       this.guidelines = response.data;
                       //this.guideline_id= response.data[0]['id'];
                       })
                       .catch(error => console.error(error));
         }
         this.changeDays();
      },

    sortArrays(arrays) {
            return _.orderBy(arrays, 'sort', 'asc');
        },

    // onGradeChangeSetupMealTypeMethod(e){
    //   let grade_range_val = e.target.value;
    //   axios.post('/menu-cycle-get-meal-types',{grade_range:grade_range_val})
    //       .then((response)=>{
    //          this.meal_types = response.data;
    //        })
    //       .catch(error => console.error(error));
    // },

    // getComponentPreviewSitesAsPerOffering(e){
    //   axios.post('/menu-cycle-get-offering-sites',{meal:e.target.value,grade_range:this.form.mc_grade_range})
    //                 .then((response)=>{
    //                    this.offering_site = response.data;
    //                  })
    //                 .catch(error => console.error(error));
    // },


    getComponentTotalsAsPerOffering(e){
      var guideline_id = e.target.value;
      axios.post('/get-component-limits-from-guideline',{guideline:guideline_id})
                    .then((response)=>{
                       this.guideline_data = response.data;
                       //console.log(this.guideline_data);
                     })
                    .catch(error => console.error(error));
    },

    addRecipeOptionMenuCycle(day){
    this.addRecipesOptionModal = true;

    this.day_number = day;
    if(day==1){this.option_number = this.mc_final_options_mon.length+1;}
    if(day==2){this.option_number = this.mc_final_options_tue.length+1;}
    if(day==3){this.option_number = this.mc_final_options_wed.length+1;}
    if(day==4){this.option_number = this.mc_final_options_thu.length+1;}
    if(day==5){this.option_number = this.mc_final_options_fri.length+1;}
    if(day==6){this.option_number = this.mc_final_options_sat.length+1;}
    if(day==7){this.option_number = this.mc_final_options_sun.length+1;}
    this.name = "Option "+this.option_number;
    },

    closeOptionsModal(attachedRecipes, optionPhoto, dayNumber, optionNumber,optionName, is_favorite, assembly_serving_free_text, assembly_serving, assembly_serving_unit, assembly_instructions, is_exclude_from_export, a_la_carte){
      this.addRecipesOptionModal = false;
      let total_val = {};

      // console.log(attachedRecipes, optionPhoto, dayNumber, optionNumber);
      if(attachedRecipes.length > 0){
        total_val = this.$helpers.getRecipeTotal(attachedRecipes);
        console.log("total_val", total_val);
      }

      var mc_options_final = {
                   'recipes' : attachedRecipes,
                   'photo' : optionPhoto,
                   'sort' : optionNumber,
                   'name' : optionName,
                   'total_val' : total_val,
                   'is_favorite' : is_favorite,
                    'assembly_serving_free_text': assembly_serving_free_text,
                   'assembly_serving' : assembly_serving,
                   'assembly_serving_unit' : assembly_serving_unit,
                   'assembly_instructions' : assembly_instructions,
                   'is_exclude_from_export' : is_exclude_from_export,
                   'a_la_carte' : a_la_carte
                 };

            if(dayNumber == 1 && attachedRecipes.length > 0){

              this.mc_final_options_mon.push(mc_options_final);
              this.mc_daily_sum_prod_mon = this.$helpers.getDayMinimumeValue(this.mc_final_options_mon);

              // console.log("mc_final_options_mon live", this.mc_final_options_mon);
              // console.log("getDayMinimumeValue", this.$helpers.getDayMinimumeValue(this.mc_final_options_mon));
              //console.log(this.mc_final_options_mon);

              attachedRecipes.forEach((value,index) => {
                this.mc_recipes_mon[value['id']] = value;
                this.mc_recipe_prefer_prod_mon = value['prefer_products'];

                 this.mc_daily_sum_prod_mon_all_data.push(this.mc_recipe_prefer_prod_mon);
                //  this.mc_daily_sum_prod_mon = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_mon_all_data);

                 this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_mon);
                 this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);
                 this.mc_recipe_prefer_prod_mon = [];
              });

              console.log("mc_daily_sum_prod_mon live", this.mc_daily_sum_prod_mon);
            }
            if(dayNumber == 2 && attachedRecipes.length > 0){
              console.log("mc_final_options_tue");
              this.mc_final_options_tue.push(mc_options_final);
              this.mc_daily_sum_prod_tue = this.$helpers.getDayMinimumeValue(this.mc_final_options_tue);
              
              //console.log(this.mc_final_options_tue);

              attachedRecipes.forEach((value,index) => {
                this.mc_recipes_tue[value['id']] = value;
                this.mc_recipe_prefer_prod_tue = value['prefer_products'];

                this.mc_daily_sum_prod_tue_all_data.push(this.mc_recipe_prefer_prod_tue);
                // this.mc_daily_sum_prod_tue = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_tue_all_data);

                this.avg_products_weekly_all_data[1].push(this.mc_recipe_prefer_prod_tue);
                this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);


                this.mc_recipe_prefer_prod_tue = [];

                });
            }
            if(dayNumber == 3 && attachedRecipes.length > 0){

            this.mc_final_options_wed.push(mc_options_final);
            this.mc_daily_sum_prod_wed = this.$helpers.getDayMinimumeValue(this.mc_final_options_wed);

            attachedRecipes.forEach((value,index) => {
            this.mc_recipes_wed[value['id']] = value;
            this.mc_recipe_prefer_prod_wed = value['prefer_products'];

                this.mc_daily_sum_prod_wed_all_data.push(this.mc_recipe_prefer_prod_wed);
                // this.mc_daily_sum_prod_wed = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_wed_all_data);

                this.avg_products_weekly_all_data[2].push(this.mc_recipe_prefer_prod_wed);
                this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);


                this.mc_recipe_prefer_prod_wed = [];
                });
            }
            if(dayNumber == 4 && attachedRecipes.length > 0){

            this.mc_final_options_thu.push(mc_options_final);
            this.mc_daily_sum_prod_thu = this.$helpers.getDayMinimumeValue(this.mc_final_options_thu);

            attachedRecipes.forEach((value,index) => {
            this.mc_recipes_thu[value['id']] = value;
            this.mc_recipe_prefer_prod_thu = value['prefer_products'];

                this.mc_daily_sum_prod_thu_all_data.push(this.mc_recipe_prefer_prod_thu);
                // this.mc_daily_sum_prod_thu = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_thu_all_data);

                this.avg_products_weekly_all_data[3].push(this.mc_recipe_prefer_prod_thu);
                this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);


                this.mc_recipe_prefer_prod_thu = [];

                });
            }
            if(dayNumber == 5 && attachedRecipes.length > 0){

            this.mc_final_options_fri.push(mc_options_final);
            this.mc_daily_sum_prod_fri = this.$helpers.getDayMinimumeValue(this.mc_final_options_fri);

            attachedRecipes.forEach((value,index) => {
            this.mc_recipes_fri[value['id']] = value;
            this.mc_recipe_prefer_prod_fri = value['prefer_products'];

                this.mc_daily_sum_prod_fri_all_data.push(this.mc_recipe_prefer_prod_fri);
                // this.mc_daily_sum_prod_fri = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_fri_all_data);

                this.avg_products_weekly_all_data[4].push(this.mc_recipe_prefer_prod_fri);
                this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);


                this.mc_recipe_prefer_prod_fri = [];

                });
            }
            if(dayNumber == 6 && attachedRecipes.length > 0){

            this.mc_final_options_sat.push(mc_options_final);
            this.mc_daily_sum_prod_sat = this.$helpers.getDayMinimumeValue(this.mc_final_options_sat);

            attachedRecipes.forEach((value,index) => {
            this.mc_recipes_sat[value['id']] = value;
            this.mc_recipe_prefer_prod_sat = value['prefer_products'];

                this.mc_daily_sum_prod_sat_all_data.push(this.mc_recipe_prefer_prod_sat);
                // this.mc_daily_sum_prod_sat = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_sat_all_data);

                this.avg_products_weekly_all_data[5].push(this.mc_recipe_prefer_prod_sat);
                this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);


                this.mc_recipe_prefer_prod_sat = [];

                });
            }
            if(dayNumber == 7 && attachedRecipes.length > 0){

            this.mc_final_options_sun.push(mc_options_final);
            this.mc_daily_sum_prod_sun = this.$helpers.getDayMinimumeValue(this.mc_final_options_sun);

            attachedRecipes.forEach((value,index) => {
            this.mc_recipes_sun[value['id']] = value;
            this.mc_recipe_prefer_prod_sun = value['prefer_products'];

                this.mc_daily_sum_prod_sun_all_data.push(this.mc_recipe_prefer_prod_sun);
                // this.mc_daily_sum_prod_sun = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_sun_all_data);

                this.avg_products_weekly_all_data[6].push(this.mc_recipe_prefer_prod_sun);
                this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

                this.mc_recipe_prefer_prod_sun = [];

                });
            }

    },

    // getWeeklyAvg(){

    // },

    addOptionEditScript(option_data, option_number, day){
      this.addRecipesOptionModal = true;

      this.option_number = option_number + 1;
      this.day_number = day;

      //this.editOptionData = [];
      this.editOptionData = option_data;
      this.name= option_data.name;
    },


    addOptionCopyScript(option_data){
     if(confirm("Are you sure you want to copy this option?")){
        this.copied_option_data = option_data;
     }
    },


    addOptionPasteScript(total, day){
        if(this.copied_option_data != ''){
        if(confirm("Are you sure you want to paste here?")){
        this.day_number = day;
        this.option_number = parseInt(total) + 1;
        this.closeOptionsModal(this.copied_option_data.recipes, this.copied_option_data.photo, day, this.option_number, this.copied_option_data.name);
        }
        }else{
        this.$toast.error('Error: Copy required first!');
        }

    },


    addOptionDuplicateScript(option_data, total, day){
        if(confirm("Are you sure you want to duplicate this Option?")){
          this.day_number = day;
          this.option_number = parseInt(total) + 1;
          this.closeOptionsModal(option_data.recipes, option_data.photo, day, this.option_number, option_data.name);
        }
    },


    addOptionDeleteScript(click_index, day) {
        let mc_option_id = "";
        if(confirm("Are you sure you want to delete this option?")){
            if(day == 1){

              mc_option_id = this.mc_final_options_mon[click_index].id;
              
              this.mc_final_options_mon.splice(click_index,1);                           
              this.mc_daily_sum_prod_mon_all_data.splice(click_index,1);
              
              this.mc_daily_sum_prod_mon = this.$helpers.getDayMinimumeValue(this.mc_final_options_mon);
              // this.mc_daily_sum_prod_mon = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_mon_all_data);
          
              this.avg_products_weekly_all_data[0].splice(click_index,1);
              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

            }
            if(day == 2){
              mc_option_id = this.mc_final_options_tue[click_index].id;
              this.mc_final_options_tue.splice(click_index,1);

              this.mc_daily_sum_prod_tue_all_data.splice(click_index,1);

              this.mc_daily_sum_prod_tue = this.$helpers.getDayMinimumeValue(this.mc_final_options_tue);

              // this.mc_daily_sum_prod_tue = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_tue_all_data);

              this.avg_products_weekly_all_data[1].splice(click_index,1);
              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

            }
            if(day == 3){
              mc_option_id = this.mc_final_options_wed[click_index].id;
              this.mc_final_options_wed.splice(click_index,1);

              this.mc_daily_sum_prod_wed_all_data.splice(click_index,1);
              
              // this.mc_daily_sum_prod_wed = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_wed_all_data);

              this.mc_daily_sum_prod_wed = this.$helpers.getDayMinimumeValue(this.mc_final_options_wed);

              this.avg_products_weekly_all_data[2].splice(click_index,1);
              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);


            }
            if(day == 4){
              mc_option_id = this.mc_final_options_thu[click_index].id;
              this.mc_final_options_thu.splice(click_index,1);

              this.mc_daily_sum_prod_thu_all_data.splice(click_index,1);
              
              // this.mc_daily_sum_prod_thu = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_thu_all_data);

              this.mc_daily_sum_prod_thu = this.$helpers.getDayMinimumeValue(this.mc_final_options_thu);

              this.avg_products_weekly_all_data[3].splice(click_index,1);
              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

            }
            if(day == 5){
              mc_option_id = this.mc_final_options_fri[click_index].id;
              this.mc_final_options_fri.splice(click_index,1);

              this.mc_daily_sum_prod_fri_all_data.splice(click_index,1);
              
              // this.mc_daily_sum_prod_fri = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_fri_all_data);

              this.mc_daily_sum_prod_fri = this.$helpers.getDayMinimumeValue(this.mc_final_options_fri);

              this.avg_products_weekly_all_data[4].splice(click_index,1);
              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

            }
            if(day == 6){
              mc_option_id = this.mc_final_options_sat[click_index].id;
              this.mc_final_options_sat.splice(click_index,1);

              this.mc_daily_sum_prod_sat_all_data.splice(click_index,1);
              
              // this.mc_daily_sum_prod_sat = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_sat_all_data);

              this.mc_daily_sum_prod_sat = this.$helpers.getDayMinimumeValue(this.mc_final_options_sat);

              this.avg_products_weekly_all_data[5].splice(click_index,1);
              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

            }
            if(day == 7){
              mc_option_id = this.mc_final_options_sun[click_index].id;
              this.mc_final_options_sun.splice(click_index,1);

              this.mc_daily_sum_prod_sun_all_data.splice(click_index,1);
              this.mc_daily_sum_prod_sun = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_sun_all_data);

              this.mc_daily_sum_prod_sun = this.$helpers.getDayMinimumeValue(this.mc_final_options_sun);

              this.avg_products_weekly_all_data[6].splice(click_index,1);
              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);
            }

          if(mc_option_id && mc_option_id != ""){
          this.form.post(this.route('menu-cycle-option-delete', mc_option_id), {
                onSuccess: () => {
                  this.$toast.success('MenuCycle option deleted successfully!');
                }
              });
          }
          }

    },

    saveAsTemplate(){
      this.form.is_template = 1;
      this.menucycle_add_save_script();
    },

    menucycle_add_save_script(){
      
      if(this.mc_final_options_mon.length > 0){this.form.mc_options_mon = this.mc_final_options_mon;}
      if(this.mc_final_options_tue.length > 0){this.form.mc_options_tue = this.mc_final_options_tue;}
      if(this.mc_final_options_wed.length > 0){this.form.mc_options_wed = this.mc_final_options_wed;}
      if(this.mc_final_options_thu.length > 0){this.form.mc_options_thu = this.mc_final_options_thu;}
      if(this.mc_final_options_fri.length > 0){this.form.mc_options_fri = this.mc_final_options_fri;}
      if(this.mc_final_options_sat.length > 0){this.form.mc_options_sat = this.mc_final_options_sat;}
      if(this.mc_final_options_sun.length > 0){this.form.mc_options_sun = this.mc_final_options_sun;}
      
      // if(this.form.is_template == true){
      //   this.form.is_template = 1;
      // }
    console.log("this.form", this.form);
      if(this.form.weekNumber && !this.form.weekNumber !== this.form.weekNumber && this.form.weekNumber != ''){
        this.form.week_number = parseInt(this.form.weekNumber);
      }

      console.log("this.form", this.form);
        
      this.form.post(this.route('menu-cycle-add-save'), {
          onSuccess: () => {
                this.$toast.success('Menu Cycle Added Successfully!');
          },
      });
    },

     


     closeEditOptionsModal(attachedRecipes, optionPhoto, dayNumber, optionNumber, optionName, is_favorite, assembly_serving_free_text, assembly_serving, assembly_serving_unit, assembly_instructions, is_exclude_from_export, a_la_carte){
      this.addRecipesOptionModal = false;
      this.editOptionData = [];
      let index = optionNumber - 1;
      let total_val = {};
      console.log("closeEditOptionsModal", attachedRecipes, optionPhoto, dayNumber, optionNumber, is_favorite);
      // if(attachedRecipes.length > 0){
      //   total_val = this.$helpers.getRecipeTotal(attachedRecipes);
      //   console.log("total_val", total_val);
      // }

      if(attachedRecipes.length > 0){
        total_val = this.$helpers.getRecipeTotal(attachedRecipes);
        console.log("total_val", total_val);
      }

      var mc_options_final = {
                   'recipes' : attachedRecipes,
                   'photo' : optionPhoto,
                   'sort' : optionNumber,
                   'name' : optionName,
                   'total_val' : total_val,
                   'is_favorite' : is_favorite,
                   'assembly_serving_free_text' : assembly_serving_free_text,
                   'assembly_serving' : assembly_serving,
                   'assembly_serving_unit' : assembly_serving_unit,
                   'assembly_instructions' : assembly_instructions,
                   'is_exclude_from_export' : is_exclude_from_export,
                   'a_la_carte' : a_la_carte
                 };
      
      console.log('im here mc_options_final',mc_options_final);
            if(dayNumber == 1 && attachedRecipes.length > 0){

              this.mc_final_options_mon[index] = mc_options_final;
              this.mc_daily_sum_prod_mon = this.$helpers.getDayMinimumeValue(this.mc_final_options_mon);

              // this.mc_final_options_mon[index].recipes = attachedRecipes;
              // this.mc_final_options_mon[index].photo = optionPhoto;
              // this.mc_final_options_mon[index].sort = optionNumber;
              // this.mc_final_options_mon[index].name = optionName;
              // this.mc_final_options_mon[index].total_val = total_val;
              
              

              attachedRecipes.forEach((value,key) => {
                this.mc_recipes_mon[value['id']] = value;
                if(value['prefer_products']){
                this.mc_recipe_prefer_prod_mon = value['prefer_products'];
                // this.mc_daily_sum_prod_mon_all_data.push(this.mc_recipe_prefer_prod_mon);
                this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_mon);
                }
              });


              // this.mc_daily_sum_prod_mon = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_mon_all_data);
              this.mc_daily_sum_prod_mon = this.$helpers.getDayMinimumeValue(this.mc_final_options_mon);

              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

              this.mc_recipe_prefer_prod_mon = [];
            }
            if(dayNumber == 2 && attachedRecipes.length > 0){

              this.mc_final_options_tue[index] = mc_options_final;
              this.mc_daily_sum_prod_tue = this.$helpers.getDayMinimumeValue(this.mc_final_options_tue);

              // this.mc_final_options_tue[index].recipes = attachedRecipes;
              // this.mc_final_options_tue[index].photo = optionPhoto;
              // this.mc_final_options_tue[index].sort = optionNumber;
              // this.mc_final_options_mon[index].name = optionName;

              attachedRecipes.forEach((value,key) => {

                this.mc_recipes_tue[value['id']] = value;

                if(value['prefer_products']){
                this.mc_recipe_prefer_prod_tue = value['prefer_products'];
                this.mc_daily_sum_prod_tue_all_data.push(this.mc_recipe_prefer_prod_tue);
                this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_tue);
                }

              });


              // this.mc_daily_sum_prod_tue = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_tue_all_data);

              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

              this.mc_recipe_prefer_prod_tue = [];
            }
            if(dayNumber == 3 && attachedRecipes.length > 0){

              this.mc_final_options_wed[index] = mc_options_final;
              this.mc_daily_sum_prod_wed = this.$helpers.getDayMinimumeValue(this.mc_final_options_wed);

            // this.mc_final_options_wed[index].recipes = attachedRecipes;
            // this.mc_final_options_wed[index].photo = optionPhoto;
            // this.mc_final_options_wed[index].sort = optionNumber;
            //   this.mc_final_options_mon[index].name = optionName;

            attachedRecipes.forEach((value,key) => {

                this.mc_recipes_wed[value['id']] = value;

                if(value['prefer_products']){
                this.mc_recipe_prefer_prod_wed = value['prefer_products'];
                this.mc_daily_sum_prod_wed_all_data.push(this.mc_recipe_prefer_prod_wed);
                this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_wed);
                }

              });


              // this.mc_daily_sum_prod_wed = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_wed_all_data);

              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

              this.mc_recipe_prefer_prod_wed = [];
            }
            if(dayNumber == 4 && attachedRecipes.length > 0){

            this.mc_final_options_thu[index] = mc_options_final;
            this.mc_daily_sum_prod_thu = this.$helpers.getDayMinimumeValue(this.mc_final_options_thu);


            // this.mc_final_options_thu[index].recipes = attachedRecipes;
            // this.mc_final_options_thu[index].photo = optionPhoto;
            // this.mc_final_options_thu[index].sort = optionNumber;
            //   this.mc_final_options_mon[index].name = optionName;

            attachedRecipes.forEach((value,key) => {

                this.mc_recipes_thu[value['id']] = value;

                if(value['prefer_products']){
                this.mc_recipe_prefer_prod_thu = value['prefer_products'];
                this.mc_daily_sum_prod_thu_all_data.push(this.mc_recipe_prefer_prod_thu);
                this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_thu);
                }

              });


              // this.mc_daily_sum_prod_thu = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_thu_all_data);

              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

              this.mc_recipe_prefer_prod_thu = [];
            }
            if(dayNumber == 5 && attachedRecipes.length > 0){

            this.mc_final_options_fri[index] = mc_options_final;
            this.mc_daily_sum_prod_fri = this.$helpers.getDayMinimumeValue(this.mc_final_options_fri);

            // this.mc_final_options_fri[index].recipes = attachedRecipes;
            // this.mc_final_options_fri[index].photo = optionPhoto;
            // this.mc_final_options_fri[index].sort = optionNumber;
            //   this.mc_final_options_mon[index].name = optionName;

            attachedRecipes.forEach((value,key) => {

                this.mc_recipes_fri[value['id']] = value;

                if(value['prefer_products']){
                this.mc_recipe_prefer_prod_fri = value['prefer_products'];
                this.mc_daily_sum_prod_fri_all_data.push(this.mc_recipe_prefer_prod_fri);
                this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_fri);
                }

              });


              // this.mc_daily_sum_prod_fri = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_fri_all_data);

              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

              this.mc_recipe_prefer_prod_fri = [];
            }
            if(dayNumber == 6 && attachedRecipes.length > 0){

            this.mc_final_options_sat[index] = mc_options_final;
            this.mc_daily_sum_prod_sat = this.$helpers.getDayMinimumeValue(this.mc_final_options_sat);

            // this.mc_final_options_sat[index].recipes = attachedRecipes;
            // this.mc_final_options_sat[index].photo = optionPhoto;
            // this.mc_final_options_sat[index].sort = optionNumber;
            //   this.mc_final_options_mon[index].name = optionName;

            attachedRecipes.forEach((value,key) => {

                this.mc_recipes_sat[value['id']] = value;

                if(value['prefer_products']){
                this.mc_recipe_prefer_prod_sat = value['prefer_products'];
                this.mc_daily_sum_prod_sat_all_data.push(this.mc_recipe_prefer_prod_sat);
                this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_sat);
                }

              });


              // this.mc_daily_sum_prod_sat = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_sat_all_data);

              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

              this.mc_recipe_prefer_prod_sat = [];
            }
            if(dayNumber == 7 && attachedRecipes.length > 0){

            this.mc_final_options_sun[index] = mc_options_final;
            this.mc_daily_sum_prod_sun = this.$helpers.getDayMinimumeValue(this.mc_final_options_sun);

            // this.mc_final_options_sun[index].recipes = attachedRecipes;
            // this.mc_final_options_sun[index].photo = optionPhoto;
            // this.mc_final_options_sun[index].sort = optionNumber;
            // this.mc_final_options_mon[index].name = optionName;

            attachedRecipes.forEach((value,key) => {

                this.mc_recipes_sun[value['id']] = value;

                if(value['prefer_products']){
                this.mc_recipe_prefer_prod_sun = value['prefer_products'];
                this.mc_daily_sum_prod_sun_all_data.push(this.mc_recipe_prefer_prod_sun);
                this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_sun);
                }

              });


              // this.mc_daily_sum_prod_sun = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_sun_all_data);

              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

              this.mc_recipe_prefer_prod_sun = [];
            }

    },


  },
};

</script>
<style>
.cancel-background-color{
 background-color: #8b8b8b;
}

.placeholder-background-color{
background-color: #f8f8f8;
}

.w-11\/12 {
    width: 95.666667%;
}

.mt-0-down{
    margin-top: -54px;
}

.bg-button-color{
background-color: #cb0000;
}

.bg-button-color-green{
 background-color: #22af4b;
}

.bg-button-color-gray{
background-color: #636363;
}
.bg-hard-grey{
background-color: #f4f4f4;
}

.w-72-box-sizing {
    width: 330px;
}

.text-color-first-li{
  color: #f7a53a;
  text-decoration: underline;
}

.icon-star-color{
color: #f7a53a;
}
.th-heading-background{
background-color: #f4f4f4;
}
.button-bg-color-wed{
background-color: #cbcbcb;
}
.input-background{
background-color: #f8f8f8;
}
.white-shadow-box{
box-shadow: 0px 2px 5px #0000005e;
}
.min-w-min-button{
min-height: 26px;
min-width: 53px;
line-height: 26px;
}

.validation_error_msg {
    font-weight: 400;
    margin: 6px 0 0 !important;
    color: red;
}
.smooth-dnd-container.vertical > .smooth-dnd-draggable-wrapper {
    overflow: visible;
}
</style>
