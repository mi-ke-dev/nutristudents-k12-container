<template>
  <Head>
  <title>Add No Meal Service | NutriStudents K-12</title>
  <meta name="description" content="Add New Special days">
  </Head>
  <default-layout>

    <BreadcrumLayout>
      <div class="flex">
        <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
        <inertia-link :href="route('special-days')" class="link-color"><U>No Meal Service</U></inertia-link></div>
      </BreadcrumLayout>



      <form action="#" @submit.prevent="false">

        <PageTitleLayout>
          <div class="lg:mb-0 mb-4 w-4/6">
            <h1 class="heading-color  2xl:text-2xl text-xl font-bold">Add New No Meal Service</h1>
          </div>
          <div class="w-full flex lg:flex-nowrap flex-wrap md:justify-end items-center">

            <button type="button" class="">
              <inertia-link :href="route('special-days')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
            </button>

            <button type="button" @click="helpstate_add_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3 sm:mt-0">Save</button>
          </div>
        </PageTitleLayout>


        <PageTitleLayout>
          <div class="w-full">
            <div class="block justify-between shadow py-8 mt-4 align-middle inline-block min-w-full   bg-white rounded-t-lg lg:divide-y-2 border-gray-300 w-full overflow-x-auto">
              <div class="w-full">
                <div class="xl:flex block xl:items-center p-5">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Sites*</label>
                  <div class="relative focus:outline-none lg:w-80 sm:w-1/2 mr-3 xl:mt-0">
                    <select 
                    v-model="form.site_id" required name=""
                    @change="getOffering($event)"
                    class="shadow-sm focus:border-none 
                    block sm:text-sm border-gray-300 
                    rounded-lg w-full select-menu-height">
                      <option v-for="(val, id) in sites" :value="id">{{ val }}</option>
                    </select>
                    <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                   <!-- <input type="text" id="helpstate_name" name="helpstate_name" v-model="form.helpstate_name"
                   class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">    -->
                   <div v-if="form.errors.site_id" class="validation_error_msg">{{ form.errors.site_id }}</div> 
                 </div>
               </div>
             </div>

            <div class="w-full">
                <div class="xl:flex block xl:items-center p-5">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Offerings*</label>
                  <div class="relative focus:outline-none lg:w-80 sm:w-1/2 mr-3 xl:mt-0">
                    <select 
                    v-model="form.offering_id"
                    change="getGuidline($event)"
                    class="shadow-sm focus:border-none block 
                    sm:text-sm border-gray-300 rounded-lg
                     w-full select-menu-height">
                     
                      <option v-for="offer in offrings" :value="offer.id">{{ offer.name }}</option>
                    </select>
                    <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>
                   <!-- <input type="text" id="helpstate_name" name="helpstate_name" v-model="form.helpstate_name"
                   class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">    -->
                   <div v-if="form.errors.offering_id" class="validation_error_msg">{{ form.errors.offering_id }}</div> 
                 </div>
               </div>
             </div>



           <div class="w-full" v-for="(dateArray, ind) in showDates">
               <div class="xl:flex block xl:items-center p-5">
                 <label class="font-bold text-gray-700  2xl:text-lg text-base w-full md:w-40">Date*</label>  
                  <div class="relative">
                    <div >
                      <input @change="changeDate" v-model="form.date[ind]" required type="date"  name="helpstate_youtube"  class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">
                   
   <a v-if="form.date.length > 1" href="javascript:void(0)" @click="deleteDate(ind)"> <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 id-color float-right mt-2 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
</svg></a>

                    </div>
                    
                             
                  
                  <div v-if="form.errors.date" class="validation_error_msg">{{ form.errors.date }}</div>
                  </div>
              </div>
              
           </div>
        
      </div>
    </div>
  </PageTitleLayout>        


  <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center mb-6 px-10 mt-6">

    <button type="button" class=" ">
      <inertia-link class="w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40" :href="route('special-days')" >Cancel</inertia-link>
    </button>

    <button type="button" @click="helpstate_add_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3  sm:mt-0" >Save</button>

  </div>

</form>

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

    props:['sites', 'site','offering_id','is_menu_planner'],

    components: {
      DefaultLayout,
      Welcome,
      BreadcrumLayout,
      PageTitleLayout,
      TableFilterLayout,
      TableIndexLayout,
    },

    computed: {
      disableSubmit(){

      },
    showDates: {
        get(){
          return this.form.date;
        },
        set(newVal){
          if(this.form.date[this.form.date.length -1]){
            console.log("this.form.date[this.form.date.length -1]",this.form.date.length, this.form.date);
              this.form.date.push('');
          } else {
            console.log("else",this.form.date.length, this.form.date);
          }
        }
      }
    },

    data(){
      return {
        log: console.log,
        offrings: [], 
        form: this.$inertia.form({
          site_id:this.site,
          offering_id:this.offering_id,
          date:[''],
          is_menu_planner:this.is_menu_planner
        })
      }
    },
    mounted() {
      if(this.offering_id != '' && this.site != ''){
        this.loadOffrings(this.site,this.offering_id);
      }
    },

    methods:{
      changeDate(){
        console.log("changeDate this.form.date", this.form.date);
        if(this.form.date[this.form.date.length -1] != ''){
          console.log("changeDate if",this.form.date.length, this.form.date);
          this.form.date.push('');
        } else {
          console.log("changeDate else",this.form.date.length, this.form.date);
        }
      },
      deleteDate(indx){
        this.form.date.splice(indx, 1);
      },

      helpstate_add_save_script(){
         this.$toast.clear();
        if(this.form.date[0] != '' && this.form.site_id != ''){
          this.form.post(this.route('add-special-days-save'), {
            onSuccess: () => {    
              this.$toast.success('No Meal Service has been created successfully!');
            },
          });
        } else {
          console.log("Erorr");
          this.$toast.error("Error: All fields are required!");
        }
        
      },
      getOffering(event){
        axios
        .post("/get-offring", {
              site_id: event.target.value,
          })
          .then((response) => {
            this.form.site_id = event.target.value;
            this.offrings = response.data;
          })
          .catch((error) => console.error(error));
      },
      getGuidline(event){
       axios
       .post("/get-guideline", {
            id: event.target.value,
        })
        .then((response) => {
          this.form.offering_id = event.target.value;
        })
        .catch((error) => console.error(error));
      },
      loadOffrings(site,offering_id){
       axios
       .post("/get-offring", {
            site_id: site,
        })
        .then((response) => {
          this.form.site_id = site;
          this.form.offering_id = offering_id;
          this.offrings = response.data;
          //this.getGuidlineData(offering_id);
        })
        .catch((error) => console.error(error));
      },
      getGuidlineData(offering_id){
        axios
        .post("/get-guideline", {
              id: offering_id,
          })
          .then((response) => {
            this.form.offering_id = offering_id;
          })
          .catch((error) => console.error(error));
      }
    },
    

  };
</script>
<style>
.min-height-third{
 min-height: 400px; 
}

.sm\:text-sm {
  font-size: 0.850rem;
  line-height: 1.25rem;
}

.w-52-rec {
  width: 13.2rem;
}

.input-background{
  background-color: #f8f8f8;
}

.button-bg-color-wed-menu2-gray{
  border: none!important;
  min-height: 35px;
  min-width: 35px;
}

.menu1-background-color{
  background-color:#FAA43D;
}

.button-bg-color-wed-menu2{
  background-color: #38558e;
  border: none!important;
  min-height: 35px;
  min-width: 35px;
}
.menu1-icon-color{
  color: #38558e;
}

.id-color-menu-edit{
  color: #F7A53A;
}

.bg-button-color{
  background-color: #cb0000;
}

.min-w-min-button{
  min-height: 26px;
  min-width: 53px;

}

.w-150{
  width: 150px;
}

.max-w-0-menu1{
  max-width: 4rem;
}

.bg-button-color-green{
 background-color: #22af4b;
}

.bg-button-color-gray{
  background-color: #636363;
}
.bg-hard-grey{
  background-color: #f4f4f4;
}

.font-size-edit {
  font-size: 10.5px;
}
.w-96-edit-recipes{
  width: 35rem;
}

.select-menu-height-edit2 {
  height: 2.8rem;
}

.validation_error_msg {
  font-weight: 400;
  margin: 6px 0 0 !important;
  color: red;
}


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

</style>
