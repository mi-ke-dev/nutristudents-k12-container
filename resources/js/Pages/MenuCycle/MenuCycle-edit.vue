<template>
  <Head>
  <title>{{menucycle.name}} - Edit Menu Cycle | NutriStudents K-12</title>
  <meta name="description" content="Edit Menu Cycle">
  </Head>
  <default-layout>

  <BreadcrumLayout v-if="this.guide_line_id === ''">
      <div class="flex">
        <!-- <a href="#" class="link-color"> --><U>Templates</U><!-- </a> -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
            clip-rule="evenodd" />
        </svg>
        <inertia-link :href="route('week-cycles')" class="link-color"><U>Menu Cycles</U></inertia-link>
      </div>
    </BreadcrumLayout>

<form action="#" @submit.prevent="false">

   <PageTitleLayout>
      <div
        class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center pt-10"
      >
       
        <div class="w-full mr-auto">
        <h2 class="heading-color xl:text-3xl text-2xl font-bold"> 
          <span  v-if="this.guide_line_id != '' && (!menucycle.is_template && menucycle.group_source_id) ">Week of {{moment(week_date).format('MM/DD/YYYY')}}</span>
            {{menucycle.name}}  
          
          </h2>
        </div>
        <div class="flex lg:flex-nowrap flex-wrap lg:justify-end md:justify-end justify-start">
             <button v-if="this.guide_line_id != ''" @click="changeMonthYearModalOpen()" class="md:w-60 w-full button-color text-white font-bold py-3 rounded md:mt-0 mt-4 px-4 md:mr-2 ml-0 uppercase leading-4">Save as New Week Cycle</button>
            <button >
              
              <inertia-link v-if="this.guide_line_id === ''" :href="route('week-cycles',{'mealtype': mealtypeWeek, 'agerange': agerangeWeek, 'days': daysWeek, 'menuUser': menuUserWeek})" class="md:w-24 w-full button-color text-white font-bold py-3 rounded lg:mt-0 sm:mt-4 px-4 cancel-background-color leading-4 inline-block">CANCEL</inertia-link>

              <inertia-link 
                v-if="this.guide_line_id != ''" 
                :href="
                  $page.props.site_url +
                  '/menu-planner' +
                  '?month=' +
                  month +
                  '&year=' +
                  year +
                  '&type=' +
                  form.type +
                  '&site=' +
                  form.site +
                  '&guide_line_id=' +
                  guide_line_id +
                  '&offering_id=' +
                  offering_id
                "
                class="md:w-24 w-full button-color text-white font-bold py-3 rounded lg:mt-0 sm:mt-4 px-4 cancel-background-color leading-4 inline-block"
               >CANCEL
               </inertia-link>
            </button>

            <button v-if="menucycle.is_tenant_admin" type="submit" @click="menucycle_edit_save_script" class="md:w-24 w-full button-color text-white font-bold py-3 rounded md:mt-0 mt-4 px-4 md:ml-2 ml-0 leading-4">UPDATE</button>
        </div>
      </div>
     </PageTitleLayout>
     <PageTitleLayout  v-if="this.guide_line_id === ''">
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
            <select id="meal_type_id" name="meal_type_id" v-model="form.meal_type_id"
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
            <select id="age_grade_id" name="age_grade_id" v-model="form.age_grade_id"
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
            <select id="days_id" name="days_id" v-model="form.days_id"
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
            <select id="guideline_id" v-model="form.guideline_id" name="guideline_id" class="input-background shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="getComponentTotalsAsPerOffering($event)">
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
   </div>


     </PageTitleLayout>


     <!-- <PageTitleLayout>
      <div class="w-full pt-4 mt-4 pb-4 mb-4 font-bold bg-white white-shadow-box">

     </div>
     </PageTitleLayout> -->


    <WeeklyCalculatedTotals :weeklyAvg="weeklyAvg" :guideline_data="guideline_data" :mc_weekly_avg_prods="mc_weekly_avg_prods" />




<!-- Week Days starts from here2... -->

<div class="w-full xl:px-10 px-5 pb-10 overflow-x-auto">
<div class="flex flex-nowrap pt-0 pb-10 overflow-x-auto items-start">

<div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_mon)">Monday</h2>

  <a v-if="menucycle.is_tenant_admin" href="#" @click="addRecipeOptionMenuCycle(1)">
    <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>

  <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white pt-2 pr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
  </svg> -->

  </header>

            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_mon" />

                <div v-if="!mc_final_options_mon.length" class="w-full flex flex-wrap items-center justify-center py-2">
                 <div>
                   <div class="text-center pl-8">
                     <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'"></div>
                     <p class="pt-4 pl-2">Nothing Here Yet</p>
                     <a href="#" v-if="menucycle.is_tenant_admin" @click="addRecipeOptionMenuCycle(1)" class="underline text-center block">Add A Menu Option</a>
                     <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_mon.length, 1)" class="underline text-center block">Paste Menu Option</button>
                   </div>
                 </div>

                <!-- <div v-else class="h-60 overflow-x-auto"> -->
                <div v-else>
                <!-- <Container group-name="1" :should-accept-drop="shouldAcceptDrop" :get-child-payload="getChildPayload_mon" @drop="onDropMethod" @dragenter="checkDrop" @dragover="checkDrop">
                <Draggable v-for="(mc_option, index) in mc_final_options_mon" :key="mc_option.index" class="px-4 py-4"> -->

                  <div v-for="(mc_option, index) in sortArrays(mc_final_options_mon)" :key="mc_option.index" class="px-4 py-4">

                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded draggable-item">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase" ><div :title="$helpers.getByName(mc_option.total_val)" class="cursor-pointer"> {{ mc_option.name }}  <!--<i class="fa fa-star icon-star-color" aria-hidden="true"></i>--></div>
                        <div>
                          <MenuOption  v-if="menucycle.is_tenant_admin"  @messageFromChildEdit="addOptionEditScript(mc_option, index, 1)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_mon.length, 1)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_mon.length, 1)" @messageFromChildDelete="addOptionDeleteScript(index, 1)" />
                        </div>
                      </li>

                      <li  v-for="(mc_option_recipe, index) in sortedArray(mc_option.recipes)" class="flex flex-nowrap justify-between pb-4 cursor-pointer" :title="$helpers.getByName(mc_option_recipe.total_val)">

                       <div  class="text-sm font-bold text-color-first-li">
                          <a target="_blank" :href="route('recipes-edit', { id: mc_option_recipe.id })">{{mc_option_recipe.name}}</a>
                          </div>
                        <div class="text-sm">{{ $helpers.getByFirstName(mc_option_recipe.total_val)}}</div>

                      </li>
                    </ul>
                  </div>
                <!-- </Draggable></Container> -->
                </div>
                </div>



</div>


 <div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_tue)">Tuesday</h2>

  <a href="#" v-if="menucycle.is_tenant_admin" @click="addRecipeOptionMenuCycle(2)">
    <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>
  </header>


            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_tue" />

                <div v-if="!mc_final_options_tue.length" class="w-full flex flex-wrap items-center justify-center py-2">
                 <div>
                   <div class="text-center pl-8">
                     <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'"></div>
                     <p class="pt-4 pl-2">Nothing Here Yet</p>
                     <a href="#" v-if="menucycle.is_tenant_admin"  @click="addRecipeOptionMenuCycle(2)" class="underline text-center block">Add A Menu Option</a>
                     <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_tue.length, 2)" class="underline text-center block">Paste Menu Option</button>
                   </div>
                 </div>


                <div v-else>
                <div v-for="(mc_option, index) in sortArrays(mc_final_options_tue)" :key="mc_option.index" class="px-4 py-4">

                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded draggable-item">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase"><div :title="$helpers.getByName(mc_option.total_val)" class="cursor-pointer">{{ mc_option.name }} <!-- <i class="fa fa-star icon-star-color" aria-hidden="true"></i> --></div>
                        <div>
                          <MenuOption  v-if="menucycle.is_tenant_admin"  @messageFromChildEdit="addOptionEditScript(mc_option, index, 2)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_tue.length, 2)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_tue.length, 2)" @messageFromChildDelete="addOptionDeleteScript(index, 2)" />
                        </div>
                      </li>

                      <li v-for="(mc_option_recipe, index) in sortedArray(mc_option.recipes)"  class="flex flex-nowrap justify-between pb-4 cursor-pointer" :title="$helpers.getByName(mc_option_recipe.total_val)">

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
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_wed)">Wednesday</h2>

  <a href="#" v-if="menucycle.is_tenant_admin"  @click="addRecipeOptionMenuCycle(3)">
   <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>
  </header>


            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_wed" />

                <div v-if="!mc_final_options_wed.length" class="w-full flex flex-wrap items-center justify-center py-2">
                 <div>
                   <div class="text-center pl-8">
                    <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'"></div>
                    <p class="pt-4 pl-2">Nothing Here Yet</p>
                    <a href="#"  v-if="menucycle.is_tenant_admin"  @click="addRecipeOptionMenuCycle(3)" class="underline text-center block">Add A Menu Option</a>
                    <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_wed.length, 3)" class="underline text-center block">Paste Menu Option</button>
                  </div>
                </div>

                <div v-else>
                <div v-for="(mc_option, index) in sortArrays(mc_final_options_wed)" :key="mc_option.index" class="px-4 py-4">
                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded draggable-item">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase">
                        <div :title="$helpers.getByName(mc_option.total_val)" class="cursor-pointer">{{ mc_option.name }}</div>
                        <div>
                          <MenuOption  v-if="menucycle.is_tenant_admin"  @messageFromChildEdit="addOptionEditScript(mc_option, index, 3)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_wed.length, 3)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_wed.length, 3)" @messageFromChildDelete="addOptionDeleteScript(index, 3)" />
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

                </div></div>



</div>

<!-----------------fourth------>
<div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_thu)">Thursday</h2>
  <a href="#"  v-if="menucycle.is_tenant_admin"  @click="addRecipeOptionMenuCycle(4)">
   <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>
  </header>


            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_thu" />


                <div v-if="!mc_final_options_thu.length" class="w-full flex flex-wrap items-center justify-center py-2">
                 <div>
                   <div class="text-center pl-8">
                    <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'"></div>
                    <p class="pt-4 pl-2">Nothing Here Yet</p>
                    <a href="#"  v-if="menucycle.is_tenant_admin"  @click="addRecipeOptionMenuCycle(4)" class="underline text-center block">Add A Menu Option</a>
                    <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_thu.length, 4)" class="underline text-center block">Paste Menu Option</button>
                  </div>
                </div>


                <div v-else>
                <div v-for="(mc_option, index) in sortArrays(mc_final_options_thu)" :key="mc_option.index" class="px-4 py-4">
                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded draggable-item">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase"><div :title="$helpers.getByName(mc_option.total_val)" class="cursor-pointer">{{ mc_option.name }} <!-- <i class="fa fa-star icon-star-color" aria-hidden="true"></i> --></div>
                        <div>
                          <MenuOption v-if="menucycle.is_tenant_admin"  @messageFromChildEdit="addOptionEditScript(mc_option, index, 4)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_thu.length, 4)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_thu.length, 4)" @messageFromChildDelete="addOptionDeleteScript(index, 4)" />
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
<!--------fivth----->
<div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_fri)">Friday</h2>
  <a href="#" v-if="menucycle.is_tenant_admin"  @click="addRecipeOptionMenuCycle(5)">
    <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>
  </header>


            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_fri" />


                <div v-if="!mc_final_options_fri.length" class="w-full flex flex-wrap items-center justify-center py-2">
                 <div>
                   <div class="text-center pl-8">
                    <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'"></div>
                    <p class="pt-4 pl-2">Nothing Here Yet</p>
                    <a href="#" v-if="menucycle.is_tenant_admin"  @click="addRecipeOptionMenuCycle(5)" class="underline text-center block">Add A Menu Option</a>
                    <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_fri.length, 5)" class="underline text-center block">Paste Menu Option</button>
                  </div>
                </div>


                <div v-else>
                <div v-for="(mc_option, index) in sortArrays(mc_final_options_fri)" :key="mc_option.index" class="px-4 py-4">
                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded draggable-item">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase"><div :title="$helpers.getByName(mc_option.total_val)" class="cursor-pointer">{{ mc_option.name }} <!-- <i class="fa fa-star icon-star-color" aria-hidden="true"></i> --></div>
                        <div>
                          <MenuOption v-if="menucycle.is_tenant_admin"  @messageFromChildEdit="addOptionEditScript(mc_option, index, 5)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_fri.length, 5)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_fri.length, 5)" @messageFromChildDelete="addOptionDeleteScript(index, 5)" />
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
<!------------------six----------->
<div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_sat)">Saturday</h2>
  <a href="#" v-if="menucycle.is_tenant_admin"  @click="addRecipeOptionMenuCycle(6)">
   <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>
  </header>


            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_sat" />


                <div v-if="!mc_final_options_sat.length" class="w-full flex flex-wrap items-center justify-center py-2 mb-4">
                 <div>
                   <div class="text-center pl-8">
                    <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'">
                    </div>
                    <p class="pt-4 pl-2">Nothing Here Yet</p>
                    <a href="#" v-if="menucycle.is_tenant_admin"  @click="addRecipeOptionMenuCycle(6)" class="underline text-center block">Add A Menu Option</a>
                    <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_sat.length, 6)" class="underline text-center block">Paste Menu Option</button>
                  </div>
                </div>


                <div v-else>
                <div v-for="(mc_option, index) in sortArrays(mc_final_options_sat)" :key="mc_option.index" class="px-4 py-4">
                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded draggable-item">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase"><div :title="$helpers.getByName(mc_option.total_val)" class="cursor-pointer">{{ mc_option.name }} <!-- <i class="fa fa-star icon-star-color" aria-hidden="true"></i> --></div>
                        <div>
                          <MenuOption v-if="menucycle.is_tenant_admin"  @messageFromChildEdit="addOptionEditScript(mc_option, index, 6)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_sat.length, 6)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_sat.length, 6)" @messageFromChildDelete="addOptionDeleteScript(index, 6)" />
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
<!--------seven------->
<div class="w-72-box-sizing bg-white mr-4 rounded-t-lg white-shadow-box mb-4">
  <header class="searching-background-color flex justify-start py-2 pl-2 shadow overflow-hidden rounded-t-lg w-full">
  <h2 class="text-white text-lg font-bold w-full cursor-pointer" :title="$helpers.getByName(mc_daily_sum_prod_sun)">Sunday</h2>
  <a href="#" v-if="menucycle.is_tenant_admin"  @click="addRecipeOptionMenuCycle(7)">
   <i class="fa fa-plus text-white pt-2 pr-2" aria-hidden="true"></i>
  </a>
  </header>


            <WeekDayTotals :guideline_data="guideline_data" :mc_daily_sum_prod="mc_daily_sum_prod_sun" />


                <div v-if="!mc_final_options_sun.length" class="w-full flex flex-wrap items-center justify-center py-2">
                 <div>
                   <div class="text-center pl-8">
                    <img :src="$page.props.asset_url +'/vendor/nutristudents/image/food-img/_Path_.png'"></div>
                    <p class="pt-4 pl-2">Nothing Here Yet</p>
                    <a href="#" v-if="menucycle.is_tenant_admin"  @click="addRecipeOptionMenuCycle(7)" class="underline text-center block">Add A Menu Option</a>
                    <button v-if="copied_option_data" type="button" @click="addOptionPasteScript(mc_final_options_sun.length, 7)" class="underline text-center block">Paste Menu Option</button>
                  </div>
                </div>


                <div v-else>
                <div v-for="(mc_option, index) in sortArrays(mc_final_options_sun)" :key="mc_option.index" class="px-4 py-4">
                  <div class="bg-hard-grey px-4 py-3 pt-4 rounded draggable-item">
                    <ul>
                      <li class="flex flex-nowrap justify-between pb-4 relative uppercase"><div :title="$helpers.getByName(mc_option.total_val)" class="cursor-pointer">{{ mc_option.name }} <!-- <i class="fa fa-star icon-star-color" aria-hidden="true"></i> --></div>
                        <div>
                          <MenuOption v-if="menucycle.is_tenant_admin"  @messageFromChildEdit="addOptionEditScript(mc_option, index, 7)" @messageFromChildCopy="addOptionCopyScript(mc_option)" @messageFromChildPaste="addOptionPasteScript(mc_final_options_sun.length, 7)" @messageFromChildDuplicate="addOptionDuplicateScript(mc_option, mc_final_options_sun.length, 7)" @messageFromChildDelete="addOptionDeleteScript(index, 7)"/>
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


</div>


  </div>

</form>


<WeekCycleDayHover v-if="addRecipesOptionModal" :categories="categories" :addRecipesOptionModal="addRecipesOptionModal" :dayNumber="day_number" :optionNumber="option_number" :editOptionData="editOptionData" @closeModal="closeOptionsModal" @closeEditModal="closeEditOptionsModal" @deleteOptionRecipeModel="deleteOptionRecipeModel" :name="name" :is_fav_show="is_fav_show" :mass_measurements="mass_measurements" :volume_measurements="volume_measurements" :unit_measurements="unit_measurements" />

</default-layout>


<jet-dialog-modal
    :show="changeMonthYearModal"
    @close="changeMonthYearModal = false"
  >
  
    <template #title>
      <div class="flex justify-between items-center">Week Cycle</div>
    </template>
     <template #content>
        <div class="flex mt-4 ml-4 lg:w-4/5 md:w-3/5 w-full">
          <div class="relative focus:outline-none md:w-3/5 w-full mr-3 xl:mt-0 md:ml-2 ml-0">
            <input type="text" placeholder="Week1" id="mc_name_new" name="mc_name_new" v-model="form.mc_name_new" class="w-full shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg w-full select-menu-height input-background">
            <div v-if="form.errors.mc_name_new" class="validation_error_msg">{{ form.errors.mc_name_new }}</div>
          </div>
        </div>
     </template>
   

    <template #footer>
       <button type="submit" @click="menucycle_edit_save_script" class="md:w-24 w-full button-color text-white font-bold py-3 rounded md:mt-0 mt-4 px-4 md:ml-2 ml-0 text-xs mr-2">SAVE</button>
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
import { Inertia } from '@inertiajs/inertia';
var moment = require('moment');
//import { Container, Draggable } from "vue-dndrop";

export default {

  props:['menucycle','guidelines_val', 'monday_data', 
  'tuesday_data', 'wednesday_data', 'thursday_data', 
  'friday_data', 'saturday_data', 'sunday_data', 
  'mealtype_data', 'agerange_data','days_data', 
  'categories', 'month', 'year', 'selected_mealtype', 
  'selected_agerange', 'selected_days','site','guide_line_id',
  'calender_days','week_date','is_update', 'is_fav_show', 
  "mass_measurements", "volume_measurements", "unit_measurements",
  'menuUserWeek','agerangeWeek','mealtypeWeek','daysWeek','type','week_number','offering_id'],
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
    // Container,
    // Draggable,
  },

  data(){

    return {

      

      todal_days:0,
      
      changeMonthYearModal: false,
      guidelines:this.guidelines_val,
      guideline_data:[],
      name : '',
      
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

      form: this.$inertia.form({
        mc_id : this.menucycle.id,
        mc_name : this.menucycle.name,
        week_number : this.week_number,
        meal_type_id : this.menucycle.meal_type_id,
        age_grade_id : this.menucycle.age_grade_id,
        days_id : this.menucycle.days_id,
        guideline_id: this.menucycle.guideline_id,
        offering_id: this.offering_id,
        month:this.month,
        year:this.year,
        mealtype:this.selected_mealtype,
        agerange:this.selected_agerange,
        days:this.selected_days,
        type:this.type,

        mc_options_mon: [],
        mc_options_tue: [],
        mc_options_wed: [],
        mc_options_thu: [],
        mc_options_fri: [],
        mc_options_sat: [],
        mc_options_sun: [],
        site: this.site,
        guide_line_id: this.guide_line_id,
        mc_name_new: '',
        is_template: 0,
        is_update: this.is_update,
        daysWeek: this.daysWeek,
        menuUserWeek: this.menuUserWeek,
        mealtypeWeek: this.mealtypeWeek,
        agerangeWeek: this.agerangeWeek

      }),
      log : console.log,
      moment: moment
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
      return this.$helpers.getWeeklyAvg(totalWeekDays, this.todal_days);
    }
  },

  mounted(){
    let $this = this;
    if(this.menucycle.guideline_id){
      var guideline_id =this.menucycle.guideline_id;
      axios.post('/get-component-limits-from-guideline',{guideline:guideline_id})
                    .then((response)=>{
                       this.guideline_data = response.data;
                     })
                    .catch(error => console.error(error));
    }

    if(this.monday_data.length > 0){
            this.monday_data.forEach((value2,index2) => {
              value2.recipes.forEach((value,index) => {
                this.mc_recipes_mon[value['id']] = value;
                this.mc_recipe_prefer_prod_mon = value['prefer_products'];
                console.log("value['prefer_products']", value['prefer_products']);
                value2.recipes[index].total_val = $this.$helpers.sum_products_week_popup_totals_new(value['prefer_products']);

                console.log("value2.recipes[index].total_val", value2.recipes[index].total_val);

                 this.mc_daily_sum_prod_mon_all_data.push(this.mc_recipe_prefer_prod_mon);
                //  this.mc_daily_sum_prod_mon = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_mon_all_data);
                 this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_mon);
                 this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

                 this.mc_recipe_prefer_prod_mon = [];
              });
              value2.total_val = this.$helpers.getRecipeTotal(value2.recipes);
              this.mc_final_options_mon.push(value2);            
              this.mc_daily_sum_prod_mon = this.$helpers.getDayMinimumeValue(this.mc_final_options_mon);

              // this.monday_data[index2].recipes.forEach((value,index) => {
              //   this.mc_recipes_mon[value['id']] = value;
              //   this.mc_recipe_prefer_prod_mon = value['prefer_products'];

              //   this.monday_data[index2].recipes[index].total_val = $this.$helpers.sum_products_week_popup_totals_new(value['prefer_products']);

              //    this.mc_daily_sum_prod_mon_all_data.push(this.mc_recipe_prefer_prod_mon);
              //   //  this.mc_daily_sum_prod_mon = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_mon_all_data);
              //   //  this.mc_daily_sum_prod_mon = this.$helpers.getDayMinimumeValue(this.mc_final_options_mon);

              //    this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_mon);
              //    this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);


              //    this.mc_recipe_prefer_prod_mon = [];
              // });
            });
            }

            if(this.tuesday_data.length > 0){

              this.tuesday_data.forEach((value2,index2) => {
              
              value2.recipes.forEach((value,index) => {
                this.mc_recipes_tue[value['id']] = value;
                this.mc_recipe_prefer_prod_tue = value['prefer_products'];
                value2.recipes[index].total_val = $this.$helpers.sum_products_week_popup_totals_new(value['prefer_products']);


                this.mc_daily_sum_prod_tue_all_data.push(this.mc_recipe_prefer_prod_tue);
                // this.mc_daily_sum_prod_tue = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_tue_all_data);

                this.avg_products_weekly_all_data[1].push(this.mc_recipe_prefer_prod_tue);
                this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);
                this.mc_recipe_prefer_prod_tue = [];
                });

                value2.total_val = this.$helpers.getRecipeTotal(value2.recipes);
                // this.mc_final_options_mon.push(value2); 
                this.mc_final_options_tue.push(value2);           
                this.mc_daily_sum_prod_tue = this.$helpers.getDayMinimumeValue(this.mc_final_options_tue);

            });
            }
            if(this.wednesday_data.length > 0){

            this.wednesday_data.forEach((value2,index2) => {
            
            value2.recipes.forEach((value,index) => {
            this.mc_recipes_wed[value['id']] = value;
            this.mc_recipe_prefer_prod_wed = value['prefer_products'];
            value2.recipes[index].total_val = $this.$helpers.sum_products_week_popup_totals_new(value['prefer_products']);

                this.mc_daily_sum_prod_wed_all_data.push(this.mc_recipe_prefer_prod_wed);
                // this.mc_daily_sum_prod_wed = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_wed_all_data);


                this.avg_products_weekly_all_data[2].push(this.mc_recipe_prefer_prod_wed);
                this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);


                this.mc_recipe_prefer_prod_wed = [];
                });
              value2.total_val = this.$helpers.getRecipeTotal(value2.recipes);
              this.mc_final_options_wed.push(value2);
              this.mc_daily_sum_prod_wed = this.$helpers.getDayMinimumeValue(this.mc_final_options_wed);
            });
            }
            if(this.thursday_data.length > 0){

            this.thursday_data.forEach((value2,index2) => {
            // this.mc_final_options_thu.push(value2);
            value2.recipes.forEach((value,index) => {
            this.mc_recipes_thu[value['id']] = value;
            this.mc_recipe_prefer_prod_thu = value['prefer_products'];
            value2.recipes[index].total_val = $this.$helpers.sum_products_week_popup_totals_new(value['prefer_products']);


                this.mc_daily_sum_prod_thu_all_data.push(this.mc_recipe_prefer_prod_thu);
                // this.mc_daily_sum_prod_thu = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_thu_all_data);

                this.avg_products_weekly_all_data[3].push(this.mc_recipe_prefer_prod_thu);
                this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);


                this.mc_recipe_prefer_prod_thu = [];

                });

              value2.total_val = this.$helpers.getRecipeTotal(value2.recipes);
              this.mc_final_options_thu.push(value2);            
              this.mc_daily_sum_prod_thu = this.$helpers.getDayMinimumeValue(this.mc_final_options_thu);
            });
            }
            if(this.friday_data.length > 0){

            this.friday_data.forEach((value2,index2) => {
            
            value2.recipes.forEach((value,index) => {
              this.mc_recipes_fri[value['id']] = value;
              this.mc_recipe_prefer_prod_fri = value['prefer_products'];
              value2.recipes[index].total_val = $this.$helpers.sum_products_week_popup_totals_new(value['prefer_products']);

                this.mc_daily_sum_prod_fri_all_data.push(this.mc_recipe_prefer_prod_fri);
                // this.mc_daily_sum_prod_fri = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_fri_all_data);

                this.avg_products_weekly_all_data[4].push(this.mc_recipe_prefer_prod_fri);
                this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);


                this.mc_recipe_prefer_prod_fri = [];

                });

              value2.total_val = this.$helpers.getRecipeTotal(value2.recipes);
              this.mc_final_options_fri.push(value2);            
              this.mc_daily_sum_prod_fri = this.$helpers.getDayMinimumeValue(this.mc_final_options_fri);
            });
            }
            if(this.saturday_data.length > 0){

            this.saturday_data.forEach((value2,index2) => {
            
              value2.recipes.forEach((value,index) => {
                this.mc_recipes_sat[value['id']] = value;
                this.mc_recipe_prefer_prod_sat = value['prefer_products'];
                value2.recipes[index].total_val = $this.$helpers.sum_products_week_popup_totals_new(value['prefer_products']);

                  this.mc_daily_sum_prod_sat_all_data.push(this.mc_recipe_prefer_prod_sat);
                  // this.mc_daily_sum_prod_sat = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_sat_all_data);

                  this.avg_products_weekly_all_data[5].push(this.mc_recipe_prefer_prod_sat);
                  this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);


                  this.mc_recipe_prefer_prod_sat = [];

              });
              value2.total_val = this.$helpers.getRecipeTotal(value2.recipes);
              this.mc_final_options_sat.push(value2);
              this.mc_daily_sum_prod_sat = this.$helpers.getDayMinimumeValue(this.mc_final_options_sat);
            });
            }
            if(this.sunday_data.length > 0){

            this.sunday_data.forEach((value2,index2) => {
            
              value2.recipes.forEach((value,index) => {
              this.mc_recipes_sun[value['id']] = value;
              this.mc_recipe_prefer_prod_sun = value['prefer_products'];
              value2.recipes[index].total_val = $this.$helpers.sum_products_week_popup_totals_new(value['prefer_products']);

                this.mc_daily_sum_prod_sun_all_data.push(this.mc_recipe_prefer_prod_sun);
                // this.mc_daily_sum_prod_sun = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_sun_all_data);
                this.avg_products_weekly_all_data[6].push(this.mc_recipe_prefer_prod_sun);
                this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

                this.mc_recipe_prefer_prod_sun = [];
                });
                value2.total_val = this.$helpers.getRecipeTotal(value2.recipes);
                this.mc_final_options_sun.push(value2);
                this.mc_daily_sum_prod_sun = this.$helpers.getDayMinimumeValue(this.mc_final_options_sun);
            });
          }

      this.changeDays();
  },

  methods:{

    sortedArray: function(recipe_arrays) {
      console.log("recipe_arrays", recipe_arrays);
      let a= _.orderBy(recipe_arrays, 'name', 'asc');
      a= _.orderBy(a, 'category_sort', 'asc');
      return a;
    },
     changeMonthYearModalOpen() {
      this.changeMonthYearModal = true;
    },
    changeDays(){
      let day_id = this.form.days_id;
      if(day_id != ''){
        let dd = this.days_data.find(x => x.id === day_id);
        // console.log('dd', dd);
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
                       })
                       .catch(error => console.error(error));
         }

         this.changeDays();
      },

    sortArrays(arrays) {
        return arrays;
        return _.orderBy(arrays, 'sort', 'asc');
      },

    getComponentTotalsAsPerOffering(e){
      var guideline_id = e.target.value;
      axios.post('/get-component-limits-from-guideline',{guideline:guideline_id})
                    .then((response)=>{
                       this.guideline_data = response.data;
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
    //console.log(this.mc_final_options_mon);
    this.name = "Option "+this.option_number;
    },

    closeOptionsModal(attachedRecipes, optionPhoto, dayNumber, optionNumber, name, is_favorite, assembly_serving_free_text, assembly_serving, assembly_serving_unit, assembly_instructions, is_exclude_from_export, a_la_carte){
      console.log('closeOptionsModal');
      this.addRecipesOptionModal = false;
      console.log(attachedRecipes, optionPhoto, dayNumber, optionNumber);
      let total_val = {};

      if(attachedRecipes.length > 0){
        total_val = this.$helpers.getRecipeTotal(attachedRecipes);
        console.log("total_val", total_val);
      }

      let mc_options_final = {
                   'recipes' : attachedRecipes,
                   'photo' : optionPhoto,
                   'sort' : optionNumber,
                   'name' : name,
                   'total_val' : total_val,
                   'is_favorite' : is_favorite,
                   'assembly_serving_free_text': assembly_serving_free_text,
                   'assembly_serving' : assembly_serving,
                   'assembly_serving_unit' : assembly_serving_unit,
                   'assembly_instructions' : assembly_instructions,
                   'is_exclude_from_export' : is_exclude_from_export,
                   'a_la_carte' : a_la_carte
                   };

            if(dayNumber == 1 ){

              this.mc_final_options_mon.push(mc_options_final);
              this.mc_daily_sum_prod_mon = this.$helpers.getDayMinimumeValue(this.mc_final_options_mon);
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
            }
            if(dayNumber == 2 ){

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
            if(dayNumber == 3 ){

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
            if(dayNumber == 4 ){

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
            if(dayNumber == 5 ){

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
            if(dayNumber == 6 ){

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
            if(dayNumber == 7 ){

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
        this.copied_option_data = this.convertOptionData(option_data);
     }
    },
    convertOptionData(option_data){
      console.log("option_data 1", JSON.stringify(option_data));
      let od = JSON.stringify(option_data);
      od = JSON.parse(od);
      delete od["id"];
      delete od["menu_cycle_day_id"];
      delete od['menu_cycle_day_option_components'];
      if(od.recipes.length > 0){
        od.recipes.map((oc) => {
          delete oc["option_component_id"];
          return oc;
        });
      }
      console.log("option_data 1", JSON.stringify(od));
      return od;
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
        if(confirm("Are you sure you want to duplicate this option?")){
          let od = JSON.stringify(option_data);
          od = JSON.parse(od);
          delete od["id"];
          delete od["menu_cycle_day_id"];
          delete od['menu_cycle_day_option_components'];
          if(od.recipes.length > 0){
            od.recipes.map((oc) => {
              delete oc["option_component_id"];
              return oc;
            });
          }
          option_data = od;
          // console.log("option_data 1", JSON.stringify(od));
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
              // this.mc_daily_sum_prod_mon = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_mon_all_data);

              this.mc_daily_sum_prod_mon = this.$helpers.getDayMinimumeValue(this.mc_final_options_mon);

              this.avg_products_weekly_all_data[0].splice(click_index,1);
              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

            }
            if(day == 2){
              mc_option_id = this.mc_final_options_tue[click_index].id;
              this.mc_final_options_tue.splice(click_index,1);

              this.mc_daily_sum_prod_tue_all_data.splice(click_index,1);
              
              // this.mc_daily_sum_prod_tue = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_tue_all_data);

              this.mc_daily_sum_prod_tue = this.$helpers.getDayMinimumeValue(this.mc_final_options_tue);

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
              // this.mc_daily_sum_prod_sun = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_sun_all_data);

              this.mc_daily_sum_prod_sun = this.$helpers.getDayMinimumeValue(this.mc_final_options_sun);

              this.avg_products_weekly_all_data[6].splice(click_index,1);
              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);
            }

          if(mc_option_id != ""){
              this.form.post(this.route('menu-cycle-option-delete', mc_option_id), {
                onSuccess: () => {
                  this.$toast.success('MenuCycle option deleted successfully!');
                }
              });
          }
          }

    },





    menucycle_edit_save_script(){

    if(this.mc_final_options_mon.length > 0){this.form.mc_options_mon = this.mc_final_options_mon;}
    if(this.mc_final_options_tue.length > 0){this.form.mc_options_tue = this.mc_final_options_tue;}
    if(this.mc_final_options_wed.length > 0){this.form.mc_options_wed = this.mc_final_options_wed;}
    if(this.mc_final_options_thu.length > 0){this.form.mc_options_thu = this.mc_final_options_thu;}
    if(this.mc_final_options_fri.length > 0){this.form.mc_options_fri = this.mc_final_options_fri;}
    if(this.mc_final_options_sat.length > 0){this.form.mc_options_sat = this.mc_final_options_sat;}
    if(this.mc_final_options_sun.length > 0){this.form.mc_options_sun = this.mc_final_options_sun;}
    this.form.is_template = 1;
    let newForm =  this.form;
    
    // Inertia.post(this.route('menu-cycle-edit-save', this.menucycle.id), newForm);

      this.form.post(this.route('menu-cycle-edit-save', this.menucycle.id), {
                    onSuccess: () => {
                          this.$toast.success('Menu Cycle has been Updated Successfully!');
                    },
      });
    },




    removeById (arr, id) {
      // console.log('removeById', id);
      // console.log('removeById', String(id));
      const requiredIndex = arr.findIndex(el => {
        // console.log("el", id, el.id)
          return el.id === id;
      });
      // console.log('requiredIndex', requiredIndex);
      if(requiredIndex === -1){
          return false;
      };
      // console.log('arr', arr);
      arr.splice(requiredIndex, 1);
      // console.log('arr', arr);
      return arr;
    },

    removeByOptionComponentId (arr, id) {
      // console.log('removeById', id);
      // console.log('removeById', String(id));
      const requiredIndex = arr.findIndex(el => {
        console.log("el", id, el.option_component_id);
          return el.option_component_id === id;
      });
      console.log('requiredIndex', requiredIndex);
      if(requiredIndex === -1){
          return false;
      };
      console.log('arr', arr);
      arr.splice(requiredIndex, 1);
      console.log('arr', arr);
      return arr;
    },

    deleteOptionRecipeModel(deleteRecipe, dayNumber, optionNumber){
      console.log("deleteOptionRecipeModel", deleteRecipe, dayNumber, optionNumber);
      // return true;
      let $this = this;
      let index = optionNumber - 1;
      console.log("deleteOptionRecipeModel", deleteRecipe, deleteRecipe.option_component_id);
      if(!deleteRecipe.option_component_id){
        return true;
      }
      if(dayNumber == 1){
        let recipes = this.mc_final_options_mon[index].recipes;
        console.log("recipes", recipes);
        // this.mc_final_options_mon.splice(index,1);
        console.log("recipes last", recipes);
        console.log("this.mc_final_options_mon[index].recipes", recipes, deleteRecipe);
        recipes = this.removeByOptionComponentId(recipes, deleteRecipe.option_component_id);
        this.mc_final_options_mon[index].recipes = recipes;
        this.mc_daily_sum_prod_mon_all_data[index] = [];
        this.avg_products_weekly_all_data[0][index] = [];
        console.log('mc_daily_sum_prod_mon_all_data',  this.mc_daily_sum_prod_mon_all_data);
        if(recipes){
          console.log('recipes if', recipes);
          recipes.forEach((value,key) => {
            console.log("value", value);
          $this.mc_recipes_mon[value['id']] = value;
            if(value.prefer_products){
              console.log("value['prefer_products']", value.prefer_products);
              $this.mc_recipe_prefer_prod_mon = value.prefer_products;
              $this.mc_daily_sum_prod_mon_all_data.push($this.mc_recipe_prefer_prod_mon);
              $this.avg_products_weekly_all_data[0].push($this.mc_recipe_prefer_prod_mon);
            }
        });
        }
        console.log("mc_daily_sum_prod_mon_all_data last", this.mc_daily_sum_prod_mon_all_data);
        this.mc_daily_sum_prod_mon = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_mon_all_data);
        this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);
        this.mc_recipe_prefer_prod_mon = [];
      }

      if(dayNumber == 2){
        let recipes = this.mc_final_options_tue[index].recipes;
        console.log("recipes", recipes);
        // this.mc_final_options_tue.splice(index,1);
        console.log("recipes last", recipes);
        console.log("this.mc_final_options_tue[index].recipes", recipes, deleteRecipe);
        recipes = this.removeByOptionComponentId(recipes, deleteRecipe.option_component_id);
        this.mc_final_options_tue[index].recipes = recipes;
        this.mc_daily_sum_prod_tue_all_data[index] = [];
        this.avg_products_weekly_all_data[0][index] = [];
        console.log('mc_daily_sum_prod_tue_all_data',  this.mc_daily_sum_prod_tue_all_data);
        if(recipes){
          console.log('recipes if', recipes);
          recipes.forEach((value,key) => {
            console.log("value", value);
          $this.mc_recipes_tue[value['id']] = value;
            if(value.prefer_products){
              console.log("value['prefer_products']", value.prefer_products);
              $this.mc_recipe_prefer_prod_tue = value.prefer_products;
              $this.mc_daily_sum_prod_tue_all_data.push($this.mc_recipe_prefer_prod_tue);
              $this.avg_products_weekly_all_data[0].push($this.mc_recipe_prefer_prod_tue);
            }
        });
        }
        console.log("mc_daily_sum_prod_tue_all_data last", this.mc_daily_sum_prod_tue_all_data);
        this.mc_daily_sum_prod_tue = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_tue_all_data);
        this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);
        this.mc_recipe_prefer_prod_tue = [];
      }

      if(dayNumber == 3){
        let recipes = this.mc_final_options_wed[index].recipes;
        console.log("recipes", recipes);
        // this.mc_final_options_wed.splice(index,1);
        console.log("recipes last", recipes);
        console.log("this.mc_final_options_wed[index].recipes", recipes, deleteRecipe);
        recipes = this.removeByOptionComponentId(recipes, deleteRecipe.option_component_id);
        this.mc_final_options_wed[index].recipes = recipes;
        this.mc_daily_sum_prod_wed_all_data[index] = [];
        this.avg_products_weekly_all_data[0][index] = [];
        console.log('mc_daily_sum_prod_wed_all_data',  this.mc_daily_sum_prod_wed_all_data);
        if(recipes){
          console.log('recipes if', recipes);
          recipes.forEach((value,key) => {
            console.log("value", value);
          $this.mc_recipes_wed[value['id']] = value;
            if(value.prefer_products){
              console.log("value['prefer_products']", value.prefer_products);
              $this.mc_recipe_prefer_prod_wed = value.prefer_products;
              $this.mc_daily_sum_prod_wed_all_data.push($this.mc_recipe_prefer_prod_wed);
              $this.avg_products_weekly_all_data[0].push($this.mc_recipe_prefer_prod_wed);
            }
        });
        }
        console.log("mc_daily_sum_prod_wed_all_data last", this.mc_daily_sum_prod_wed_all_data);
        this.mc_daily_sum_prod_wed = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_wed_all_data);
        this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);
        this.mc_recipe_prefer_prod_wed = [];
      }

      if(dayNumber == 4){
        let recipes = this.mc_final_options_thu[index].recipes;
        console.log("recipes", recipes);
        // this.mc_final_options_thu.splice(index,1);
        console.log("recipes last", recipes);
        console.log("this.mc_final_options_thu[index].recipes", recipes, deleteRecipe);
        recipes = this.removeByOptionComponentId(recipes, deleteRecipe.option_component_id);
        this.mc_final_options_thu[index].recipes = recipes;
        this.mc_daily_sum_prod_thu_all_data[index] = [];
        this.avg_products_weekly_all_data[0][index] = [];
        console.log('mc_daily_sum_prod_thu_all_data',  this.mc_daily_sum_prod_thu_all_data);
        if(recipes){
          console.log('recipes if', recipes);
          recipes.forEach((value,key) => {
            console.log("value", value);
          $this.mc_recipes_thu[value['id']] = value;
            if(value.prefer_products){
              console.log("value['prefer_products']", value.prefer_products);
              $this.mc_recipe_prefer_prod_thu = value.prefer_products;
              $this.mc_daily_sum_prod_thu_all_data.push($this.mc_recipe_prefer_prod_thu);
              $this.avg_products_weekly_all_data[0].push($this.mc_recipe_prefer_prod_thu);
            }
        });
        }
        console.log("mc_daily_sum_prod_thu_all_data last", this.mc_daily_sum_prod_thu_all_data);
        this.mc_daily_sum_prod_thu = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_thu_all_data);
        this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);
        this.mc_recipe_prefer_prod_thu = [];
      }

      if(dayNumber == 5){
        let recipes = this.mc_final_options_fri[index].recipes;
        console.log("recipes", recipes);
        // this.mc_final_options_fri.splice(index,1);
        console.log("recipes last", recipes);
        console.log("this.mc_final_options_fri[index].recipes", recipes, deleteRecipe);
        recipes = this.removeByOptionComponentId(recipes, deleteRecipe.option_component_id);
        this.mc_final_options_fri[index].recipes = recipes;
        this.mc_daily_sum_prod_fri_all_data[index] = [];
        this.avg_products_weekly_all_data[0][index] = [];
        console.log('mc_daily_sum_prod_fri_all_data',  this.mc_daily_sum_prod_fri_all_data);
        if(recipes){
          console.log('recipes if', recipes);
          recipes.forEach((value,key) => {
            console.log("value", value);
          $this.mc_recipes_fri[value['id']] = value;
            if(value.prefer_products){
              console.log("value['prefer_products']", value.prefer_products);
              $this.mc_recipe_prefer_prod_fri = value.prefer_products;
              $this.mc_daily_sum_prod_fri_all_data.push($this.mc_recipe_prefer_prod_fri);
              $this.avg_products_weekly_all_data[0].push($this.mc_recipe_prefer_prod_fri);
            }
        });
        }
        console.log("mc_daily_sum_prod_fri_all_data last", this.mc_daily_sum_prod_fri_all_data);
        this.mc_daily_sum_prod_fri = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_fri_all_data);
        this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);
        this.mc_recipe_prefer_prod_fri = [];
      }

      if(dayNumber == 6){
        let recipes = this.mc_final_options_sat[index].recipes;
        console.log("recipes", recipes);
        // this.mc_final_options_sat.splice(index,1);
        console.log("recipes last", recipes);
        console.log("this.mc_final_options_sat[index].recipes", recipes, deleteRecipe);
        recipes = this.removeByOptionComponentId(recipes, deleteRecipe.option_component_id);
        this.mc_final_options_sat[index].recipes = recipes;
        this.mc_daily_sum_prod_sat_all_data[index] = [];
        this.avg_products_weekly_all_data[0][index] = [];
        console.log('mc_daily_sum_prod_sat_all_data',  this.mc_daily_sum_prod_sat_all_data);
        if(recipes){
          console.log('recipes if', recipes);
          recipes.forEach((value,key) => {
            console.log("value", value);
          $this.mc_recipes_sat[value['id']] = value;
            if(value.prefer_products){
              console.log("value['prefer_products']", value.prefer_products);
              $this.mc_recipe_prefer_prod_sat = value.prefer_products;
              $this.mc_daily_sum_prod_sat_all_data.push($this.mc_recipe_prefer_prod_sat);
              $this.avg_products_weekly_all_data[0].push($this.mc_recipe_prefer_prod_sat);
            }
        });
        }
        console.log("mc_daily_sum_prod_sat_all_data last", this.mc_daily_sum_prod_sat_all_data);
        this.mc_daily_sum_prod_sat = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_sat_all_data);
        this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);
        this.mc_recipe_prefer_prod_sat = [];
      }

      if(dayNumber == 7){
        let recipes = this.mc_final_options_sun[index].recipes;
        console.log("recipes", recipes);
        // this.mc_final_options_sun.splice(index,1);
        console.log("recipes last", recipes);
        console.log("this.mc_final_options_sun[index].recipes", recipes, deleteRecipe);
        recipes = this.removeByOptionComponentId(recipes, deleteRecipe.option_component_id);
        this.mc_final_options_sun[index].recipes = recipes;
        this.mc_daily_sum_prod_sun_all_data[index] = [];
        this.avg_products_weekly_all_data[0][index] = [];
        console.log('mc_daily_sum_prod_sun_all_data',  this.mc_daily_sum_prod_sun_all_data);
        if(recipes){
          console.log('recipes if', recipes);
          recipes.forEach((value,key) => {
            console.log("value", value);
          $this.mc_recipes_sun[value['id']] = value;
            if(value.prefer_products){
              console.log("value['prefer_products']", value.prefer_products);
              $this.mc_recipe_prefer_prod_sun = value.prefer_products;
              $this.mc_daily_sum_prod_sun_all_data.push($this.mc_recipe_prefer_prod_sun);
              $this.avg_products_weekly_all_data[0].push($this.mc_recipe_prefer_prod_sun);
            }
        });
        }
        console.log("mc_daily_sum_prod_sun_all_data last", this.mc_daily_sum_prod_sun_all_data);
        this.mc_daily_sum_prod_sun = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_sun_all_data);
        this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);
        this.mc_recipe_prefer_prod_sun = [];
      }
    },

    closeEditOptionsModal(attachedRecipes, optionPhoto, dayNumber, optionNumber, name = '', is_favorite, assembly_serving_free_text, assembly_serving, assembly_serving_unit,  assembly_instructions, is_exclude_from_export, a_la_carte){
      console.log("closeEditOptionsModal");
      this.addRecipesOptionModal = false;
      this.editOptionData = [];
      let index = optionNumber - 1;
      let total_val = {};

      console.log(attachedRecipes, optionPhoto, dayNumber, optionNumber);

      console.log("dayNumber", dayNumber);
      if(attachedRecipes.length > 0){
        total_val = this.$helpers.getRecipeTotal(attachedRecipes);
        console.log("total_val", total_val);
      }



      var mc_options_final = {
                   'recipes' : attachedRecipes,
                   'photo' : optionPhoto,
                   'sort' : optionNumber,
                   'name' : name,
                   'total_val' : total_val,
                   'is_favorite' : is_favorite
                 };

            if(dayNumber == 1 ){

              // this.mc_final_options_mon[index] = mc_options_final;
              
              this.mc_final_options_mon[index].recipes = attachedRecipes;
              this.mc_final_options_mon[index].photo = optionPhoto;
              this.mc_final_options_mon[index].sort = optionNumber;
              this.mc_final_options_mon[index].name = name;
              this.mc_final_options_mon[index].is_favorite = is_favorite;
              
              this.mc_final_options_mon[index].total_val = total_val;
              this.mc_final_options_mon[index].assembly_serving_free_text = assembly_serving_free_text;
              this.mc_final_options_mon[index].assembly_serving = assembly_serving;
              this.mc_final_options_mon[index].assembly_serving_unit = assembly_serving_unit;
              this.mc_final_options_mon[index].assembly_instructions = assembly_instructions;
              this.mc_final_options_mon[index].is_exclude_from_export = is_exclude_from_export;
              this.mc_final_options_mon[index].a_la_carte = a_la_carte;


              this.mc_daily_sum_prod_mon = this.$helpers.getDayMinimumeValue(this.mc_final_options_mon);


              attachedRecipes.forEach((value,key) => {

                this.mc_recipes_mon[value['id']] = value;

                if(value['prefer_products']){
                this.mc_recipe_prefer_prod_mon = value['prefer_products'];
                this.mc_daily_sum_prod_mon_all_data.push(this.mc_recipe_prefer_prod_mon);
                this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_mon);
                }

              });

              this.mc_daily_sum_prod_mon = this.$helpers.getDayMinimumeValue(this.mc_final_options_mon);
              // this.mc_daily_sum_prod_mon = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_mon_all_data);

              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

              this.mc_recipe_prefer_prod_mon = [];

            }
            if(dayNumber == 2 ){

              // this.mc_final_options_tue[index] = mc_options_final;
              this.mc_final_options_tue[index].recipes = attachedRecipes;
              this.mc_final_options_tue[index].photo = optionPhoto;
              this.mc_final_options_tue[index].sort = optionNumber;
              this.mc_final_options_tue[index].name = name;
              this.mc_final_options_tue[index].total_val = total_val;
              this.mc_final_options_tue[index].is_favorite = is_favorite;
              this.mc_final_options_tue[index].assembly_serving_free_text = assembly_serving_free_text;
              this.mc_final_options_tue[index].assembly_serving = assembly_serving;
              this.mc_final_options_tue[index].assembly_serving_unit = assembly_serving_unit;
              this.mc_final_options_tue[index].assembly_instructions = assembly_instructions;
              this.mc_final_options_tue[index].is_exclude_from_export = is_exclude_from_export;
              this.mc_final_options_tue[index].a_la_carte = a_la_carte;

              this.mc_daily_sum_prod_tue = this.$helpers.getDayMinimumeValue(this.mc_final_options_tue);
              
              attachedRecipes.forEach((value,key) => {

                this.mc_recipes_tue[value['id']] = value;

                if(value['prefer_products']){
                this.mc_recipe_prefer_prod_tue = value['prefer_products'];
                this.mc_daily_sum_prod_tue_all_data.push(this.mc_recipe_prefer_prod_tue);
                this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_tue);
                }

              });

              this.mc_daily_sum_prod_tue = this.$helpers.getDayMinimumeValue(this.mc_final_options_tue);
              // this.mc_daily_sum_prod_tue = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_tue_all_data);

              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

              this.mc_recipe_prefer_prod_tue = [];
            }
            if(dayNumber == 3 ){

              // this.mc_final_options_wed[index] = mc_options_final;
              
            this.mc_final_options_wed[index].recipes = attachedRecipes;
            this.mc_final_options_wed[index].photo = optionPhoto;
            this.mc_final_options_wed[index].sort = optionNumber;
            this.mc_final_options_wed[index].name = name;
            this.mc_final_options_wed[index].is_favorite = is_favorite;
            this.mc_final_options_wed[index].total_val = total_val;
            this.mc_final_options_wed[index].assembly_serving_free_text = assembly_serving_free_text;
            this.mc_final_options_wed[index].assembly_serving = assembly_serving;
            this.mc_final_options_wed[index].assembly_serving_unit = assembly_serving_unit;
            this.mc_final_options_wed[index].assembly_instructions = assembly_instructions;
            this.mc_final_options_wed[index].is_exclude_from_export = is_exclude_from_export;
            this.mc_final_options_wed[index].a_la_carte = a_la_carte;

            this.mc_daily_sum_prod_wed = this.$helpers.getDayMinimumeValue(this.mc_final_options_wed);


            attachedRecipes.forEach((value,key) => {

                this.mc_recipes_wed[value['id']] = value;

                if(value['prefer_products']){
                this.mc_recipe_prefer_prod_wed = value['prefer_products'];
                this.mc_daily_sum_prod_wed_all_data.push(this.mc_recipe_prefer_prod_wed);
                this.avg_products_weekly_all_data[0].push(this.mc_recipe_prefer_prod_wed);
                }

              });

              // this.mc_daily_sum_prod_wed = this.$helpers.getDayMinimumeValue(this.mc_final_options_wed);
              // this.mc_daily_sum_prod_wed = this.$helpers.sum_products_daily_setup(this.mc_daily_sum_prod_wed_all_data);

              this.mc_weekly_avg_prods = this.$helpers.avg_products_week_setup(this.avg_products_weekly_all_data);

              this.mc_recipe_prefer_prod_wed = [];
            }
            if(dayNumber == 4 ){

            this.mc_final_options_thu[index].recipes = attachedRecipes;
            this.mc_final_options_thu[index].photo = optionPhoto;
            this.mc_final_options_thu[index].sort = optionNumber;
            this.mc_final_options_thu[index].name = name;
            this.mc_final_options_thu[index].total_val = total_val;
            this.mc_final_options_thu[index].is_favorite = is_favorite;
            this.mc_final_options_thu[index].assembly_serving_free_text = assembly_serving_free_text;
            this.mc_final_options_thu[index].assembly_serving = assembly_serving;
              this.mc_final_options_thu[index].assembly_serving_unit = assembly_serving_unit;
              
              this.mc_final_options_thu[index].assembly_instructions = assembly_instructions;
              this.mc_final_options_thu[index].is_exclude_from_export = is_exclude_from_export;
              this.mc_final_options_thu[index].a_la_carte = a_la_carte;

            console.log("mc_final_options_thu", this.mc_final_options_thu);

            // this.mc_final_options_thu[index] = mc_options_final;
            this.mc_daily_sum_prod_thu = this.$helpers.getDayMinimumeValue(this.mc_final_options_thu);

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
            if(dayNumber == 5 ){

            // this.mc_final_options_fri[index] = mc_options_final;
            

            this.mc_final_options_fri[index].recipes = attachedRecipes;
            this.mc_final_options_fri[index].photo = optionPhoto;
            this.mc_final_options_fri[index].sort = optionNumber;
            this.mc_final_options_fri[index].name = name;
            this.mc_final_options_fri[index].total_val = total_val;
            this.mc_final_options_fri[index].is_favorite = is_favorite;
            this.mc_final_options_fri[index].assembly_serving_free_text = assembly_serving_free_text;
            this.mc_final_options_fri[index].assembly_serving = assembly_serving;
              this.mc_final_options_fri[index].assembly_serving_unit = assembly_serving_unit;
              
              this.mc_final_options_fri[index].assembly_instructions = assembly_instructions;
              this.mc_final_options_fri[index].is_exclude_from_export = is_exclude_from_export;
              this.mc_final_options_fri[index].a_la_carte = a_la_carte;


            this.mc_daily_sum_prod_fri = this.$helpers.getDayMinimumeValue(this.mc_final_options_fri);

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
            if(dayNumber == 6 ){

            this.mc_final_options_sat[index].recipes = attachedRecipes;
            this.mc_final_options_sat[index].photo = optionPhoto;
            this.mc_final_options_sat[index].sort = optionNumber;
            this.mc_final_options_sat[index].name = name;
            this.mc_final_options_sat[index].total_val = total_val;
            this.mc_final_options_sat[index].is_favorite = is_favorite;
            this.mc_final_options_sat[index].assembly_serving_free_text = assembly_serving_free_text;
            this.mc_final_options_sat[index].assembly_serving = assembly_serving;
            this.mc_final_options_sat[index].assembly_serving_unit = assembly_serving_unit;
            
            this.mc_final_options_sat[index].assembly_instructions = assembly_instructions;
            this.mc_final_options_sat[index].is_exclude_from_export = is_exclude_from_export;
            this.mc_final_options_sat[index].a_la_carte = a_la_carte;
            // this.mc_final_options_sat[index] = mc_options_final;
            this.mc_daily_sum_prod_sat = this.$helpers.getDayMinimumeValue(this.mc_final_options_sat);

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
            if(dayNumber == 7 ){

            this.mc_final_options_sun[index].recipes = attachedRecipes;
            this.mc_final_options_sun[index].photo = optionPhoto;
            this.mc_final_options_sun[index].sort = optionNumber;
            this.mc_final_options_sun[index].name = name;
            this.mc_final_options_sun[index].total_val = total_val;
            this.mc_final_options_sun[index].is_favorite = is_favorite;
            this.mc_final_options_sun[index].assembly_serving_free_text = assembly_serving_free_text;
            this.mc_final_options_sun[index].assembly_serving = assembly_serving;
            this.mc_final_options_sun[index].assembly_serving_unit = assembly_serving_unit;
            
            this.mc_final_options_sun[index].assembly_instructions = assembly_instructions;
            this.mc_final_options_sun[index].is_exclude_from_export = is_exclude_from_export;
            this.mc_final_options_sun[index].a_la_carte = a_la_carte;

            // this.mc_final_options_sun[index] = mc_options_final;
            this.mc_daily_sum_prod_sun = this.$helpers.getDayMinimumeValue(this.mc_final_options_sun);

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




    // //drag and drop features methods
    // checkDrop(){
    //  Event.preventDefault();
    // },

    // shouldAcceptDrop (sourceContainerOptions, payload) {
    //   return true;
    // },

    // onDropMethod (dropResult) {
    //   //alert('test');
    //   console.log(dropResult);
    //   //this[collection] = applyDrag(this[collection], dropResult)
    // },
    // getChildPayload_mon (index) {
    //   return this.mc_final_options_mon[index];
    // },
    // getChildPayload_tue (index) {
    //   return this.mc_final_options_tue[index];
    // },
    // getChildPayload_wed (index) {
    //   return this.mc_final_options_wed[index];
    // },
    // getChildPayload_thu (index) {
    //   return this.mc_final_options_thu[index];
    // },
    // getChildPayload_fri (index) {
    //   return this.mc_final_options_fri[index];
    // },
    // getChildPayload_sat (index) {
    //   return this.mc_final_options_sat[index];
    // },
    // getChildPayload_sun (index) {
    //   return this.mc_final_options_sun[index];
    // },

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
