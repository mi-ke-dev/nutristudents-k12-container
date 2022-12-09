<template>
  <Head>
  <title>Add New Product | NutriStudents K-12</title>
  <meta name="description" content="Add New Product">
  </Head>
  <default-layout>

    <BreadcrumLayout>
      <div class="flex">
        <!-- <a href="#" class="link-color"> --><U>Templates</U><!-- </a> -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
            clip-rule="evenodd" />
        </svg>
        <inertia-link :href="route('products')" class="link-color"><U>Products</U></inertia-link>
      </div>
    </BreadcrumLayout>


    <form action="#" @submit.prevent="false">

      <PageTitleLayout>
        <div class="lg:mb-0 mb-4 md:w-4/6">
          <h1 class="heading-color  2xl:text-2xl text-xl font-bold">Add New Product</h1>
        </div>
        <div class="w-full flex lg:flex-nowrap flex-wrap md:justify-end items-center">

          <button type="button"
            >
            <inertia-link :href="route('products')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
          </button>

          <button type="button" @click="product_add_save_script"
            class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3 sm:mt-0">
            Save
          </button>





        </div>
      </PageTitleLayout>


      <PageTitleLayout>
        <div class="lg:mb-0 mb-4 w-full md:mt-0 mt-6">
          <h1 class="text-base text-gray-500 font-bold" id="response_msg"></h1>
        </div>
      </PageTitleLayout>



      <PageTitleLayout>
        <div
          class="md:flex block justify-between shadow py-8 mt-4 align-middle inline-block min-w-full bg-white rounded-t-lg xl:divide-x-2 divide-gray-300 border-b-4 border-gray-300 w-full overflow-x-auto">
          <div class="w-6/12">

            <div class="xl:flex block  xl:items-center xl:justify-evenly xl:pl-0 lg:pl-12 md:pl-12 pl-6">
              <label class="font-bold text-gray-700 2xl:text-lg text-base">Product Name*</label>
              <div>
                <input type="text" id="pname" name="pname" v-model="form.pname"
                  class="2xl:text-base text-base text-gray-400 xl:mt-0 mt-4 sm:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">
                <div v-if="form.errors.pname" class="validation_error_msg">{{ form.errors.pname }}</div>
              </div>
            </div>

             

            <div class="xl:flex block  xl:items-center xl:justify-evenly xl:pl-0 lg:pl-12 md:pl-12 pl-6 pt-10">
              <label class="font-bold text-gray-700 2xl:text-lg text-base">Distributor</label>

              <div class="relative focus:outline-none sm:w-80 w-60 xl:pl-4 pl-0 xl:mt-0 mt-4">
                <select id="distributor_id_val" name="distributor_id_val" autocomplete="distributor_id_val"
                  v-model="form.distributor_id_val"
                  class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height 2xl:text-base text-base text-gray-400">
                  <option value="">Distributor</option>
                  <option v-for="distributor in distributors" :value="distributor.id">{{distributor.name}}</option>
                </select>
                <div
                  class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>
                </div>
              </div>
            </div>

            <div class="xl:flex block  xl:items-center xl:justify-evenly xl:pl-0 lg:pl-24 md:pl-12 pl-6 pt-10">
              <label class="font-bold text-gray-700 2xl:text-lg text-base">GTIN Number</label>        
              <input type="text" id="pgtin" name="pgtin" v-model="form.pgtin"
                  class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">
              
            </div>


          </div>


          <div class="sm:w-6/12 w-52 sm:mr-0 mr-4">
            <div class="xl:flex block  xl:items-center xl:justify-evenly xl:pl-0 lg:pl-24 md:pl-12 pl-6 md:pt-0 pt-10">
              <label class="font-bold text-gray-700 2xl:text-lg text-base">Manufacturer*</label>
              <div>
                <input type="text" id="pmanufacturer" name="pmanufacturer" v-model="form.pmanufacturer"
                  class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">
                <div v-if="form.errors.pmanufacturer" class="validation_error_msg">{{ form.errors.pmanufacturer }}</div>
              </div>
            </div>

            <div class="xl:flex block  xl:items-center xl:justify-evenly xl:pl-0 lg:pl-24 md:pl-12 pl-6 pt-10">
              <label class="font-bold text-gray-700 2xl:text-lg text-base">Manufacturer #*</label>
              <div>
                <input type="text" id="pmanufacturer_sku" name="pmanufacturer_sku" v-model="form.pmanufacturer_sku"
                  class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">
                <div v-if="form.errors.pmanufacturer_sku" class="validation_error_msg">{{ form.errors.pmanufacturer_sku
                  }}</div>
              </div>
            </div>            


          </div>
        </div>

      </PageTitleLayout>

      <header
        class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg sm:mx-10 mx-6 mt-10">
        <h2 class="text-white text-lg font-bold w-11/12">Product Categories</h2>

      </header>

      <div class="flex flex-col mb-6 mx-10">
        <div class="overflow-x-auto">
          <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
              <table class="min-w-full">
                <thead class="header-bg-color">
                  <tr>
                    <th colspan="3" scope="col"
                      class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                      Primary*
                    </th>
                    <th colspan="4" scope="col"
                      class="px-20  py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                      Secondary
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Oddd row -->
                  <tr class="bg-white align-top">
                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-base font-bold">
                      <div class="space-x-4">
                        <div class="relative focus:outline-none lg:w-52 w-40  inline-block align-top">
                          <select id="primary_cat_val" name="primary_cat_val" autocomplete="primary_cat_val"
                            v-model="form.primary_cat_val"
                            class="text-gray-400 text-base shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height"
                            @change="onCategoryChangefunc">
                            <option value="">Category</option>
                            <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                          </select>
                          <div
                            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                          </div>
                          <div v-show="form.errors.primary_cat_val" class="validation_error_msg">{{
                            form.errors.primary_cat_val}}</div>
                        </div>
                        <div class="relative focus:outline-none lg:w-52 w-40  inline-block align-top">
                          <select id="primary_subcat_val" name="primary_subcat_val" autocomplete="primary_subcat_val"
                            v-model="form.primary_subcat_val"
                            class="text-gray-400 text-base shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height">
                            <option value="">Sub Category</option>
                            <option v-for="subcat_val in subcat_vals" :value="subcat_val.id">{{subcat_val.name}}
                            </option>
                          </select>
                          <div
                            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                          </div>
                          <div v-show="form.errors.primary_subcat_val" class="validation_error_msg">{{
                            form.errors.primary_subcat_val}}</div>
                        </div>
                      </div>
                    </td>
                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color"></td>
                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-base font-bold">
                      <div class="flex items-center">
                        <div class="w-full space-y-2">
                          <div v-for="(cat_counter,index) in sec_cat_counters" class="space-x-4 w-full pr-2">
                            <div class="relative focus:outline-none lg:w-52 w-40  inline-block">
                              <select id="secondary_cat_val" name="secondary_cat_val" autocomplete="secondary_cat_val"
                                class="text-gray-400 text-base shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height"
                                @change="onSecondaryCategoryChangefunc(index, $event)" v-model="sec_cat_vals[index]">
                                <option value="undefined">Category</option>
                                <option v-for="category in categories" :value="category.id">{{category.name}}</option>
                              </select>
                              <div
                                class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                                <i class="fa fa-sort-desc" aria-hidden="true"></i>
                              </div>
                            </div>
                            <div class="relative focus:outline-none lg:w-52 w-40  inline-block">
                              <select id="sec_subcat_select" name="sec_subcat_select" autocomplete="sec_subcat_select"
                                class="text-gray-400 text-base shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height"
                                v-model="secondary_subcats[index]">
                                <option value="undefined">Sub Category</option>
                                <option v-for="subcat_val in sec_subcat_vals[index]" :value="subcat_val.id">
                                  {{subcat_val.name}}</option>
                              </select>
                              <div
                                class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                                <i class="fa fa-sort-desc" aria-hidden="true"></i>
                              </div>
                            </div>
                            <i v-if="index > 0" class="fa fa-minus-circle plus-font-size products-edit-minus-color cursor-pointer"
                              aria-hidden="true" @click="onSecondaryCatRemoveFieldRow(index)"></i>
                          </div>
                        </div>
                        <i class="fa fa-plus-circle plus-font-size products-edit-minus-color cursor-pointer" aria-hidden="true"
                          @click="onSecondaryCatAddFieldRow"></i>
                      </div>
                    </td>
                  </tr>
                  <!-- <tr class="bg-white" colspan="6">
                    <td colspan="6" class="px-6 pb-4 whitespace-nowrap text-base font-bold"></td>
                    <td class="md:pl-60 pl-44 pb-4 whitespace-nowrap text-base font-bold">

                    </td>
                  </tr> -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>



      <header
        class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg sm:mx-10 mx-6 mt-10">
        <h2 class="text-white text-lg font-bold w-11/12">Products Tags</h2>

      </header>

      <div class="flex flex-col mb-6 mx-10">
        <div class="overflow-x-auto">
          <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
              <table class="min-w-full">
                <thead class="header-bg-color">
                  <tr>
                    <th colspan="3" scope="col"
                      class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                      Create New Tag
                    </th>
                    <th colspan="5" scope="col"
                      class="px-14  py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                      Current Tags
                    </th>


                  </tr>
                </thead>
                <tbody>
                  <!-- Oddd row -->
                  <tr class="bg-white">
                    <td colspan="3" class="px-6 py-4 whitespace-nowrap text-base font-bold space-x-4">


                      <input type="text" v-model="product_tags_add"
                        class="2xl:text-base text-base text-gray-400 xl:mt-0 mt-4 w-96 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-xl select-menu-height input-background inline-block">

                      <i class="fa fa-plus-circle plus-font-size products-edit-minus-color inline-block"
                        aria-hidden="true" @click="onTagAdditionfunc"></i>







                    </td>


                    <td class="py-4 whitespace-nowrap text-base font-bold uppercase">

                      <div class="flex flex-wrap">
                        <div v-for="(product_tag,index) in form.product_tags_val" class="mb-4 mr-2">
                          <i class="current_tag fa fa-minus-circle plus-font-size products-edit-minus-color inline-block"
                            aria-hidden="true" @click="onTagRemovefunc(index)"></i>
                          <input type="text" :value="product_tag"
                            class="pl-10 uppercase 2xl:text-base text-base text-gray-400 xl:mt-0 mt-4 w-30 text-center shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-xl select-menu-height input-background inline-block">
                        </div>
                      </div>

                    </td>



                  </tr>





                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>




      <header
        class="mx-8 searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg mt-8">
        <h2 class="text-white text-lg font-bold w-11/12">Case Information</h2>


      </header>
      <div class="mx-8 flex flex-col mb-6">
        <div class="overflow-x-auto">
          <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col"
                      class=" px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                      case weight
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                      sub case weight
                    </th>
                    <th scope="col"
                      class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                      case volume
                    </th>

                    <th scope="col"
                      class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                      sub case volume
                    </th>



                    <th scope="col"
                      class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                      case qty
                    </th>

                    <th scope="col"
                      class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                      sub case qty
                    </th>

                    <th scope="col"
                      class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                      yield (%)
                    </th>


                  </tr>
                </thead>
                <tbody>
                  <!-- Odd row -->
                  <tr class="bg-white">




                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center  justify-center">
                      <div class="flex">
                        <input type="number" min="0" step='0.01' id="case_weight" name="case_weight" v-model="form.case_weight"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <div class="relative focus:outline-none W-44">
                          <select id="case_mass_uom" name="case_mass_uom" autocomplete="case_mass_uom"
                            v-model="form.case_mass_uom"
                            class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-24 select-menu-height">
                            <option v-for="(mass_measurement,index) in mass_measurements" :value="mass_measurement.id">
                              {{mass_measurement.name}}</option>
                          </select>
                          <div
                            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center  justify-center">
                      <div class="flex">
                        <input type="number" min="0" step='0.01' id="sub_case_weight" name="sub_case_weight"
                          v-model="form.sub_case_weight"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <div class="relative focus:outline-none W-44">
                          <select id="subcase_mass_uom" name="subcase_mass_uom" autocomplete="subcase_mass_uom"
                            v-model="form.subcase_mass_uom"
                            class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-24 select-menu-height">
                            <option v-for="mass_measurement in mass_measurements" :value="mass_measurement.id">
                              {{mass_measurement.name}}</option>
                          </select>
                          <div
                            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center  justify-center">
                      <div class="flex">
                        <input type="number" min="0" step='0.01' id="case_volume" name="case_volume" v-model="form.case_volume"
                          class="shadow-sm focus:outline-none block w-14 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <div class="relative focus:outline-none W-44">
                          <select id="case_vol_uom" name="case_vol_uom" autocomplete="case_vol_uom"
                            v-model="form.case_vol_uom"
                            class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-24 select-menu-height">
                            <option v-for="volume_measurement in volume_measurements" :value="volume_measurement.id">
                              {{volume_measurement.name}}</option>
                          </select>
                          <div
                            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </td>

                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center  justify-center">
                      <div class="flex">
                        <input type="number" min="0" step='0.01' id="sub_case_volume" name="sub_case_volume"
                          v-model="form.sub_case_volume"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <div class="relative focus:outline-none W-44">
                          <select id="case_vol_sub_uom" name="case_vol_sub_uom" autocomplete="case_vol_sub_uom"
                            v-model="form.case_vol_sub_uom"
                            class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-24 select-menu-height">
                            <option v-for="volume_measurement in volume_measurements" :value="volume_measurement.id">
                              {{volume_measurement.name}}</option>
                          </select>
                          <div
                            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </td>


                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center  justify-center">

                      <input type="number" min="0" id="case_qty" name="case_qty" v-model="form.case_qty"
                        class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">

                    </td>

                    <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center  justify-center">

                      <input type="number" min="0" id="sub_case_qty" name="sub_case_qty" v-model="form.sub_case_qty"
                        class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">

                    </td>


                  <td class="px-6 py-3 whitespace-nowrap text-sm text-gray-500 text-center  justify-center">          
                   <input type="number" min="0" max="100" placeholder="100" id="pyield" name="pyield" v-model="form.pyield" class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">            
                  </td>


                  </tr>

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>



      <h3 class="searching-background-color py-2 rounded-md rounded-b-none text-white font-bold text-lg pl-6 mx-6">
        Measurement Information (1 Serving)</h3>
      <div class="flex flex-col mb-6 px-6">
        <div class="overflow-x-auto">
          <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      WEIGHT
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      VOLUME
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      UNIT
                    </th>
                    <th scope="col" class="px-3 py-3 text-center text-sm font-bold text-gray-600 uppercase">
                      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    </th>
                    <th scope="col" class="px-3 py-3 text-center text-sm font-bold text-gray-600 uppercase">
                      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    </th>
                    <th scope="col" class="px-3 py-3 text-center text-sm font-bold text-gray-600 uppercase">
                      &nbsp; &nbsp;&nbsp; &nbsp;
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Odd row -->
                  <tr class="bg-white">
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      <div class="flex">
                        <input type="number" min="0" step="0.01" id="mass_measurements" name="mass_measurements"
                          v-model="form.mass_measurements"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <div class="relative focus:outline-none W-44">
                          <select id="mass_measurements_uom" name="mass_measurements_uom"
                            autocomplete="mass_measurements_uom" v-model="form.mass_measurements_uom"
                            class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-28 select-menu-height">
                            <option v-for="mass_measurement in mass_measurements" :value="mass_measurement.id">
                              {{mass_measurement.name}}</option>
                          </select>
                          <div
                            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </th>
                    <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500">
                      <div class="flex">
                        <input type="number" min="0" step="0.01" id="volume_measurement" name="volume_measurement"
                          v-model="form.volume_measurement"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <div class="relative focus:outline-none W-44">
                          <select id="volume_measurement_uom" name="volume_measurement_uom"
                            autocomplete="volume_measurement_uom" v-model="form.volume_measurement_uom"
                            class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-28 select-menu-height">
                            <option v-for="volume_measurement in volume_measurements" :value="volume_measurement.id">
                              {{volume_measurement.name}}</option>
                          </select>
                          <div
                            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500">
                      <div class="flex">
                        <input type="number" min="0" step="0.01" id="unit_measurement" name="unit_measurement"
                          v-model="form.unit_measurement"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <div class="relative focus:outline-none W-44">
                          <select id="unit_measurement_uom" name="unit_measurement_uom"
                            autocomplete="unit_measurement_uom" v-model="form.unit_measurement_uom"
                            class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-28 select-menu-height">
                            <option v-for="unit_measurement in unit_measurements" :value="unit_measurement.id">
                              {{unit_measurement.name}}</option>
                          </select>
                          <div
                            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    </td>
                    <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-center flex justify-center">
                      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    </td>
                    <td class="px-3 py-3 whitespace-nowrap text-center">
                      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


      <header
        class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg mx-6 mt-8">
        <h2 class="text-white text-lg font-bold w-11/12">USDA Component Information (1 Serving) </h2>

      </header>

      <div class="flex flex-col mb-6 mx-6">
        <div class="overflow-x-auto">
          <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
              <table class="min-w-full shadow rounded-t-lg overflow-hidden table-background">
                <thead>
                  <tr class="">
                    <th scope="col" class="px-3 py-2 text-left text-sm font-white text-black uppercase tracking-wider">
                      meat
                    </th>
                    <th scope="col" class="px-3 py-2 text-left text-sm font-white text-black uppercase tracking-wider">
                      grain
                    </th>
                    <th scope="col" class="px-3 py-2 text-left text-sm font-white text-black uppercase tracking-wider">
                      fruit
                    </th>
                    <th scope="col" class="px-3 py-2 text-left text-sm font-white text-black uppercase tracking-wider">
                      milk
                    </th>
                    <th scope="col" class="px-3 py-2 text-left text-sm font-white text-black uppercase tracking-wider">
                      veg
                    </th>
                    <th scope="col" class="px-3 py-2 text-left text-sm font-white text-black uppercase tracking-wider">
                      veg/leg
                    </th>
                    <th scope="col" class="px-3 py-2 text-left text-sm font-white text-black uppercase tracking-wider">
                      veg/red
                    </th>
                    <th scope="col" class="px-3 py-2 text-left text-sm font-white text-black uppercase tracking-wider">
                      veg/grn
                    </th>
                    <th scope="col" class="px-3 py-2 text-left text-sm font-white text-black uppercase tracking-wider">
                      veg/star
                    </th>
                    <th scope="col" class="px-3 py-2 text-left text-sm font-white text-black uppercase tracking-wider">
                      veg/othr
                    </th>



                  </tr>
                </thead>
                <tbody>
                  <!-- Odd row -->
                  <tr class="bg-white">
                    <td scope="col"
                      class="px-3 py-2 text-center text-sm font-white text-gray-400 uppercase tracking-wider">
                      <input type="number" min="0" id="usda_componenent_serving_meat"
                        name="usda_componenent_serving_meat" v-model="form.usda_componenent_serving_meat"
                        class="shadow-sm focus:outline-none block w-20 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </td>
                    <td scope="col"
                      class="px-3 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider">
                      <input type="number" min="0" id="usda_componenent_serving_grain"
                        name="usda_componenent_serving_grain" v-model="form.usda_componenent_serving_grain"
                        class="shadow-sm focus:outline-none block w-20 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </td>
                    <td scope="col"
                      class="px-3 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider">
                      <input type="number" min="0" id="usda_componenent_serving_fruit"
                        name="usda_componenent_serving_fruit" v-model="form.usda_componenent_serving_fruit"
                        class="shadow-sm focus:outline-none block w-20 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </td>
                    <td scope="col"
                      class="px-3 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider">
                      <input type="number" min="0" id="usda_componenent_serving_milk"
                        name="usda_componenent_serving_milk" v-model="form.usda_componenent_serving_milk"
                        class="shadow-sm focus:outline-none block w-20 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </td>
                    <td scope="col"
                      class="px-3 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider">
                      <input type="number" min="0" id="usda_componenent_serving_veg" name="usda_componenent_serving_veg"
                        v-model="form.usda_componenent_serving_veg"
                        class="shadow-sm focus:outline-none block w-20 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </td>
                    <td scope="col"
                      class="px-3 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider">
                      <input type="number" min="0" id="usda_componenent_serving_vegleg"
                        name="usda_componenent_serving_vegleg" v-model="form.usda_componenent_serving_vegleg"
                        class="shadow-sm focus:outline-none block w-20 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </td>
                    <td scope="col"
                      class="px-3 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider">
                      <input type="number" min="0" id="usda_componenent_serving_vegred"
                        name="usda_componenent_serving_vegred" v-model="form.usda_componenent_serving_vegred"
                        class="shadow-sm focus:outline-none block w-20 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </td>
                    <td scope="col"
                      class="px-3 py-2 text-left text-sm font-white text-gray-400 uppercase tracking-wider">
                      <input type="number" min="0" id="usda_componenent_serving_veggrn"
                        name="usda_componenent_serving_veggrn" v-model="form.usda_componenent_serving_veggrn"
                        class="shadow-sm focus:outline-none block w-20 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </td>
                    <td scope="col"
                      class="px-3 py-2 text-left text-sm font-white ttext-gray-400 uppercase tracking-wider">
                      <input type="number" min="0" id="usda_componenent_serving_vegstar"
                        name="usda_componenent_serving_vegstar" v-model="form.usda_componenent_serving_vegstar"
                        class="shadow-sm focus:outline-none block w-20 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </td>
                    <td scope="col"
                      class="px-3 py-2 text-left  text-sm font-white text-gray-400 uppercase tracking-wider">
                      <input type="number" min="0" id="usda_componenent_serving_vegothr"
                        name="usda_componenent_serving_vegothr" v-model="form.usda_componenent_serving_vegothr"
                        class="shadow-sm focus:outline-none block w-20 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center">
                    </td>

                  </tr>
                </tbody>

              </table>
            </div>
          </div>
        </div>
      </div>




      <h3 class="searching-background-color py-2 rounded-md rounded-b-none text-white font-bold text-lg pl-6 mx-6">
        Nutrition Facts</h3>
      <div class="flex flex-col mb-6 px-6">
        <div class="overflow-x-auto">
          <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      WEIGHT
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      VOLUME
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      UNIT
                    </th>
                    <th scope="col" class="px-3 py-3 text-center text-sm font-bold text-gray-600 uppercase">
                      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    </th>
                    <th scope="col" class="px-3 py-3 text-center text-sm font-bold text-gray-600 uppercase">
                      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    </th>
                    <th scope="col" class="px-3 py-3 text-center text-sm font-bold text-gray-600 uppercase">
                      &nbsp; &nbsp;&nbsp; &nbsp;
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Odd row -->
                  <tr class="bg-white">
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      <div class="flex">
                        <input type="number" min="0" step="0.01" id="nutrition_facts_weight" name="nutrition_facts_weight"
                          v-model="form.nutrition_facts_weight"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <div class="relative focus:outline-none W-44">
                          <select id="nutrition_mass_measurement" name="nutrition_mass_measurement"
                            autocomplete="nutrition_mass_measurement" v-model="form.nutrition_mass_measurement"
                            class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-28 select-menu-height">
                            <option v-for="mass_measurement in mass_measurements" :value="mass_measurement.id">
                              {{mass_measurement.name}}</option>
                          </select>
                          <div
                            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </th>
                    <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500">
                      <div class="flex">
                        <input type="number" min="0" step="0.01" id="nutrition_facts_volume" name="nutrition_facts_volume"
                          v-model="form.nutrition_facts_volume"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <div class="relative focus:outline-none W-44">
                          <select id="nutrition_vol_measurement" name="nutrition_vol_measurement"
                            autocomplete="nutrition_vol_measurement" v-model="form.nutrition_vol_measurement"
                            class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-28 select-menu-height">
                            <option v-for="volume_measurement in volume_measurements" :value="volume_measurement.id">
                              {{volume_measurement.name}}</option>
                          </select>
                          <div
                            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500">
                      <div class="flex">
                        <input type="number" min="0" step="0.01" id="nutrition_facts_unit" name="nutrition_facts_unit"
                          v-model="form.nutrition_facts_unit"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <div class="relative focus:outline-none W-44">
                          <select id="nutrition_unit_measurement" name="nutrition_unit_measurement"
                            autocomplete="nutrition_unit_measurement" v-model="form.nutrition_unit_measurement"
                            class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-28 select-menu-height">
                            <option v-for="unit_measurement in unit_measurements" :value="unit_measurement.id">
                              {{unit_measurement.name}}</option>
                          </select>
                          <div
                            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                          </div>
                        </div>
                      </div>
                    </td>
                    <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    </td>
                    <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-center flex justify-center">
                      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    </td>
                    <td class="px-3 py-3 whitespace-nowrap text-center">
                      &nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;
                    </td>
                  </tr>
                </tbody>
              </table>
              <!---------------even row-------->
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      calories
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      cal/fat
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      total fat
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      sat fat
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      trans fat
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      polysat fat
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      monosat fat
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      cholesterol
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      sodium
                    </th>
                  </tr>
                </thead>

                <tbody>

                  <!-- Odd row -->
                  <tr class="bg-white">
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600 ">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_calories" name="nutrition_facts_calories"
                          v-model="form.nutrition_facts_calories"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">cals</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600 ">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_calfat" name="nutrition_facts_calfat"
                          v-model="form.nutrition_facts_calfat"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-gray-400">cals</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_totalfat" name="nutrition_facts_totalfat"
                          v-model="form.nutrition_facts_totalfat"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">g</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_satfat" name="nutrition_facts_satfat"
                          v-model="form.nutrition_facts_satfat"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">g</p>
                      </div>

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_transfat" name="nutrition_facts_transfat"
                          v-model="form.nutrition_facts_transfat"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">g</p>
                      </div>

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_polysatfat" name="nutrition_facts_polysatfat"
                          v-model="form.nutrition_facts_polysatfat"
                          class=" shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">g</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_monosatfat" name="nutrition_facts_monosatfat"
                          v-model="form.nutrition_facts_monosatfat"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">g</p>
                      </div>

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_cholesterol" name="nutrition_facts_cholesterol"
                          v-model="form.nutrition_facts_cholesterol"
                          class=" shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class=" text-sm text-gray-400">mg</p>
                      </div>

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_sodium" name="nutrition_facts_sodium"
                          v-model="form.nutrition_facts_sodium"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">mg</p>
                      </div>

                    </th>
                  </tr>
                </tbody>




                <!-- Even row -->


                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      potassium
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      carbs
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      fiber
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      sugar
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      protein
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      vitamin a
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      vitamin b6
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      vitamin b12
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      vitamin c
                    </th>
                  </tr>
                </thead>

                <tbody>

                  <!-- Odd row -->
                  <tr class="bg-white">
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600 ">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_potassium" name="nutrition_facts_potassium"
                          v-model="form.nutrition_facts_potassium"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">mg</p>
                      </div>



                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600 ">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_carbs" name="nutrition_facts_carbs"
                          v-model="form.nutrition_facts_carbs"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-gray-400">g</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_fiber" name="nutrition_facts_fiber"
                          v-model="form.nutrition_facts_fiber"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">g</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">

                        <input type="number" min="0" id="nutrition_facts_sugar" name="nutrition_facts_sugar"
                          v-model="form.nutrition_facts_sugar"
                          class="hadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">g</p>

                      </div>
                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">

                        <input type="number" min="0" id="nutrition_facts_protein" name="nutrition_facts_protein"
                          v-model="form.nutrition_facts_protein"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">g</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">

                        <input type="number" min="0" id="nutrition_facts_vitamina" name="nutrition_facts_vitamina"
                          v-model="form.nutrition_facts_vitamina"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">%</p>
                      </div>

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">

                        <input type="number" min="0" id="nutrition_facts_vitaminb6" name="nutrition_facts_vitaminb6"
                          v-model="form.nutrition_facts_vitaminb6"
                          class=" shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class=" text-sm text-gray-400">%</p>
                      </div>

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">

                      <div class="flex items-center">

                        <input type="number" min="0" id="nutrition_facts_vitaminb12" name="nutrition_facts_vitaminb12"
                          v-model="form.nutrition_facts_vitaminb12"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">%</p>
                      </div>

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_vitaminc" name="nutrition_facts_vitaminc"
                          v-model="form.nutrition_facts_vitaminc"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">%</p>
                      </div>


                    </th>
                  </tr>
                </tbody>




                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      vitamin d
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      vitamin e
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      calcium
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      iron
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      magnesium
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      Cobalamin
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      Thiamine
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      Riboflavin
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      Niacin
                    </th>
                  </tr>
                </thead>

                <tbody>

                  <!-- Odd row -->
                  <tr class="bg-white">
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600 ">

                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_vitamind" name="nutrition_facts_vitamind"
                          v-model="form.nutrition_facts_vitamind"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">%</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600 ">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_vitamine" name="nutrition_facts_vitamine"
                          v-model="form.nutrition_facts_vitamine"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-gray-400">%</p>
                      </div>

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_calcium" name="nutrition_facts_calcium"
                          v-model="form.nutrition_facts_calcium"
                          class=" shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">%</p>
                      </div>

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_iron" name="nutrition_facts_iron"
                          v-model="form.nutrition_facts_iron"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">mg</p>
                      </div>

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_magnesium" name="nutrition_facts_magnesium"
                          v-model="form.nutrition_facts_magnesium"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">mg</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_coblamin" name="nutrition_facts_coblamin"
                          v-model="form.nutrition_facts_coblamin"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">mg</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" id="nutrition_facts_thiamin" name="nutrition_facts_thiamin"
                          v-model="form.nutrition_facts_thiamin"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class=" text-sm text-gray-400">mg</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_riboflavin" name="nutrition_facts_riboflavin"
                          v-model="form.nutrition_facts_riboflavin"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">mg</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_niacin" name="nutrition_facts_niacin"
                          v-model="form.nutrition_facts_niacin"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">mg</p>
                      </div>

                    </th>
                  </tr>
                </tbody>







                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      zinc
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      water
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">
                      ash
                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">

                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">

                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">

                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">

                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">

                    </th>
                    <th scope="col" class="px-3 py-3 text-left text-sm font-bold text-gray-600 uppercase">

                    </th>
                  </tr>
                </thead>

                <tbody>

                  <!-- Odd row -->
                  <tr class="bg-white">
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600 ">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_zinc" name="nutrition_facts_zinc"
                          v-model="form.nutrition_facts_zinc"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">mg</p>
                      </div>


                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600 ">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_water" name="nutrition_facts_water"
                          v-model="form.nutrition_facts_water"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-gray-400">g</p>
                      </div>

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      <div class="flex items-center">
                        <input type="number" min="0" id="nutrition_facts_ash" name="nutrition_facts_ash"
                          v-model="form.nutrition_facts_ash"
                          class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                        <p class="text-sm text-gray-400">g</p>
                      </div>

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                      &nbsp;&nbsp;

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;



                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                      &nbsp;&nbsp;
                      &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">

                      &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                      &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">


                      &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                      &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;

                    </th>
                    <th class="px-3 py-3 text-left text-sm font-bold text-gray-600">
                      &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
                      &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;

                    </th>
                  </tr>
                </tbody>
              </table>


            </div>
          </div>
        </div>
      </div>

      <h3 class="searching-background-color py-2 rounded-md rounded-b-none text-white font-bold text-lg px-4 mx-6">
        Allergens</h3>
      <div class="flex flex-col mb-6 px-6">
        <div class="overflow-x-auto">
          <div class="align-middle inline-block min-w-full">
            <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th v-for="allergen in allergens" scope="col"
                      class="px-3 py-3 text-center text-sm font-bold text-gray-600 uppercase">
                      {{allergen.name}}
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Odd row -->
                  <tr class="bg-white">
                    <td v-for="allergen in allergens"
                      class="px-3 py-3 text-center text-sm font-bold text-gray-600 uppercase">
                      <input type="checkbox" name="product_allergen_ids" :value="allergen.id"
                        v-model="form.product_allergen_ids"
                        class="w-5 h-5 appearance-none checked:bg-blue-600 rounded-sm bg-gray-100 border-gray-300 focus:ring-0 focus:ring-offset-0 cursor-pointer">
                    </td>
                  </tr>

                  <!-- Even row -->


                  <!-- More people... -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="w-full flex lg:flex-nowrap flex-wrap md:justify-end items-center pr-6 pb-6 md:ml-0 ml-6">
        <button type="button"
          >
          <inertia-link :href="route('products')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
        </button>
        <button  type="button" @click="product_add_save_script"
          class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3 sm:mt-0">
          Save
        </button>





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
    props: ['allergens', 'categories', 'distributors', 'menu_users', 'mass_measurements', 'unit_measurements', 'volume_measurements'],
    components: {
      DefaultLayout,
      Welcome,
      BreadcrumLayout,
      PageTitleLayout,
      TableFilterLayout,
      TableIndexLayout,
    },
    data() {
      return {

        subcat_vals: [],
        sec_cat_counters: [1],
        sec_cat_length: 1,
        sec_cat_vals: [],
        sec_subcat_vals: [],
        secondary_subcats: [],

        product_tags_add: '',

        form: this.$inertia.form({

          pname: '',
          pmanufacturer: '',
          pmanufacturer_sku: '',
          pgtin:'',
          pyield:'',
          distributor_id_val: '',
          primary_cat_val: '',
          primary_subcat_val: '',
          case_weight: '',
          sub_case_weight: '',
          case_volume: '',
          sub_case_volume: '',
          case_qty: '',
          sub_case_qty: '',
          mass_measurements: '',
          volume_measurement: '',
          unit_measurement: '',
          case_mass_uom: this.mass_measurements[0]['id'],
          subcase_mass_uom: this.mass_measurements[0]['id'],
          case_vol_uom: this.volume_measurements[0]['id'],
          case_vol_sub_uom: this.volume_measurements[0]['id'],
          mass_measurements_uom: this.mass_measurements[0]['id'],
          volume_measurement_uom: this.volume_measurements[0]['id'],
          unit_measurement_uom: this.unit_measurements[0]['id'],
          usda_componenent_serving_meat: '',
          usda_componenent_serving_grain: '',
          usda_componenent_serving_fruit: '',
          usda_componenent_serving_milk: '',
          usda_componenent_serving_veg: '',
          usda_componenent_serving_vegleg: '',
          usda_componenent_serving_vegred: '',
          usda_componenent_serving_veggrn: '',
          usda_componenent_serving_vegstar: '',
          usda_componenent_serving_vegothr: '',
          nutrition_facts_weight: '',
          nutrition_facts_volume: '',
          nutrition_facts_unit: '',
          nutrition_mass_measurement: this.mass_measurements[0]['id'],
          nutrition_vol_measurement: this.volume_measurements[0]['id'],
          nutrition_unit_measurement: this.unit_measurements[0]['id'],
          nutrition_facts_calories: '',
          nutrition_facts_calfat: '',
          nutrition_facts_totalfat: '',
          nutrition_facts_satfat: '',
          nutrition_facts_transfat: '',
          nutrition_facts_polysatfat: '',
          nutrition_facts_monosatfat: '',
          nutrition_facts_cholesterol: '',
          nutrition_facts_sodium: '',
          nutrition_facts_potassium: '',
          nutrition_facts_carbs: '',
          nutrition_facts_fiber: '',
          nutrition_facts_sugar: '',
          nutrition_facts_protein: '',
          nutrition_facts_vitamina: '',
          nutrition_facts_vitaminb6: '',
          nutrition_facts_vitaminb12: '',
          nutrition_facts_vitaminc: '',
          nutrition_facts_vitamind: '',
          nutrition_facts_vitamine: '',
          nutrition_facts_calcium: '',
          nutrition_facts_iron: '',
          nutrition_facts_magnesium: '',
          nutrition_facts_coblamin: '',
          nutrition_facts_thiamin: '',
          nutrition_facts_riboflavin: '',
          nutrition_facts_niacin: '',
          nutrition_facts_zinc: '',
          nutrition_facts_water: '',
          nutrition_facts_ash: '',
          product_allergen_ids: [],
          product_tags_val: [],
          secondary_subcat_ids: []
          // ,
          // user_id:''
        })
      }
    },
    methods: {

      onCategoryChangefunc() {
        axios.post('/get_prod_subcategories', { category_id: this.form.primary_cat_val })
          .then((response) => {
            this.subcat_vals = [];
            this.subcat_vals = response.data;
          })
          .catch(error => console.error(error));
      },


      onSecondaryCategoryChangefunc(index, e) {
        axios.post('/get_prod_subcategories', { category_id: e.target.value })
          .then((response) => {
            this.sec_cat_vals[index] = e.target.value;
            this.sec_subcat_vals[index] = response.data;
          })
          .catch(error => console.error(error));
      },



      onTagAdditionfunc() {
        var tag_val = this.product_tags_add;
        if (tag_val != "") {
          this.form.product_tags_val.push(tag_val);
          this.product_tags_add = "";
        } else {
          this.$toast.error("Tag Value Can't Be Empty!");
        }
        return false;
      },


      onTagRemovefunc(index) {
        //var index = this.product_tags_val.indexOf(val);
        if (index > -1) {
          this.form.product_tags_val.splice(index, 1);
        }
        return false;
      },


      onSecondaryCatAddFieldRow() {
        this.sec_cat_length = this.sec_cat_counters.length;
        if (this.sec_cat_length < 5) {
          this.sec_cat_counters.push(1);
        } else {
          this.$toast.warning('Maximum 5 secondary categories allowed!');
        }
      },

      onSecondaryCatRemoveFieldRow(index) {
        this.sec_cat_counters.splice(index, 1);
        this.sec_cat_length = this.sec_cat_counters.length;
        this.sec_cat_vals.splice(index, 1);
        this.sec_subcat_vals.splice(index, 1);
        this.secondary_subcats.splice(index, 1);
      },

      product_add_save_script() {
        this.form.secondary_subcat_ids = this.secondary_subcats;
        this.form.post(this.route('products_add_save'), {
          onSuccess: () => {
            this.$toast.success('Product Added Successfully!');
          },
        });
      }
    },
  };
</script>
<style>
  .min-height-third {
    min-height: 400px;
  }

  .sm\:text-sm {
    font-size: 0.850rem;
    line-height: 1.25rem;
  }

  .w-52-rec {
    width: 13.2rem;
  }

  .input-background {
    background-color: #f8f8f8;
  }

  .text-base-heading {
    font-size: 14px;
  }

  .button-bg-color-wed-menu2-gray {
    border: none !important;
    min-height: 35px;
    min-width: 35px;
  }

  .menu1-background-color {
    background-color: #FAA43D;
  }

  .products-edit-minus-color {
    color: #f7a53a;
  }

  .button-bg-color-wed-menu2 {
    background-color: #38558e;
    border: none !important;
    min-height: 35px;
    min-width: 35px;
  }

  .menu1-icon-color {
    color: #38558e;
  }

  .id-color-menu-edit {
    color: #F7A53A;
  }

  .bg-button-color {
    background-color: #cb0000;
  }

  .min-w-min-button {
    min-height: 26px;
    min-width: 53px;

  }

  .w-150 {
    width: 150px;
  }

  .max-w-0-menu1 {
    max-width: 4rem;
  }

  .bg-button-color-green {
    background-color: #22af4b;
  }

  .plus-font-size {
    font-size: 20px;
  }

  .bg-button-color-gray {
    background-color: #636363;
  }

  .bg-hard-grey {
    background-color: #f4f4f4;
  }

  .font-size-edit {
    font-size: 10.5px;
  }

  .w-96-edit-recipes {
    width: 35rem;
  }

  .select-menu-height-edit2 {
    height: 2.8rem;
  }

  .pl-60-plus-icon {
    padding-left: 14.50rem;
  }

  .current_tag.fa-minus-circle:before {
    content: "\f056";
    position: relative;
    top: 1px;
    left: 30px;
  }

  .validation_error_msg {
    font-weight: 400;
    margin: 6px 0 0 !important;
    color: red;
  }
</style>
