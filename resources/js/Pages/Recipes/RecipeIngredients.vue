<template>
  <tr>
    <td class="p-5 font-bold underline id-color-menu-edit whitespace-nowrap" @click="getServingAmountScale">

    <a :href="route('ingredients-edit', { id: ingredient.id })" target="_blank">
    {{ ingredient.name }}</a></td>
    
    <td>
    <div class="flex p-5">
      <input
          @change="handleChangeRecipeAmount"
          type="number" min="0" step="any"
          class="shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-18-input mr-4"
          v-model="recipe_amount" required="" >
          
      <uom-dropdown          
          :options="availableUoms"
          v-model="recipe_amount_uom"/>
    </div></td>
    <td>
      <div v-if="recipe_amount !== null && recipe_portion > 0" class="flex p-5">
        <input
            @change="handleChangeServingAmount"
            type="number" min="0" step="any"           
            class="shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-18-input mr-4"
            v-model="serving_amount" required="">
        <uom-dropdown            
            :options="availableUoms"
            v-model="serving_amount_uom"
        />
      </div>
    </td>
    
    <td>
      <usda-component @changeComponent="handleChangeComponentValue"
                      key="component_mma" v-model="component_mma"
                      :scale="component_scale"
                      :init-value="preferred_product_information.component_mma"
                      :hide-values="serving_amount === null"
                      :recipe-portion="recipe_portion" 
                      :check-override="componentOverrideData.optional_component_mma" />
    </td>
    <td>
      <usda-component @changeComponent="handleChangeComponentValue"
                      key="component_wgr"
                      :scale="component_scale"
                      :init-value="preferred_product_information.component_wgr"
                      :hide-values="serving_amount === null"
                      :recipe-portion="recipe_portion"
                      :check-override="componentOverrideData.optional_component_wgr" />
    </td>
    <td>
      <usda-component @changeComponent="handleChangeComponentValue"
                      key="component_fru"
                      :scale="component_scale"
                      :init-value="preferred_product_information.component_fru"
                      :hide-values="serving_amount === null"
                      :recipe-portion="recipe_portion"
                      :check-override="componentOverrideData.optional_component_fru" />
    </td>
    <td>
      <usda-component @changeComponent="handleChangeComponentValue"
                      key="component_mlk"
                      :scale="component_scale"
                      :init-value="preferred_product_information.component_mlk"
                      :hide-values="serving_amount === null"
                      :recipe-portion="recipe_portion"
                      :check-override="componentOverrideData.optional_component_mlk" />
    </td>
    <td>
      <usda-component @changeComponent="handleChangeComponentValue"
                      key="component_veg"
                      :scale="component_scale"
                      :init-value="preferred_product_information.component_veg"
                      :hide-values="serving_amount === null"
                      :recipe-portion="recipe_portion"
                      :check-override="componentOverrideData.optional_component_veg" />
    </td>
    <td>
      <usda-component @changeComponent="handleChangeComponentValue"
                      key="component_dg"
                      :scale="component_scale"
                      :init-value="preferred_product_information.component_dg"
                      :hide-values="serving_amount === null"
                      :recipe-portion="recipe_portion"
                      :check-override="componentOverrideData.optional_component_dg" />
    </td>
    <td>
      <usda-component @changeComponent="handleChangeComponentValue"
                      key="component_ro"
                      :scale="component_scale"
                      :init-value="preferred_product_information.component_ro"
                      :hide-values="serving_amount === null"
                      :recipe-portion="recipe_portion"
                      :check-override="componentOverrideData.optional_component_ro" />
    </td>
    <td>
      <usda-component @changeComponent="handleChangeComponentValue"
                      key="component_leg"
                      :scale="component_scale"
                      :init-value="preferred_product_information.component_leg"
                      :hide-values="serving_amount === null"
                      :recipe-portion="recipe_portion"
                      :check-override="componentOverrideData.optional_component_leg" />
    </td>
    <td>
      <usda-component @changeComponent="handleChangeComponentValue"
                      key="component_star"
                      :scale="component_scale"
                      :init-value="preferred_product_information.component_star"
                      :hide-values="serving_amount === null"
                      :recipe-portion="recipe_portion"
                      :check-override="componentOverrideData.optional_component_star" />
    </td>
    <td>
      <usda-component @changeComponent="handleChangeComponentValue"
                      key="component_other"
                      :scale="component_scale"
                      :init-value="preferred_product_information.component_other"
                      :hide-values="serving_amount === null"
                      :recipe-portion="recipe_portion"
                      :check-override="componentOverrideData.optional_component_other" />
    </td>

    <td class="px-6 py-4 whitespace-nowrap  id-color text-xl  font-extrabold"> 
      <button v-if="recipe.is_tenant_admin" type="button" @click="showOptionalComponentsMethod">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd" />
</svg>
      </button>
      <button v-if="recipe.is_tenant_admin" type="button" @click="onIngredientDeleteMethod" class="pl-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
</svg></button>
    </td>

  </tr> 

   <optional-components v-if="show_optional_components" @hideOptionalComponents="hideOptionalComponentsMethod" :componentOverrideData="componentOverrideData" @updateOptionalComponents="updateOptionalComponents"/>

</template>

<script>
import UomDropdown from "@/Pages/Recipes/Partials/UomDropdown";
import UsdaComponent from "@/Pages/Recipes/Partials/UsdaComponent";
import OptionalComponents from "@/Pages/Recipes/Partials/OptionalComponents";

export default {
  components: {UsdaComponent, UomDropdown, OptionalComponents},
  props: [
    'ingredient',
    'recipe_portion',
    'recipe'
  ],
  name: "RecipeIngredients",
  mounted() {
    // the default UoM is determined based off of the
    // measurement serving information


    if( this.ingredient.optional_component_mma !== null || 
        this.ingredient.optional_component_wgr !== null || 
        this.ingredient.optional_component_fru !== null || 
        this.ingredient.optional_component_mlk !== null || 
        this.ingredient.optional_component_veg !== null || 
        this.ingredient.optional_component_dg  !== null || 
        this.ingredient.optional_component_ro  !== null || 
        this.ingredient.optional_component_leg !== null || 
        this.ingredient.optional_component_star !== null || 
        this.ingredient.optional_component_other !== null ){        
        this.show_optional_components = true;
      }


    //check if it is edit page to check saved data in place of base data    
    if(this.ingredient.recipe_ingredient_edit === undefined){              
    this.recipe_amount_uom = this.defaultUom
    this.serving_amount_uom = this.defaultUom
    this.serving_amount = this.getBaseServingAmount()
    }

    console.log('this.ingredient.preferred_product_information', this.ingredient.preferred_product_information)
    console.log('getBaseServingAmount', this.getBaseServingAmount());

  },

  data() {
    return {

      show_optional_components: false,

      componentOverrideData:{
           'optional_component_mma':this.ingredient.optional_component_mma,
           'optional_component_wgr':this.ingredient.optional_component_wgr,
           'optional_component_fru':this.ingredient.optional_component_fru,
           'optional_component_mlk':this.ingredient.optional_component_mlk,
           'optional_component_veg':this.ingredient.optional_component_veg,
           'optional_component_dg' :this.ingredient.optional_component_dg,
           'optional_component_ro' :this.ingredient.optional_component_ro,
           'optional_component_leg':this.ingredient.optional_component_leg,
           'optional_component_star' :this.ingredient.optional_component_star,
           'optional_component_other':this.ingredient.optional_component_other,
      },      

      recipe_amount: this.convertToFix(this.ingredient.recipe_amount),
      recipe_amount_uom: this.ingredient.recipe_amount_uom,
      serving_amount: this.ingredient.serving_amount,
      //serving_amount_original: null,
      serving_amount_uom: this.ingredient.serving_amount_uom,
      component_mma: this.ingredient.component_mma,
      component_wgr: this.ingredient.component_wgr,
      component_fru: this.ingredient.component_fru,
      component_mlk: this.ingredient.component_mlk,
      component_veg: this.ingredient.component_veg,
      component_dg:  this.ingredient.component_dg,
      component_ro:  this.ingredient.component_ro,
      component_leg: this.ingredient.component_leg,
      component_star: this.ingredient.component_star,
      component_other: this.ingredient.component_other,
      preferred_product_information: this.ingredient.preferred_product_information
    };
  },
  
  methods: {    

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

    showOptionalComponentsMethod() {
       this.show_optional_components = true;    
    },
    hideOptionalComponentsMethod() {    
       this.show_optional_components = false;
       
       this.componentOverrideData.optional_component_mma = null;
       this.componentOverrideData.optional_component_wgr = null;
       this.componentOverrideData.optional_component_fru = null;
       this.componentOverrideData.optional_component_mlk = null;
       this.componentOverrideData.optional_component_veg = null;
       this.componentOverrideData.optional_component_dg = null;
       this.componentOverrideData.optional_component_ro = null;
       this.componentOverrideData.optional_component_leg = null;
       this.componentOverrideData.optional_component_star = null;
       this.componentOverrideData.optional_component_other = null;

       this.updateOptionalComponents();
    },

    updateOptionalComponents(val_array) {       
       this.$emit('updateOptionalComponentsParent', val_array);
    },

    onIngredientDeleteMethod() {
      this.$emit('onIngredientDelete');
    },    

    handleChangeRecipeAmount() {

      //console.log(this.recipe_amount_uom);
      
      if(this.recipe_amount == 0){
        this.resetValuesOnZero();
        return false;
      }

      const RecipeAmountUomType = this.$helpers.uomType(this.recipe_amount_uom);
      const ServingAmountUomType = this.$helpers.uomType(this.serving_amount_uom);

      if (RecipeAmountUomType === ServingAmountUomType && RecipeAmountUomType === "Weight") {
        this.serving_amount = this.convertToFix(this.$conversions.weight(this.recipe_amount, this.recipe_amount_uom, this.serving_amount_uom) / this.recipe_portion);
      }

      if (RecipeAmountUomType === ServingAmountUomType && RecipeAmountUomType === "Volume") {
        this.serving_amount = this.convertToFix(this.$conversions.volume(this.recipe_amount, this.recipe_amount_uom, this.serving_amount_uom) / this.recipe_portion);
      }

      if (RecipeAmountUomType === 'Weight' && ServingAmountUomType === 'Volume') {
        this.serving_amount = this.convertToFix(this.$conversions.weightToVolume(this.preferred_product_information, this.recipe_amount, this.recipe_amount_uom, this.serving_amount_uom)  / this.recipe_portion)
      }

      if (RecipeAmountUomType === 'Volume' && ServingAmountUomType === 'Weight') {
        this.serving_amount = this.convertToFix(this.$conversions.volumeToWeight(this.preferred_product_information, this.recipe_amount, this.recipe_amount_uom, this.serving_amount_uom) / this.recipe_portion)
      }   

      if (RecipeAmountUomType === 'Unit' || ServingAmountUomType === 'Unit') {
        this.serving_amount = this.convertToFix(this.recipe_amount / this.recipe_portion);
      }     

      this.handleChangeComponentUpdate(this.component_scale);
      this.getRecipeIngredientDataOnChange();

    },

    handleChangeServingAmount() {
    

      if(this.serving_amount == 0){
        this.resetValuesOnZero();
        return false;
      }

      //let recipeAmount = 0;
      const RecipeAmountUomType = this.$helpers.uomType(this.recipe_amount_uom);
      const ServingAmountUomType = this.$helpers.uomType(this.serving_amount_uom);

      if (RecipeAmountUomType === ServingAmountUomType && RecipeAmountUomType === "Weight") {
        this.recipe_amount = this.convertToFix( this.$conversions.weight(this.serving_amount, this.serving_amount_uom, this.recipe_amount_uom) * this.recipe_portion );
      }

      if (RecipeAmountUomType === ServingAmountUomType && RecipeAmountUomType === "Volume") {
        this.recipe_amount = this.convertToFix( this.$conversions.volume(this.serving_amount, this.serving_amount_uom, this.recipe_amount_uom) * this.recipe_portion );
      }

      if (RecipeAmountUomType === 'Weight' && ServingAmountUomType === 'Volume') {
        this.recipe_amount = this.convertToFix(this.$conversions.volumeToWeight(this.preferred_product_information, this.serving_amount, this.serving_amount_uom,  this.recipe_amount_uom) * this.recipe_portion)
      }

      if (RecipeAmountUomType === 'Volume' && ServingAmountUomType === 'Weight') {
        this.recipe_amount = this.convertToFix(this.$conversions.weightToVolume(this.preferred_product_information, this.serving_amount, this.serving_amount_uom,  this.recipe_amount_uom) * this.recipe_portion)

      }  

      if (RecipeAmountUomType === 'Unit' || ServingAmountUomType === 'Unit') {
        this.recipe_amount = this.convertToFix(this.serving_amount * this.recipe_portion);
      }  
      
      //this.recipe_amount = recipeAmount;
      this.handleChangeComponentUpdate(this.component_scale);  
      this.getRecipeIngredientDataOnChange();
    },

    handleChangeComponentValue(newScale) {
      let scaledAmount = 0;
      let servingAmount = 0;

      console.log('newScale', newScale);
      const ServingAmountUomType = this.$helpers.uomType(this.serving_amount_uom);

      if (ServingAmountUomType === "Weight") {
        scaledAmount = this.preferred_product_information.measurement_serving_weight * newScale;
        console.log('scaledAmount', scaledAmount)
        servingAmount = this.$conversions.weight(scaledAmount, this.preferred_product_information.measurement_serving_weight_uom, this.serving_amount_uom)

      }

      if (ServingAmountUomType === "Volume") {
        scaledAmount = this.preferred_product_information.measurement_serving_volume * newScale;
        servingAmount = this.$conversions.volume(scaledAmount, this.preferred_product_information.measurement_serving_volume_uom, this.serving_amount_uom)        

      }

      
      this.serving_amount = servingAmount;
      this.handleChangeServingAmount();

      this.handleChangeComponentUpdate(newScale);
      this.getRecipeIngredientDataOnChange();

    },



    handleChangeComponentUpdate(newScale){          
    this.component_mma = newScale * this.preferred_product_information.component_mma;
    this.component_wgr = newScale * this.preferred_product_information.component_wgr;
    this.component_fru = newScale * this.preferred_product_information.component_fru;
    this.component_mlk = newScale * this.preferred_product_information.component_mlk;
    this.component_veg = newScale * this.preferred_product_information.component_veg;
    this.component_dg = newScale * this.preferred_product_information.component_dg;
    this.component_ro = newScale * this.preferred_product_information.component_ro;
    this.component_leg = newScale * this.preferred_product_information.component_leg;
    this.component_star = newScale * this.preferred_product_information.component_star;
    this.component_other = newScale * this.preferred_product_information.component_other;
    },

    getRecipeIngredientDataOnChange(){
      
      let data_values = {};
      
      data_values['recipe_amount'] = this.recipe_amount;
      data_values['serving_amount'] = this.serving_amount;

      data_values['recipe_amount_uom'] = this.recipe_amount_uom;
      data_values['serving_amount_uom'] = this.serving_amount_uom;

      data_values['component_mma'] =   this.component_mma;
      data_values['component_wgr'] =   this.component_wgr;
      data_values['component_fru'] =   this.component_fru;
      data_values['component_mlk'] =   this.component_mlk;
      data_values['component_veg'] =   this.component_veg;
      data_values['component_dg'] =    this.component_dg;
      data_values['component_ro'] =    this.component_ro;
      data_values['component_leg'] =   this.component_leg;
      data_values['component_star'] =  this.component_star;
      data_values['component_other'] = this.component_other;
      
      this.$emit('getDataRecipeIngredient', data_values);
    },

    resetValuesOnZero(){
      this.recipe_amount = '';
      this.serving_amount = '';
      this.component_mma = 0;
      this.component_wgr = 0;
      this.component_fru = 0;
      this.component_mlk = 0;
      this.component_veg = 0;
      this.component_dg = 0;
      this.component_ro = 0;
      this.component_leg = 0;
      this.component_star = 0;
      this.component_other = 0;
      this.getRecipeIngredientDataOnChange();
    },

    // handleChangeComponentValue(newScale) {
    //   this.component_scale = newScale;
    //   this.serving_amount = this.serving_amount_original * newScale;
    // }

    getBaseServingAmount() {
      console.log(' 👉 getBaseServingAmount', this.$helpers.uomType(this.serving_amount_uom))

      // Weight, Volume, or Unit ?
      const uomType = this.$helpers.uomType(this.serving_amount_uom);
      if (uomType === 'Weight') {
        return this.preferred_product_information.measurement_serving_weight
      }

      if (uomType === 'Volume') {
        return this.preferred_product_information.measurement_serving_volume
      }

      if (uomType === 'Unit') {
        return this.preferred_product_information.measurement_serving_unit
      }

      // Error
      return -1;
    },
    getServingAmountScale() {

      console.log('scale', this.component_scale);

    }
  },
  computed: {
    component_scale() {
      const currentServingAmount = this.serving_amount;
      const uomType = this.$helpers.uomType(this.serving_amount_uom);

      let baseAmount = null
      let baseAmountUoM = null
      let convertedAmount = null

      if (uomType === 'Weight') {
        baseAmount = this.preferred_product_information.measurement_serving_weight
        baseAmountUoM = this.preferred_product_information.measurement_serving_weight_uom
        convertedAmount = this.$conversions.weight(baseAmount, baseAmountUoM, this.serving_amount_uom)
      }

      if (uomType === 'Volume') {
        baseAmount = this.preferred_product_information.measurement_serving_volume
        baseAmountUoM = this.preferred_product_information.measurement_serving_volume_uom
        convertedAmount = this.$conversions.volume(baseAmount, baseAmountUoM, this.serving_amount_uom)
      }

      if (uomType === 'Unit') {
        baseAmount = this.preferred_product_information.measurement_serving_unit
        convertedAmount = baseAmount
      }

      let scale_factor = currentServingAmount / convertedAmount;
      
      if(isFinite(scale_factor) && !isNaN(scale_factor)){        
        return scale_factor;
      }

      console.log('✅');
      console.log(scale_factor);
      
    },
    availableUoms() {
      let uoms = []

      if (this.preferred_product_information.measurement_serving_unit_uom !== null) {
        uoms.push('Unit')
      }
      if (this.preferred_product_information.measurement_serving_weight_uom !== null) {
        uoms.push('Weight')
      }
      if (this.preferred_product_information.measurement_serving_volume_uom !== null) {
        uoms.push('Volume')
      }

      return uoms
    },
    defaultUom() {

      if (this.preferred_product_information.measurement_serving_volume_uom !== null) {
        return this.preferred_product_information.measurement_serving_volume_uom;
      }

      if (this.preferred_product_information.measurement_serving_weight_uom !== null) {
        return this.preferred_product_information.measurement_serving_weight_uom;
      }

      if (this.preferred_product_information.measurement_serving_unit_uom !== null) {
        return this.preferred_product_information.measurement_serving_unit_uom;
      }


      return "Not Found"
    }    
  },
  watch: {

    recipe_portion() {
      this.handleChangeRecipeAmount();        
    },

    recipe_amount_uom(newUom, oldUom) {

      if (this.recipe_amount === null) return;

      let newRecipeAmount = null

      const newUomType = this.$helpers.uomType(newUom);
      const oldUomType = this.$helpers.uomType(oldUom);
      console.log(`🧮 Converting ${this.recipe_amount} ${oldUom} to ${newUom}`)

      const initAmount = this.recipe_amount;

      if (newUomType === oldUomType && newUomType === 'Weight') {
        newRecipeAmount = this.$conversions.weight(initAmount, oldUom, newUom);
      }

      if (newUomType === oldUomType && newUomType === 'Volume') {
        newRecipeAmount = this.$conversions.volume(initAmount, oldUom, newUom);
      }

      if (newUomType === 'Weight' && oldUomType === 'Volume') {
        newRecipeAmount = this.$conversions.volumeToWeight(this.preferred_product_information, this.recipe_amount, oldUom, newUom)
      }

      if (newUomType === 'Volume' && oldUomType === 'Weight') {
        newRecipeAmount = this.$conversions.weightToVolume(this.preferred_product_information, this.recipe_amount, oldUom, newUom)
      }

      if (newUomType === oldUomType && newUomType === 'Unit') {
        newRecipeAmount = initAmount;
      }

      this.recipe_amount =this.convertToFix( newRecipeAmount);      

    },


    serving_amount_uom(newUom, oldUom) {

      if (this.serving_amount === null) return;

      let newServingAmount = null

      const newUomType = this.$helpers.uomType(newUom);
      const oldUomType = this.$helpers.uomType(oldUom);
      console.log(`🧮 Converting ${this.serving_amount} ${oldUom} to ${newUom}`)

      const initAmount = this.serving_amount;

      if (newUomType === 'Weight') {
        if(this.preferred_product_information.measurement_serving_weight_uom == newUom){
          newServingAmount = this.preferred_product_information.measurement_serving_weight;
        }else{
          newServingAmount = this.$conversions.weight(initAmount, oldUom, newUom);
        }
        
      }

      if (newUomType === 'Volume') {
        if(this.preferred_product_information.measurement_serving_volume_uom == newUom){
          newServingAmount = this.preferred_product_information.measurement_serving_volume;
        }else{
          newServingAmount = this.$conversions.volume(initAmount, oldUom, newUom);
        }
      }

      if (newUomType === 'Unit') {
        if(this.preferred_product_information.measurement_serving_unit_uom == newUom){
          newServingAmount = this.preferred_product_information.measurement_serving_unit;
        }else{
          newServingAmount = initAmount;
        }
      }

      if (newUomType === 'Weight' && oldUomType === 'Volume') {
        if(this.preferred_product_information.measurement_serving_weight_uom == newUom){
          newServingAmount = this.preferred_product_information.measurement_serving_weight;
        }else{
          newServingAmount = this.$conversions.volumeToWeight(this.preferred_product_information, this.serving_amount, oldUom, newUom);
        }
      }

      if (newUomType === 'Volume' && oldUomType === 'Weight') {
        if(this.preferred_product_information.measurement_serving_volume_uom == newUom){
          newServingAmount = this.preferred_product_information.measurement_serving_volume;
        }else{
          newServingAmount = this.$conversions.weightToVolume(this. preferred_product_information, this.serving_amount,  oldUom, newUom);
        }
      }


      this.serving_amount = this.convertToFix(newServingAmount);
      this.handleChangeComponentUpdate(this.component_scale);
      this.getRecipeIngredientDataOnChange();

    },


  },
  updated:
    function(){
      
    }
  
}
</script>

<style scoped>
.w-18-input{
width: 90px;
}
.key-icon{
transform: rotate(
45deg);
}
</style>
