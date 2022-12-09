<template>
<div class="relative focus:outline-none xl:w-32 w-32 mr-3">
  
  <select :value="modelValue" @change="handleChange" class="cursor-pointer shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height">
    <optgroup v-if="options.includes('Weight')" label="Weight">
      <!-- <option>Pound</option> -->
      <option>Ounce</option>
      <option>Gram</option>
      <option>LB</option>
    </optgroup>

    <optgroup v-if="options.includes('Volume')" label="Volume">
      <option>Gallon</option>
      <option>Quart</option>
      <option>Pint</option>
      <option>Cup</option>
      <option>Fluid Ounce</option>
      <option>Tablespoon</option>
      <option>Teaspoon</option>
    </optgroup>

    <optgroup v-if="options.includes('Unit')" label="Unit">
      <!-- <option>Piece</option> -->
      <!-- <option>Qty</option> -->
      <option>Each</option>
    </optgroup>
  </select>
  <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc arrow-size" aria-hidden="true"></i></div>
  </div>
</template>

<script>
export default {
  props: [
    "modelValue",
    "otherProp",
    "value",
    "options"
  ],
  name: "UomDropdown",
  mounted() {
    console.log('mounted.value', this.modelValue)
    console.log('mounted.options', this.options)
  },
  data() {
    return {
      choice: this.modelValue
    }
  },
  methods: {
    handleChange(event) {
      // console.log('handleChange', event);
      console.log('handleChange', event.target.value);
      // this.$emit('input', event.target.value)
      // this.$emit('change', event.target.value)
      this.$emit('update:modelValue', event.target.value)
    }
  }
}
</script>

<style scoped>
.arrow-size{
font-size: 35px;
padding-bottom: 12px;
cursor: pointer;
}
</style>
