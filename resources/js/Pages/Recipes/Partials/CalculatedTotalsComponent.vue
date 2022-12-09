<template>
    <table class="min-w-full shadow rounded-t-lg overflow-hidden table-background">
              <thead>
                <tr class="">
                  <th scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider">
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

                <tr v-if="!sum_products_totals.length" class="bg-white">
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="15">Calculated totals not available!</td>
                </tr>


                <tr v-else v-for="sum_product_total in sum_products_totals" class="bg-white">
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div v-if="sum_product_total.MMA > 0 && sum_product_total.MMA != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.MMA)}}</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >                  
                  <div v-if="sum_product_total.WGR > 0 && sum_product_total.WGR != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.WGR)}}</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div v-if="sum_product_total.FRU > 0 && sum_product_total.FRU != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.FRU)}}</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div v-if="sum_product_total.MLK > 0 && sum_product_total.MLK != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.MLK)}}</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div v-if="sum_product_total.VEG > 0 && sum_product_total.VEG != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.VEG)}}</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div v-if="sum_product_total.DG > 0 && sum_product_total.DG != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.DG)}}</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                  
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div v-if="sum_product_total.RO > 0 && sum_product_total.RO != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.RO)}}</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div v-if="sum_product_total.LEG > 0 && sum_product_total.LEG != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.LEG)}}</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                  <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div v-if="sum_product_total.STAR > 0 && sum_product_total.STAR != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.STAR)}}</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >                  
                  <div v-if="sum_product_total.OTH > 0 && sum_product_total.OTH != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.OTH)}}</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >                  
                  <div v-if="sum_product_total.CALS > 0 && sum_product_total.CALS != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.CALS)}}cals</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >                  
                  <div v-if="sum_product_total.SOD > 0 && sum_product_total.SOD != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.SOD)}}mg</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div v-if="sum_product_total.FAT > 0 && sum_product_total.FAT != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.FAT)}}g</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div v-if="sum_product_total.PROT > 0 && sum_product_total.PROT != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.PROT)}}g</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                   <td
                    scope="col"
                    class="px-3 py-2 text-center text-sm font-white text-black uppercase tracking-wider"
                  >
                  <div v-if="sum_product_total.CARB > 0 && sum_product_total.CARB != null" class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{roundTwoDecimals(sum_product_total.CARB)}}g</div>
                  <div v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white"> - </div>
                  </td>
                </tr>


  </tbody>

  </table>

</template>

<script>
export default {
    
    props:['sum_products_totals'],
    name: "CalculatedTotalsComponent",
    data() {
        return {
            
        };
    },

    methods: {
    roundTwoDecimals(result){
        return +(result).toFixed(2);
    },
  },


};
</script>

<style>
</style>
