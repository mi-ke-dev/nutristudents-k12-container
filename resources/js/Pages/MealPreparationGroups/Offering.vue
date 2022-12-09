<template>
  <tr >
    <td
      class="p-5 font-bold underline id-color-menu-edit whitespace-nowrap"
    >
      <a
        :href="route('edit-site', { id: offering.site.id })"
        target="_blank"
      >
        {{ offering.site.name }}</a
      >
    </td>

    <td>
      {{ offering.name }}
    </td>
    <td>
     <button type="button" @click="creation_delete_script(offering.id)" class="">
        <i class="fa fa-trash" aria-hidden="true"></i>
      </button>
    </td>
  </tr>

 {{log(site_offering)}}
</template>

<script>

export default {
  props: [
    'offering',
    'site_offering'
  ],
  mounted() {
   
  },

  data() {
    return {
      log: console.log,
      show_optional_components: false,
    };
  },
  
  methods: { 
    creation_delete_script(rid) {
      if(confirm("Are you sure you want to detache this meal-preparation-groups?")){
        this.$emit('updateSiteOffering', rid);
      }
    },  
  },
  
}
</script>

<style scoped>
.w-18-input {
  width: 90px;
}
.key-icon {
  transform: rotate(45deg);
}
</style>
