<template>
  <Head>
  <title>Food Production Report | NutriStudents K-12</title>
  <meta name="description" content="Food Production Report">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <U>Tools</U> 
    </BreadcrumLayout>
    <PageTitleLayout>
        
      <div class="lg:mb-0 mb-4 w-full">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">Food Production Report</h1>
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
              <option type="group" v-for="site in MenuCreationGroup" :value="site.id">
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
                @change="getDateRecipeData"
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
                Date
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                Site/Group
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                Offering
              </th> 
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
              </th> 
            </tr>
          </thead>
          <tbody>
            

            <tr v-if="!getDateRecipe" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">Please select date, site/group, offering</td>
            </tr>

            <tr v-if="getDateRecipe && (form.day_id == '' && form.sites.length == 0)" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Record Found</td>
            </tr>


            <!-- Odd row -->
            <!-- Sites -->
            <tr class="bg-white" v-if="getDateRecipe && form.day_id != ''">
                <td  class="text px-6 py-4">
                  <b>{{ form.date }}</b>
                </td>            
 
                <td    class="px-6 py-4">{{ showSiteName() }}</td> 
                <td    class="px-6 py-4">{{ showOfferName() }}</td> 
                
                <td   class="px-6 py-4 whitespace-nowrap font-bold underline id-color text-2xl">                  
                  <a target="_blank" :href="'/download-fpr/'+form.day_id + '?curent_date='+form.date+'&site_id='+ form.site"  ><i class="fa fa-external-link" aria-hidden="true"></i></a>
                </td>
            </tr>
            <tr v-for="gsite in form.sites" class="bg-white">
                <td  class="text px-6 py-4">
                  <b>{{ form.date }}</b>
                </td>            
 
                <td class="px-6 py-4">{{ gsite.site_name }}</td> 
                <td class="px-6 py-4">{{ gsite.name }}</td>
                
                <td   class="px-6 py-4 whitespace-nowrap font-bold underline id-color text-2xl">                  
                  <a target="_blank" :href="'/download-fpr/'+gsite.day_id + '?curent_date='+form.date+'&site_id='+ gsite.site_id"  ><i class="fa fa-external-link" aria-hidden="true"></i></a>
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
  props:['sites', 'MenuCreationGroup'],
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
      is_data_show : false,
      form: {
        date:'',
        site: '',
        offer: '',
        type:'',
        day_id:'',
        sites:[]
      },
    }
  },
  computed: {      
      getDateRecipe:function () {
          if(this.form.date != '' && this.form.site != '' && (this.form.offer != '' || this.form.type == 'group' ) ){
              // this.getDateRecipeData();
              return true;
          } else {
            this.recipes = [];
            return false;
          }
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
              type:'',
              day_id:'',
              sites:[]
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

         
        

        showSiteName(){
          if(this.form.type == "group"){
            return this.MenuCreationGroup.find(e => e.id == this.form.site).name;
          } 
          if(this.form.type == "site"){
            return this.sites.find(e => e.id == this.form.site).name;
            
          }         
        },

        showOfferName(){
          if(this.form.type == "group"){
            return '-';
          } 
          if(this.form.type == "site"){
            return this.offerings.find(e => e.id == this.form.offer).name;
            
          }         
        },

        getDateRecipeData(){
            // console.log("getDateRecipeData", this.form);
            if(this.form.date != '' && this.form.site != '' && (this.form.offer != '' || this.form.type == 'group' ) ){
            let $this = this;
            $this.form.sites = [];
            axios
            .get(this.route('get-food-production-report-data',  this.form))
            .then((response) => {
              $this.searchResults = [];
              console.log("response.data", response.data);
              if(response.data.status){
                if($this.form.type == "group"){
                  console.log("response.data.data", response.data.data)
                  $this.form.sites= response.data.data;
                } else {
                  $this.form.day_id = response.data.data;                 
                }
                
              } else {
                $this.form.day_id = '';
              }
              
            })
          .catch((error) => console.error(error));
            }
        },

        getOffering(event){
          this.form.day_id = "";
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
