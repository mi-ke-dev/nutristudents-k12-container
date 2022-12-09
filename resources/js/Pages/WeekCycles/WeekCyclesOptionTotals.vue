<template>

  <header class="mt-10 searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg w-">
   <h2 class="text-white text-lg font-bold w-11/12">Option Calculated Totals</h2>
   <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2 font-bold" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
</svg> -->
      
  </header>

          <div class="flex flex-col mb-6">
            <div class="overflow-x-auto">
              <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
                   <table
              class="min-w-full shadow rounded-t-lg overflow-hidden table-background"
            >
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

                

                <tr v-if="!Object.keys(avg_products).length" class="bg-white">
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="15">Totals are not available!</td>
                </tr>

                <tr v-else  class="bg-white">
                <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="text-xs bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.MMA}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.WGR}}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.FRU}}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.MLK}}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.VEG}}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.DG}}</div>
                  </td>
                  
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.RO}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.LEG}}</div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.STAR}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.OTH}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.CALS}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center px-2 text-white">{{avg_products.SOD}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.FAT}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.PROT}}</div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-xs font-white text-black uppercase tracking-wider"
                  >
                  <div class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{avg_products.CARB}}</div>
                  </td>
                </tr>
                
  
  </tbody>

  </table>
  </div>
  </div>
  </div>
  </div>
</template>

<script>

export default {
    
    props:['avg_products'],

    components: {   

    },

    name: "WeekCyclesOptionTotals",
    data() {
        return {
           
        };
    },

    methods: {
      
    },


};

</script>