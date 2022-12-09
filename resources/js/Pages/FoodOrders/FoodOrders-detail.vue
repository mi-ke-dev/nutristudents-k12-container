<template>
  <default-layout>

    <BreadcrumLayout>
    <div class="flex">
      <a href="#" class="link-color"><U>Planning</U></a>
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
</svg>
 <a href="#" class="link-color"><U>Food Orders</U></a></div>
    </BreadcrumLayout>
    <PageTitleLayout>
    <div class="w-full flex flex-wrap justify-between items-center">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold text-left">Create Order</h1>
        
        <div class="right-button">
        <button class="cancel-button-color text-white font-bold py-3 xl:px-8 sm:px-8 px-4 lg:ml-6 sm:ml-6 ml-0 rounded lg:mt-0 sm:mt-0">
          CANCEL
        </button>
        <button class="cancel-button-color text-white font-bold py-3 xl:px-8 sm:px-8 px-4 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0">
          BACK
        </button>
        <inertia-link
                                :href="route('foodorderdetail-next')"
                                class="
                                    
                                "
                            >
         <button class="button-color text-white font-bold py-3 sm:px-8 px-4 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0">
          NEXT
        </button></inertia-link>
      </div>
        </div>
        
    </PageTitleLayout>
   
    <div class="order-detail xl:px-10 px-5">
    <p class="text-base">Order for: Placentia Linda West</p></div>
  <TableIndexLayout>
  <div class="food-order xl:px-10 px-5 mt-6">
  <h3 class="progress-text font-bold">Progress: Step 3 of 4</h3>
 <div class="w-full progress-bar">
    <div class="py-0.5 text-xs text-center text-white bg-green-500 w-1/2">50%</div>
</div>
</div>
</TableIndexLayout>

      <PageTitleLayout>
      
     
    </PageTitleLayout>
   
    

  
           
      <div class="lg:mb-0 mb-4 w-full mt-6 flex xl:px-10 px-5">
       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="#0093d0">
  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
</svg><span class="span-text font-bold pl-1">Confirm the order quantities for each delivery location:</span>
      </div>
         
     <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg mx-10 mt-1">
     <h2 class="text-white text-lg font-bold w-11/12">Van Buren Elementary</h2>
   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
</svg>
  </header>

          <div class="flex flex-col mb-6 mx-10 my_table">
            <div class="overflow-x-auto">
              <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
                 <table class="min-w-full">
          <thead class="header-bg-color">
            <tr>
              <th scope="col" class="w-3/5 id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                ingredient
              </th>
              <th scope="col" class="w-1/5 px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                needed
              </th>
             <th scope="col" class="w-1/5 px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
               on hand
              </th>
              <th scope="col" class="w-1/5 px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                order
              </th>
               
            </tr>
          </thead>
          <tbody>
            <!-- Oddd row -->
            <tr class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                   Tyson-Frozen 1/4 Ib Beef Patty
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                   100
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                  <input type="text" value="" class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                </td>
              
                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                  100
                </td>
                
            </tr>

            <tr class="tr-background-color">
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                   Land o Lakes-Shredded Cheddar Cheese
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                  10
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                     <input type="text" value="10" class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                </td>
              
                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                   10
                </td>
                
            </tr>

            <tr class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                  Horizon-Extra Large Eggs
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                   75
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                  <input type="text" value="" class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                </td>
              
                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    75
                </td> 
            </tr>
         <tr class="tr-background-color">
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                  Alta Dena-2% Milk Boxes
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                    5
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                  <input type="text" value="" class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                </td>
              
                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                  5
                </td>  
            </tr>

             <tr class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                  Zacky-mini Corn Dogs
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                   100
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                 <input type="text" value="" class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                </td>
              
                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    100
                </td>  
            </tr>
           

           
            
             <tr class="tr-background-color">
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                Motts-10oz Apple Juice Bottles
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                    90
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                   <input type="text" value="" class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                </td>
              
                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                  90
                </td> 
            </tr>

             <tr class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
               Mrs.T's-Spicy Bloody Mary Mix
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                   5
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                   <input type="text" value="" class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                </td>
              
                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                 5
                </td> 
            </tr>



            <tr class="tr-background-color">
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
              Living Green-8"Frozen Cheese Pizza
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                    85
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                    <input type="text" value="" class="shadow-sm focus:outline-none block w-20 p-0 px-1 h-9 bg-gray-100 sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-50 text-center mr-2">
                </td>
              
                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                   85

                </td>
            </tr>






          </tbody>
        </table>
  </div>
              </div>
            </div>
          </div>
        

       
       <div class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg sm:mx-10 mx-6 mt-6">
     <h2 class="text-white text-lg font-bold w-11/12">Lakeview</h2>
   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
</svg>
  </div>
  <div class="content bg-white overflow-hidden sm:mx-10 mx-6 hidden">
      <p class="p-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
    </div>
   
 <div class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg sm:mx-10 mx-6 mt-6">
     <h2 class="text-white text-lg font-bold w-11/12">Brookhaven</h2>
   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
</svg>
  </div>
  <div class="content bg-white overflow-hidden sm:mx-10 mx-6 hidden">
      <p class="p-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
    </div>

   <div class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg sm:mx-10 mx-6 mt-6">
     <h2 class="text-white text-lg font-bold w-11/12">Bryant Ranch</h2>
   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
</svg>
  </div>
  <div class="content bg-white overflow-hidden sm:mx-10 mx-6 hidden">
      <p class="p-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
    </div>
            

            <div class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg sm:mx-10 mx-6 mt-6">
     <h2 class="text-white text-lg font-bold w-11/12">Golden</h2>
   <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
</svg>
  </div>
  <div class="content bg-white overflow-hidden sm:mx-10 mx-6 hidden">
      <p class="p-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
    </div>



 <div class="bottom_button w-full sm:flex lg:flex-nowrap flex-nowrap lg:justify-end items-center  mb-6  px-10 mt-6">
        
         <button class="cancel-button-color text-white font-bold py-1.5 xl:px-8 sm:px-8 px-4 lg:ml-6  ml-0 rounded lg:mt-0 sm:mt-0 xl:mt-10">
          CANCEL
        </button>
        <button class="cancel-button-color text-white font-bold py-1.5 xl:px-8 sm:px-8 px-4 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 xl:mt-10">
          BACK
        </button>
         <inertia-link
                                :href="route('foodorderdetail-next')"
                                class="
                                    
                                "
                            >
         <button class="button-color text-white font-bold py-1.5 xl:px-8 sm:px-8 px-4 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 xl:mt-10">
          NEXT
        </button></inertia-link>



     
      
      </div>
    

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
  components: {
    DefaultLayout,
    Welcome,
    BreadcrumLayout,
    PageTitleLayout,
    TableFilterLayout,
    TableIndexLayout,
  },
};
</script>
<style>
.title::after, .title::before {
  content: '';
  position: absolute;
  right: 1.25em;
  top: 1.25em;
  width: 2px;
  height: 0.75em;
  background-color: #7A7572;
  transition: all 0.2s;
}
.content p{
padding: 20px;
}
.min-height-third{
 min-height: 400px; 
}
.span-text {
    font-size: 14px;
    color: #727272;
    padding-bottom: 5px;
}
.progress-bar > div {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    height: 23px;
    line-height: 23px;
}
.progress-text{
  font-size: 19px;
  color: #3f3f3f;
}
 .progress-bar{
  background-color: #fff;
  border: 1px solid #cacaca;
  border-radius: 5px;
  height: 25px;
}
.bg-green-500{
background-color: #22af4b;
}
.sm\:text-sm {
    font-size: 0.850rem;
    line-height: 1.25rem;
}

.order-detail{
color: #4a4a4a;
font-size: 14px;
}

.w-52-rec {
    width: 13.2rem;
}
.cancel-button-color{
background-color: #8b8b8b;
}

.input-background{
background-color: #f8f8f8;
}

.text-base-heading{
font-size: 14px;
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
@media screen and (max-width: 1279px){
.searching-background-color{
margin-left: 1.25rem;
margin-right: 1.25rem;
}
.my_table{
margin-left: 1.25rem;
margin-right: 1.25rem;
}
.bottom_button{
padding-right: 1.25rem;
padding-left: 1.25rem;
}
}
@media screen and (max-width: 570px){
.right-button, .order-detail{
margin-top: 0.625rem;
}
}



</style>
