<template>
  <tr>
    <td></td>
    <td></td>
    <td></td>

    <td class="amount_number text-left px-6">
     
      <input
          type="number" min="0" step="any"
          @change="handleOptionalChange('component_mma', $event)"          
          class="shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-24" v-model="componentOverrideData.optional_component_mma"
      />      
    </td>

    <td class="amount_number text-left px-6">
      <input
          type="number" min="0" step="any"    
          @change="handleOptionalChange('component_wgr', $event)"
          class="w-18-input shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-24" v-model="componentOverrideData.optional_component_wgr"
      />      
    </td>

    <td class="amount_number text-left px-6">
      <input
          type="number" min="0" step="any"         
          @change="handleOptionalChange('component_fru', $event)"
          class="w-18-input shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-24" v-model="componentOverrideData.optional_component_fru"
      />      
    </td>

    <td class="amount_number text-left px-6">
      <input
          type="number" min="0" step="any"    
          @change="handleOptionalChange('component_mlk', $event)"
          class="w-18-input shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-24" v-model="componentOverrideData.optional_component_mlk"
      />      
    </td>

    <td class="amount_number text-left px-6">
      <input
          type="number" min="0" step="any"        
          @change="handleOptionalChange('component_veg', $event)"
          class="w-18-input shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-24" v-model="componentOverrideData.optional_component_veg"
      />      
    </td>

    <td class="amount_number text-left px-6">
      <input
          type="number" min="0" step="any"         
          @change="handleOptionalChange('component_dg', $event)"
          class="w-18-input shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-24" v-model="componentOverrideData.optional_component_dg"
      />      
    </td>

    <td class="amount_number text-left px-6">
      <input
          type="number" min="0" step="any"        
          @change="handleOptionalChange('component_ro', $event)"
          class="w-18-input shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-24" v-model="componentOverrideData.optional_component_ro"
      />      
    </td>

    <td class="amount_number text-left px-6">
      <input
          type="number" min="0" step="any"          
          @change="handleOptionalChange('component_leg', $event)"
          class="w-18-input shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-24" v-model="componentOverrideData.optional_component_leg"
      />      
    </td>

    <td class="amount_number text-left px-6">
      <input
          type="number" min="0" step="any"         
          @change="handleOptionalChange('component_star', $event)"
          class="w-18-input shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-24" v-model="componentOverrideData.optional_component_star"
      />      
    </td>

    <td class="amount_number text-left px-6">
      <input
          type="number" min="0" step="any"          
          @change="handleOptionalChange('component_other', $event)"
          class="w-18-input shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-24" v-model="componentOverrideData.optional_component_other"
      />      
    </td>

    <td class="amount_number text-left px-6">
      <button type="button" @click="hideOptionalComponents">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 id-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
       <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
       </svg>
      </button>    
    </td>

  </tr>
</template>

<script>
export default {
  props: [ 'componentOverrideData' ],
  name: "OptionalComponents",
  mounted() {
      //console.log(this.componentOverrideData);      
  },
  data() {
    return {
      updatedPreferProduct: {},        
    }
  },
  methods: {

    hideOptionalComponents(){      

       this.$emit('hideOptionalComponents');
    },

    handleOptionalChange(type, event){      

    let val = parseFloat(event.target.value);    

    let send_data = [{'value':val, 'type':type}];    
    this.$emit('updateOptionalComponents', send_data);

    },

  }
}
</script>

<style scoped>
.text-base-arrow{
font-size: 25px;
}
</style>
