<template>
  <Head>
  <title>Products | NutriStudents K-12</title>
  <meta name="description" content="Products">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <!-- <a href="#" class="link-color"> --><U>Templates</U><!-- </a> -->
    </BreadcrumLayout>
    <PageTitleLayout>
      <div class="lg:mb-0 mb-4">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">Products</h1>
      </div>
      <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center">
        <div class="relative lg:pl-6 sm:pl-6 pl-0 lg:w-48 sm:w-1/2 w-full lg:top-0 sm:top-0 top-4 mr-5">
          <select
              id="menuUserFilter"
              name="menuUserFilter"
              autocomplete=""
              class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="onWeekCycleFilterMethod" v-model="menuUserFilterVal"
            >
              <option value="">Source</option>
              <option v-for="menu_user in tenant_names" :value="menu_user['id']">{{menu_user['name']}}</option>
            </select>
            <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
            <i class="fa fa-sort-desc" aria-hidden="true"></i>
          </div>
        </div>
        <div class="relative focus:outline-none lg:w-44 sm:w-1/2 w-full">
          <select id="category" name="category" autocomplete="category" class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="onChangeCategoryfunc" v-model="categoryval">            
            <option value="">Category</option>
            <option v-for="category in categories" :value="category.id">{{category.name}}</option>
          </select>
          <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
            <i class="fa fa-sort-desc" aria-hidden="true"></i>
          </div>
        </div>
        <div class="relative lg:pl-6 sm:pl-6 pl-0 lg:w-48 sm:w-1/2 w-full lg:top-0 sm:top-0 top-4">
          <select id="sub_category" name="sub_category" autocomplete="sub_category"
            class="shadow-sm focus:border-color block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="onChangeSubCategoryfunc" v-model="subcategoryval">
            <option v-for="subcategory in subcategories" :value="subcategory.id">{{subcategory.name}}</option>
          </select>
          <div
            class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
          >
            <i class="fa fa-sort-desc" aria-hidden="true"></i>
          </div>
        </div>
        <button >
          <inertia-link :href="route('products_add')" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-4 mt-10  inline-block">
          CREATE NEW PRODUCT
          </inertia-link>
        </button>
      </div>
    </PageTitleLayout>
    <TableFilterLayout @messageFromChild="productSearchData" :searchVal="prod_searched" />
    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-auto max-height-screen">
            <table class="min-w-full">
              <thead class="header-bg-color">
                <tr>
                  <th
                    scope="col"
                    class="id_arrow   px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative"
                  >
                    # <!-- <i class="fa fa-sort-asc" aria-hidden="true"></i> <i class="fa fa-sort-desc" aria-hidden="true"></i> -->
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider"
                  >
                    PRODUCT NAME
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider"
                  >
                  Source
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider"
                  >
                    MANUFACTURER
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider"
                  >
                    MFG#
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider"
                  >
                    CATEGORY
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider"
                  >
                    SUB CATEGORY
                  </th>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider"
                  ></th>
                </tr>
              </thead>
              <tbody>

                <!-- Odd row -->
                <tr v-if="!products.data.length" class="bg-white">
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Products Found</td>
                </tr>

                <tr v-for="(product,index) in products.data" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">

                  <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                  <a :href="route('products_edit',{ id: product.id })">{{index+products.from}}</a>
                  </td>
                  
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                    <div class="tooltip">
                      <div class="trim_text">{{product.name}}</div>
                      <div class="top">
                          {{product.name}}
                          <i></i>
                      </div>
                    </div>
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                    {{product.tenant_name}}
                  </td> 

                  <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                    {{product.manufacturer}}
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    {{product.manufacturer_sku}}
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    {{product.category_name[0]}}
                  </td>

                  <td class="px-6 py-4 whitespace-nowrap text-base font-medium text-color">
                    {{product.sub_category_name[0]}}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap id-color text-xl font-extrabold">
                    <button type="button" @click="product_copy_save_script(product.id)" class="">
                    <i class="fa fa-clone pr-3" aria-hidden="true"></i>
                    </button>

                    <inertia-link :href="route('products_edit',{ id: product.id })" class="">
                           <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>  
                    </inertia-link>

                    <button v-if="product.is_tenant_admin" type="button" @click="product_delete_script(product.id)" class="">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>

                  </td>
                </tr>


              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="float-left w-full flex justify-start px-10">
        <paginate :urlsArray="links"></paginate>
      </div>

      <div class="mt-12 flex justify-end pr-10 w-full mb-8">
        <button
          
        >
          <inertia-link :href="route('products_add')" class="button-color text-white font-bold py-1.5 px-4 mb- rounded focus:outline-none  inline-block">
          CREATE NEW PRODUCT
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
import Paginate from "@/Pages/Partials/Paginate";


export default {
  props: ['product_data','categories', 'prod_searched','prod_filter','prod_subfilter','menu_users', 'tenant_names'],
  components: {
    DefaultLayout,
    Welcome,
    BreadcrumLayout,
    PageTitleLayout,
    TableFilterLayout,
    TableIndexLayout,
    Paginate,
  },

  
  data(){
    return {
      categoryval: this.prod_filter,
      subcategoryval: this.prod_subfilter,
      subcategories:[{id:'',name:'Sub Category'}],
      products:this.product_data,   
      links:this.product_data.links,   
      menu_users: this.menu_users,
      menuUserFilterVal:"",
      form: this.$inertia.form({

      })
    }
  },


  methods: {
        onChangeCategoryfunc() {  

            if(this.categoryval == ""){
            
            window.location.reload();

            }else{          

            axios.post('/get_prod_subcategories',{category_id:this.categoryval})
                    .then((response)=>{ 
                       this.subcategories = [];
                       this.subcategories = response.data;
                     })
                    .catch(error => console.error(error));

            axios.post('/product-search-filter',{type:'filter',term:this.categoryval})
                    .then((response)=>{
                       this.products = response.data;
                       this.links = this.products.links;
                       let cat_id = this.categoryval;
                       this.links.map(function(item, i){
                           if(item.url){
                                  let new_url = item.url.split('?');
                                  let main_url = window.location.href.split('?')[0];
                                  item.url = main_url +'?' +new_url[1] +'&filter=' +cat_id;
                                  return item;
                                }
                       });
                     })
                    .catch(error => console.error(error));
            }
        },

        onChangeSubCategoryfunc() {

            axios.post('/product-search-filter',{type:'filter2',term:this.subcategoryval})
                    .then((response)=>{
                       this.products = response.data;
                       this.links = this.products.links;
                       let cat_id = this.subcategoryval;
                       this.links.map(function(item, i){
                           if(item.url){
                              let new_url = item.url.split('?');
                              let main_url = window.location.href.split('?')[0];
                              item.url = main_url +'?' +new_url[1] +'&subfilter=' + cat_id;
                              return item;
                              }
                       });
                     })
                    .catch(error => console.error(error));
        },

        product_copy_save_script(pid) {
          if(confirm("Are you sure you want to duplicate this product?")){
          this.form.post(this.route('product_copy',pid), {
                onSuccess: () => {    
                  this.$toast.success('Product copied successfully!');
                  // setTimeout(function(){
                  //   window.location.reload();
                  // }, 1000);
                }
              });
          }
        },

        product_delete_script(pid) {
          if(confirm("Are you sure you want to delete this product?")){
          this.form.post(this.route('product_delete',pid), {
                onSuccess: () => {
                  this.$toast.success('Product deleted successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
              });
          }
        },

        productSearchData(search){
            
            if(search == ""){
              this.products = this.product_data;   
              this.links = this.product_data.links; 
            // this.$toast.error('Error: Search value required!');
            // return false;
            }else{
            axios.post('/product-search-filter',{type:'search',term:search})
                    .then((response)=>{
                       this.products = response.data;
                       this.links = this.products.links;
                       this.links.map(function(item, i){
                           if(item.url){
                                  let new_url = item.url.split('?');
                                  let main_url = window.location.href.split('?')[0];
                                  item.url = main_url +'?' +new_url[1] +'&search=' +search;
                                  return item;
                                }
                       });
                     })
                    .catch(error => console.error(error));
            }
        },
        onWeekCycleFilterMethod(){
          let $this= this;
          if(this.menuUserFilterVal){
             axios.post('/product-search-filter',{type:'filter3',term:this.menuUserFilterVal})
              .then((response)=>{
                this.products = response.data;
              })
              .catch(error => console.error(error));
          }
        },

    },
  
};


</script>


<style>

@media screen and (min-width: 1500px) {
.id_arrow .fa-sort-desc:before {
    content: "\f0dd";
    position: absolute;
    top: 16px;
    left: 43px;
    padding-left:7px;
    color: #219FD5;
}

.id_arrow .fa-sort-asc:before {
    content: "\f0de";
    color: #219FD5;
    padding-left:7px;
    position: absolute;
    top: 16px;
    left: 43px;
}
}

@media screen and (max-width: 1499px){
.id_arrow .fa-sort-asc:before {
    content: "\f0de";
    color: #219FD5;
    padding-left: 7px;
    position: absolute;
    top: 28px;
    left: 43px;
}

.id_arrow .fa-sort-desc:before {
    content: "\f0dd";
    position: absolute;
    top: 28px;
    left: 43px;
    padding-left: 7px;
    color: #219FD5;
}

}



.max-height-screen{
  max-height: calc(100vh - 380px);
}
.trim_text {
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 250px;
}

.tooltip {
    display:inline-block;
    position:relative;
    text-align:left;
}
.tooltip .top {
    width: 250px;
    top:50%;
    left:100%;
    margin-left:20px;
    transform:translate(0, -50%);
    padding: 5px 10px;
    color: #444444;
    background-color: #EEEEEE;
    font-weight: normal;
    font-size: 14px;
    border-radius: 5px;
    position: absolute;
    z-index: 99999999;
    box-sizing: border-box;
    box-shadow: 0 1px 8px rgba(0,0,0,0.5);
    display: none;
    white-space: normal;
}
.tooltip:hover .top {
    display:block;
}
.tooltip .top i {
    position:absolute;
    top:50%;
    right:100%;
    margin-top:-12px;
    width:12px;
    height:24px;
    overflow:hidden;
}
.tooltip .top i::after {
    content:'';
    position:absolute;
    width:12px;
    height:12px;
    left:0;
    top:50%;
    transform:translate(50%,-50%) rotate(-45deg);
    background-color:#EEEEEE;
    box-shadow:0 1px 8px rgba(0,0,0,0.5);
}
</style>
