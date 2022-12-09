<template>
    <div class="w-full">
   <ul class="flex justify-end pl-px list-none rounded my-2 mt-5 w-full">
      <li
         class="relative block py-2 px-3 leading-tight bg-white border border-gray-300 -ml-px hover:bg-gray-200 cursor-pointer"
         v-for="(eachUrlArray, index) in urlsArray"
         :key="eachUrlArray.indexKey"
         :class="{'bg-blue-600 active':eachUrlArray.active, 'disable_pagination': !eachUrlArray.url}"
         >
         <span class="text-blue-600" v-if="!eachUrlArray.active && eachUrlArray.url">
            <InertiaLink
               :href="eachUrlArray.url"
                class="page-link"
               >
        <span v-if="index == 0">  &laquo; </span>
        <span v-else-if="index == urlsArray.length-1">  &raquo; </span>
         <span v-else class="text-blue" v-html="eachUrlArray.label">
         </span>


            </InertiaLink>
         </span>
         <span class="text-blue" v-else-if="index == 0">  &laquo; </span>
         <span class="text-blue" v-else-if="index == urlsArray.length-1">  &raquo; </span>
         <span class="text-blue" v-else v-html="eachUrlArray.label" >
         </span>
      </li>

   </ul>
</div>
</template>
<style scoped>
li.active span {
    color: #fff;
}
</style>
<script>
export default {
    props : ['urlsArray','previousPageUrl','nextPageUrl'],
}
</script>

<style scoped>
.text-blue-600 {
    color: #213665;
}
.bg-blue-600{
   background: #213665;
}
.disable_pagination{
   background-color: rgba(229, 231, 235, var(--tw-bg-opacity));
   cursor: not-allowed;
}
</style>