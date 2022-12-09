<template>
  <Head>
  <title>Meal Preparation Group | NutriStudents K-12</title>
  <meta name="description" content="Recipes">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
    </BreadcrumLayout>
    <PageTitleLayout>
      <div class="lg:mb-0 mb-4">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">Meal Preparation Group</h1>
      </div>
      <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center">
        <div class="relative focus:outline-none lg:w-44 sm:w-1/2 w-full">
          <select id="search_meal_type" name="search_meal_type" autocomplete="search_meal_type"
            class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" @change="onChangeFunction" v-model="search_meal_type">
            <option value="">Meal Type</option>
            <option v-for="category in mealTypes" :value="category.id">{{category.name}}</option>
          </select>
          <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
        </div>

        <inertia-link :href="route('meal-preparation-groups.add')" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 mt-10">
          CREATE NEW GROUP
          </inertia-link>
      </div>
    </PageTitleLayout>

    <TableFilterLayout @messageFromChild="groupSearchData" :searchVal="rec_searched"/>

    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-auto max-height-screen">
            <table class="min-w-full">
          <thead class="header-bg-color">
            <tr>
              <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                GROUP NAME
              </th>
             
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                MEAL TYPE
              </th> 
               
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                Action
              </th>  
            </tr>
          </thead>
          <tbody>
            

            <tr v-if="!groups.data.length" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Group Found</td>
            </tr>

            <!-- Odd row -->
            <tr v-for="(group,index) in groups.data" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                   {{group.name}}
                </td>
                 
                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                  {{group.meal_type.name}}
                </td> 

                 
                <td class="px-6 py-4 whitespace-nowrap  id-color text-xl  font-extrabold">
                  
                    <inertia-link :href="route('meal-preparation-groups-edit', { id: group.id })" class="">
                        <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>  
                    </inertia-link>

                    <button type="button" @click="creation_delete_script(group.id)" class="">
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
        <inertia-link :href="route('meal-preparation-groups.add')" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 mt-10">
          CREATE NEW GROUP
        </inertia-link>
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
  props:['groupss','categories','rec_searched','rec_filter','mealTypes','ageGradeOfferings','days'],
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
      groups:this.groupss,
      links:this.groupss.links,

      search_meal_type : '',
      search_offerings: '',
      search_day: '',

      form: this.$inertia.form({

      })
    }
  },
  methods:{
        creation_delete_script(rid) {
          if(confirm("Are you sure you want to delete this group?")){
          this.form.post(this.route('meal-preparation-groups.group-delete', rid), {
                onSuccess: () => {
                  this.$toast.success('Meal preparation group deleted successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
              });
          }
        },
        groupSearchData(search){
            if(search == ""){
              // this.recipes = this.groups;
              // this.links = this.groups.links;
              this.onChangeFunction();
            }else{
              axios.post('/meal-preparation-groups-search-filter',{type:'search',term:search})
              .then((response)=>{
                  this.groups = response.data;
                  this.links = this.groups.links;
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
        onChangeFunction() {  
           axios.post('/meal-preparation-groups-search-filter',{type:'filter',term:this.search,meal:this.search_meal_type,day:this.search_day,offrings:this.search_offerings})
          .then((response)=>{
              this.groups = response.data;
              this.links = this.recipes.links;
              this.links.map(function(item, i){
                if(item.url){
                  let new_url = item.url.split('?');
                  let main_url = window.location.href.split('?')[0];
                  item.url = main_url +'?' +new_url[1] +'&filter=';
                  return item;
                }
              });
            })
          .catch(error => console.error(error));
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
