import conversions from '@/Pages/VueClasses/RecipeIngredientsPrototype/conversions';
export default {
    uomType(val) {
        const weight = [            
            'Ounce',
            'Gram',
            'LB',
        ];

        const volume = [
            'Gallon',
            'Quart',
            'Pint',
            'Cup',
            'Fluid Ounce',
            'Tablespoon',
            'Teaspoon',
        ];

        const unit = [            
            'Each',
        ];

        if (unit.includes(val))
        {
            return "Unit"
        }
        if (volume.includes(val))
        {
            return "Volume"
        }
        if (weight.includes(val))
        {
            return "Weight"
        }

        return "Not Found"
    },


    preferProductsCalculatedTotals(ing_prefer_products){
         
         let scale_val = 1;

         let sum_product_data = [];  

         let total_num = ing_prefer_products.length;   
         console.log("preferProductsCalculatedTotals ", ing_prefer_products);
       
         if(total_num > 0){

         let sum1 = 0, sum2 = 0, sum3 = 0, sum4 = 0, sum5 = 0, sum6 = 0, sum7 = 0, sum8 = 0, sum9 = 0, sum10 = 0, sum11 = 0, sum12 = 0, sum13 = 0, sum14 = 0, sum15 = 0;
         for (let i = 0; i < ing_prefer_products.length; i++) {

            scale_val = this.getNutritionScaleFactor(ing_prefer_products[i]);
            console.log("preferProductsCalculatedTotals in  ", ing_prefer_products[i]);
            
            sum1 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_mma') || 0;
            sum2 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_wgr') || 0;
            sum3 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_fru') || 0;
            sum4 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_mlk') || 0;
            sum5 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_veg') || 0;
            sum6 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_dg') || 0;
            sum7 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_ro') || 0;
            sum8 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_leg') || 0;
            sum9 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_star') || 0;
            sum10 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_other') || 0;
            sum11 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_nut_calories') * scale_val || 0;
            sum12 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_nut_sodium') * scale_val || 0;
            sum13 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_nut_totalfat') * scale_val || 0;
            sum14 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_nut_protein') * scale_val || 0;
            sum15 += this.getIngPreferProductComponentVal(ing_prefer_products[i],'component_nut_carbs') * scale_val || 0;            
         
         }         

         sum_product_data = [{
                              'MMA': this.roundTwoDecimals(sum1), 
                              'WGR': this.roundTwoDecimals(sum2), 
                              'FRU': this.roundTwoDecimals(sum3), 
                              'MLK': this.roundTwoDecimals(sum4), 
                              'VEG': this.roundTwoDecimals(sum5), 
                              'DG':  this.roundTwoDecimals(sum6),                              
                              'RO':  this.roundTwoDecimals(sum7),
                              'LEG': this.roundTwoDecimals(sum8),
                              'STAR':this.roundTwoDecimals(sum9),
                              'OTH': this.roundTwoDecimals(sum10),
                              'CALS':this.roundTwoDecimals(sum11),
                              'SOD': this.roundTwoDecimals(sum12),
                              'FAT': this.roundTwoDecimals(sum13),
                              'PROT':this.roundTwoDecimals(sum14),
                              'CARB':this.roundTwoDecimals(sum15),
                             }];
        }        

        return sum_product_data;
    },


    getIngPreferProductComponentVal(ing_prefer_product, type){
       let optional_type = 'optional_' +type;
       
       if(ing_prefer_product[optional_type] !== null && ing_prefer_product[optional_type] !== undefined){          
          return parseFloat(ing_prefer_product[optional_type]);
       }else{
          return parseFloat(ing_prefer_product[type]);
       }

    },


    getNutritionScaleFactor(ing_product) {      
      
      let ing_amount = ing_product.serving_amount;
      let ing_uom = ing_product.serving_amount_uom;

      let ing_uom_type = this.uomType(ing_uom);

      if (ing_amount === null) return 0;

      /////////get scale factor

      // let baseAmount = null
      // let baseAmountUoM = null
      // let convertedAmount = null

      // if (ing_uom_type === 'Weight') {
      //   baseAmount = ing_product.preferred_product_information.measurement_serving_weight;
      //   baseAmountUoM = ing_product.preferred_product_information.measurement_serving_weight_uom;
      //   convertedAmount = conversions.weight(baseAmount, baseAmountUoM, ing_uom);
      // }

      // if (ing_uom_type === 'Volume') {
      //   baseAmount = ing_product.preferred_product_information.measurement_serving_volume;
      //   baseAmountUoM = ing_product.preferred_product_information.measurement_serving_volume_uom;
      //   convertedAmount = conversions.volume(baseAmount, baseAmountUoM, ing_uom);
      // }

      // if (ing_uom_type === 'Unit') {
      //   baseAmount = ing_product.preferred_product_information.measurement_serving_unit;
      //   convertedAmount = baseAmount;
      // }

      // let scale_factor = ing_amount / convertedAmount;

      let base_amount = null;
      let base_uom = null;

      if (ing_uom_type == "Unit"){
        if (ing_product.preferred_product_information.measurement_serving_unit !== null) {
        base_amount = ing_product.preferred_product_information.measurement_serving_unit;
        base_uom = ing_product.preferred_product_information.measurement_serving_unit_uom;
        }
      }

      if (ing_uom_type == "Weight"){
        if(ing_product.preferred_product_information.measurement_serving_volume !== null) {
        base_amount = ing_product.preferred_product_information.measurement_serving_volume;
        base_uom = ing_product.preferred_product_information.measurement_serving_volume_uom;
        }
        if(ing_product.preferred_product_information.measurement_serving_weight !== null) {
        base_amount = ing_product.preferred_product_information.measurement_serving_weight;
        base_uom = ing_product.preferred_product_information.measurement_serving_weight_uom;
        }
      }

      if (ing_uom_type == "Volume"){
        if(ing_product.preferred_product_information.measurement_serving_weight !== null) {
        base_amount = ing_product.preferred_product_information.measurement_serving_weight;
        base_uom = ing_product.preferred_product_information.measurement_serving_weight_uom;
        }
        if(ing_product.preferred_product_information.measurement_serving_volume !== null) {
        base_amount = ing_product.preferred_product_information.measurement_serving_volume;
        base_uom = ing_product.preferred_product_information.measurement_serving_volume_uom;
        }
      } 
      
      
      const newUom = base_uom;
      const oldUom = ing_uom;

      const newUomType = this.uomType(newUom);
      const oldUomType = this.uomType(oldUom);      

      const initAmount = ing_amount;
      let newAmount = null;

      if (newUomType === oldUomType && newUomType === 'Weight') {
        newAmount = conversions.weight(initAmount, oldUom, newUom);
      }

      if (newUomType === oldUomType && newUomType === 'Volume') {
        newAmount = conversions.volume(initAmount, oldUom, newUom);
      }

      if (newUomType === 'Weight' && oldUomType === 'Volume') {
        newAmount = conversions.volumeToWeight(ing_product.preferred_product_information, initAmount, oldUom, newUom)
      }

      if (newUomType === 'Volume' && oldUomType === 'Weight') {
        newAmount = conversions.weightToVolume(ing_product.preferred_product_information, initAmount, oldUom, newUom)
      }

      if (newUomType === oldUomType && newUomType === 'Unit') {
        newAmount = initAmount;
      }      
      
      let scale_factor =  newAmount / base_amount;

      // console.log('Nutrition_scale_factor', scale_factor);

      if(isFinite(scale_factor) && !isNaN(scale_factor) && scale_factor !== null){        
        return scale_factor;
      }else{
        return 0;
      }      
      
    },

/****************************** Week Cycle ************************************/

    // week/menu cycle avg calculated weekly totals...


    avg_products_week_setup(avg_ing_prefer_products){ 

        let sum_final_products_weekly = [];
        let scale_val = 1;
  
        let sum1 = 0,sum2 = 0,sum3 = 0,sum4 = 0,sum5 = 0,sum6 = 0,sum7 = 0,sum8 = 0,sum9 = 0,sum10 = 0,sum11 = 0,sum12 = 0,sum13 = 0,sum14 = 0,sum15 = 0,final_total = 0;
       
        for(let one=0; one < avg_ing_prefer_products.length; one++){
        
        for(let two=0; two < avg_ing_prefer_products[one].length; two++){
         
         let ing_prefer_products = avg_ing_prefer_products[one][two];
         
         if(ing_prefer_products.length > 0)
         {                       

         for (let i = 0; i < ing_prefer_products.length; i++) {     

         scale_val = this.getMenuClycleNutritionScaleFactor(ing_prefer_products[i]);       
            
            sum1 += parseFloat(ing_prefer_products[i]['usda_componenent_serving_meat']) || 0;
            sum2 += parseFloat(ing_prefer_products[i]['usda_componenent_serving_grain']) || 0;
            sum3 += parseFloat(ing_prefer_products[i]['usda_componenent_serving_fruit']) || 0;
            sum4 += parseFloat(ing_prefer_products[i]['usda_componenent_serving_milk']) || 0;
            sum5 += parseFloat(ing_prefer_products[i]['usda_componenent_serving_veg']) || 0;
            sum6 += parseFloat(ing_prefer_products[i]['usda_componenent_serving_veggrn']) || 0;
            sum7 += parseFloat(ing_prefer_products[i]['usda_componenent_serving_vegred']) || 0;
            sum8 += parseFloat(ing_prefer_products[i]['usda_componenent_serving_vegleg']) || 0;
            sum9 += parseFloat(ing_prefer_products[i]['usda_componenent_serving_vegstar']) || 0;
            sum10 += parseFloat(ing_prefer_products[i]['usda_componenent_serving_vegothr']) || 0;

            // sum11 += parseFloat(ing_prefer_products[i]['nutrition_facts_calories']) || 0;
            // sum12 += parseFloat(ing_prefer_products[i]['nutrition_facts_sodium']) || 0;
            // sum13 += parseFloat(ing_prefer_products[i]['nutrition_facts_totalfat']) || 0;
            // sum14 += parseFloat(ing_prefer_products[i]['nutrition_facts_protein']) || 0;
            // sum15 += parseFloat(ing_prefer_products[i]['nutrition_facts_carbs']) || 0;

            sum11 += parseFloat(ing_prefer_products[i]['nutrition_facts_calories']) * scale_val || 0;
            sum12 += parseFloat(ing_prefer_products[i]['nutrition_facts_sodium']) * scale_val || 0;
            sum13 += parseFloat(ing_prefer_products[i]['nutrition_facts_totalfat']) * scale_val || 0;
            sum14 += parseFloat(ing_prefer_products[i]['nutrition_facts_protein']) * scale_val || 0;
            sum15 += parseFloat(ing_prefer_products[i]['nutrition_facts_carbs']) * scale_val || 0;
            
         }
         
         
         }
         }
        } 

         sum_final_products_weekly = [{
                              'MMA':this.roundTwoDecimals(sum1), 
                              'WGR':this.roundTwoDecimals(sum2), 
                              'FRU':this.roundTwoDecimals(sum3), 
                              'MLK':this.roundTwoDecimals(sum4), 
                              'VEG':this.roundTwoDecimals(sum5), 
                              'DG':this.roundTwoDecimals(sum6),                              
                              'RO':this.roundTwoDecimals(sum7),
                              'LEG':this.roundTwoDecimals(sum8),
                              'STAR':this.roundTwoDecimals(sum9), 
                              'OTH':this.roundTwoDecimals(sum10),
                              'CALS':this.roundTwoDecimals(sum11, 'cals'),
                              'SOD':this.roundTwoDecimals(sum12, 'mg'),
                              'FAT':this.roundTwoDecimals(sum13, 'g'),
                              'PROT':this.roundTwoDecimals(sum14, 'g'),
                              'CARB':this.roundTwoDecimals(sum15, 'g'),
                            }];

         //console.log(sum_final_products_weekly);
         return sum_final_products_weekly;

           
    },

   // week/menu cycle sum calculated daily totals...

    sum_products_daily_setup(ing_prefer_products){  
    //console.log('---',ing_prefer_products);
    let sum_products_daily = [];  

    if(ing_prefer_products.length > 0){

    let sum1 = 0,sum2 = 0,sum3 = 0,sum4 = 0,sum5 = 0,sum6 = 0,sum7 = 0,sum8 = 0,sum9 = 0,sum10 = 0,sum11 = 0,sum12 = 0,sum13 = 0,sum14 = 0,sum15 = 0;
      
      for(let index=0; index < ing_prefer_products.length; index++){
      
         let total_num = ing_prefer_products[index].length;
         
         if(total_num > 0)
         {

         for (let i = 0; i < total_num; i++) {            
            
            sum1 += parseFloat(ing_prefer_products[index][i]['usda_componenent_serving_meat']) || 0
            sum2 += parseFloat(ing_prefer_products[index][i]['usda_componenent_serving_grain']) || 0
            sum3 += parseFloat(ing_prefer_products[index][i]['usda_componenent_serving_fruit']) || 0
            sum4 += parseFloat(ing_prefer_products[index][i]['usda_componenent_serving_milk']) || 0
            sum5 += parseFloat(ing_prefer_products[index][i]['usda_componenent_serving_veg']) || 0
            sum6 += parseFloat(ing_prefer_products[index][i]['usda_componenent_serving_veggrn']) || 0
            sum7 += parseFloat(ing_prefer_products[index][i]['usda_componenent_serving_vegred']) || 0
            sum8 += parseFloat(ing_prefer_products[index][i]['usda_componenent_serving_vegleg']) || 0
            sum9 += parseFloat(ing_prefer_products[index][i]['usda_componenent_serving_vegstar']) || 0
            sum10 += parseFloat(ing_prefer_products[index][i]['usda_componenent_serving_vegothr']) || 0
            
         }        
                 
         }
         }
         
         sum_products_daily = [{
                              'MMA':this.roundTwoDecimals(sum1), 
                              'WGR':this.roundTwoDecimals(sum2), 
                              'FRU':this.roundTwoDecimals(sum3), 
                              'MLK':this.roundTwoDecimals(sum4), 
                              'VEG':this.roundTwoDecimals(sum5), 
                              'DG':this.roundTwoDecimals(sum6),                              
                              'RO':this.roundTwoDecimals(sum7),
                              'LEG':this.roundTwoDecimals(sum8),
                              'STAR':this.roundTwoDecimals(sum9), 
                              'OTH':this.roundTwoDecimals(sum10),
                            }];
                     
         }

         return sum_products_daily;       
    },


    sum_products_week_popup_totals(ing_prefer_productss){    
         let avg_products = [];

         let total_num = ing_prefer_productss.length;
         let scale_val = 1;

         if(total_num > 0)
         {

         let sum1 = 0, sum2 = 0, sum3 = 0, sum4 = 0, sum5 = 0, sum6 = 0, sum7 = 0, sum8 = 0, sum9 = 0, sum10 = 0, sum11 = 0, sum12 = 0, sum13 = 0, sum14 = 0 , sum15 = 0;         
          
         for (let i = 0; i < total_num; i++) {   

         scale_val = this.getMenuClycleNutritionScaleFactor(ing_prefer_productss[i]);         
            
            sum1 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_meat']) || 0;
            sum2 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_grain']) || 0;
            sum3 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_fruit']) || 0;
            sum4 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_milk']) || 0;
            sum5 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_veg']) || 0;
            sum6 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_veggrn']) || 0;
            sum7 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_vegred']) || 0;
            sum8 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_vegleg']) || 0;
            sum9 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_vegstar']) || 0;
            sum10 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_vegothr']) || 0;

            sum11 += parseFloat(ing_prefer_productss[i]['nutrition_facts_calories']) * scale_val || 0;
            sum12 += parseFloat(ing_prefer_productss[i]['nutrition_facts_sodium']) * scale_val || 0;
            sum13 += parseFloat(ing_prefer_productss[i]['nutrition_facts_totalfat']) * scale_val || 0;
            sum14 += parseFloat(ing_prefer_productss[i]['nutrition_facts_protein']) * scale_val || 0;
            sum15 += parseFloat(ing_prefer_productss[i]['nutrition_facts_carbs']) * scale_val || 0;
            
         }     
         
         avg_products = [{
                              'MMA':this.roundTwoDecimals(sum1), 
                              'WGR':this.roundTwoDecimals(sum2), 
                              'FRU':this.roundTwoDecimals(sum3), 
                              'MLK':this.roundTwoDecimals(sum4), 
                              'VEG':this.roundTwoDecimals(sum5), 
                              'DG':this.roundTwoDecimals(sum6),                            
                              'RO':this.roundTwoDecimals(sum7),
                              'LEG':this.roundTwoDecimals(sum8),
                              'STAR':this.roundTwoDecimals(sum9),
                              'OTH':this.roundTwoDecimals(sum10),
                              'CALS':this.roundTwoDecimals(sum11, 'cals'),
                              'SOD':this.roundTwoDecimals(sum12, 'mg'),
                              'FAT':this.roundTwoDecimals(sum13, 'g'),
                              'PROT':this.roundTwoDecimals(sum14, 'g'),
                              'CARB':this.roundTwoDecimals(sum15, 'g'),
                        }];
         }
         return avg_products;
    },

    sum_products_week_popup_totals_new(ing_prefer_productss){   
           let avg_products = {};
  
           let total_num = ing_prefer_productss.length;
           let scale_val = 1;
  
           if(total_num > 0)
           {
  
           let sum1 = 0, sum2 = 0, sum3 = 0, sum4 = 0, sum5 = 0, sum6 = 0, sum7 = 0, sum8 = 0, sum9 = 0, sum10 = 0, sum11 = 0, sum12 = 0, sum13 = 0, sum14 = 0 , sum15 = 0; 

      let calfat = 0, satfat = 0, transfat = 0, polysatfat = 0, monosatfat = 0, cholesterol = 0, potassium = 0, fiber = 0, sugar = 0, vitamina = 0, vitaminb6 = 0, vitaminb12 = 0, vitaminc = 0, vitamind = 0, vitamine = 0, calcium = 0, iron = 0, magnesium = 0, coblamin = 0, thiamin = 0, riboflavin = 0, niacin = 0, zinc = 0, water = 0, ash  = 0;

            
           for (let i = 0; i < total_num; i++) {   
  
           scale_val = this.getMenuClycleNutritionScaleFactor(ing_prefer_productss[i]);         
              
              sum1 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_meat']) || 0;
              sum2 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_grain']) || 0;
              sum3 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_fruit']) || 0;
              sum4 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_milk']) || 0;
              sum5 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_veg']) || 0;
              sum6 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_veggrn']) || 0;
              sum7 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_vegred']) || 0;
              sum8 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_vegleg']) || 0;
              sum9 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_vegstar']) || 0;
              sum10 += parseFloat(ing_prefer_productss[i]['usda_componenent_serving_vegothr']) || 0;
  
              sum11 += parseFloat(ing_prefer_productss[i]['nutrition_facts_calories']) * scale_val || 0;
              sum12 += parseFloat(ing_prefer_productss[i]['nutrition_facts_sodium']) * scale_val || 0;
              sum13 += parseFloat(ing_prefer_productss[i]['nutrition_facts_totalfat']) * scale_val || 0;
              sum14 += parseFloat(ing_prefer_productss[i]['nutrition_facts_protein']) * scale_val || 0;
              sum15 += parseFloat(ing_prefer_productss[i]['nutrition_facts_carbs']) * scale_val || 0;

              calfat+= parseFloat(ing_prefer_productss[i]['nutrition_facts_calfat']) * scale_val || 0;
              satfat+= parseFloat(ing_prefer_productss[i]['nutrition_facts_satfat']) * scale_val || 0;
              transfat+= parseFloat(ing_prefer_productss[i]['nutrition_facts_transfat']) * scale_val || 0;
              polysatfat+= parseFloat(ing_prefer_productss[i]['nutrition_facts_polysatfat']) * scale_val || 0;
              monosatfat+= parseFloat(ing_prefer_productss[i]['nutrition_facts_monosatfat']) * scale_val || 0;
              cholesterol+= parseFloat(ing_prefer_productss[i]['nutrition_facts_cholesterol']) * scale_val || 0;
              potassium+= parseFloat(ing_prefer_productss[i]['nutrition_facts_potassium']) * scale_val || 0;
              fiber+= parseFloat(ing_prefer_productss[i]['nutrition_facts_fiber']) * scale_val || 0;
              sugar+= parseFloat(ing_prefer_productss[i]['nutrition_facts_sugar']) * scale_val || 0;
              vitamina+= parseFloat(ing_prefer_productss[i]['nutrition_facts_vitamina']) * scale_val || 0;
              vitaminb6+= parseFloat(ing_prefer_productss[i]['nutrition_facts_vitaminb6']) * scale_val || 0;
              vitaminb12+= parseFloat(ing_prefer_productss[i]['nutrition_facts_vitaminb12']) * scale_val || 0;
              vitaminc+= parseFloat(ing_prefer_productss[i]['nutrition_facts_vitaminc']) * scale_val || 0;
              vitamind+= parseFloat(ing_prefer_productss[i]['nutrition_facts_vitamind']) * scale_val || 0;
              vitamine+= parseFloat(ing_prefer_productss[i]['nutrition_facts_vitamine']) * scale_val || 0;
              calcium+= parseFloat(ing_prefer_productss[i]['nutrition_facts_calcium']) * scale_val || 0;
              iron+= parseFloat(ing_prefer_productss[i]['nutrition_facts_iron']) * scale_val || 0;
              magnesium+= parseFloat(ing_prefer_productss[i]['nutrition_facts_magnesium']) * scale_val || 0;
              coblamin+= parseFloat(ing_prefer_productss[i]['nutrition_facts_coblamin']) * scale_val || 0;
              thiamin+= parseFloat(ing_prefer_productss[i]['nutrition_facts_thiamin']) * scale_val || 0;
              riboflavin+= parseFloat(ing_prefer_productss[i]['nutrition_facts_riboflavin']) * scale_val || 0;
              niacin+= parseFloat(ing_prefer_productss[i]['nutrition_facts_niacin']) * scale_val || 0;
              zinc+= parseFloat(ing_prefer_productss[i]['nutrition_facts_zinc']) * scale_val || 0;
              water+= parseFloat(ing_prefer_productss[i]['nutrition_facts_water']) * scale_val || 0;
              ash+= parseFloat(ing_prefer_productss[i]['nutrition_facts_ash']) * scale_val || 0;

              
           } 
           
           console.log("check FRU sum3", sum3, this.roundTwoDecimalsNew(sum3));
           
           avg_products = {
                                'MMA':this.roundTwoDecimalsNew(sum1), 
                                'WGR':this.roundTwoDecimalsNew(sum2), 
                                'FRU':this.roundTwoDecimalsNew(sum3), 
                                'MLK':this.roundTwoDecimalsNew(sum4), 
                                'VEG':this.roundTwoDecimalsNew(sum5), 
                                'DG':this.roundTwoDecimalsNew(sum6),                            
                                'RO':this.roundTwoDecimalsNew(sum7),
                                'LEG':this.roundTwoDecimalsNew(sum8),
                                'STAR':this.roundTwoDecimalsNew(sum9),
                                'OTH':this.roundTwoDecimalsNew(sum10),
                                'CALS':this.roundTwoDecimalsNew(sum11),
                                'SOD':this.roundTwoDecimalsNew(sum12 ),
                                'FAT':this.roundTwoDecimalsNew(sum13 ),
                                'PROT':this.roundTwoDecimalsNew(sum14 ),
                                'CARB':this.roundTwoDecimalsNew(sum15 ),

                                'calfat':this.roundTwoDecimalsNew(calfat ),
                                'satfat':this.roundTwoDecimalsNew(satfat ),
                                'transfat':this.roundTwoDecimalsNew(transfat ),
                                'polysatfat':this.roundTwoDecimalsNew(polysatfat ),
                                'monosatfat':this.roundTwoDecimalsNew(monosatfat ),
                                'cholesterol':this.roundTwoDecimalsNew(cholesterol ),
                                'potassium':this.roundTwoDecimalsNew(potassium ),
                                'fiber':this.roundTwoDecimalsNew(fiber ),
                                'sugar':this.roundTwoDecimalsNew(sugar ),
                                'vitamina':this.roundTwoDecimalsNew(vitamina ),
                                'vitaminb6':this.roundTwoDecimalsNew(vitaminb6 ),
                                'vitaminb12':this.roundTwoDecimalsNew(vitaminb12 ),
                                'vitaminc':this.roundTwoDecimalsNew(vitaminc ),
                                'vitamind':this.roundTwoDecimalsNew(vitamind ),
                                'vitamine':this.roundTwoDecimalsNew(vitamine ),
                                'calcium':this.roundTwoDecimalsNew(calcium ),
                                'iron':this.roundTwoDecimalsNew(iron ),
                                'magnesium':this.roundTwoDecimalsNew(magnesium ),
                                'coblamin':this.roundTwoDecimalsNew(coblamin ),
                                'thiamin':this.roundTwoDecimalsNew(thiamin ),
                                'riboflavin':this.roundTwoDecimalsNew(riboflavin ),
                                'niacin':this.roundTwoDecimalsNew(niacin ),
                                'zinc':this.roundTwoDecimalsNew(zinc ),
                                'water':this.roundTwoDecimalsNew(water ),
                                'ash':this.roundTwoDecimalsNew(ash )
                          };
           }
           return avg_products;
      },

      roundTwoDecimalsNew(result, unit=null){

        if(result == 0 || isNaN(result) || !isFinite(result)){
        return result;
        }else{
          
          let string = result.toString();
          let array = string.split('.');
          let firstNumber  = +array[0]; 
          let secondNumber = +array[1];
          let newEighthValue = secondNumber/8;
          let nearestValue = '.' + newEighthValue * 7;
          let newValue = parseFloat(firstNumber) + parseFloat(nearestValue);

          // if(!isNaN(firstNumber) && !isNaN(secondNumber)){
          //   let reslt = +(newValue).toFixed(3);        
          //   return reslt +unit;
          // }else{
            let reslt = +(result).toFixed(3);
            return reslt +unit;
          // }
        
        }
    },

    minus_products_week_popup_totals(product_avg,ing_prefer_productss){ 
        // console.log('ing_prefer_productss12434',ing_prefer_productss);
        // console.log('ing_prefer_productss124',ing_prefer_productss[0]);
        // console.log('ing_prefer_productss12',JSON.stringify(ing_prefer_productss));
        ing_prefer_productss.forEach((value,index) => {
          // console.log("ing_prefer_products_42343243",value); 
        }); 
         
        let avg_products = [];
    
        let total_num = ing_prefer_productss.length;
        // console.log("total_num",total_num); 
        let scale_val = 1;
        
        // if(total_num > 0)
        // {
          // console.log('product_avg.MMA',product_avg.MMA);
        let sum1 = product_avg.MMA, sum2 = product_avg.WGR, sum3 = product_avg.FRU, sum4 = product_avg.MLK, sum5 = product_avg.VEG, sum6 = product_avg.DG, sum7 =product_avg.RO, sum8 = product_avg.LEG, sum9 =product_avg.STAR, sum10 = product_avg.OTH, sum11 = product_avg.CALS, sum12 = product_avg.SOD, sum13 = product_avg.FAT, sum14 =product_avg.PROT , sum15 = product_avg.CARB;         
        let i = 0;
        
        //for (let i = 0; i < total_num; i++) {   

           //scale_val = this.getMenuClycleNutritionScaleFactor(ing_prefer_productss[i]);          
            // sum1 -=  parseFloat(ing_prefer_productss[i]['usda_componenent_serving_meat']) || 0;
            // console.log('sum1',sum1);
            // sum2 -= parseFloat(ing_prefer_productss[i]['usda_componenent_serving_grain']) || 0;
            // sum3 -= parseFloat(ing_prefer_productss[i]['usda_componenent_serving_fruit']) || 0;
            // sum4 -= parseFloat(ing_prefer_productss[i]['usda_componenent_serving_milk']) || 0;
            // sum5 -= parseFloat(ing_prefer_productss[i]['usda_componenent_serving_veg']) || 0;
            // sum6 -= parseFloat(ing_prefer_productss[i]['usda_componenent_serving_veggrn']) || 0;
            // sum7 -= parseFloat(ing_prefer_productss[i]['usda_componenent_serving_vegred']) || 0;
            // sum8 -= parseFloat(ing_prefer_productss[i]['usda_componenent_serving_vegleg']) || 0;
            // sum9 -= parseFloat(ing_prefer_productss[i]['usda_componenent_serving_vegstar']) || 0;
            // sum10 -= parseFloat(ing_prefer_productss[i]['usda_componenent_serving_vegothr']) || 0;

            // sum11 -= parseFloat(ing_prefer_productss[i]['nutrition_facts_calories']) * scale_val || 0;
            // sum12 -= parseFloat(ing_prefer_productss[i]['nutrition_facts_sodium']) * scale_val || 0;
            // sum13 -= parseFloat(ing_prefer_productss[i]['nutrition_facts_totalfat']) * scale_val || 0;
            // sum14 -= parseFloat(ing_prefer_productss[i]['nutrition_facts_protein']) * scale_val || 0;
            // sum15 -= parseFloat(ing_prefer_productss[i]['nutrition_facts_carbs']) * scale_val || 0;
            
        //}     
        
        avg_products = [{
                              'MMA':this.roundTwoDecimals(sum1), 
                              'WGR':this.roundTwoDecimals(sum2), 
                              'FRU':this.roundTwoDecimals(sum3), 
                              'MLK':this.roundTwoDecimals(sum4), 
                              'VEG':this.roundTwoDecimals(sum5), 
                              'DG':this.roundTwoDecimals(sum6),                            
                              'RO':this.roundTwoDecimals(sum7),
                              'LEG':this.roundTwoDecimals(sum8),
                              'STAR':this.roundTwoDecimals(sum9),
                              'OTH':this.roundTwoDecimals(sum10),
                              'CALS':this.roundTwoDecimals(sum11, 'cals'),
                              'SOD':this.roundTwoDecimals(sum12, 'mg'),
                              'FAT':this.roundTwoDecimals(sum13, 'g'),
                              'PROT':this.roundTwoDecimals(sum14, 'g'),
                              'CARB':this.roundTwoDecimals(sum15, 'g'),
                        }];
        //}
        // console.log('min_avg_products',avg_products);
        return avg_products;
    },


    roundTwoDecimals(result, unit=null){

        if(result == 0 || isNaN(result) || !isFinite(result)){
        return ' - ';
        }else{
        let reslt = +(result).toFixed(3);        
        return reslt +unit;
        }
    },



    getMenuClycleNutritionScaleFactor(ing_product) {      
      
      let ing_amount = ing_product.serving_amount;
      let ing_uom = ing_product.serving_amount_uom;

      let ing_uom_type = this.uomType(ing_uom);

      if (ing_amount === null) return 0;

      /////////get scale factor

      let baseAmount = null
      let baseAmountUoM = null
      let convertedAmount = null

      if (ing_uom_type === 'Weight') {
        baseAmount = ing_product.serving_measurement_weight;
        baseAmountUoM = ing_product.serving_measurement_weight_uom_name;
        convertedAmount = conversions.weight(baseAmount, baseAmountUoM, ing_uom);
      }

      if (ing_uom_type === 'Volume') {
        baseAmount = ing_product.serving_measurement_volume;
        baseAmountUoM = ing_product.serving_measurement_volume_uom_name;
        convertedAmount = conversions.volume(baseAmount, baseAmountUoM, ing_uom);
      }

      if (ing_uom_type === 'Unit') {
        baseAmount = ing_product.serving_measurement_unit;
        convertedAmount = baseAmount;
      }

      let scale_factor = ing_amount / convertedAmount;      

      //console.log('Nutrition_scale_factor', scale_factor);

      if(isFinite(scale_factor) && !isNaN(scale_factor) && scale_factor !== null){        
        return scale_factor;
      }else{
        return 0;
      }
      
    }
    ,

    checkIsNull(cVal, ucVal){
      if(ucVal != null){
        if(cVal != null){
          console.log('checkIsNull',parseFloat(cVal),parseFloat(ucVal), this.ConvertToDecimal(parseFloat(cVal) + parseFloat(ucVal)))
          return this.ConvertToDecimal(parseFloat(cVal) + parseFloat(ucVal));
        } else {
          return ucVal;
        }
      } else {
        return cVal;
      }
    },

    ConvertToDecimal(num) {
      if(this.isFloat(num)){
        num = Math.round(num * 100) / 100;
        
        num = parseFloat(num);
       
        // return num;
        num = num.toString(); //If it's not already a String
        num = num.slice(0, (num.indexOf(".")) + 3); //With 3 exposing the hundredths place
       
        return Number(num);
      } else {
        return Number(num);
      }
      // return num;
      // num = Math.round(num * 100) / 100;
      // console.log('ConvertToDecimal', num);
      // num = parseFloat(num);
      // console.log('ConvertToDecimal is', parseFloat(num));
      // // return num;
      // num = num.toString(); //If it's not already a String
      // num = num.slice(0, (num.indexOf(".")) + 3); //With 3 exposing the hundredths place
      // console.log('return ConvertToDecimal l ', Number(num));
      // return Number(num);
    //  alert('M : ' +  Number(num)); //If you need it back as a Number    
    },
    isFloat(value) {
      if (
        typeof value === 'number' &&
        !Number.isNaN(value) &&
        !Number.isInteger(value)
      ) {
        return true;
      }
    
      return false;
    },

    checkIfNull(cVal, ucVal){
      if(cVal != null && parseFloat(cVal) >= 0 ){
        return cVal;
      } else {
        return ucVal
      }
    },

    getRecipeTotal(recipes){
      let $this = this;
      let total = this.getBlankObject();
      if(recipes.length > 0){
        const keys = Object.keys(total);
        recipes.forEach((value) => {
          console.log('asdfasdfasfsadfasdf',value);
          keys.forEach((key, index) => {
            if(value.is_override){
              //console.log("checkifnull ", key,value.total_val_override[key], value.total_val[key],  $this.checkIfNull(value.total_val_override[key], value.total_val[key]))
              total[key]= $this.checkIsNull(total[key], $this.checkIfNull(value.total_val_override[key], value.total_val[key]) );
            } else {
              total[key]= $this.checkIsNull(total[key], value.total_val[key]);
            }
            
            // console.log(`${key}: ${courses[key]}`);
          });          
        });
        return total;
      } else {
        return total;
      }
      
      
      // let total = [
      //   'MMA':this.roundTwoDecimals(sum1), 
      //   'WGR':this.roundTwoDecimals(sum2), 
      //   'FRU':this.roundTwoDecimals(sum3), 
      //   'MLK':this.roundTwoDecimals(sum4), 
      //   'VEG':this.roundTwoDecimals(sum5), 
      //   'DG':this.roundTwoDecimals(sum6),                            
      //   'RO':this.roundTwoDecimals(sum7),
      //   'LEG':this.roundTwoDecimals(sum8),
      //   'STAR':this.roundTwoDecimals(sum9),
      //   'OTH':this.roundTwoDecimals(sum10),
      //   'CALS':this.roundTwoDecimals(sum11, 'cals'),
      //   'SOD':this.roundTwoDecimals(sum12, 'mg'),
      //   'FAT':this.roundTwoDecimals(sum13, 'g'),
      //   'PROT':this.roundTwoDecimals(sum14, 'g'),
      //   'CARB':this.roundTwoDecimals(sum15, 'g'),
      // ];

    },

    getDayMinimumeValue(days){
      // console.log("days", days);
      let $this = this;
      let total = this.getBlankObject();
      // console.log("blank total", total);
      const keys = Object.keys(total);
      const nutration = this.getBlankNutration();
      if(days.length > 0){
        days.forEach((value) => {
          if(!value.a_la_carte){
            keys.forEach((key, index) => {
              if(nutration.includes(key)){
                // console.log("nutraion ", key);
                total[key]= $this.checkIsNull(total[key], value.total_val[key]);
              } else {
                total[key]= $this.getMinValue(total[key], value.total_val[key]);
              }            
            });
          }
                    
        });

        // console.log("days total", total);
        nutration.forEach((key, index) => {
          // console.log("nutration.forEach", key, total[key] , days.length, total[key] / days.length);
          // if(total[key]){
            total[key] = total[key] / days.length;
          // }
        });

        // console.log("days total 1 ", total);
        return total;
      } else {
        return total;
      }
    },

    getMinValue(cVal, ucVal){
      if(ucVal != null){
        if(cVal != null){
          if(parseFloat(cVal) > parseFloat(ucVal)){
            return parseFloat(ucVal);
          } else {
            return cVal;
          }
        } else {
          return ucVal;
        }
      } else {
        return cVal;
      }
		},

    getWeeklyAvg(days, total_days){
      let $this = this;
      // console.log("getWeeklyAvg", days);
      let total = {};
      
      if(days.length > 0){
        total = this.getBlankObject();
        const nutration = this.getBlankNutration();
        const keys = Object.keys(total);
        days.forEach((value) => {
          if( value != null &&  Object.keys(value).length > 0){
            // console.log("getWeeklyAvg value", total);
            keys.forEach((key, index) => {
              total[key]= $this.checkIsNull(total[key], value[key]);
              // console.log("getWeeklyAvg value total", total);
            }); 
          }                 
        });
        // console.log("getWeeklyAvg total ", total);
        nutration.forEach((key, index) => {
          // console.log("nutration.forEach", key, total[key] , days.length, total[key] / days.length);
          // if(total[key]){
            total[key] = (total[key] / total_days).toFixed(3) ;
          // }
        });
        // console.log("getWeeklyAvg total 1", total);
        return total;
      } else {
        // console.log("getWeeklyAvg total else", total);
        return total;
      }
      
      
		},

    getByName(recipe){
      let $this= this;
      const keys = Object.keys(this.getBlankObject());
      let name = [];
      // console.log("getByName recipe", recipe);
      keys.forEach((key, index) => {
        if(recipe[key] != null && recipe[key] > 0){
          name.push( $this.ConvertToDecimal(recipe[key]) + key);
        }
      });
      // console.log("getByName recipe return ", name.join(', '));
      return name.join(', ');
    },

    getByFirstName(recipe){
      const keys = Object.keys(this.getBlankObject());
      let name = "";
      keys.forEach((key, index) => {
        if(recipe[key] != null && recipe[key] > 0){
          if(name != ''){
            return false;
          }
          name = recipe[key] + key;
        }
      });
      return name;
    },

    getBlankNutration(){
      return [
        'CALS','SOD','FAT','PROT','CARB',
        'calfat',
            'satfat',
            'transfat',
            'polysatfat',
            'monosatfat',
            'cholesterol',
            'potassium',
            'fiber',
            'sugar',
            'vitamina',
            'vitaminb6',
            'vitaminb12',
            'vitaminc',
            'vitamind',
            'vitamine',
            'calcium',
            'iron',
            'magnesium',
            'coblamin',
            'thiamin',
            'riboflavin',
            'niacin',
            'zinc',
            'water',
            'ash'
      ]
    },

    getBlankObject(){
      return {
            'MMA':null, 
            'WGR':null, 
            'FRU':null, 
            'MLK':null, 
            'VEG':null, 
            'DG':null,                            
            'RO':null,
            'LEG':null,
            'STAR':null,
            'OTH':null,
            'CALS':null,
            'SOD':null,
            'FAT':null,
            'PROT':null,
            'CARB':null,

            'calfat':null,
            'satfat':null,
            'transfat':null,
            'polysatfat':null,
            'monosatfat':null,
            'cholesterol':null,
            'potassium':null,
            'fiber':null,
            'sugar':null,
            'vitamina':null,
            'vitaminb6':null,
            'vitaminb12':null,
            'vitaminc':null,
            'vitamind':null,
            'vitamine':null,
            'calcium':null,
            'iron':null,
            'magnesium':null,
            'coblamin':null,
            'thiamin':null,
            'riboflavin':null,
            'niacin':null,
            'zinc':null,
            'water':null,
            'ash':null
        };
    },


    /**
     * ************************************************************************************
     * Conver MenuCycle to showing array 
     * ************************************************************************************
     */
    convertMenuCycleToShowingData(menuCycle, week){
      let $this = this;
      let total_val = [];
       menuCycle.menu_cycle_days = menuCycle.menu_cycle_days.map((menu_cycle_day, index) => {
       
        if(menu_cycle_day.options.length){
          menu_cycle_day.options.map((options, option_index) => {
            if(options.recipes && options.recipes.length > 0){
              options.recipes.map((value,index) => {
                value.total_val = $this.sum_products_week_popup_totals_new(value['prefer_products']);
              });
              options.total_val = $this.getRecipeTotal(options.recipes);
            }
            // options.total_val = $this.getRecipeTotal(options.recipes);
            // console.log("options", options);
            return options;
            // options.option_min_total_val = $this.getRecipeTotal(options.recipes);
          });
        }
                
        menu_cycle_day.date = week.days[menu_cycle_day.day_of_week_number];
        menu_cycle_day.total_val = $this.getDayMinimumeValue(menu_cycle_day.options);
        menu_cycle_day.is_guidline = $this.checkGuidlineValue(menuCycle.guideline, menu_cycle_day.total_val, 'daily');
        total_val.push(menu_cycle_day.total_val);
        return menu_cycle_day;
      });

      menuCycle.total_val = this.getWeeklyAvg(total_val, menuCycle.day.total_days);
      menuCycle.is_guidline = $this.checkGuidlineValue(menuCycle.guideline, menuCycle.total_val, 'weekly');
          
      return menuCycle;
    },

    // daily weekly
    checkGuidlineValue(guideline, total_val, checkType){
      let $this= this;
      let guidline_vals = this.getAllGuidLineParam(checkType);
      const nutration = this.getBlankNutration();
      //this.getBlankObject();
      let returnVal = true;
      
      const keys = Object.keys(guidline_vals);
      keys.forEach((key, index) => {
        let rt;
        if(nutration.includes(key)){
          rt = $this.checkGuidLineValidOrNot(guideline, guidline_vals, key, total_val, 'nutrtion');
        } else {
          rt =  $this.checkGuidLineValidOrNot(guideline, guidline_vals, key, total_val, 'component');
        }
        if(!rt){
          console.log("checkGuidlineValue false ", key);
          returnVal = false;
        }
      });    
      return returnVal; 
    },

    checkGuidLineValidOrNot(guideline, guidline_vals, keys, total_val, is_nutrtion){
      let min = guideline[guidline_vals[keys][0]]; 
      let max = guideline[guidline_vals[keys][1]];
      let validReturn = true;
      console.log("checkGuidLineValidOrNot start", keys  ,total_val, total_val[keys]);
      let gValid = this.checkGuildLineVals(min, max, total_val[keys], is_nutrtion);
      
      if(gValid == 'red'  ){
        console.log("checkGuidLineValidOrNot red ",gValid, keys, min, max, total_val, total_val[keys], is_nutrtion );
        return false;
      } else {
        console.log("checkGuidLineValidOrNot end");
        return validReturn;
      }
      // if(this.checkIfNull(min, null)){
      //   if(this.checkIfNull(total_val[keys], null)){
      //     if(this.checkIfNull(min, null) > this.checkIfNull(total_val[keys], null)){
      //       return false;
      //     }
      //   } else {
      //     return false;
      //   }
      // }
      
    
      // if(this.checkIfNull(max, null)){
      //   if(this.checkIfNull(total_val[keys], null)){
      //     if(this.checkIfNull(max, null) < this.checkIfNull(total_val[keys], null)){
      //       return false;
      //     }
      //   } else {
      //     return false;
      //   }
      // }
      
    },

    checkGuildLineVals(gMin, gMax, cVal, cType){
        
        console.log("checkGuildLineVals gMin, gMax, cVal helper ",gMin, gMax, cVal, cType);
        // check guildline min or max value for is not null or 0
        if(this.checkIntOrNotNull(gMin) || this.checkIntOrNotNull(gMax)){
          let returnVal = 'green';
          // check guidline min value is not null or 0
          if(this.checkIntOrNotNull(gMin)){
            
            // check guidline min value <= cVal
            if(this.checkIntOrNotNull(cVal) && gMin <= parseFloat(cVal)){
              // return 'green';
            } else {
              console.log("this.checkIntOrNotNull(cVal) min red ", this.checkIntOrNotNull(cVal));
              return 'red';
            }
          }

          // check guidline max value is not null or 0
          if(this.checkIntOrNotNull(gMax)){
            // check guidline max value <= cVal
            if(this.checkIntOrNotNull(cVal) && gMax >= parseFloat(cVal)  ){
              // returnVal = 'green';
            } else {
              if(cType == 'component'){
                console.log('gray max component', gMax, cVal, cType);
                returnVal = 'gray';
                
              } else {
                console.log('red max nutraion', gMax, cVal, cType);
                 returnVal = 'red'; 
              }                          
            }
          }
          return returnVal;
        } else {
          if(cType == 'component'){
            return 'gray';
            
          } else {
             return 'green'; 
          }
        }
      },
    

    getAllGuidLineParam(types){
      return {
        'MMA':[types+'_min_usda_componenent_serving_meat', types+'_max_usda_componenent_serving_meat'], 
        'WGR':[types+'_min_usda_componenent_serving_grain', types+'_max_usda_componenent_serving_grain'], 
        'FRU':[types+'_min_usda_componenent_serving_fruit', types+'_max_usda_componenent_serving_fruit'], 
        'MLK':[types+'_min_usda_componenent_serving_milk', types+'_max_usda_componenent_serving_milk'], 
        'VEG':[types+'_min_usda_componenent_serving_veg', types+'_max_usda_componenent_serving_veg'], 
        'LEG':[types+'_min_usda_componenent_serving_vegleg', types+'_max_usda_componenent_serving_vegleg'],                            
        'RO':[types+'_min_usda_componenent_serving_vegred', types+'_max_usda_componenent_serving_vegred'],
        'DG':[types+'_min_usda_componenent_serving_veggrn', types+'_max_usda_componenent_serving_veggrn'],
        'STAR':[types+'_min_usda_componenent_serving_vegstar', types+'_max_usda_componenent_serving_vegstar'],
        'OTH':[types+'_min_usda_componenent_serving_vegothr', types+'_max_usda_componenent_serving_vegothr'],
        
        'CALS':[types+'_min_nutrition_facts_calories', types+'_max_nutrition_facts_calories'],
        'SOD':[types+'_min_nutrition_facts_sodium', types+'_max_nutrition_facts_sodium'],
        'FAT':[types+'_min_nutrition_facts_totalfat', types+'_max_nutrition_facts_totalfat'],
        'PROT':[types+'_min_nutrition_facts_protein', types+'_max_nutrition_facts_protein'],
        'CARB':[types+'_min_nutrition_facts_carbs', types+'_max_nutrition_facts_carbs'],

        'calfat':[types+'_min_nutrition_facts_calfat', types+'_max_nutrition_facts_calfat'],
        'satfat':[types+'_min_nutrition_facts_satfat', types+'_max_nutrition_facts_satfat'],
        'transfat':[types+'_min_nutrition_facts_transfat', types+'_max_nutrition_facts_transfat'],
        'polysatfat':[types+'_min_nutrition_facts_polysatfat', types+'_max_nutrition_facts_polysatfat'],
        'monosatfat':[types+'_min_nutrition_facts_monosatfat', types+'_max_nutrition_facts_monosatfat'],
        'cholesterol':[types+'_min_nutrition_facts_cholesterol', types+'_max_nutrition_facts_cholesterol'],
        'potassium':[types+'_min_nutrition_facts_potassium', types+'_max_nutrition_facts_potassium'],
        'fiber':[types+'_min_nutrition_facts_fiber', types+'_max_nutrition_facts_fiber'],
        'sugar':[types+'_min_nutrition_facts_sugar', types+'_max_nutrition_facts_sugar'],
        'vitamina':[types+'_min_nutrition_facts_vitamina', types+'_max_nutrition_facts_vitamina'],
        'vitaminb6':[types+'_min_nutrition_facts_vitaminb6', types+'_max_nutrition_facts_vitaminb6'],
        'vitaminb12':[types+'_min_nutrition_facts_vitaminb12', types+'_max_nutrition_facts_vitaminb12'],
        'vitaminc':[types+'_min_nutrition_facts_vitaminc', types+'_max_nutrition_facts_vitaminc'],
        'vitamind':[types+'_min_nutrition_facts_vitamind', types+'_max_nutrition_facts_vitamind'],
        'vitamine':[types+'_min_nutrition_facts_vitamine', types+'_max_nutrition_facts_vitamine'],
        'calcium':[types+'_min_nutrition_facts_calcium', types+'_max_nutrition_facts_calcium'],
        'iron':[types+'_min_nutrition_facts_iron', types+'_max_nutrition_facts_iron'],
        'magnesium':[types+'_min_nutrition_facts_magnesium', types+'_max_nutrition_facts_magnesium'],
        'coblamin':[types+'_min_nutrition_facts_coblamin', types+'_max_nutrition_facts_coblamin'],
        'thiamin':[types+'_min_nutrition_facts_thiamin', types+'_max_nutrition_facts_thiamin'],
        'riboflavin':[types+'_min_nutrition_facts_riboflavin', types+'_max_nutrition_facts_riboflavin'],
        'niacin':[types+'_min_nutrition_facts_niacin', types+'_max_nutrition_facts_niacin'],
        'zinc':[types+'_min_nutrition_facts_zinc', types+'_max_nutrition_facts_zinc'],
        'water':[types+'_min_nutrition_facts_water', types+'_max_nutrition_facts_water'],
        'ash':[types+'_min_nutrition_facts_ash', types+'_max_nutrition_facts_ash']
      }
    },

    checkIntOrNotNull(cVal){
      if(!isNaN(cVal)){
        if(cVal > 0){
          return true;
        } else {
          return false;
        }
      } else {
        return false;
      }
    }

};
