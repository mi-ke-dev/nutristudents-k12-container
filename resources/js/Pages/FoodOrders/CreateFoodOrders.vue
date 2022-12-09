<template>
   <default-layout>
      <BreadcrumLayout>
         <a href="#" class="link-color"><U>Planning</U></a>
      </BreadcrumLayout>
      <PageTitleLayout>
         <div class="w-full flex flex-wrap justify-between items-center">
            <h1 class="heading-color xl:text-4xl text-2xl font-bold text-left">Create Order</h1>
            <div class="right-button">
               <button class="cancel-button-color text-white font-bold py-3 xl:px-8 px-8 lg:ml-6 sm:ml-6 ml-0 rounded lg:mt-0 sm:mt-0">
               CANCEL
               </button>
               <inertia-link
                  :href="route('CreateFoodOrders-next')"
                  class="
                  "
                  >
                  <button class="button-color text-white font-bold py-3 xl:px-8 px-8 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0">
                  NEXT
                  </button>
               </inertia-link>
            </div>
         </div>
      </PageTitleLayout>
      <TableIndexLayout>
         <div class="food-order xl:px-10 px-5 mt-6">
            <h3 class="progress-text font-bold">PROGRESS: STEP 1 of 4</h3>
            <div class="w-full progress-bar">
               <div class="py-0.5 text-xs text-center text-white bg-green-500 w-9">0%</div>
            </div>
         </div>
      </TableIndexLayout>
      <div class="searching xl:px-10 px-5 md:pt-10 pt-8 w-full">
         <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
            <h2 class="text-lg text-white font-bold">Choose Group/Site</h2>
         </header>
      </div>
      <TableIndexLayout>
         <div class="xl:px-10 px-5">
            <div class="bg-white py-6 pl-6">
               <p class="text-base text-black-600 pb-3 font-bold">What Group/Site is this order for?</p>
               <div class="relative focus:outline-none lg:w-72 sm:w-1/2 w-60">
                  <select
                     class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height">
                     <option value="">Choose</option>
                     <option value="">Category</option>
                  </select>
                  <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
               </div>
            </div>
            <div class="right-button float-right">
               <button class="cancel-button-color text-white font-bold py-1.5 xl:px-8 px-8 lg:ml-6 sm:ml-6 ml-0 rounded lg:mt-0 sm:mt-0 xl:mt-10">
               CANCEL
               </button>
               <inertia-link
                  :href="route('CreateFoodOrders-next')"
                  class="
                  "
                  >
                  <button class="button-color text-white font-bold py-1.5 xl:px-8 px-8 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 xl:mt-10">
                  NEXT
                  </button>
               </inertia-link>
            </div>
         </div>
      </TableIndexLayout>
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
.cancel-button-color{
   background-color: #8b8b8b;
   }
.progress-bar > div {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    height: 23px;
    line-height: 23px;
}
   .progress-text{
   font-size: 19px;
   color: #3f3f3f   }

   .progress-bar > div {
    border-top-left-radius: 4px;
    border-bottom-left-radius: 4px;
    height: 23px;
    line-height: 23px;
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
   @media screen and (min-width: 1500px) {
   .id_arrow .fa-sort-desc.food-orders:before {
   content: "\f0dd";
   position: absolute;
   top: 17px;
   left: 1px;
   padding-left:7px;
   color: #219FD5;
   }
   .id_arrow .fa-sort-asc.food-orders:before {
   content: "\f0de";
   color: #219FD5;
   padding-left:7px;
   position: absolute;
   top: 18px;
   left: 1px;
   }
   }
   @media screen and (max-width: 1499px){
   .id_arrow .fa-sort-asc.food-orders:before {
   content: "\f0de";
   color: #219FD5;
   padding-left: 7px;
   position: absolute;
   top: 18px;
   left: 1px;
   }
   .id_arrow .fa-sort-desc.food-orders:before {
   content: "\f0dd";
   position: absolute;
   top: 17px;
   left: 1px;
   padding-left: 7px;
   color: #219FD5;
   }
   .cancel-button-color{
   background-color: #8b8b8b;
   }
   }
   @media screen and (max-width: 448px){
   .right-button{
   margin-top: 20px;
   float: left;
   }
   }
</style>
