<template>
  <Head>
  <title>Group Meal Prep | NutriStudents K-12</title>
  <meta name="description" content="Food Production Report">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <U>Tools</U> 
    </BreadcrumLayout>
    <PageTitleLayout>
        
      <div class="lg:mb-0 mb-4 w-full">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">Group Meal Prep</h1>
      </div>
      <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center">
        
      </div>
    </PageTitleLayout>
 
    <div class="xl:flex w-full xl:px-10 px-5 xl:pt-10 pt-5 lg:mb-10 mb-5 justify-between items-end">
    <div class="sm:flex flex-wrap items-end -mx-3">
       
      <div
          class="
            relative
            focus:outline-none
            lg:w-48
            sm:w-1/2
            w-full
            px-3
            xl:mt-0
            mb-4 lg:mb-0
            ml-5
          "
        >
        <label for="" class="font-bold text-black-800 uppercase text-sm">Date</label>
        <input class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" type="date" v-model="form.date" @change="getDateRecipeData" />
      </div>
        <div
          class="
            relative
            focus:outline-none
            lg:w-48
            sm:w-1/2
            w-full
            px-3
            xl:mt-0
            mb-4 lg:mb-0
          "
        >
        <label for="" class="font-bold text-black-800 uppercase text-sm">Meal Type</label>
          <select
            class="
              shadow-sm
              focus:border-none
              block
              sm:text-sm
              border-gray-300
              rounded-lg
              w-full
              select-menu-height
            "
            v-model="form.meal_type"
            @change="getOffering($event)"            
          >
            <option value="">Select</option> 
            <option type="site" v-for="site in mealTypes" :value="site.id">
              {{ site.name }}
            </option> 
            
          </select>

          <div
            class="
              absolute
              flex
              justify-center
              items-center
              searching-background-color
              select-menu-height
              w-9
              text-white
              bottom-0
              right-3
              rounded-lg rounded-tl-none rounded-bl-none
              pointer-events-none
            "
          >
            <i class="fa fa-sort-desc" aria-hidden="true"></i>
          </div>
        </div>

        <div
            class="
              relative
              focus:outline-none
              lg:w-48
              sm:w-1/2
              w-full
              px-3
              xl:mt-0
              mb-4 lg:mb-0
            "
          >
            <label for="" class="font-bold text-black-800 uppercase text-sm">PREP GROUP</label>
            <select
              class="
                shadow-sm
                focus:border-none
                block
                sm:text-sm
                border-gray-300
                rounded-lg
                w-full
                select-menu-height
              "
                v-model="form.meal_preparation_group_id"
                @change="getDateRecipeData"
            >
              <option value="">Select</option>
              <option v-for="offer in meal_preparation_groups" :value="offer.id">
                {{ offer.name }}
              </option>
            </select>

            <div
              class="
                absolute
                flex
                justify-center
                items-center
                searching-background-color
                select-menu-height
                w-9
                text-white
                bottom-0
                right-3
                rounded-lg rounded-tl-none rounded-bl-none
                pointer-events-none
              "
            >
              <i class="fa fa-sort-desc" aria-hidden="true"></i>
            </div>
          </div>
          <button @click="resetSeatch" class="button-color w-40 text-white font-bold py-1.5 rounded px-1.5 md:mt-0 mt-4"><a href="javascript:void(0)"> Reset Search </a></button>
        </div>
          
          <div v-if="form.meal_preparation_groups && form.meal_preparation_groups.length > 0">

            <a @click="downloadPrepReport()" href="javascript:void(0)" class="button-color text-white font-bold rounded px-6 xl:mt-0 inline-block py-1.5">Export Prep Report</a>

            <a @click="downloadAllReport()" href="javascript:void(0)"  class="button-color text-white font-bold rounded px-6 xl:mt-0 inline-block ml-3 py-1.5">Export All</a>           
          </div>

        

    </div>

   
    <!-- <TableFilterLayout @messageFromChild="recipeSearchData" :searchVal="rec_searched"/> -->

    <TableIndexLayout>
      <div class="-my-2 mb-0">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full pb-0">
          <div class="shadow mb-10 overflow-auto">
            <table class="min-w-full">
          <thead class="header-bg-color">
            <tr>
              <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                Recipe
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                Previous Count
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                Current Count
              </th> 
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                Override Count
              </th> 
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
              </th> 
            </tr>
          </thead>
          <tbody>
            

            <tr v-if="!getDateRecipe" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">Please select date, meal type, prep group</td>
            </tr>

            <tr v-if="getDateRecipe && (form.meal_preparation_groups == '' && form.meal_preparation_groups.length == 0)" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Record Found</td>
            </tr>


            <!-- Odd row -->
            <!-- Sites -->
            <tr v-for="gsite in form.meal_preparation_groups" class="bg-white border-b border-gray-300 ">
                <td  class="text px-6 py-4">
                  <b v-if="gsite.type == 'recipe'">{{ gsite.name }}</b>
                  <span class="pl-4" v-else>{{ gsite.name }}</span>                  
                </td>            
 
                <td class="px-6 py-4"><b v-if="gsite.type == 'recipe'">{{ gsite.prev_count }}</b>
                  <span v-else>{{ gsite.prev_count }}</span></td> 
                <td class="px-6 py-4">
                  <b v-if="gsite.type == 'recipe'">{{ gsite.student_count }}</b>
                  <span  v-else>{{ gsite.student_count }}</span></td>
                <td class="px-6 py-4">
                  <input type="text" v-model="gsite.override_count" @change="getToalOverride(gsite.r_id)" v-if="gsite.type == 'site'" class="w-full shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height input-background">  
                  <span  v-else>{{ (gsite.override_count == gsite.student_count)?'':gsite.override_count }}</span> 
                </td>
                
                <td class="px-6 py-4 whitespace-nowrap font-bold underline id-color text-2xl">                  
                  <a v-if="gsite.type == 'recipe'" target="_blank" :href="route('sizing-calculator.download-card', [gsite.id, gsite.override_count])"  ><i class="fa fa-external-link" aria-hidden="true"></i></a>
                </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

    
    </TableIndexLayout>
  </default-layout>
</template>
<script>
import DefaultLayout from "@/Layouts/DefaultLayout";
import BreadcrumLayout from "@/Pages/Common/Breadcrumbs";
import PageTitleLayout from "@/Pages/Common/PageTitle";
import TableFilterLayout from "@/Pages/Common/TableFilters";
import TableIndexLayout from "@/Pages/Common/TableIndex";
import Paginate from "@/Pages/Partials/Paginate";
import Option from '../MenuCycle/Option.vue';
import { Link } from '@inertiajs/inertia-vue3';

export default {
  props:['mealTypes'],
  components: {
    DefaultLayout,
    BreadcrumLayout,
    PageTitleLayout,
    TableFilterLayout,
    TableIndexLayout,
    Paginate,
    Link
  },
  data(){
    return {
      recipes:[],
      searchResults:[],
      offerings:[],
      options:{},
      exportRecipe:[],
      exportRecipeSearced:[],
      exportAssembly:[],
      recipeStudentCount:[],
      recipeCurrentStudentCount:[],
      searchByName:'',
      siteName:[],
      is_data_show : false,
      meal_preparation_groups:[],
      recipeCount:[],
      form: {
        date:'',
        meal_type: '',
        meal_preparation_group_id: '',
        meal_preparation_groups:[]
      },
    }
  },
  computed: {      
      getDateRecipe:function () {
          if(this.form.date != '' && this.form.meal_type != '' && this.form.meal_preparation_group_id != ''){
              return true;
          } else {
            this.recipes = [];
            return false;
          }
      },
      getRecipeOverride:function() {
        return this.recipeCount;
      }
       
      
  },
  methods:{
    showLoader(t){
      if(t == 'show'){
        document.getElementById('full_loader').style.display="flex";
      } else {
        document.getElementById('full_loader').style.display="none";
      }
    },
    getToalOverride(rid){
      let total_override = 0;
      this.form.meal_preparation_groups.forEach(element => {
        // console.log("total_override", element);
        if(element.type == 'site' && element.r_id == rid){
          if(element.override_count > 0){
            total_override = parseInt(element.override_count) + parseInt(total_override);
          } else if(element.student_count > 0){
            total_override = parseInt(element.student_count) + parseInt(total_override);
          }          
        }
      });
      this.form.meal_preparation_groups.forEach(element => {
        console.log("total_override r ", element);
        if( element.id == rid){
          element.override_count = total_override;
        }
      });
      // return (total_override > 0)?total_override:'';
    },
    showCount(sc){
      if(isNaN(sc)){
        return 'N/A';
      } else if(sc >= 1) {
        return sc;
      } else if(sc === 0){
        return 0;
      } else{
        return 'N/A';
      }
    },

    resetSeatch(){
        this.form = {
              date:'',
              meal_type: '',
              meal_preparation_group_id: '',
              meal_preparation_groups:[]
            };
        this.recipes = [];
        this.searchResults = [];
        this.offerings = [];
        this.options = {};
        this.exportRecipe = [];
        this.exportRecipeSearced = [];
        this.exportAssembly = [];
        this.recipeStudentCount = [];
        this.searchByName = "";
      },

         
        

       

        showOfferName(){
          if(this.form.type == "group"){
            return '-';
          } 
          if(this.form.type == "site"){
            return this.offerings.find(e => e.id == this.form.offer).name;
            
          }         
        },

        downloadAllReport(){
          
          let $this = this;
          $this.showLoader('show');
          axios
            .post(this.route('group-meal-prep.export-all'), this.form)
            .then((response) => {
              // let blob = new Blob([response.data], { type: response.headers['content-type'] });
              let link = document.createElement('a');
              link.href = response.data;
              link.click();  
              $this.showLoader('');            
            })
          .catch((error) => console.error(error));            
        },

        downloadPrepReport(){
          let $this = this;
          $this.showLoader('show');
          axios
            .post(this.route('group-meal-prep.export-prep-report'), {preps:this.form.meal_preparation_groups})
            .then((response) => {
              $this.showLoader('');
              // cosnole
              // var blob=new Blob([response.data]);
              var link=document.createElement('a');
              link.href = response.data;
              link.download="";
              link.target="_blank";
              link.click();
              // let link = document.createElement('a');
              // link.href = response.data;
              // link.download="my-downloaded-file.pdf";
              // link.click();
              // let blob = new Blob([response.data], { type: response.headers['content-type'] });
              // var link=document.createElement('a');
              // link.href=window.URL.createObjectURL(blob);
              // link.download="my-downloaded-file.pdf";
              // link.click();
            })
          .catch((error) => console.error(error));            
        },

        getDateRecipeData(){
          console.log("getDateRecipeData", this.form);
          let $this = this;
            if(this.form.date != '' && this.form.meal_type != '' && this.form.meal_preparation_group_id != ''){
            
            $this.form.sites = [];
            let form = {
              date:this.form.date,
              meal_type: this.form.meal_type,
              meal_preparation_group_id: this.form.meal_preparation_group_id
            }
            axios
            .get(this.route('get-group-meal-prep-data',  form))
            .then((response) => {
              $this.searchResults = [];
              console.log("response.data", response.data);
              if(response.data.status){
                response.data.data.forEach(element => {
                  if(element.type =='recipe'){
                    $this.recipeCount[element.r_id]=[];
                  }                  
                  console.log("recipeCount", $this.recipeCount);
                });
                $this.form.meal_preparation_groups = response.data.data;   
                
              } else {
                $this.form.day_id = '';
                  $this.form.meal_preparation_groups = [];
                $this.recipeCount = [];
              }
              
            })
          .catch((error) => console.error(error));
            } else {
              $this.form.meal_preparation_groups = [];
              $this.recipeCount = [];
            }
        },

        getOffering(event){
          this.form.day_id = "";
          var options = event.target.options;
          let sid = this.form.meal_type;
          let site = this.mealTypes.find(o => o.id === sid);
          if(site){
              this.meal_preparation_groups = site.meal_preparation_groups;
          } else {
              this.meal_preparation_groups = [];
          }
        }
        
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
.recipe_name_list{
  display: none;
}
.onhover:hover .recipe_name_list{
  display: block;
}
table.min-w-full tr:last-child .recipe_name_list {
    top: auto;
    bottom: 32px;
}
</style>
