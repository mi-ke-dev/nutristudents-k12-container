<template>
<table class="min-w-full shadow overflow-hidden table-background">
              <thead>
                <tr class="th-heading-background">
                  <th scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" >MMA</th>
                  <th scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" >WGR</th>
                  <th scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" >FRU</th>
                  <th scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" >MLK</th>
                  <th scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" >VEG</th>
                </tr>
              </thead>
                <tbody>
                  <tr class="bg-white" v-if="Object.keys(mc_daily_sum_prod).length == 0">
                  <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider"><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div></td>
                  <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider"><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div></td>
                  <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider"><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div></td>
                  <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider"><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div></td>
                  <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider"><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div></td>
                  </tr>

                  <tr  v-if="Object.keys(mc_daily_sum_prod).length > 0">
                    <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider">                     
                        
                      <div :title="showMinMax('daily_min_usda_componenent_serving_meat', 'daily_max_usda_componenent_serving_meat')" v-if="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_meat, guideline_data.daily_max_usda_componenent_serving_meat, parseFloat(mc_daily_sum_prod.MMA)) != 'gray'" 
                      :class="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_meat, guideline_data.daily_max_usda_componenent_serving_meat, parseFloat(mc_daily_sum_prod.MMA)) == 'green'?'bg-button-color-green': 'bg-button-color'"   class="rounded min-w-min-button text-center text-white" >{{ getNames(mc_daily_sum_prod.MMA ) }}</div>

                      <div :title="showMinMax('daily_min_usda_componenent_serving_meat', 'daily_max_usda_componenent_serving_meat')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ getNames(mc_daily_sum_prod.MMA ) }}</div>

                    </td>

                    <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider">
                      
                      <div :title="showMinMax('daily_min_usda_componenent_serving_grain', 'daily_max_usda_componenent_serving_grain')" v-if="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_grain , guideline_data.daily_max_usda_componenent_serving_grain, parseFloat(mc_daily_sum_prod.WGR))!= 'gray'"  :class="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_grain , guideline_data.daily_max_usda_componenent_serving_grain, parseFloat(mc_daily_sum_prod.WGR)) == 'green'?'bg-button-color-green': 'bg-button-color'"   class="rounded min-w-min-button text-center text-white" >{{ getNames(mc_daily_sum_prod.WGR ) }}</div>
                      <div :title="showMinMax('daily_min_usda_componenent_serving_grain', 'daily_max_usda_componenent_serving_grain')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ getNames(mc_daily_sum_prod.WGR ) }}</div>

                      
                    </td>

                    <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider">
                      
                      <div :title="showMinMax('daily_min_usda_componenent_serving_fruit', 'daily_max_usda_componenent_serving_fruit')" v-if="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_fruit , guideline_data.daily_max_usda_componenent_serving_fruit, parseFloat(mc_daily_sum_prod.FRU)) != 'gray'"  :class="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_fruit , guideline_data.daily_max_usda_componenent_serving_fruit, parseFloat(mc_daily_sum_prod.FRU)) == 'green'?'bg-button-color-green': 'bg-button-color'"   class="rounded min-w-min-button text-center text-white" >{{ getNames(mc_daily_sum_prod.FRU ) }}</div>
                      <div :title="showMinMax('daily_min_usda_componenent_serving_fruit', 'daily_max_usda_componenent_serving_fruit')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ getNames(mc_daily_sum_prod.FRU ) }}</div>

                       
                    </td>

                    <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider">
                       
                      <div :title="showMinMax('daily_min_usda_componenent_serving_milk', 'daily_max_usda_componenent_serving_milk')" v-if="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_milk , guideline_data.daily_max_usda_componenent_serving_milk, parseFloat(mc_daily_sum_prod.MLK)) != 'gray'"   :class="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_milk , guideline_data.daily_max_usda_componenent_serving_milk, parseFloat(mc_daily_sum_prod.MLK)) == 'green'?'bg-button-color-green': 'bg-button-color'"   class="rounded min-w-min-button text-center text-white" >{{ getNames(mc_daily_sum_prod.MLK ) }}</div>
                      <div :title="showMinMax('daily_min_usda_componenent_serving_milk', 'daily_max_usda_componenent_serving_milk')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ getNames(mc_daily_sum_prod.MLK ) }}</div>

                       
                    </td>

                    <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider">
                   
                      <div :title="showMinMax('daily_min_usda_componenent_serving_veg', 'daily_max_usda_componenent_serving_veg')" v-if="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_veg , guideline_data.daily_max_usda_componenent_serving_veg, parseFloat(mc_daily_sum_prod.VEG)) != 'gray'"  :class="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_veg , guideline_data.daily_max_usda_componenent_serving_veg, parseFloat(mc_daily_sum_prod.VEG)) == 'green'?'bg-button-color-green': 'bg-button-color'"   class="rounded min-w-min-button text-center text-white" >{{ getNames(mc_daily_sum_prod.VEG ) }}</div>
                      <div :title="showMinMax('daily_min_usda_componenent_serving_veg', 'daily_max_usda_componenent_serving_veg')" v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ getNames(mc_daily_sum_prod.VEG ) }}</div>

                       
                    </td>
                  </tr>

                  <tr class="th-heading-background">
                  <th scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" >DG</th>                  
                  <th scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" >R/O</th>
                  <th scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" >LEG</th>
                  <th scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" >STAR</th>
                  <th scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider" >OTH</th>
                 </tr>

                 <tr class="bg-white" v-if="Object.keys(mc_daily_sum_prod).length == 0">
                  <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider">
                    <div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div></td>
                  <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider"><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div></td>
                  <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider"><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div></td>
                  <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider"><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div></td>
                  <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider"><div class="button-bg-color-wed rounded min-w-min-button text-center text-white"></div></td>
                  </tr>

                 <tr v-if="Object.keys(mc_daily_sum_prod).length > 0">
                    <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider">
                       
                      <div :title="showMinMax('daily_min_usda_componenent_serving_veggrn', 'daily_max_usda_componenent_serving_veggrn')"  v-if="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_veggrn , guideline_data.daily_max_usda_componenent_serving_veggrn, parseFloat(mc_daily_sum_prod.DG)) != 'gray'"  :class="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_veggrn , guideline_data.daily_max_usda_componenent_serving_veggrn, parseFloat(mc_daily_sum_prod.DG)) == 'green'?'bg-button-color-green': 'bg-button-color'"   class="rounded min-w-min-button text-center text-white" >{{ getNames(mc_daily_sum_prod.DG ) }}</div>
                      <div :title="showMinMax('daily_min_usda_componenent_serving_veggrn', 'daily_max_usda_componenent_serving_veggrn')"   v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ getNames(mc_daily_sum_prod.DG ) }}</div>

                      
                    </td>

                    <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider">
                       
                      <div  :title="showMinMax('daily_min_usda_componenent_serving_vegred', 'daily_max_usda_componenent_serving_vegred')"  v-if="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_vegred , guideline_data.daily_max_usda_componenent_serving_vegred, parseFloat(mc_daily_sum_prod.RO)) != 'gray'"  :class="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_vegred , guideline_data.daily_max_usda_componenent_serving_vegred, parseFloat(mc_daily_sum_prod.RO)) == 'green'?'bg-button-color-green': 'bg-button-color'"   class="rounded min-w-min-button text-center text-white" >{{ getNames(mc_daily_sum_prod.RO ) }}</div>
                      <div :title="showMinMax('daily_min_usda_componenent_serving_vegred', 'daily_max_usda_componenent_serving_vegred')"  v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ getNames(mc_daily_sum_prod.RO ) }}</div>

                     
                    </td>

                    <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider">
                      
                      <div  :title="showMinMax('daily_min_usda_componenent_serving_vegleg', 'daily_max_usda_componenent_serving_vegleg')"  v-if="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_vegleg , guideline_data.daily_max_usda_componenent_serving_vegleg, parseFloat(mc_daily_sum_prod.LEG)) != 'gray'"  :class="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_vegleg , guideline_data.daily_max_usda_componenent_serving_vegleg, parseFloat(mc_daily_sum_prod.LEG)) == 'green'?'bg-button-color-green': 'bg-button-color'"   class="rounded min-w-min-button text-center text-white" >{{ getNames(mc_daily_sum_prod.LEG ) }}</div>
                      <div :title="showMinMax('daily_min_usda_componenent_serving_vegleg', 'daily_max_usda_componenent_serving_vegleg')"  v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ getNames(mc_daily_sum_prod.LEG ) }}</div>

                       
                    </td>

                    <td scope="col" class="px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider">
                       
                      <div  :title="showMinMax('daily_min_usda_componenent_serving_vegstar', 'daily_max_usda_componenent_serving_vegstar')"  v-if="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_vegstar , guideline_data.daily_max_usda_componenent_serving_vegstar, parseFloat(mc_daily_sum_prod.STAR)) != 'gray'"  :class="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_vegstar , guideline_data.daily_max_usda_componenent_serving_vegstar, parseFloat(mc_daily_sum_prod.STAR)) == 'green'?'bg-button-color-green': 'bg-button-color'"   class="rounded min-w-min-button text-center text-white" >{{ getNames(mc_daily_sum_prod.STAR ) }}</div>
                      <div :title="showMinMax('daily_min_usda_componenent_serving_vegstar', 'daily_max_usda_componenent_serving_vegstar')"  v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ getNames(mc_daily_sum_prod.STAR ) }}</div>

                      
                    </td>

                    <td scope="col" class=" px-1 py-2 text-center text-xs font-white text-black uppercase tracking-wider">
                       
                      <div  :title="showMinMax('daily_min_usda_componenent_serving_vegothr', 'daily_max_usda_componenent_serving_vegothr')"  v-if="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_vegothr ,guideline_data.daily_max_usda_componenent_serving_vegothr, parseFloat(mc_daily_sum_prod.OTH)) != 'gray'"  :class="checkGuildLineVals(guideline_data.daily_min_usda_componenent_serving_vegothr ,guideline_data.daily_max_usda_componenent_serving_vegothr, parseFloat(mc_daily_sum_prod.OTH)) == 'green'?'bg-button-color-green': 'bg-button-color'"   class="rounded min-w-min-button text-center text-white" >{{ getNames(mc_daily_sum_prod.OTH ) }}</div>

                      <div :title="showMinMax('daily_min_usda_componenent_serving_vegothr', 'daily_max_usda_componenent_serving_vegothr')"  v-else class="bg-button-color-gray rounded min-w-min-button text-center text-white">{{ getNames(mc_daily_sum_prod.OTH ) }}</div>

                      
                    </td>
                    
                 </tr>

                  

                </tbody>  
</table>
</template>

<script>
export default {
    
    props:['guideline_data','mc_daily_sum_prod'],
    components: {},
    name: "WeekDayTotals",
    data() {
        return {
        
        };
    },

    methods: {
      showMinMax(min, max){
      let gline = this.guideline_data;
      var rText = 'Minimum: ';
      if(gline[min] && gline[min] > 0){
        rText += gline[min];
      } else {
        rText += 'n/a';
      }
      rText += ', Maximum: ';
      if(gline[max] && gline[max] > 0){
        rText += gline[max];
      } else {
        rText += 'n/a';
      }
      return rText;
    },
      getNames(names){
        if(names > 0){
          return names;
        } else {
          return ' - ';
        }
      },
      checkGuildLineVals(gMin, gMax, cVal){
        // console.log("checkGuildLineVals gMin, gMax, cVal  ",gMin, gMax, cVal);
        // check guildline min or max value for is not null or 0
        if(this.$helpers.checkIntOrNotNull(gMin) || this.$helpers.checkIntOrNotNull(gMax)){
          let returnVal = 'green';
          // check guidline min value is not null or 0
          if(this.$helpers.checkIntOrNotNull(gMin)){
            
            // check guidline min value <= cVal
            if(this.$helpers.checkIntOrNotNull(cVal) && gMin <= cVal){
              // return 'green';
            } else {
              // console.log("this.$helpers.checkIntOrNotNull(cVal)", this.$helpers.checkIntOrNotNull(cVal));
              returnVal = 'red';
            }
          }

          // check guidline max value is not null or 0
          if(this.$helpers.checkIntOrNotNull(gMax)){
            // check guidline max value <= cVal
            if(this.$helpers.checkIntOrNotNull(cVal) && gMax >= cVal  ){
              // returnVal = 'green';
            } else {
              returnVal = 'gray';              
            }
          }

          return returnVal;

        } else {
          return 'gray';
        }
      }
    }


};
</script>