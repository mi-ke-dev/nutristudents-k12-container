<template>
  <Head>
  <title>{{guideline.name}} - Edit Guideline | NutriStudents K-12</title>
  <meta name="description" content="Edit Guideline">
  </Head>
  <default-layout>

    <BreadcrumLayout>
      <div class="flex">
        <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
        <inertia-link :href="route('guidelines')" class="link-color"><U>Guidelines</U></inertia-link></div>
      </BreadcrumLayout>



      <form action="#" @submit.prevent="false">

        <PageTitleLayout>
          <div class="lg:mb-0 mb-4 w-4/6">
            <h1 class="heading-color  2xl:text-2xl text-xl font-bold">{{guideline.name}}</h1>
          </div>
          <div class="w-full flex lg:flex-nowrap flex-wrap md:justify-end items-center">

            <button type="button" >
              <inertia-link :href="route('guidelines')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
            </button>

            <button v-if="guideline.is_tenant_admin" type="button" @click="guideline_edit_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3 sm:mt-0">Update</button>


          </div>
        </PageTitleLayout>


        <PageTitleLayout>
          <div class="w-full">



            <div class="block justify-between shadow py-8 mt-4 align-middle min-w-full   bg-white rounded-t-lg lg:divide-y-2 border-gray-300 w-full overflow-x-auto">
              <div class="w-full">
                <div class="xl:flex block xl:items-center p-5">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-48">Guideline Name*</label>
                  <div class="2xl:w-96 xl:w-96 w-60">
                    <input type="text" v-model="form.name" class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 w-full shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">   
                    <div v-if="form.errors.name" class="validation_error_msg">{{ form.errors.name }}</div> 
                  </div>
                </div>


                <div class="xl:flex block xl:items-center p-5">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-48">Meal Type*</label>
                  <div class="relative pl-0 sm:w-64 w-48 lg:top-0  xl:mt-0 mt-4">
                      <select id="meal_type_id" name="meal_type_id" v-model="form.meal_type_id" class="shadow-sm focus:border-color block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height input-background text-gray-500" >
                          <option value="">Select</option>
                          <option v-for="mealVal in mealtype_data" :value="mealVal.id">{{mealVal.name}}</option>
                      </select>
                      <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                      <div v-if="form.errors.meal_type_id" class="validation_error_msg">{{ form.errors.meal_type_id }}</div>
                  </div>
                </div>


                <div class="xl:flex block xl:items-center p-5">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-48">Age Range*</label>
                  <div class="relative pl-0 sm:w-64 w-48 lg:top-0  xl:mt-0 mt-4">
                      <select id="age_grade_id" name="age_grade_id" v-model="form.age_grade_id" class="shadow-sm focus:border-color block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height input-background text-gray-500" >
                          <option value="">Select</option>
                          <option v-for="ageVal in agerange_data" :value="ageVal.id">{{ageVal.name}}</option>
                      </select>
                      <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                      <div v-if="form.errors.age_grade_id" class="validation_error_msg">{{ form.errors.age_grade_id }}</div>
                  </div>
                </div>


                <div class="xl:flex block xl:items-center p-5">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-48">Days*</label>
                  <div class="relative pl-0 sm:w-64 w-48 lg:top-0  xl:mt-0 mt-4">
                      <select id="days_id" name="days_id" v-model="form.days_id" class="shadow-sm focus:border-color block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height input-background text-gray-500" >
                          <option value="">Select</option>
                          <option v-for="daysVal in days_data" :value="daysVal.id">{{daysVal.name}}</option>
                      </select>
                      <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                      <div v-if="form.errors.days_id" class="validation_error_msg">{{ form.errors.days_id }}</div>
                  </div>
                </div>

              </div>
            </div>



<!-- weekly requirement fields start here -->

            <div class="w-full pt-10 pb-5">
              <h2 class="heading-color 2xl:text-2xl text-xl font-bold">Weekly Requirements</h2>
            </div>
            <div>
              <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
                <h3 class="text-white text-lg font-bold w-11/12">Component Information Minimum Requirements</h3>
                <div class="text-white text-2xl pr-6 cursor-pointer">
                  <i class="fa fa-chevron-down"></i>
                </div>
              </header>
              <div class="border-b-2 border-gray-200 sm:rounded-lg">
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      meat
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_usda_componenent_serving_meat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      grain
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_usda_componenent_serving_grain" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      fruit
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_usda_componenent_serving_fruit" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      milk
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_usda_componenent_serving_milk" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_usda_componenent_serving_veg" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/leg
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_usda_componenent_serving_vegleg" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/red
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_usda_componenent_serving_vegred" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/grn
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_usda_componenent_serving_veggrn" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/star
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_usda_componenent_serving_vegstar" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/othr
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_usda_componenent_serving_vegothr" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="pt-7">
              <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
                <h3 class="text-white text-lg font-bold w-11/12">Component Information Maximum Requirements</h3>
                <div class="text-white text-2xl pr-6 cursor-pointer">
                  <i class="fa fa-chevron-down"></i>
                </div>
              </header>
              <div class="border-b-2 border-gray-200 sm:rounded-lg">
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      meat
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_usda_componenent_serving_meat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      grain
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_usda_componenent_serving_grain" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      fruit
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_usda_componenent_serving_fruit" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      milk
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_usda_componenent_serving_milk" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_usda_componenent_serving_veg" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/leg
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_usda_componenent_serving_vegleg" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/red
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_usda_componenent_serving_vegred" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/grn
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_usda_componenent_serving_veggrn" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/star
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_usda_componenent_serving_vegstar" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/othr
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_usda_componenent_serving_vegothr" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>
                </div>
              </div>
            </div>

<!-- weekly nutriction requirement fields start here -->            

            <div class="pt-7">
              <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
                <h3 class="text-white text-lg font-bold w-11/12">Nutrition Facts Minimum Requirements</h3>
                <div class="text-white text-2xl pr-6 cursor-pointer">
                  <i class="fa fa-chevron-down"></i>
                </div>
              </header>
              <div class="border-b-2 border-gray-200 sm:rounded-lg">
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Calories
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_calories" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">cals</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Cal/Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_calfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">cals</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Total Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_totalfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Sat Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_satfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Trans Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_transfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Polysat Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_polysatfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Monosat Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_monosatfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Cholesterol
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_cholesterol" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Sodium
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_sodium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Potassium
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_potassium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>
                </div>
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Carbs
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_carbs" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      fiber
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_fiber" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      SUGAR
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_sugar" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      PROTEIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_protein" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN A
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_vitamina" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN B6
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_vitaminb6" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN B12
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_vitaminb12" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN C
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_vitaminc" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN D
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_vitamind" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN E
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_vitamine" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>
                </div>
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      CALCIUM
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_calcium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      IRON
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_iron" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      MAGNESIUM
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_magnesium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      COBALAMIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_coblamin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      THIAMINE
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_thiamin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      RIBOFLAVIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_riboflavin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      NIACIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_niacin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      ZINC
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_zinc" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      WATER
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_water" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      ASH
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_min_nutrition_facts_ash" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="pt-7">
              <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
                <h3 class="text-white text-lg font-bold w-11/12">Nutrition Facts Maximum Requirements</h3>
                <div class="text-white text-2xl pr-6 cursor-pointer">
                  <i class="fa fa-chevron-down"></i>
                </div>
              </header>
              <div class="border-b-2 border-gray-200 sm:rounded-lg">
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Calories
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_calories" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">cals</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Cal/Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_calfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">cals</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Total Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_totalfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Sat Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_satfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Trans Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_transfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Polysat Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_polysatfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Monosat Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_monosatfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Cholesterol
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_cholesterol" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Sodium
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_sodium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Potassium
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_potassium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>
                </div>
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Carbs
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_carbs" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      fiber
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_fiber" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      SUGAR
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_sugar" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      PROTEIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_protein" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN A
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_vitamina" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN B6
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_vitaminb6" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN B12
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_vitaminb12" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN C
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_vitaminc" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN D
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_vitamind" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN E
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_vitamine" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>
                </div>
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      CALCIUM
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_calcium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      IRON
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_iron" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      MAGNESIUM
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_magnesium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      COBALAMIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_coblamin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      THIAMINE
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_thiamin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      RIBOFLAVIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_riboflavin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      NIACIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_niacin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      ZINC
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_zinc" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      WATER
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_water" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      ASH
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.weekly_max_nutrition_facts_ash" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>




<!-- daily requirement fields start here -->


            <div class="w-full pt-10 pb-5">
              <h2 class="heading-color 2xl:text-2xl text-xl font-bold">Daily Requirements</h2>
            </div>
            <div>
              <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
                <h3 class="text-white text-lg font-bold w-11/12">Component Information Minimum Requirements</h3>
                <div class="text-white text-2xl pr-6 cursor-pointer">
                  <i class="fa fa-chevron-down"></i>
                </div>
              </header>
              <div class="border-b-2 border-gray-200 sm:rounded-lg">
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      meat
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_usda_componenent_serving_meat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      grain
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_usda_componenent_serving_grain" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      fruit
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_usda_componenent_serving_fruit" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      milk
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_usda_componenent_serving_milk" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_usda_componenent_serving_veg" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/leg
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_usda_componenent_serving_vegleg" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/red
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_usda_componenent_serving_vegred" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/grn
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_usda_componenent_serving_veggrn" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/star
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_usda_componenent_serving_vegstar" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/othr
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_usda_componenent_serving_vegothr" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="pt-7">
              <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
                <h3 class="text-white text-lg font-bold w-11/12">Component Information Maximum Requirements</h3>
                <div class="text-white text-2xl pr-6 cursor-pointer">
                  <i class="fa fa-chevron-down"></i>
                </div>
              </header>
              <div class="border-b-2 border-gray-200 sm:rounded-lg">
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      meat
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_usda_componenent_serving_meat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      grain
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_usda_componenent_serving_grain" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      fruit
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_usda_componenent_serving_fruit" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      milk
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_usda_componenent_serving_milk" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_usda_componenent_serving_veg" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/leg
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_usda_componenent_serving_vegleg" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/red
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_usda_componenent_serving_vegred" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/grn
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_usda_componenent_serving_veggrn" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/star
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_usda_componenent_serving_vegstar" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      veg/othr
                    </div>
                    <div class="px-2 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider w-full bg-white">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_usda_componenent_serving_vegothr" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </div>
                  </div>
                </div>
              </div>
            </div>

<!-- Daily Nutrition fields... -->

            <div class="pt-7">
              <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
                <h3 class="text-white text-lg font-bold w-11/12">Nutrition Facts Minimum Requirements</h3>
                <div class="text-white text-2xl pr-6 cursor-pointer">
                  <i class="fa fa-chevron-down"></i>
                </div>
              </header>
              <div class="border-b-2 border-gray-200 sm:rounded-lg">
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Calories
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_calories" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">cals</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Cal/Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_calfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">cals</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Total Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_totalfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Sat Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_satfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Trans Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_transfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Polysat Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_polysatfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Monosat Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_monosatfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Cholesterol
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_cholesterol" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Sodium
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_sodium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Potassium
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_potassium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>
                </div>
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Carbs
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_carbs" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      fiber
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_fiber" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      SUGAR
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_sugar" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      PROTEIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_protein" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN A
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_vitamina" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN B6
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_vitaminb6" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN B12
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_vitaminb12" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN C
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_vitaminc" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN D
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_vitamind" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN E
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_vitamine" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>
                </div>
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      CALCIUM
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_calcium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      IRON
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_iron" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      MAGNESIUM
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_magnesium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      COBALAMIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_coblamin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      THIAMINE
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_thiamin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      RIBOFLAVIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_riboflavin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      NIACIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_niacin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      ZINC
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_zinc" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      WATER
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_water" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      ASH
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_min_nutrition_facts_ash" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="pt-7">
              <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
                <h3 class="text-white text-lg font-bold w-11/12">Nutrition Facts Maximum Requirements</h3>
                <div class="text-white text-2xl pr-6 cursor-pointer">
                  <i class="fa fa-chevron-down"></i>
                </div>
              </header>
              <div class="border-b-2 border-gray-200 sm:rounded-lg">
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Calories
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_calories" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">cals</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Cal/Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_calfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">cals</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Total Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_totalfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Sat Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_satfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Trans Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_transfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Polysat Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_polysatfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Monosat Fat
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_monosatfat" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Cholesterol
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_cholesterol" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Sodium
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_sodium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Potassium
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_potassium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>
                </div>
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      Carbs
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_carbs" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      fiber
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_fiber" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      SUGAR
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_sugar" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      PROTEIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_protein" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN A
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_vitamina" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN B6
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_vitaminb6" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN B12
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_vitaminb12" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN C
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_vitaminc" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN D
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_vitamind" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      VITAMIN E
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_vitamine" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>
                </div>
                <div class="flex flex-wrap">
                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      CALCIUM
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_calcium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">%</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      IRON
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_iron" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      MAGNESIUM
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_magnesium" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      COBALAMIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_coblamin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      THIAMINE
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_thiamin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      RIBOFLAVIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_riboflavin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      NIACIN
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_niacin" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      ZINC
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_zinc" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">mg</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      WATER
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_water" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>

                  <div class="w-2/4 xl:w-1/1 md:w-1/5">
                    <div class="px-2 py-2 text-left text-xs font-white text-black uppercase tracking-wider font-bold w-full">
                      ASH
                    </div>
                    <div class="px-3 py-2 text-left font-white text-gray-400 tracking-wider w-full bg-white flex items-center">
                      <input type="number" min="0"  step="0.125" v-model="form.daily_max_nutrition_facts_ash" class="shadow-sm focus:outline-none 2xl:w-20 w-full h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                      <p class="text-gray-400 pl-1">g</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
          </div>
        </PageTitleLayout>        


  <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center mb-6 px-10 mt-6">

    <button type="button" >
    <inertia-link :href="route('guidelines')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
    </button>

    <button v-if="guideline.is_tenant_admin" type="button" @click="guideline_edit_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3  sm:mt-0">Update</button>

  </div>

</form>

</default-layout>

</template>

<script>
  import DefaultLayout from "@/Layouts/DefaultLayout";
  import Welcome from "@/Jetstream/Welcome";
  import BreadcrumLayout from "@/Pages/Common/Breadcrumbs";
  import PageTitleLayout from "@/Pages/Common/PageTitle";
  import TableFilterLayout from "@/Pages/Common/TableFilters";
  import TableIndexLayout from "@/Pages/Common/TableIndex";

  export default {
    props:['guideline','mealtype_data', 'agerange_data', 'days_data'],
    components: {
      DefaultLayout,
      Welcome,
      BreadcrumLayout,
      PageTitleLayout,
      TableFilterLayout,
      TableIndexLayout,
    },

    data(){
      return {      

        form: this.$inertia.form({

            name:this.guideline.name,

            meal_type_id:this.guideline.meal_type_id,
            age_grade_id:this.guideline.age_grade_id,
            days_id:this.guideline.days_id,

            weekly_min_usda_componenent_serving_meat:this.guideline.weekly_min_usda_componenent_serving_meat,
            weekly_min_usda_componenent_serving_grain:this.guideline.weekly_min_usda_componenent_serving_grain,
            weekly_min_usda_componenent_serving_fruit:this.guideline.weekly_min_usda_componenent_serving_fruit,
            weekly_min_usda_componenent_serving_milk:this.guideline.weekly_min_usda_componenent_serving_milk,
            weekly_min_usda_componenent_serving_veg:this.guideline.weekly_min_usda_componenent_serving_veg,
            weekly_min_usda_componenent_serving_vegleg:this.guideline.weekly_min_usda_componenent_serving_vegleg,
            weekly_min_usda_componenent_serving_vegred:this.guideline.weekly_min_usda_componenent_serving_vegred,
            weekly_min_usda_componenent_serving_veggrn:this.guideline.weekly_min_usda_componenent_serving_veggrn,
            weekly_min_usda_componenent_serving_vegstar:this.guideline.weekly_min_usda_componenent_serving_vegstar,
            weekly_min_usda_componenent_serving_vegothr:this.guideline.weekly_min_usda_componenent_serving_vegothr,

            weekly_max_usda_componenent_serving_meat:this.guideline.weekly_max_usda_componenent_serving_meat,
            weekly_max_usda_componenent_serving_grain:this.guideline.weekly_max_usda_componenent_serving_grain,
            weekly_max_usda_componenent_serving_fruit:this.guideline.weekly_max_usda_componenent_serving_fruit,
            weekly_max_usda_componenent_serving_milk:this.guideline.weekly_max_usda_componenent_serving_milk,
            weekly_max_usda_componenent_serving_veg:this.guideline.weekly_max_usda_componenent_serving_veg,
            weekly_max_usda_componenent_serving_vegleg:this.guideline.weekly_max_usda_componenent_serving_vegleg,
            weekly_max_usda_componenent_serving_vegred:this.guideline.weekly_max_usda_componenent_serving_vegred,
            weekly_max_usda_componenent_serving_veggrn:this.guideline.weekly_max_usda_componenent_serving_veggrn,
            weekly_max_usda_componenent_serving_vegstar:this.guideline.weekly_max_usda_componenent_serving_vegstar,
            weekly_max_usda_componenent_serving_vegothr:this.guideline.weekly_max_usda_componenent_serving_vegothr,

            weekly_min_nutrition_facts_calories:this.guideline.weekly_min_nutrition_facts_calories,
            weekly_min_nutrition_facts_calfat:this.guideline.weekly_min_nutrition_facts_calfat,
            weekly_min_nutrition_facts_totalfat:this.guideline.weekly_min_nutrition_facts_totalfat,
            weekly_min_nutrition_facts_satfat:this.guideline.weekly_min_nutrition_facts_satfat,
            weekly_min_nutrition_facts_transfat:this.guideline.weekly_min_nutrition_facts_transfat,
            weekly_min_nutrition_facts_polysatfat:this.guideline.weekly_min_nutrition_facts_polysatfat,
            weekly_min_nutrition_facts_monosatfat:this.guideline.weekly_min_nutrition_facts_monosatfat,
            weekly_min_nutrition_facts_cholesterol:this.guideline.weekly_min_nutrition_facts_cholesterol,
            weekly_min_nutrition_facts_sodium:this.guideline.weekly_min_nutrition_facts_sodium,
            weekly_min_nutrition_facts_potassium:this.guideline.weekly_min_nutrition_facts_potassium,
            weekly_min_nutrition_facts_carbs:this.guideline.weekly_min_nutrition_facts_carbs,
            weekly_min_nutrition_facts_fiber:this.guideline.weekly_min_nutrition_facts_fiber,
            weekly_min_nutrition_facts_sugar:this.guideline.weekly_min_nutrition_facts_sugar,
            weekly_min_nutrition_facts_protein:this.guideline.weekly_min_nutrition_facts_protein,
            weekly_min_nutrition_facts_vitamina:this.guideline.weekly_min_nutrition_facts_vitamina,
            weekly_min_nutrition_facts_vitaminb6:this.guideline.weekly_min_nutrition_facts_vitaminb6,
            weekly_min_nutrition_facts_vitaminb12:this.guideline.weekly_min_nutrition_facts_vitaminb12,
            weekly_min_nutrition_facts_vitaminc:this.guideline.weekly_min_nutrition_facts_vitaminc,
            weekly_min_nutrition_facts_vitamind:this.guideline.weekly_min_nutrition_facts_vitamind,
            weekly_min_nutrition_facts_vitamine:this.guideline.weekly_min_nutrition_facts_vitamine,
            weekly_min_nutrition_facts_calcium:this.guideline.weekly_min_nutrition_facts_calcium,
            weekly_min_nutrition_facts_iron:this.guideline.weekly_min_nutrition_facts_iron,
            weekly_min_nutrition_facts_magnesium:this.guideline.weekly_min_nutrition_facts_magnesium,
            weekly_min_nutrition_facts_coblamin:this.guideline.weekly_min_nutrition_facts_coblamin,
            weekly_min_nutrition_facts_thiamin:this.guideline.weekly_min_nutrition_facts_thiamin,
            weekly_min_nutrition_facts_riboflavin:this.guideline.weekly_min_nutrition_facts_riboflavin,
            weekly_min_nutrition_facts_niacin:this.guideline.weekly_min_nutrition_facts_niacin,
            weekly_min_nutrition_facts_zinc:this.guideline.weekly_min_nutrition_facts_zinc,
            weekly_min_nutrition_facts_water:this.guideline.weekly_min_nutrition_facts_water,
            weekly_min_nutrition_facts_ash:this.guideline.weekly_min_nutrition_facts_ash,

            weekly_max_nutrition_facts_calories:this.guideline.weekly_max_nutrition_facts_calories,
            weekly_max_nutrition_facts_calfat:this.guideline.weekly_max_nutrition_facts_calfat,
            weekly_max_nutrition_facts_totalfat:this.guideline.weekly_max_nutrition_facts_totalfat,
            weekly_max_nutrition_facts_satfat:this.guideline.weekly_max_nutrition_facts_satfat,
            weekly_max_nutrition_facts_transfat:this.guideline.weekly_max_nutrition_facts_transfat,
            weekly_max_nutrition_facts_polysatfat:this.guideline.weekly_max_nutrition_facts_polysatfat,
            weekly_max_nutrition_facts_monosatfat:this.guideline.weekly_max_nutrition_facts_monosatfat,
            weekly_max_nutrition_facts_cholesterol:this.guideline.weekly_max_nutrition_facts_cholesterol,
            weekly_max_nutrition_facts_sodium:this.guideline.weekly_max_nutrition_facts_sodium,
            weekly_max_nutrition_facts_potassium:this.guideline.weekly_max_nutrition_facts_potassium,
            weekly_max_nutrition_facts_carbs:this.guideline.weekly_max_nutrition_facts_carbs,
            weekly_max_nutrition_facts_fiber:this.guideline.weekly_max_nutrition_facts_fiber,
            weekly_max_nutrition_facts_sugar:this.guideline.weekly_max_nutrition_facts_sugar,
            weekly_max_nutrition_facts_protein:this.guideline.weekly_max_nutrition_facts_protein,
            weekly_max_nutrition_facts_vitamina:this.guideline.weekly_max_nutrition_facts_vitamina,
            weekly_max_nutrition_facts_vitaminb6:this.guideline.weekly_max_nutrition_facts_vitaminb6,
            weekly_max_nutrition_facts_vitaminb12:this.guideline.weekly_max_nutrition_facts_vitaminb12,
            weekly_max_nutrition_facts_vitaminc:this.guideline.weekly_max_nutrition_facts_vitaminc,
            weekly_max_nutrition_facts_vitamind:this.guideline.weekly_max_nutrition_facts_vitamind,
            weekly_max_nutrition_facts_vitamine:this.guideline.weekly_max_nutrition_facts_vitamine,
            weekly_max_nutrition_facts_calcium:this.guideline.weekly_max_nutrition_facts_calcium,
            weekly_max_nutrition_facts_iron:this.guideline.weekly_max_nutrition_facts_iron,
            weekly_max_nutrition_facts_magnesium:this.guideline.weekly_max_nutrition_facts_magnesium,
            weekly_max_nutrition_facts_coblamin:this.guideline.weekly_max_nutrition_facts_coblamin,
            weekly_max_nutrition_facts_thiamin:this.guideline.weekly_max_nutrition_facts_thiamin,
            weekly_max_nutrition_facts_riboflavin:this.guideline.weekly_max_nutrition_facts_riboflavin,
            weekly_max_nutrition_facts_niacin:this.guideline.weekly_max_nutrition_facts_niacin,
            weekly_max_nutrition_facts_zinc:this.guideline.weekly_max_nutrition_facts_zinc,
            weekly_max_nutrition_facts_water:this.guideline.weekly_max_nutrition_facts_water,
            weekly_max_nutrition_facts_ash:this.guideline.weekly_max_nutrition_facts_ash,


            daily_min_usda_componenent_serving_meat:this.guideline.daily_min_usda_componenent_serving_meat,
            daily_min_usda_componenent_serving_grain:this.guideline.daily_min_usda_componenent_serving_grain,
            daily_min_usda_componenent_serving_fruit:this.guideline.daily_min_usda_componenent_serving_fruit,
            daily_min_usda_componenent_serving_milk:this.guideline.daily_min_usda_componenent_serving_milk,
            daily_min_usda_componenent_serving_veg:this.guideline.daily_min_usda_componenent_serving_veg,
            daily_min_usda_componenent_serving_vegleg:this.guideline.daily_min_usda_componenent_serving_vegleg,
            daily_min_usda_componenent_serving_vegred:this.guideline.daily_min_usda_componenent_serving_vegred,
            daily_min_usda_componenent_serving_veggrn:this.guideline.daily_min_usda_componenent_serving_veggrn,
            daily_min_usda_componenent_serving_vegstar:this.guideline.daily_min_usda_componenent_serving_vegstar,
            daily_min_usda_componenent_serving_vegothr:this.guideline.daily_min_usda_componenent_serving_vegothr,

            daily_max_usda_componenent_serving_meat:this.guideline.daily_max_usda_componenent_serving_meat,
            daily_max_usda_componenent_serving_grain:this.guideline.daily_max_usda_componenent_serving_grain,
            daily_max_usda_componenent_serving_fruit:this.guideline.daily_max_usda_componenent_serving_fruit,
            daily_max_usda_componenent_serving_milk:this.guideline.daily_max_usda_componenent_serving_milk,
            daily_max_usda_componenent_serving_veg:this.guideline.daily_max_usda_componenent_serving_veg,
            daily_max_usda_componenent_serving_vegleg:this.guideline.daily_max_usda_componenent_serving_vegleg,
            daily_max_usda_componenent_serving_vegred:this.guideline.daily_max_usda_componenent_serving_vegred,
            daily_max_usda_componenent_serving_veggrn:this.guideline.daily_max_usda_componenent_serving_veggrn,
            daily_max_usda_componenent_serving_vegstar:this.guideline.daily_max_usda_componenent_serving_vegstar,
            daily_max_usda_componenent_serving_vegothr:this.guideline.daily_max_usda_componenent_serving_vegothr,

            daily_min_nutrition_facts_calories:this.guideline.daily_min_nutrition_facts_calories,
            daily_min_nutrition_facts_calfat:this.guideline.daily_min_nutrition_facts_calfat,
            daily_min_nutrition_facts_totalfat:this.guideline.daily_min_nutrition_facts_totalfat,
            daily_min_nutrition_facts_satfat:this.guideline.daily_min_nutrition_facts_satfat,
            daily_min_nutrition_facts_transfat:this.guideline.daily_min_nutrition_facts_transfat,
            daily_min_nutrition_facts_polysatfat:this.guideline.daily_min_nutrition_facts_polysatfat,
            daily_min_nutrition_facts_monosatfat:this.guideline.daily_min_nutrition_facts_monosatfat,
            daily_min_nutrition_facts_cholesterol:this.guideline.daily_min_nutrition_facts_cholesterol,
            daily_min_nutrition_facts_sodium:this.guideline.daily_min_nutrition_facts_sodium,
            daily_min_nutrition_facts_potassium:this.guideline.daily_min_nutrition_facts_potassium,
            daily_min_nutrition_facts_carbs:this.guideline.daily_min_nutrition_facts_carbs,
            daily_min_nutrition_facts_fiber:this.guideline.daily_min_nutrition_facts_fiber,
            daily_min_nutrition_facts_sugar:this.guideline.daily_min_nutrition_facts_sugar,
            daily_min_nutrition_facts_protein:this.guideline.daily_min_nutrition_facts_protein,
            daily_min_nutrition_facts_vitamina:this.guideline.daily_min_nutrition_facts_vitamina,
            daily_min_nutrition_facts_vitaminb6:this.guideline.daily_min_nutrition_facts_vitaminb6,
            daily_min_nutrition_facts_vitaminb12:this.guideline.daily_min_nutrition_facts_vitaminb12,
            daily_min_nutrition_facts_vitaminc:this.guideline.daily_min_nutrition_facts_vitaminc,
            daily_min_nutrition_facts_vitamind:this.guideline.daily_min_nutrition_facts_vitamind,
            daily_min_nutrition_facts_vitamine:this.guideline.daily_min_nutrition_facts_vitamine,
            daily_min_nutrition_facts_calcium:this.guideline.daily_min_nutrition_facts_calcium,
            daily_min_nutrition_facts_iron:this.guideline.daily_min_nutrition_facts_iron,
            daily_min_nutrition_facts_magnesium:this.guideline.daily_min_nutrition_facts_magnesium,
            daily_min_nutrition_facts_coblamin:this.guideline.daily_min_nutrition_facts_coblamin,
            daily_min_nutrition_facts_thiamin:this.guideline.daily_min_nutrition_facts_thiamin,
            daily_min_nutrition_facts_riboflavin:this.guideline.daily_min_nutrition_facts_riboflavin,
            daily_min_nutrition_facts_niacin:this.guideline.daily_min_nutrition_facts_niacin,
            daily_min_nutrition_facts_zinc:this.guideline.daily_min_nutrition_facts_zinc,
            daily_min_nutrition_facts_water:this.guideline.daily_min_nutrition_facts_water,
            daily_min_nutrition_facts_ash:this.guideline.daily_min_nutrition_facts_ash,

            daily_max_nutrition_facts_calories:this.guideline.daily_max_nutrition_facts_calories,
            daily_max_nutrition_facts_calfat:this.guideline.daily_max_nutrition_facts_calfat,
            daily_max_nutrition_facts_totalfat:this.guideline.daily_max_nutrition_facts_totalfat,
            daily_max_nutrition_facts_satfat:this.guideline.daily_max_nutrition_facts_satfat,
            daily_max_nutrition_facts_transfat:this.guideline.daily_max_nutrition_facts_transfat,
            daily_max_nutrition_facts_polysatfat:this.guideline.daily_max_nutrition_facts_polysatfat,
            daily_max_nutrition_facts_monosatfat:this.guideline.daily_max_nutrition_facts_monosatfat,
            daily_max_nutrition_facts_cholesterol:this.guideline.daily_max_nutrition_facts_cholesterol,
            daily_max_nutrition_facts_sodium:this.guideline.daily_max_nutrition_facts_sodium,
            daily_max_nutrition_facts_potassium:this.guideline.daily_max_nutrition_facts_potassium,
            daily_max_nutrition_facts_carbs:this.guideline.daily_max_nutrition_facts_carbs,
            daily_max_nutrition_facts_fiber:this.guideline.daily_max_nutrition_facts_fiber,
            daily_max_nutrition_facts_sugar:this.guideline.daily_max_nutrition_facts_sugar,
            daily_max_nutrition_facts_protein:this.guideline.daily_max_nutrition_facts_protein,
            daily_max_nutrition_facts_vitamina:this.guideline.daily_max_nutrition_facts_vitamina,
            daily_max_nutrition_facts_vitaminb6:this.guideline.daily_max_nutrition_facts_vitaminb6,
            daily_max_nutrition_facts_vitaminb12:this.guideline.daily_max_nutrition_facts_vitaminb12,
            daily_max_nutrition_facts_vitaminc:this.guideline.daily_max_nutrition_facts_vitaminc,
            daily_max_nutrition_facts_vitamind:this.guideline.daily_max_nutrition_facts_vitamind,
            daily_max_nutrition_facts_vitamine:this.guideline.daily_max_nutrition_facts_vitamine,
            daily_max_nutrition_facts_calcium:this.guideline.daily_max_nutrition_facts_calcium,
            daily_max_nutrition_facts_iron:this.guideline.daily_max_nutrition_facts_iron,
            daily_max_nutrition_facts_magnesium:this.guideline.daily_max_nutrition_facts_magnesium,
            daily_max_nutrition_facts_coblamin:this.guideline.daily_max_nutrition_facts_coblamin,
            daily_max_nutrition_facts_thiamin:this.guideline.daily_max_nutrition_facts_thiamin,
            daily_max_nutrition_facts_riboflavin:this.guideline.daily_max_nutrition_facts_riboflavin,
            daily_max_nutrition_facts_niacin:this.guideline.daily_max_nutrition_facts_niacin,
            daily_max_nutrition_facts_zinc:this.guideline.daily_max_nutrition_facts_zinc,
            daily_max_nutrition_facts_water:this.guideline.daily_max_nutrition_facts_water,
            daily_max_nutrition_facts_ash:this.guideline.daily_max_nutrition_facts_ash,
        })

      }
    },

    methods:{


      guideline_edit_save_script(){
        this.form.post(this.route('edit-guideline-save', this.guideline.id), {
          onSuccess: () => { 
            this.$toast.success('Guideline updated successfully!');
          },
        });
      }
    },

  };
</script>
<style>
.min-height-third{
 min-height: 400px; 
}

.sm\:text-sm {
  font-size: 0.850rem;
  line-height: 1.25rem;
}

.w-52-rec {
  width: 13.2rem;
}

.input-background{
  background-color: #f8f8f8;
}

.button-bg-color-wed-menu2-gray{
  border: none!important;
  min-height: 35px;
  min-width: 35px;
}

.menu1-background-color{
  background-color:#FAA43D;
}

.button-bg-color-wed-menu2{
  background-color: #38558e;
  border: none!important;
  min-height: 35px;
  min-width: 35px;
}
.menu1-icon-color{
  color: #38558e;
}

.id-color-menu-edit{
  color: #F7A53A;
}

.bg-button-color{
  background-color: #cb0000;
}

.min-w-min-button{
  min-height: 26px;
  min-width: 53px;

}

.w-150{
  width: 150px;
}

.max-w-0-menu1{
  max-width: 4rem;
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

.font-size-edit {
  font-size: 10.5px;
}
.w-96-edit-recipes{
  width: 35rem;
}

.select-menu-height-edit2 {
  height: 2.8rem;
}

.validation_error_msg {
  font-weight: 400;
  margin: 6px 0 0 !important;
  color: red;
}


@media screen and (min-width: 1500px) {
  .id_arrow .fa-sort-desc:before {
    content: "\f0dd";
    position: absolute;
    top: 16px;
    left: 43px;
    padding-left:7px;
    color: #219FD5;
  }

  .id_arrow .fa-sort-asc:before {
    content: "\f0de";
    color: #219FD5;
    padding-left:7px;
    position: absolute;
    top: 16px;
    left: 43px;
  }
}

@media screen and (max-width: 1499px){
  .id_arrow .fa-sort-asc:before {
    content: "\f0de";
    color: #219FD5;
    padding-left: 7px;
    position: absolute;
    top: 28px;
    left: 43px;
  }

  .id_arrow .fa-sort-desc:before {
    content: "\f0dd";
    position: absolute;
    top: 28px;
    left: 43px;
    padding-left: 7px;
    color: #219FD5;
  }
}

@media (min-width: 1280px) {
    .xl\:w-1\/1 {
        width: 10%;
    }
}
</style>
