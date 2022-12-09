<template>
  <Head>
  <title>Sizing Calculator | NutriStudents K-12</title>
  <meta name="description" content="Sizing Calculator">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <U>Tools</U> 
    </BreadcrumLayout>
    <PageTitleLayout>
        
      <div class="lg:mb-0 mb-4 w-full">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">Sizing Calculator</h1>
      </div>
      <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center">
        
      </div>
    </PageTitleLayout>
 
    <div class="xl:flex w-full xl:px-10 px-5 xl:pt-10 pt-5 lg:mb-10 mb-5 justify-between items-end">
    <div class="sm:flex flex-wrap items-end -mx-3">
      <div class="searching relative
            focus:outline-none
            lg:w-56
            sm:w-1/2
            w-full
            px-3
            xl:mt-0
            mb-4 lg:mb-0">
        <label for="" class="font-bold text-black-800 uppercase text-sm">Search</label>
        <div class="relative md:w-56">
          
          <input class="border-2 border-gray-300 bg-white h-10 px-3 pr-10 rounded-lg text-sm focus:outline-none w-full" type="search" name="searchByName" placeholder="Search Recipe" v-model="searchByName" @keyup.enter="recipeSearchData" @input="onQueryChange" >
          <button type="submit" class="absolute right-0 top-0 mt-2 mr-4 outline-none" @click="recipeSearchData"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
      </div>
      <span style="margin-bottom: 7px; margin-left: 25px; margin-right: -15px;">OR</span>
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
        <input class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height" type="date" v-model="form.date" />
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
        <label for="" class="font-bold text-black-800 uppercase text-sm">Site/Group</label>
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
            v-model="form.site"
            @change="getOffering($event)"            
          >
            <option value="">Choose Site/Group</option>
            <optgroup label="Site">
            <option type="site" v-for="site in sites" :value="site.id">
              {{ site.name }}
            </option>
            </optgroup>

            <optgroup  label="Groups">
              <option type="group" v-for="site in mealPreparationGroups" :value="site.id">
              {{ site.name }}
            </option>

            </optgroup>
            
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
            <label for="" class="font-bold text-black-800 uppercase text-sm">offering</label>
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
                v-model="form.offer"
            >
              <option value="">Choose Offerings</option>
              <option v-for="offer in offerings" :value="offer.id">
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
          <div v-if="exportAssembly.length > 0 || exportRecipe.length > 0 || exportRecipeSearced.length > 0">
            <a :href="route('sizing-calculator.export-all', [{'assembly': exportAssembly}, {'recipe' : exportRecipe, 'recipeStudentCount': recipeStudentCount, 'searchRecipe' : exportRecipeSearced, 'recipeCurrentStudentCount':recipeCurrentStudentCount, 'type':form.type, 'site':form.site, 'date':form.date }])" target="_blank" class="button-color text-white font-bold py-3 rounded px-6 mt-5 xl:mt-0">Export Selected </a>
           
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
                # 
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                Recipe
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                Current Count
              </th> 
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                Override Count
              </th> 
            </tr>
          </thead>
          <tbody>
            

            <tr v-if="!getDateRecipe && searchResults.length == 0" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">Please enter recipe name or select date, site, offering</td>
            </tr>

            <tr v-if="getDateRecipe && searchResults.length == 0 && getConvertData.length == 0" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Record Found</td>
            </tr>


            <!-- Odd row -->
            <!-- Sites -->
            <tr v-if="getDateRecipe && this.form.type != 'group'" v-for="(option,index) in getConvertData" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                  <input v-if="option.is_type == 'option'" class="focus:ring-blue-500 h-6 w-6 text-blue-600 border-2 border-gray-300 rounded" v-model="exportAssembly" :value="option.id" type="checkbox" />
                  <input v-else class="focus:ring-blue-500 h-6 w-6 text-blue-600 border-2 border-gray-300 rounded" v-model="exportRecipe" :value="option.id" type="checkbox" />

                </td>
                <td v-if="option.is_type == 'option'" class="text px-6 py-4">
                  <b>{{ option.name }}</b>
                </td>
                <td v-else class="px-6 py-4">
                 {{ option.recipe.name }}
                </td>

                <td v-if="option.is_type == 'option'" class="px-6 py-4 "></td>
                <td v-else class="px-6 py-4 ">{{ option.student_count }}</td>

                <td v-if="option.is_type == 'option'" class="px-6 py-4"></td>
                <td v-else class=" px-6 py-4"><input type="text" class="border-gray-300 rounded w-20" v-model="recipeStudentCount[option.id]" ></td>

                <td class="px-6 py-4 whitespace-nowrap font-bold underline id-color text-2xl" v-if="option.is_type == 'option'" >
                  <a target="_blank" :href="route('sizing-calculator.download-assembly-instructions', option.id)" ><i class="fa fa-external-link" aria-hidden="true"></i></a>
                </td>
                <td v-else class="px-6 py-4 whitespace-nowrap font-bold underline id-color text-2xl">                  
                  <a target="_blank" :href="route('sizing-calculator.download-recipe-card', [option.id , recipeStudentCount[option.id]])" ><i class="fa fa-external-link" aria-hidden="true"></i></a>
                </td>
            </tr>

            <!-- Groups -->
            <tr v-if="getDateRecipe && this.form.type == 'group'" v-for="(option,index) in getConvertData" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                  <input v-if="option.is_type == 'option'" class="focus:ring-blue-500 h-6 w-6 text-blue-600 border-2 border-gray-300 rounded" v-model="exportAssembly" :value="option.id" type="checkbox" />
                  <input v-else class="focus:ring-blue-500 h-6 w-6 text-blue-600 border-2 border-gray-300 rounded" v-model="exportRecipe" :value="option.id" type="checkbox" />

                </td>
                <td v-if="option.is_type == 'option'" class="text px-6 py-4">
                  <b>{{ option.name }} </b>
                </td>
                <td v-else class="px-6 py-4"> 
                  {{ option.recipe.name }} 
                   
                </td>

                <td v-if="option.is_type == 'option'" class="px-6 py-4 "></td>
                <td v-else class="px-6 py-4 ">
                  <div class="onhover relative cursor-pointer">
                  {{ option.student_count }}
                  <div class="recipe_name_list absolute top-8 left-0 rounded-sm bg-white p-3 shadow-lg w-48 z-20">
                    <label v-for="(sName, index) in option.sites">
                      {{ showSiteName(index) }} - {{ showCount(sName) }}<br>
                    </label>
                   </div>
                 </div>
                 </td>

                <td v-if="option.is_type == 'option'" class="px-6 py-4"></td>
                <td v-else class=" px-6 py-4"><input type="text" class="border-gray-300 rounded w-20" v-model="recipeStudentCount[option.id]" ></td>

                <td class="px-6 py-4 whitespace-nowrap font-bold underline id-color text-2xl" v-if="option.is_type == 'option'" >
                  <a target="_blank" :href="route('sizing-calculator.download-assembly-instructions', option.id)+'?type=group&site='+form.site + '&date='+ form.date" ><i class="fa fa-external-link" aria-hidden="true"></i></a>
                </td>
                <td v-else class="px-6 py-4 whitespace-nowrap font-bold underline id-color text-2xl">                  
                  <a target="_blank" :href="route('sizing-calculator.download-recipe-card', [option.id , (recipeStudentCount[option.id])?recipeStudentCount[option.id]:option.student_count ])" ><i class="fa fa-external-link" aria-hidden="true"></i></a>
                </td>
            </tr>

            <!-- Search Result -->

            <tr v-if="searchResults" v-for="(option,index) in searchResults" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}"> 
              <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                  <input class="focus:ring-blue-500 h-6 w-6 text-blue-600 border-2 border-gray-300 rounded" v-model="exportRecipeSearced" :value="option.id" type="checkbox" />
              </td>   
              <td class="px-6 py-4">
                {{ option.name }}
              </td>
              <td class="px-6 py-4">0</td>
              <td class=" px-6 py-4">
                <input type="text" class="border-gray-300 rounded w-20" v-model="recipeStudentCount[option.id]" >
              </td>     
              <td class="px-6 py-4 whitespace-nowrap font-bold underline id-color text-2xl">                  
                <a target="_blank" :href="route('sizing-calculator.download-card', [option.id , recipeStudentCount[option.id]])" ><i class="fa fa-external-link" aria-hidden="true"></i></a>
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

export default {
  props:['sites', 'mealPreparationGroups'],
  components: {
    DefaultLayout,
    BreadcrumLayout,
    PageTitleLayout,
    TableFilterLayout,
    TableIndexLayout,
    Paginate
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
      form: {
        date:'',
        site: '',
        offer: '',
        type:''
      },
    }
  },
  computed: {
      
      getDateRecipe:function () {
          if(this.form.date != '' && this.form.site != '' && (this.form.offer != '' || this.form.type == 'group' ) ){
              this.getDateRecipeData();
              return true;
          } else {
            this.recipes = [];
            return false;
          }
      },
      getConvertData: function () {
        let $this = this;
        let recpArray = [];
        this.recipes.forEach(rec => {
          rec.is_type = 'option';
          recpArray.push(rec);
          console.log("rec.menu_cycle_day_options", rec.menu_cycle_day_option_components);
          if(rec.menu_cycle_day_option_components){
            rec.menu_cycle_day_option_components.forEach(ra => {
              ra.is_type = 'recipe';
              // ra.name = (ra.recipe)?ra.recipe.name:'no recipe';
              recpArray.push(ra);
            })
          }
        });       
        return recpArray;
      },
      
  },
  methods:{

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
              site: '',
              offer: '',
              type:''
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

        getRecipeStudentCount(){
          let $this = this;
          this.recipeStudentCount  = [];
          this.recipeCurrentStudentCount = [];
          this.recipes.forEach(rec => {
          if(rec.menu_cycle_day_option_components){
            rec.menu_cycle_day_option_components.forEach(ra => {
              ra.is_type = 'recipe';
              $this.recipeStudentCount[ra.id] = null;
              $this.recipeCurrentStudentCount[ra.id] = ra.student_count;
            })
          }
        });
        console.log("recipeStudentCount", this.recipeStudentCount);
        },
        getSearchRecipeStudentCount(){
          let $this = this;
          this.recipeStudentCount  = [];
          this.recipeCurrentStudentCount = [];
          console.log("searchResults", this.searchResults);
          this.searchResults.forEach(rec => {
            $this.recipeStudentCount[rec.id] = null;
            $this.recipeCurrentStudentCount = [];
          });
          console.log("recipeStudentCount", this.recipeStudentCount);
        },

        showSiteName(site_id){
          console.log("siteName", this.siteName);
          return (this.siteName[site_id])?this.siteName[site_id]:site_id;
        },

        getDateRecipeData(){
            console.log("getDateRecipeData", this.form);
            let $this = this;
            axios
            .get(this.route('get-sizing-calculator-data',  this.form))
            .then((response) => {
              this.searchResults = [];
              console.log("response.data", response.data);
              if(response.data.status){
                this.exportRecipe = [];
                this.exportAssembly = [];
                this.options = response.data;
                if(response.data.data){
                  $this.siteName = response.data.sites;
                  $this.recipes = [];
                  if(response.data.type == 'group'){

                    // this.recipes = response.data.data.menu_cycle_day_options;
                    response.data.data.forEach(rec => {
                      $this.recipes.push(rec);
                      // $this.recipes = rec.menu_cycle_day_options;
                    });
                  } else {
                    response.data.data.forEach(rec => {
                      rec.menu_cycle_day_options.forEach(opRec => {
                        $this.recipes.push(opRec);
                      });
                      // $this.recipes = rec.menu_cycle_day_options;
                    });
                  }
                  
                  
                }
                // this.recipes = response.data.data.menu_cycle_day_options;
                this.getRecipeStudentCount();
              } else {
                this.recipes = [];
                this.exportRecipe = [];
                this.exportAssembly = [];
                this.recipeStudentCount = [];
                this.recipeCurrentStudentCount = [];
              }
              
            })
          .catch((error) => console.error(error));
        },

        getOffering(event){
           var options = event.target.options;
           console.log("options", options);
           var type = '';
          if (options.selectedIndex > -1) {
            type = options[options.selectedIndex].getAttribute('type');
            console.log("type ", type );
          }
          this.form.type = type;
          console.log("this.form", this.form);

          if(this.form.type == 'group'){
            this.getDateRecipeData();
            this.offerings = [];
          } else {
            let sid = this.form.site;
          let site = this.sites.find(o => o.id === sid);
          if(site){
              this.offerings = site.offerings;
          } else {
              this.offerings = [];
          }
          this.form.offer = '';
          }

          
        },
      recipeSearchData(){
        axios.post('/recipe-search-filter',{type:'search',term:this.searchByName})
          .then((response)=>{
            this.recipes = [];
            this.searchResults = response.data.data;
              this.getSearchRecipeStudentCount();
            
            })
          .catch(error => console.error(error));
      },
       onQueryChange(event) {
        if(event.target.value.trim().length === 0) {
          this.recipes = [];
          this.searchResults = [];
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
