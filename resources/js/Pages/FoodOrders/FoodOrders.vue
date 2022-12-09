<template>
  <Head>
  <title>Food Orders | NutriStudents K-12</title>
  <meta name="description" content="Food Orders">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <a href="#" class="link-color"><U>Planning</U></a>
    </BreadcrumLayout>
    <PageTitleLayout>
    <div class="w-full flex  justify-between md:items-center items-end">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold text-left">Orders</h1>
         <inertia-link
                                :href="route('CreateFoodOrders')"
                                class="
                                    
                                "
                            >
         <button class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 xl:mt-10">
          CREATE NEW ORDER
        </button></inertia-link>
      </div>
        
    </PageTitleLayout>
    <div class="searching xl:px-10 px-5 md:pt-10 pt-8 w-full">
    <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
  <div class="relative md:w-56">
    
  </div>

<svg class="mr-3 h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
</svg>
</header>
</div>

    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-auto">
           <table class="min-w-full">
          <thead class="header-bg-color">
            <tr>
              <th scope="col" class="w-1/6 id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative whitespace-nowrap">
                Creation Date<i class="fa fa-sort-asc food-orders" aria-hidden="true"></i> <i class="fa fa-sort-desc food-orders" aria-hidden="true"></i>
              </th>
              <th scope="col" class="w-1/6 px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider whitespace-nowrap">
                Site/Group
              </th>
             <th scope="col" class="w-1/6 px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider whitespace-nowrap">
                First Date
              </th>
              <th scope="col" class="w-1/6 px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider whitespace-nowrap">
               Last Date
              </th>
               <th scope="col" class="w-1/6 px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider whitespace-nowrap">
                Status
              </th>
              <th scope="col" class="w-1/6 px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider whitespace-nowrap">
                
              </th>
              
            </tr>
          </thead>
          <tbody>
            <!-- Odd row -->
            <tr class="bg-white">
                <td class="w-1/6 px-6 py-4 whitespace-nowrap text-base font-bold underline id-color uppercase">
                   APRIL 23, 2021
                </td>
                <td class="w-1/6 px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                   Fairmont
                </td>

                <td class="w-1/6 px-6 py-4 whitespace-nowrap text-base text-color">
                   March 17, 2021
                </td>
              
                <td class="w-1/6 px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    March 28, 2021
                </td>

                <td class="w-1/6 px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                   Completed
                </td>
               
                
                <td class="px-6 py-4 whitespace-nowrap  id-color text-xl  font-extrabold">
                    <i class="fa fa-download pr-3" aria-hidden="true"></i>
                     <inertia-link
                                :href="route('foodorder-detail')"
                                class="
                                    
                                "
                            >
                                  
                          
                     <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>  </inertia-link>
                     
                     <i class="fa fa-trash" aria-hidden="true"></i>
                </td>  
            </tr>

            <tr class="tr-background-color">
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color uppercase">
                   April 23, 2021
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                    Van Buren
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                    March 17, 2021
                </td>
              
                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    March 28, 2021
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    Draft
                </td>
               
                 

                 <td class="px-6 py-4 whitespace-nowrap  id-color text-xl  font-extrabold">
                    <i class="fa fa-download pr-3" aria-hidden="true"></i>
                      <inertia-link
                                :href="route('foodorder-detail')"
                                class="
                                    
                                "
                            >
                                  
                          
                     <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>  </inertia-link>
                     <i class="fa fa-trash" aria-hidden="true"></i>
                </td>  
            </tr>
             </tbody>
        </table>
          </div>
        </div>
      </div>

      <div class="float-left w-full flex justify-start px-10">
        <paginate :urlsArray="links"></paginate>
      </div>


      <div class="mt-12 flex justify-end pr-10 w-full mb-8">
       <inertia-link
                                :href="route('CreateFoodOrders')"
                                class="
                                    
                                "
                            >
        <button class="button-color text-white font-bold py-1.5 px-4 mb- rounded focus:outline-none">
           CREATE NEW ORDER
        </button> </inertia-link>
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
    top: 15px;
    left: 1px;
}
}

@media screen and (max-width: 1499px){
.id_arrow .fa-sort-asc.food-orders:before {
    content: "\f0de";
    color: #219FD5;
    padding-left: 7px;
    position: absolute;
    top: 16px;
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

}
</style>

