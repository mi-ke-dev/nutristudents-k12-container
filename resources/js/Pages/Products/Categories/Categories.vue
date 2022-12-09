<template>
  <Head>
  <title>Product Categories | NutriStudents K-12</title>
  <meta name="description" content="Product Categories">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
    </BreadcrumLayout>
    <PageTitleLayout>
      <div class="lg:mb-0 mb-4 w-1/2">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">Product Categories</h1>
      </div>
      <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center">
        <div class="relative focus:outline-none lg:w-44 sm:w-1/2 w-full">
          <select id="main_cat_filter" name="main_cat_filter" autocomplete="main_cat_filter" class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="onChangeMainCategoryfilter" v-model="maincategory_filter">            
            <option value="">Main Category</option>
            <option v-for="category in main_categories" :value="category.id">{{category.name}}</option>
          </select>
          <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
            <i class="fa fa-sort-desc" aria-hidden="true"></i>
          </div>
        </div>
        <button >
          <inertia-link :href="route('add-product-category')" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 mt-10  inline-block">
          CREATE CATEGORY
          </inertia-link>
        </button>
      </div>
    </PageTitleLayout>

    <TableFilterLayout @messageFromChild="prodCategorySearchData" />

    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-auto">
            <table class="min-w-full">
          <thead class="header-bg-color">
            <tr>
              <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                CATEGORY NAME
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                MAIN CATEGORY
              </th>
            </tr>
          </thead>
          <tbody>
            

            <tr v-if="!sub_categories.length" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Category Found</td>
            </tr>

            <!-- Odd row -->
            <tr v-for="(sub_category,index) in sub_categories" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                    {{sub_category.name}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                    {{sub_category.main_category[0]}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap id-color text-xl  font-extrabold">

                    <inertia-link :href="route('edit-product-category', { id: sub_category.id })" class="">
                        <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>  
                    </inertia-link>

                    <button v-if="sub_category.is_tenant_admin" type="button" @click="prodCategory_delete_script(sub_category.id)" class="">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </td>  
            </tr>


          </tbody>
        </table>
          </div>
        </div>
      </div>
      <div class="mt-12 flex justify-end pr-10 w-full mb-8">
        <button >
          <inertia-link :href="route('add-product-category')" class="button-color text-white font-bold py-1.5 px-4 mb- rounded focus:outline-none  inline-block">
            CREATE CATEGORY
          </inertia-link>
        </button>
      </div>
    </TableIndexLayout>
  </default-layout>
</template>
<script>
import DefaultLayout from "@/Layouts/DefaultLayout";
import Welcome from "@/Jetstream/Welcome";
import BreadcrumLayout from "@/Pages/Common/Breadcrumbs";
import PageTitleLayout from "@/Pages/Common/PageTitle";
import TableFilterLayout from "@/Pages/Common/TableFilters";
import TableIndexLayout from "@/Pages/Common/TableIndex";

export default {
  props:['all_sub_cats','main_categories'],
  components: {
    DefaultLayout,
    Welcome,
    BreadcrumLayout,
    PageTitleLayout,
    TableFilterLayout,
    TableIndexLayout,
  },
  data(){
    return {
      sub_categories : this.all_sub_cats,
      maincategory_filter : '',
      form: this.$inertia.form({

      })
    }
  },
  methods:{
        
        onChangeMainCategoryfilter() {  

            if(this.maincategory_filter == ""){
            
            window.location.reload();

            }else{                      

            axios.post('/prod-sub-category-search',{type:'filter',term:this.maincategory_filter})
                    .then((response)=>{
                       this.sub_categories = response.data;
                     })
                    .catch(error => console.error(error));
            }
        },   

        prodCategory_delete_script(catid) {
          if(confirm("Are you sure you want to delete this category?")){
          this.form.post(this.route('delete-product-category', catid), {
                onSuccess: () => {
                  this.$toast.success('Category deleted successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
              });
          }
        },

        prodCategorySearchData(search){
            
            if(search == ""){
              this.sub_categories = this.all_sub_cats;
            // this.$toast.error('Error: Search value required!');
            // return false;
            }else{
            axios.post('/prod-sub-category-search',{type:'search',term:search})
                    .then((response)=>{
                       this.sub_categories = response.data;
                     })
                    .catch(error => console.error(error));
            }
        },        

  },
};
</script>
<style>
.id_arrow .fa-sort-desc:before {
    content: "\f0dd";
    position: absolute;
    top: 17px;
    left: 43px;
    padding-left:7px;
    color: #219FD5;
}

.id_arrow .fa-sort-asc:before {
    content: "\f0de";
    color: #219FD5;
    padding-left:7px;
    position: absolute;
    top: 17px;
    left: 43px;
}
</style>
