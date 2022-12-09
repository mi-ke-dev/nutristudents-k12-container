<template>
  <Head>
  <title>Add New HACCP Snippet | NutriStudents K-12</title>
  <meta name="description" content="Add New HACCP Snippet">
  </Head>
  <default-layout>

    <BreadcrumLayout>
      <div class="flex">
        <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
        <inertia-link :href="route('haccp-snippets')" class="link-color"><U>HACCP Snippets</U></inertia-link></div>
      </BreadcrumLayout>



      <form action="#" @submit.prevent="false">

        <PageTitleLayout>
          <div class="lg:mb-0 mb-4 w-4/6">
            <h1 class="heading-color  2xl:text-2xl text-xl font-bold">Add New HACCP Snippet</h1>
          </div>
          <div class="w-full flex lg:flex-nowrap flex-wrap md:justify-end items-center">

            <button type="button" >
              <inertia-link :href="route('haccp-snippets')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
            </button>

            <button type="button" @click="haccp_add_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3 sm:mt-0">Save</button>


          </div>
        </PageTitleLayout>


        <PageTitleLayout>
          <div class="w-full">
            <div class="block justify-between shadow py-8 mt-4 align-middle inline-block min-w-full   bg-white rounded-t-lg lg:divide-y-2 border-gray-300 w-full overflow-x-auto">
              <div class="w-full">
                <div class="xl:flex block xl:items-center p-5">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Name*</label>
                  <div>
                   <input type="text" id="haccp_name" name="haccp_name" v-model="form.haccp_name"
                   class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">   
                   <div v-if="form.errors.haccp_name" class="validation_error_msg">{{ form.errors.haccp_name }}</div> 
                 </div>
               </div>
             </div>
             <div class="w-full">
               <div class="xl:flex block xl:items-center p-5">
                 <label class="font-bold text-gray-700  2xl:text-lg text-base w-full md:w-40">Type*</label>
                 <div>
                   <div class="relative pl-0 2xl:w-80 xl:w-80 w-72 xl:mt-0 mt-4 2xl:text-lg text-xs text-gray-400">

                  <select
                    id="haccp_type"
                    name="haccp_type"
                    autocomplete="haccp_type" v-model="form.haccp_type"
                    class="sm:text-sm text-xs  shadow-sm focus:border-color block  border-gray-300 rounded-lg w-full select-menu-height-edit2 input-background text-gray-500"
                    > <option value="">Select</option>
                    <option value="No Cook">No Cook</option>
                    <option value="Same Day Service">Same Day Service</option>
                    <option value="Complex Food Prep">Complex Food Prep</option>
                  </select>
                  <div class="absolute flex justify-center items-center searching-background-color select-menu-height-edit2 w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
                  >
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>
                </div>

                
              </div>    

              <div v-if="form.errors.haccp_type" class="validation_error_msg">{{ form.errors.haccp_type }}</div>
            </div>
          </div>
        </div>
        <div class="w-full">
          <div class="xl:flex block p-5">
            <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40 mt-2">Rule</label>
            <textarea class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg input-background h-60" id="haccp_rule" name="haccp_rule" v-model="form.haccp_rule"></textarea>
          </div>
        </div>
      </div>
    </div>
  </PageTitleLayout>        


  <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center mb-6 px-10 mt-6">

    <button type="button" >
      <inertia-link :href="route('haccp-snippets')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40 ">Cancel</inertia-link>
    </button>

    <button type="button" @click="haccp_add_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3  sm:mt-0">Save</button>

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

        form: this.$inertia.form({
          haccp_name:'',
          haccp_type:'',
          haccp_rule:'',       
        })

      }
    },

    methods:{


      haccp_add_save_script(){
        this.form.post(this.route('haccp-snippet-add-save'), {
          onSuccess: () => {    
            this.$toast.success('HACCP Snippet created successfully!');
          },
        });
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
