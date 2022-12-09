<template>
  <Head>
  <title>Add New Ingredient | NutriStudents K-12</title>
  <meta name="description" content="Add New Ingredient">
  </Head>
  <default-layout>

    <BreadcrumLayout>
    <div class="flex">
      <!-- <a href="#" class="link-color"> --><U>Templates</U><!-- </a> -->
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
</svg>
 <inertia-link :href="route('ingredients')" class="link-color"><U>Ingredients</U></inertia-link></div>
    </BreadcrumLayout>



<form action="#" @submit.prevent="false">

  <PageTitleLayout>
    <div class="lg:mb-0 mb-4 w-4/6">
      <h1 class="heading-color  2xl:text-2xl text-xl font-bold">Add New Ingredient</h1>
    </div>
    <div class="w-full flex lg:flex-nowrap flex-wrap md:justify-end items-center">

      <button type="button" >
        <inertia-link :href="route('ingredients')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
      </button>

      <button type="button" @click="ingredient_add_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3 sm:mt-0">Save</button>


    </div>
  </PageTitleLayout>
   

    <PageTitleLayout>
      <div class="lg:mb-0 mb-4 w-full md:mt-0 mt-6">
        <h1 class="text-base text-gray-500 font-bold"></h1>
      </div>
     
    </PageTitleLayout>
   
    <PageTitleLayout>

    <div class="md:flex block justify-between shadow py-8 mt-4 align-middle inline-block min-w-full   bg-white rounded-t-lg   lg:divide-x-2 divide-gray-300 border-b-4 border-gray-300 w-full overflow-x-auto">
    <div class="w-6/12">
   
    <div class="xl:flex block  xl:items-center xl:justify-evenly xl:pl-0 lg:pl-24 md:pl-12 pl-6">
    <label class="font-bold text-gray-700 2xl:text-lg text-base">Ingredient Name*</label>
    <div>
     <input type="text" id="ing_name" name="ing_name" v-model="form.ing_name"
              class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">   
    <div v-if="form.errors.ing_name" class="validation_error_msg">{{ form.errors.ing_name }}</div> 
    </div>
    </div>
    
  
    </div>
   
    
    <div class="sm:w-6/12 w-52 sm:mr-0 mr-4">
   <div class="xl:flex block  xl:items-center xl:justify-evenly xl:pl-8 lg:pl-12 pl-6 md:pt-0 pt-8 2xl:mr-0 pr-4 ">
     <label class="font-bold text-gray-700  2xl:text-lg text-base">Preferred Product</label>
     <div>
     <div class="relative pl-0 2xl:w-80 xl:w-80 w-72 xl:mt-0 mt-4 2xl:text-lg text-xs text-gray-400">
      
          <select
            id="ing_prefer_product"
            name="ing_prefer_product"
            autocomplete="ing_prefer_product" v-model="form.ing_prefer_product"
            class="sm:text-sm text-xs  shadow-sm focus:border-color block  border-gray-300 rounded-lg w-full select-menu-height-edit2 input-background text-gray-500"
          > <option value="">Select</option>
            <option v-for="product in ing_products" :value="product.id">{{product.name}}</option>
          </select>
          
          <div
            class="absolute flex justify-center items-center searching-background-color select-menu-height-edit2 w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
          >
            <i class="fa fa-sort-desc" aria-hidden="true"></i>
          </div>

    </div>    
    </div>

        

    </div>
     
   
          </div>
     </div>    
  
      </PageTitleLayout>


<div class="searching xl:px-10 px-5 md:pt-10 pt-8 w-full">
  <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">

    <div class="relative md:w-56">
    <input class="border-2 border-gray-300 bg-white h-10 px-3 pr-10 rounded-lg text-sm focus:outline-none w-full" type="search" name="ipsearch" placeholder="Search" v-model="ipsearch" @keyup.enter="ingProductSearchScript">
    <button type="button" class="absolute right-0 top-0 mt-2 mr-4 outline-none" @click="ingProductSearchScript"><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>

   <a href="#" @click="addProductsIngredientModalOpen">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
    </svg>
   </a>

    </header>
</div>

    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-auto">
            <table class="min-w-full">
              <thead class="header-bg-color">
                <tr>
                  <th
                    scope="col"
                    class="id_arrow   px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative"
                  >
                    #
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider"
                  >
                    PRODUCT NAME
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider"
                  >
                    Source
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider"
                  >
                    MANUFACTURER
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider"
                  >
                    MFG#
                  </th>                  
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider"
                  ></th>
                </tr>
              </thead>
              <tbody>
                <!-- Odd row -->

                <tr v-if="!ing_products.length" class="bg-white"><td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Attached Products Found!</td></tr>
                

                <tr v-else-if="ing_searched_products.length > 0" v-for="(iproduct,index) in ing_searched_products" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                  {{log('iproduct',iproduct)}}
                  <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                    <a :href="route('products_edit', { id: iproduct.id })" class="" target="_blank">{{index+1}}</a>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    {{iproduct.name}}
                  </td>
                  <td  class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    {{iproduct.tenant_name}}
                  </td> 

                  <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                    {{iproduct.manufacturer}}
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    {{iproduct.manufacturer_sku}}
                  </td>
                  
                  <td class="px-6 py-4 whitespace-nowrap id-color text-xl font-extrabold">
                    <button type="button" @click="addProductsDeleteScript2(iproduct.id)" class="">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                  </td>

                </tr>


                <tr v-else v-for="(iproduct,index) in ing_products" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">

                  <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                    <a :href="route('products_edit', { id: iproduct.id })" class="" target="_blank">{{index+1}}</a>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    {{iproduct.name}}
                  </td>

                  <td   class="px-6 py-4 whitespace-nowrap text-base text-color">
                    {{iproduct.tenant_name}}
                  </td> 
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                    {{iproduct.manufacturer}}
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    {{iproduct.manufacturer_sku}}
                  </td>
                  
                  <td class="px-6 py-4 whitespace-nowrap id-color text-xl font-extrabold">
                    <a :href="route('products_edit', { id: iproduct.id })" class="" target="_blank"><i class="fa fa-external-link pr-3" aria-hidden="true"></i></a>
                    <button type="button" @click="addProductsDeleteScript(iproduct.id)" class="">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                  </td>
                  
                </tr>
                
             
              </tbody>
            </table>
            
          </div>
        </div>
      </div>
      
    </TableIndexLayout>
    
         
<header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg sm:mx-10 mx-6 mt-10">
<h2 class="text-white text-lg font-bold w-11/12">Calculated Totals</h2>
<!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white  font-bold" viewBox="0 0 20 20" fill="currentColor">
<path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
</svg>
      <svg
                xmlns="http://www.w3.org/2000/svg"
                class="h-6 w-6 text-white mr-3"
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

          <div class="flex flex-col mb-6 mx-10">
            <div class="overflow-x-auto">
              <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
              
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
                    star
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
                  sod
                  </th>
                     <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  fat
                  </th>
                   <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  PROT
                  </th>
                    <th
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  carb
                  </th>
                </tr>
              </thead>
                <tbody>


                <!-- Odd row -->

                <tr v-if="!avg_product.length" class="bg-white">
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="15">No Attached Products Found!</td>
                </tr>


                <tr v-else v-for="avg_productt in avg_product" class="bg-white">
                <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.MMA) }}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.WGR) }}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.FRU) }}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.MLK) }}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.VEG) }}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.DG) }}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.STAR) }}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.RO) }}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.LEG) }}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.OTH) }}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.CALS) }}cals</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center px-2 text-white">{{ convertToFix(avg_productt.SOD) }}mg</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.FAT) }}g</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.PROT) }}g</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ convertToFix(avg_productt.CARB) }}g</div>
                  </td>
                </tr>
                
  
  </tbody>

  </table>
  </div>
              </div>
            </div>
          </div>


 <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center mb-6 px-10 mt-6">
        
    <button type="button" >
      <inertia-link :href="route('ingredients')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40 ">Cancel</inertia-link>
    </button>

    <button type="button" @click="ingredient_add_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3  sm:mt-0">Save</button>

  </div>
    
</form>

  </default-layout>

<!-- <jet-button @click="addProductsIngredientModalOpen">Add Products</jet-button> -->
<jet-dialog-modal :show="addProductsModal" @close="addProductsModal = false">
 <template #title>
  <div class="flex justify-between items-center">
  Search products to Add/Attach with ingredient
  <div class="relative md:w-56 ">
    <input class="border-2 border-gray-300 bg-white h-10 px-3 pr-10 rounded-lg text-sm focus:outline-none w-full" type="search" name="search_term" placeholder="Search" v-model="search_term" @keyup.enter="productSearchScriptModal">
    <button type="button" class="absolute right-0 top-0 mt-2 mr-4 outline-none" @click="productSearchScriptModal"><i class="fa fa-search" aria-hidden="true"></i></button>
  </div>
 </div>
 </template>

  <template #content>
    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block px-2 w-full">
          <div class="shadow overflow-auto max-height">
            <table class="min-w-full">
              <thead class="header-bg-color">
                <tr>                  
                  <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">PRODUCT NAME</th>
                  <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">MANUFACTURER</th>
                  <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">Source</th>
                  <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider" >MFG#</th>                  
                  <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider" ></th>
                </tr>
              </thead>
              <tbody>

                <!-- Odd row -->
                <tr v-if="!searched_products.length" class="bg-white">
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Product Found</td>
                </tr>

                <tr v-for="(product,index) in searched_products" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}" class="cursor-pointer" @click="addProductsAddScript(product, index)">
                  
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                    <div class="tooltip">
                      <div class="trim_text">{{product.name}}</div>
                      <div class="top">
                          {{product.name}}
                          <i></i>
                      </div>
                    </div>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                    {{product.manufacturer}}
                  </td>
                  <td   class="px-6 py-4 whitespace-nowrap text-base text-color">
                    {{product.tenant_name}}
                  </td> 

                  <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    {{product.manufacturer_sku}}
                  </td>
                  
                  <td class="px-6 py-4 whitespace-nowrap id-color text-xl font-extrabold">
                     
                    <a :href="route('products_edit', { id: product.id })" class="" target="_blank"><i class="fa fa-external-link pr-3" aria-hidden="true"></i></a>

                    <button type="button" class="">
                    <i class="fa fa-plus pr-3" aria-hidden="true"></i>
                    </button>

                  </td>
                </tr>


              </tbody>
            </table>
            
          </div>
        </div>
      </div>
    </TableIndexLayout>
  </template>

  <template #footer>
   <label class="float-left">Show Products Without Component Values <input value="1" v-model="is_all" type="checkbox" /></label> 
  <jet-secondary-button @click="addProductsModal = false">Close</jet-secondary-button>
  </template>
</jet-dialog-modal>

<jet-dialog-modal :show="addProductsModalWarring" @close="addProductsModalWarring = false">
 <template #title>
  <div class="flex justify-between items-center text-red-600 text-xl font-bold">
  Warning 
  </div>
 </template>

  <template #content>
    <p>You are attemting to add a product that  does not have USDA component information.In order to proceed, please add the values and try again.</p>    
    <a v-if="error_product_array.id" href="#" class="whitespace-nowrap id-color text-lg font-bold underline mt-2">{{ error_product_array.name }} </a>
  </template>

  <template #footer>
    <div class="flex justify-end items-center">
      <button @click="addProductsModalWarring = false" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition bg-gray-500 text-white inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase text-base mr-2">Cancel</button>
      <a v-if="error_product_array.is_tenant_admin" target="_blank" :href="route('products_edit', error_product_array.id)" @click="addProductsModalWarring = false" class="inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase bg-red-500 text-white text-base">Edit Product </a>
      <form  v-if="!error_product_array.is_tenant_admin" target="_blank"  :action="route('product_copy', error_product_array.id)" method="post">
        <input type="hidden" name="_token" :value="csrf" />
        <button type="submit"  class="inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase bg-red-500 text-white focus:outline-none text-base"  > Duplicate & Edit Product </button>
      </form>
    </div>
  </template>
</jet-dialog-modal>

</template>

<script>
import DefaultLayout from "@/Layouts/DefaultLayout";
import Welcome from "@/Jetstream/Welcome";
import BreadcrumLayout from "@/Pages/Common/Breadcrumbs";
import PageTitleLayout from "@/Pages/Common/PageTitle";
import TableFilterLayout from "@/Pages/Common/TableFilters";
import TableIndexLayout from "@/Pages/Common/TableIndex";
import JetButton from '@/Jetstream/Button';
import JetSecondaryButton from '@/Jetstream/SecondaryButton';
import JetDialogModal from '@/Jetstream/DialogModal';

export default {
  
  components: {
    DefaultLayout,
    Welcome,
    BreadcrumLayout,
    PageTitleLayout,
    TableFilterLayout,
    TableIndexLayout,
    JetButton,
    JetSecondaryButton,
    JetDialogModal,
  },

  data(){
    return {
      csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      log: console.log,
      ing_products:[],
      ing_searched_products:[],
      avg_product:[],
      error_product_array:null,
      
      ipsearch:'',

      addProductsModal:false,
      addProductsModalWarring: false,
      search_term:'',
      searched_products:'',
      is_all:false,

      form: this.$inertia.form({
        ing_name:'',
        ing_prefer_product:'',
        attached_products:[], 
              
      })

    }
  },

  methods:{

    ingProductSearchScript(event){
            
           
            event.preventDefault();
            

            if(this.ipsearch == ""){

             if(this.ing_products.length == 0){
               this.$toast.error('Error: Search value required!');
             } 
             
              this.ing_searched_products = [];
            }
            else if(this.ing_products.length == 0){
            this.$toast.error('Error: No Attached Products Found!');
            this.ing_searched_products = [];
            }
            else{
                  this.ing_searched_products = [];
                  this.ing_products.forEach((value,index) => {
                    let product_name = value['name'].toLowerCase();
                    if(product_name.indexOf(this.ipsearch.toLowerCase()) !== -1){
                      this.ing_searched_products.push(value);
                    }           
                  });

                  if(this.ing_searched_products.length == 0){
                    this.ing_searched_products = [];
                    this.$toast.error('Error: No Products Found!');
                  }

            }
    },

    addProductsIngredientModalOpen() {
      this.addProductsModal = true; 

      this.search_term = "";
      this.searched_products = [];               
    },

    productSearchScriptModal(){
            if(this.search_term == ""){
            this.$toast.error('Error: Search value required!');
            }else{
            let exist_products = [];
            this.ing_products.forEach((value,index) => {exist_products.push(value['id']);});  
            axios.post('/ingredient-product-search-modal',{term:this.search_term,ex_ids:exist_products
              , is_all : this.is_all
            })
                    .then((response)=>{
                       this.searched_products = response.data;                       
                     })
                    .catch(error => console.error(error));
            }
    },

    addProductsAddScript(product_array, index){

      console.log('im here',product_array);
      if(product_array.is_usda)
      {
        this.ing_products.push(product_array);   
        this.searched_products.splice(index,1);  
        this.avg_products_val_setup();
      } else {
        this.error_product_array = product_array;
        this.addProductsModalWarring = true;
        console.log("this.error_product_array", this.error_product_array);
      }
    },

    addProductsDeleteScript(product_id){
            
            this.ing_products.forEach((value,index) => {
                 //console.log(value['id']);
                 if(product_id == value['id']){
                  this.ing_products.splice(index,1);
                  //this.searched_products.push(value);     
                 }
            });

            this.avg_products_val_setup();
    },

    addProductsDeleteScript2(product_id){
            
            this.ing_searched_products.forEach((value,index) => {
                 if(product_id == value['id']){
                  this.ing_searched_products.splice(index,1);   
                 }
            });

            this.ing_products.forEach((value,index) => {
                 if(product_id == value['id']){
                  this.ing_products.splice(index,1);   
                 }
            });

            this.avg_products_val_setup();
    },

    convertToFix(vals){
      if(vals > 0 && this.isFloat(vals)){
        return vals.toFixed(2);
      } else {
        return vals;
      }
    },
    isFloat(n){
      return Number(n) === n && n % 1 !== 0;
    },


    avg_products_val_setup(){    
         
         let total_num = this.ing_products.length;         
         if(total_num > 0){
         let sum1 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum1 += parseFloat(this.ing_products[i]['usda_componenent_serving_meat']) || 0;
         }
         let MMA = parseFloat(sum1);
         

         let sum2 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum2 += parseFloat(this.ing_products[i]['usda_componenent_serving_grain']) || 0;
         }
         let WGR = parseFloat(sum2);

         let sum3 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum3 += parseFloat(this.ing_products[i]['usda_componenent_serving_fruit']) || 0;
         }
         let FRU = parseFloat(sum3);

         let sum4 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum4 += parseFloat(this.ing_products[i]['usda_componenent_serving_milk']) || 0;
         }
         let MLK = parseFloat(sum4);      

         let sum5 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum5 += parseFloat(this.ing_products[i]['usda_componenent_serving_veg']) || 0;
         }
         let VEG = parseFloat(sum5);

         let sum6 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum6 += parseFloat(this.ing_products[i]['usda_componenent_serving_veggrn']) || 0;
         }
         let DG = parseFloat(sum6);

         let sum7 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum7 += parseFloat(this.ing_products[i]['usda_componenent_serving_vegstar']) || 0;
         }
         let STAR = parseFloat(sum7);

         let sum8 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum8 += parseFloat(this.ing_products[i]['usda_componenent_serving_vegred']) || 0;
         }
         let RO = parseFloat(sum8);

         let sum9 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum9 += parseFloat(this.ing_products[i]['usda_componenent_serving_vegleg']) || 0;
         }
         let LEG = parseFloat(sum9);

         let sum10 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum10 += parseFloat(this.ing_products[i]['usda_componenent_serving_vegothr']) || 0;
         }
         let OTH = parseFloat(sum10);

         let sum11 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum11 += parseFloat(this.ing_products[i]['nutrition_facts_calories']) || 0;
         }
         let CALS = parseFloat(sum11);

         let sum12 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum12 += parseFloat(this.ing_products[i]['nutrition_facts_sodium']) || 0;
         }
         let SOD = parseFloat(sum12);

         let sum13 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum13 += parseFloat(this.ing_products[i]['nutrition_facts_totalfat']) || 0;
         }
         let FAT = parseFloat(sum13);

         let sum14 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum14 += parseFloat(this.ing_products[i]['nutrition_facts_protein']) || 0;
         }
         let PROT = parseFloat(sum14);

         let sum15 = 0;
         for (let i = 0; i < this.ing_products.length; i++) {
            sum15 += parseFloat(this.ing_products[i]['nutrition_facts_carbs']) || 0;
         }
         let CARB = parseFloat(sum15);


         this.avg_product.splice(0);
         this.avg_product = [{
                              'MMA': MMA, 
                              'WGR': WGR, 
                              'FRU': FRU, 
                              'MLK': MLK, 
                              'VEG': VEG, 
                              'DG': DG,
                              'STAR': STAR, 
                              'RO': RO,
                              'LEG': LEG,
                              'OTH': OTH,
                              'CALS': CALS,
                              'SOD': SOD,
                              'FAT': FAT,
                              'PROT': PROT,
                              'CARB':CARB,
                            }];
        }else{
          this.avg_product = [];
        }
         
         //console.log(this.avg_product);
    },


    ingredient_add_save_script(){
            this.form.attached_products = this.ing_products;
            this.form.post(this.route('ingredients-add-save'), {
                    onSuccess: () => {    
                          this.$toast.success('Ingredient has been created successfully!');
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


.max-height{
  max-height: 600px;
}
.trim_text {
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 250px;
}

@media (min-width: 640px){
  .mb-6.bg-white.rounded-lg.overflow-hidden.shadow-xl.transform.transition-all.sm\:w-full.sm\:mx-auto.sm\:max-w-2xl {
      max-width: 60rem;
  }
}

.tooltip {
    display:inline-block;
    position:relative;
    text-align:left;
}
.tooltip .top {
    width: 250px;
    top:50%;
    left:100%;
    margin-left:20px;
    transform:translate(0, -50%);
    padding: 5px 10px;
    color: #444444;
    background-color: #EEEEEE;
    font-weight: normal;
    font-size: 14px;
    border-radius: 5px;
    position: absolute;
    z-index: 99999999;
    box-sizing: border-box;
    box-shadow: 0 1px 8px rgba(0,0,0,0.5);
    display: none;
    white-space: normal;
}
.tooltip:hover .top {
    display:block;
}
.tooltip .top i {
    position:absolute;
    top:50%;
    right:100%;
    margin-top:-12px;
    width:12px;
    height:24px;
    overflow:hidden;
}
.tooltip .top i::after {
    content:'';
    position:absolute;
    width:12px;
    height:12px;
    left:0;
    top:50%;
    transform:translate(50%,-50%) rotate(-45deg);
    background-color:#EEEEEE;
    box-shadow:0 1px 8px rgba(0,0,0,0.5);
}
</style>
