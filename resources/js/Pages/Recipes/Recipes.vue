<template>
  <Head>
  <title>Recipes | NutriStudents K-12</title>
  <meta name="description" content="Recipes">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <!-- <a href="#" class="link-color"> --><U>Templates</U><!-- </a> -->
    </BreadcrumLayout>
    <PageTitleLayout>
      <div class="lg:mb-0 mb-4">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">Recipes</h1>
      </div>
      <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center">
        <div class="relative focus:outline-none lg:w-44 sm:w-1/2 w-full">
          <select id="recipe_cat" name="recipe_cat" autocomplete="recipe_cat"
            class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="onChangeCategoryFunction" v-model="categoryval">
            <option value="">Category</option>
            <option v-for="category in categories" :value="category">{{category}}</option>
          </select>
          <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
        </div>
         
        <button >
          <inertia-link :href="route('recipes-add')" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 mt-10 flex">
          CREATE NEW RECIPE
          </inertia-link>
        </button>
      </div>
    </PageTitleLayout>

    <TableFilterLayout @messageFromChild="recipeSearchData" :searchVal="rec_searched"/>

    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-auto max-height-screen">
            <table class="min-w-full">
          <thead class="header-bg-color">
            <tr>
              <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                # <!-- <i class="fa fa-sort-asc" aria-hidden="true"></i><i class="fa fa-sort-desc" aria-hidden="true"></i> -->
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                NAME
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                CATEGORY
              </th> 
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                Favorite
              </th> 
            </tr>
          </thead>
          <tbody>
            

            <tr v-if="!recipes.data.length" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Recipes Found</td>
            </tr>

            <!-- Odd row -->
            <tr v-for="(recipe,index) in recipes.data" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                   <a :href="route('recipes-edit', { id: recipe.id })">{{index+recipes.from}}</a>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                  <div class="tooltip">
                      <div class="trim_text">{{recipe.name}}</div>
                      <div class="top">
                          {{recipe.name}}
                          <i></i>
                      </div>
                    </div>
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                   {{recipe.category}}
                </td> 
                <td class="flex justify-center w-24 padding-top-icon text-center align-bottom h-full items-end pt-4">
                   <svg v-if="!recipe.is_favorite"  @click="isFav(recipe, true)" xmlns="http://www.w3.org/2000/svg" class="h-8 w-6 cart-color" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                                  </svg>                                  
                                  
                                  <svg v-if="recipe.is_favorite" @click="isFav(recipe, false)"   xmlns="http://www.w3.org/2000/svg" class="h-8 w-6 cart-color" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                  </svg>
                </td> 
                <td class="px-6 py-4 whitespace-nowrap  id-color text-xl  font-extrabold">
                    <button type="button" @click="recipe_copy_script(recipe.id)" class="">
                    <i class="fa fa-clone pr-3" aria-hidden="true"></i>
                    </button>

                    <inertia-link :href="route('recipes-edit', { id: recipe.id })" class="">
                        <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>  
                    </inertia-link>

                    <button v-if="recipe.is_tenant_admin" type="button" @click="recipe_delete_script(recipe.id)" class="">
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
        <button >
          <inertia-link :href="route('recipes-add')" class="button-color text-white font-bold py-1.5 px-4 mb- rounded focus:outline-none">
           CREATE NEW RECIPE
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
  props:['recipe_data','categories','rec_searched','rec_filter'],
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
      categoryval: "",
      recipes:this.recipe_data,
      links:this.recipe_data.links,

      form: this.$inertia.form({

      })
    }
  },
  methods:{

        isFav(rev, fav){
          rev.is_favorite = fav;
          axios.post('/favorite-recipes',{recipe_id:rev.id, is_fav:fav})
              .then((response)=>{
                  console.log("response", response);
                })
              .catch(error => console.error(error));
        },    
        recipe_copy_script(rid) {
          if(confirm("Are you sure you want to duplicate this recipe?")){
          this.form.post(this.route('recipe-copy', rid), {
                onSuccess: () => {    
                  this.$toast.success('Recipe copied successfully!');                  
                  // setTimeout(function(){
                  //   window.location.reload();
                  // }, 1000);                  
                }
              });
          }
        },

        recipe_delete_script(rid) {
          if(confirm("Are you sure you want to delete this recipe?")){
          this.form.post(this.route('recipe-delete', rid), {
                onSuccess: () => {
                  this.$toast.success('Recipe deleted successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
              });
          }
        },

        recipeSearchData(search){
            
            if(search == ""){
              this.recipes = this.recipe_data;
              this.links = this.recipe_data.links;
            // this.$toast.error('Error: Search value required!');
            // return false;
            }else{
            axios.post('/recipe-search-filter',{type:'search',term:search})
                    .then((response)=>{
                       this.recipes = response.data;
                       this.links = this.recipes.links;
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


        onChangeCategoryFunction() {  

            if(this.categoryval == ""){
            
            window.location.reload();

            }else{
            
            axios.post('/recipe-search-filter',{type:'filter',term:this.categoryval})
                    .then((response)=>{
                       this.recipes = response.data;
                       this.links = this.recipes.links;
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
.cart-color {
    color: #f7a53a;
}
</style>
