<template>
  <div>    
    
    <div v-if="initValue !== null && component_value !== null && scale !== null && scale > 0 && initValue > 0 && !hideValues && recipePortion > 0" class="text-left px-6">

      <input
          type="number" step="any"          
          @change="handleChange"
          class="shadow focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm border-gray-300 rounded-md w-24"
          :value="this.initValue * this.scale" 
          :disabled="this.checkOverride !== null"
      />
    </div>

    <div v-else class="text-left px-6">
      &hyphen;
    </div>

  </div>
</template>

<script>
export default {
  props: [
    "scale",
    "initValue",
    "hideValues",
    "recipePortion",
    "checkOverride",
  ],
  name: "UsdaComponent",
  mounted() {
    // console.log('component_value', this.component_value)
    // console.log('component_value', this.component_value === null)      
  },
  data() {
    return {      
      component_value: (Math.round((this.initValue * this.scale) * 8) / 8).toFixed(3) 
      //closes 0.125
      //component_value: this.initValue * this.scale,
    }
  },
  methods: {
    handleChange(event) {
      // determine the scale
      console.log('handleChange.event.target.value', event.target.value)

      const scale = event.target.value / this.initValue;
      console.log('handleChange.initValue', this.initValue)
      console.log('handleChange.scale', scale)
      this.$emit('changeComponent', scale)
    }
  }
}
</script>

<style scoped>
input:disabled {
  background: #ccc;
}
</style>
