<template>
  <Head>
  <title>Add New Site | NutriStudents K-12</title>
  <meta name="description" content="Add New Site">
  </Head>
  <default-layout>

    <BreadcrumLayout>
      <div class="flex">
        <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
        <inertia-link :href="route('sites')" class="link-color"><U>Sites</U></inertia-link></div>
      </BreadcrumLayout>



      <form action="#" @submit.prevent="false">

        <PageTitleLayout>
          <div class="lg:mb-0 mb-4 w-4/6">
            <h1 class="heading-color 2xl:text-2xl text-xl font-bold">Add New Site</h1>
          </div>
          <div class="w-full flex lg:flex-nowrap flex-wrap md:justify-end items-center">

            <button type="button" >
              <inertia-link :href="route('sites')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
            </button>

            <button type="button" @click="site_add_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3 sm:mt-0">Save</button>


          </div>
        </PageTitleLayout>


        <PageTitleLayout>
          <div class="w-full">
            <div class="block justify-between shadow py-8 mt-4 align-middle inline-block min-w-full   bg-white rounded-t-lg lg:divide-y-2 border-gray-300 w-full overflow-x-auto">
              <div class="w-full">
                <div class="xl:flex block xl:items-center p-5">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Name*</label>
                  <div>
                   <input type="text" id="site_name" name="site_name" v-model="form.site_name"
                   class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">   
                   <div v-if="form.errors.site_name" class="validation_error_msg">{{ form.errors.site_name }}</div> 
                 </div>
               </div>
             </div>
             
        
      </div>
    </div>
  </PageTitleLayout>  


  <!-- add Offering section  -->

  <header class="mx-8 searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg mt-8">
  <h2 class="text-white text-lg font-bold w-11/12">Offerings</h2>

  <a href="#" @click="addSiteOfferingModalOpen">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
  </svg>
  </a>
    
  </header>
          <div class="mx-8 flex flex-col mb-6">
            <div class="overflow-x-auto">
              <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
                  
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>                        
                       <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                       NAME
                       </th> 


                      <th scope="col" class="px-6 py-3 text-center text-base font-bold text-black-800 uppercase tracking-wider">
                     GUIDELINE
                      </th>

                      <th scope="col" class="px-6 py-3 text-center text-base font-bold text-black-800 uppercase tracking-wider">
                     Meal Type
                      </th> 

                      <th scope="col" class="px-6 py-3 text-center text-base font-bold text-black-800 uppercase tracking-wider">
                     Age Range
                      </th>

                      <th scope="col" class="px-6 py-3 text-center text-base font-bold text-black-800 uppercase tracking-wider">
                     Days
                      </th> 

                      <th scope="col" class="px-6 py-3 text-center text-base font-bold text-black-800 uppercase tracking-wider">
                  
                      </th> 
                      </tr>
                    </thead>


                    <tbody>
                      <!-- Odd row -->
                      <tr v-if="!site_offerings.length" class="bg-white"><td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="9">No Attached Offering Found!</td></tr>


                      <tr v-else v-for="(site_offering,index) in site_offerings" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">

                        <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color id-color font-bold">
                        {{site_offering.name}}
                        </td>


                        <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color text-center">
                        {{site_offering.guidelineText}}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color text-center">
                        {{ getMealTypeName(site_offering.meal_type_id) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color text-center">
                        {{ getAgeRangeName(site_offering.age_grade_id) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color text-center">
                        {{ getDaysName(site_offering.days_id) }}
                        </td>

                        
                       <td class="px-6 py-4 whitespace-nowrap id-color text-xl font-extrabold text-center">
                        <button type="button" @click="addSiteOfferingEditScript(index)" class=""><i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i></button>
                        <button type="button" @click="addSiteOfferingDeleteScript(index)" class=""><i class="fa fa-trash" aria-hidden="true"></i></button>
                       </td>
                      </tr>
                                                      

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


  <!-- add User section  -->

  <!-- <header class="mx-8 searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg mt-8">
  <h2 class="text-white text-lg font-bold w-11/12">Permissions</h2>

  <a href="#" @click="addSiteUserModalOpen">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
  </svg>
  </a>
    
  </header> -->
          <!-- <div class="mx-8 flex flex-col mb-6">
            <div class="overflow-x-auto">
              <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden border-b-2 border-gray-200 sm:rounded-lg">
                  
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>                        
                       <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                       NAME
                       </th> 


                      <th scope="col" class="px-6 py-3 text-center text-base font-bold text-black-800 uppercase tracking-wider">
                     VIEW
                      </th> 

                      <th scope="col" class="px-6 py-3 text-center text-base font-bold text-black-800 uppercase tracking-wider">
                     ADMIN
                      </th> 
                     
                      <th scope="col" class="px-6 py-3 text-center text-base font-bold text-black-800 uppercase tracking-wider">
                  
                      </th> 
                      </tr>
                    </thead>


                    <tbody> 

                      <tr v-if="!site_users.length" class="bg-white"><td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="9">No Attached Users Found!</td></tr>


                      <tr v-else v-for="(site_user,index) in site_users" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">

                        <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                        {{site_user.name}}
                        </td>

                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                          <input type="checkbox" v-model="user_permission_check[site_user.id]" value="view" @change="onChangeUserPermissions(site_user.id, index)">
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                          <input type="checkbox" v-model="user_permission_check[site_user.id]" value="admin" @change="onChangeUserPermissions(site_user.id, index)">
                        </td>

                         <td class="px-6 py-4 whitespace-nowrap  id-color text-xl  font-extrabold text-center">
                          <button type="button" @click="addSiteUserDeleteScript(site_user.id, index)" class=""><i class="fa fa-trash" aria-hidden="true"></i></button>
                         </td>
                      </tr>
                                                      

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>       -->


  <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center mb-6 px-10 mt-6">

    <button type="button" >
    <inertia-link :href="route('sites')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
    </button>

    <button type="button" @click="site_add_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3  sm:mt-0">Save</button>

  </div>

</form>

</default-layout>


<!-- site add offering modal -->
<jet-dialog-modal :show="addOfferingModal || editOfferingModal" @close="addOfferingModal = false, editOfferingModal = false">
 <template #title>
  <div class="flex justify-between items-center"></div>
 </template>

  <template #content>
    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block px-2 w-full">
          <div class="shadow overflow-x-auto">

            <div class="w-full">

                <div class="xl:flex block xl:items-center p-5">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Name*</label>
                  <div>
                   <input type="text" id="offering_name" name="offering_name" v-model="offering_name"
                   class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">   
                   <div v-if="form.errors.offering_name" class="validation_error_msg">{{ form.errors.offering_name }}</div> 
                 </div>
               </div>

               <div class="xl:flex block xl:items-center px-5 py-2">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Meal Type*</label>                  
                  <div class="relative pl-0 2xl:w-80 xl:w-80 w-72 xl:mt-0 mt-4 2xl:text-lg text-xs text-gray-400">              
                  <select id="meal_type_id" name="meal_type_id" autocomplete="" v-model="meal_type_id" class="sm:text-sm text-xs  shadow-sm focus:border-color block  border-gray-300 rounded-lg w-full select-menu-height-edit2 input-background text-gray-500" @change="updateGuidelineValues"> 
                    <option value="">Select to update guidelines</option>
                    <option v-for="mealVal in mealtype_data" :value="mealVal.id">{{mealVal.name}}</option>
                  </select>
                  <div class="absolute flex justify-center items-center searching-background-color select-menu-height-edit2 w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>                  
                  </div> 
                 </div>
               </div>

               <div class="xl:flex block xl:items-center px-5 py-2">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Age Range*</label>                  
                  <div class="relative pl-0 2xl:w-80 xl:w-80 w-72 xl:mt-0 mt-4 2xl:text-lg text-xs text-gray-400">                    
                  <select id="age_grade_id" name="age_grade_id" autocomplete="" v-model="age_grade_id" class="sm:text-sm text-xs  shadow-sm focus:border-color block  border-gray-300 rounded-lg w-full select-menu-height-edit2 input-background text-gray-500" @change="updateGuidelineValues"> 
                    <option value="">Select to update guidelines</option>
                    <option v-for="ageVal in agerange_data" :value="ageVal.id">{{ageVal.name}}</option>
                  </select>
                  <div class="absolute flex justify-center items-center searching-background-color select-menu-height-edit2 w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>                  
                  </div> 
                 </div>
               </div>

               <div class="xl:flex block xl:items-center px-5 py-2">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Days*</label>                  
                  <div class="relative pl-0 2xl:w-80 xl:w-80 w-72 xl:mt-0 mt-4 2xl:text-lg text-xs text-gray-400">                    
                  <select id="days_id" name="days_id" autocomplete="" v-model="days_id" class="sm:text-sm text-xs  shadow-sm focus:border-color block  border-gray-300 rounded-lg w-full select-menu-height-edit2 input-background text-gray-500" @change="updateGuidelineValues"> 
                    <option value="">Select to update guidelines</option>
                    <option v-for="daysVal in days_data" :value="daysVal.id">{{daysVal.name}}</option>
                  </select>
                  <div class="absolute flex justify-center items-center searching-background-color select-menu-height-edit2 w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>                  
                  </div> 
                 </div>
               </div>

               <div class="xl:flex block xl:items-center p-5">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Guideline*</label>                  
                  <div class="relative pl-0 2xl:w-80 xl:w-80 w-72 xl:mt-0 mt-4 2xl:text-lg text-xs text-gray-400">
                  <select id="offering_guideline" name="offering_guideline" autocomplete="" v-model="offering_guideline" class="sm:text-sm text-xs  shadow-sm focus:border-color block  border-gray-300 rounded-lg w-full select-menu-height-edit2 input-background text-gray-500"> 
                    <option value="">Select</option>
                    <option v-for="offering_guidelne in offering_guidelines" v-bind:value="{id: offering_guidelne.id, text: offering_guidelne.name}">{{offering_guidelne.name}}</option>
                  </select>
                  <div class="absolute flex justify-center items-center searching-background-color select-menu-height-edit2 w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>                  
                  </div> 
                 </div>
               </div>
             <div v-if="offering_validation" class="validation_error_msg text-center p-2">All fields required to fill, please check!</div>
             </div>

          </div>
        </div>
      </div>
    </TableIndexLayout>
  </template>

  <template #footer>
  <jet-secondary-button v-if="addOfferingModal" @click="addSiteOfferingModalProcess()">Add Offering</jet-secondary-button>
  <jet-secondary-button v-if="editOfferingModal" @click="addSiteOfferingEditModalProcess()">Update Offering</jet-secondary-button>
  <jet-secondary-button @click="addOfferingModal = false, editOfferingModal = false">Close</jet-secondary-button>
  </template>
</jet-dialog-modal>


<!-- site add user modal -->
<jet-dialog-modal :show="addUsersModal" @close="addUsersModal = false">
 <template #title>
  <div class="flex justify-between items-center">
  Search User to Add/Attach with Site
  <div class="relative md:w-56 ">
    <input class="border-2 border-gray-300 bg-white h-10 px-3 pr-10 rounded-lg text-sm focus:outline-none w-full" type="search" name="search_user_term" placeholder="Search" v-model="search_user_term">
    <button type="button" class="absolute right-0 top-0 mt-2 mr-4 outline-none" @click="userSearchScriptModal"><i class="fa fa-search" aria-hidden="true"></i></button>
  </div>
 </div>
 </template>

  <template #content>
    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block px-2 w-full">
          <div class="shadow overflow-x-auto">
            <table class="min-w-full">
              <thead class="header-bg-color">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">USER NAME</th>               
                  <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider" ></th>
                </tr>
              </thead>
              <tbody>

                <!-- Odd row -->
                <tr v-if="!searched_users.length" class="bg-white">
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No User Available!</td>
                </tr>

                <tr v-for="(user,index) in searched_users" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                  
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                    {{user.name}}
                  </td>          
                  <td class="px-6 py-4 whitespace-nowrap id-color text-xl font-extrabold">
                    <button type="button" @click="addSiteUserAddScript(user, index)" class="">
                    <i class="fa fa-plus pr-3" aria-hidden="true"></i>
                    </button>
                  </td>
                </tr>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </TableIndexLayout>
  </template>

  <template #footer>
  <jet-secondary-button @click="addUsersModal = false">Close</jet-secondary-button>
  </template>
</jet-dialog-modal>



</template>

<script>
  import DefaultLayout from "@/Layouts/DefaultLayout";
  import Welcome from "@/Jetstream/Welcome";
  import BreadcrumLayout from "@/Pages/Common/Breadcrumbs";
  import PageTitleLayout from "@/Pages/Common/PageTitle";
  import TableFilterLayout from "@/Pages/Common/TableFilters";
  import TableIndexLayout from "@/Pages/Common/TableIndex";
  import JetSecondaryButton from '@/Jetstream/SecondaryButton';
  import JetDialogModal from '@/Jetstream/DialogModal';

  export default {
    props:['offering_guidelines', 'offering_menuadmins_user','offering_menuadmins_group','offering_orderadmins_user','offering_orderadmins_group', 'offering_sites', 'mealtype_data', 'agerange_data','days_data'],
    components: {
      DefaultLayout,
      Welcome,
      BreadcrumLayout,
      PageTitleLayout,
      TableFilterLayout,
      TableIndexLayout,
      JetSecondaryButton,
      JetDialogModal,
    },

    data(){
      return { 
      
      addUsersModal:false,  
      addOfferingModal:false,
      editOfferingModal:false, 

      editOfferingIndex:'',

      meal_type_id:'',
      age_grade_id:'',
      days_id:'',
      offering_guidelines:[],

      site_users:[], 
      site_offerings:[],

      offering_menu_admin_type: 'user',
      offering_order_admin_type: 'user',
      offering_menuadmins:this.offering_menuadmins_user,
      offering_orderadmins:this.offering_orderadmins_user,
      
      offering_validation:false,
      offering_name:'',
      offering_guideline:'',
      offering_menu_admin:'',
      offering_order_admin:'',
      offering_prep_site:'',
      offering_cook_site:'',

      search_user_term :'',
      searched_users : [],

      user_permission_check:[],  

      form: this.$inertia.form({
        site_name:'',    
        attached_users:[], 
        attached_offerings:[],
      })

      }
    },

    methods:{

      updateGuidelineValues(){
         if(this.meal_type_id && this.age_grade_id && this.days_id){
          axios.post('/site-offering-get-guidelines',{
                         meal_type:this.meal_type_id,
                         age_range:this.age_grade_id,
                         days:this.days_id,
                       }).then((response)=>{    
                       this.offering_guidelines = response.data;
                       })
                       .catch(error => console.error(error));
         }
      },

      site_add_save_script(){
        this.form.attached_users = this.site_users;
        this.form.attached_offerings = this.site_offerings;

        this.form.post(this.route('add-site-save'), {
          onSuccess: () => {    
            this.$toast.success('Site created successfully!');
          },
        });
      },

    
    addSiteOfferingModalOpen() {
      this.addOfferingModal = true;       
    },


    onMenuAdminTypeChange(e) {
     if(e.target.value == "user"){
      this.offering_menuadmins = this.offering_menuadmins_user;
     }
     if(e.target.value == "group"){
      this.offering_menuadmins = this.offering_menuadmins_group;
     }
    },

    onOrderAdminTypeChange(e) {
     if(e.target.value == "user"){
      this.offering_orderadmins = this.offering_orderadmins_user;
     }
     if(e.target.value == "group"){
      this.offering_orderadmins = this.offering_orderadmins_group;
     }
    },


    addSiteOfferingModalProcess(){           
    
    if(this.offering_name == "" || this.offering_guideline.length == 0){
    this.offering_validation = true;
    }else{

      var add_offering_data = {
        'id':'',
        'name':this.offering_name,
        'guidelineId':this.offering_guideline.id,
        'guidelineText':this.offering_guideline.text,
        'menuType':this.offering_menu_admin_type,
        'menuId':this.offering_menu_admin.id,
        'menuText':this.offering_menu_admin.text,
        'orderType':this.offering_order_admin_type,
        'orderId':this.offering_order_admin.id,
        'orderText':this.offering_order_admin.text,
        'prepId':this.offering_prep_site.id,
        'prepText':this.offering_prep_site.text,
        'cookId':this.offering_cook_site.id,
        'cookText':this.offering_cook_site.text,
        'meal_type_id' : this.meal_type_id,
        'age_grade_id' : this.age_grade_id,
        'days_id' : this.days_id,
      };

      this.site_offerings.push(add_offering_data);
      
      this.offering_name = '';
      this.offering_guideline = [];
      this.offering_menu_admin = [];
      this.offering_order_admin =[];
      this.offering_prep_site = [];
      this.offering_cook_site = [];

      this.meal_type_id = '';
      this.age_grade_id = '';
      this.days_id = '';
      
      this.addOfferingModal = false;
    }

    },


    addSiteOfferingDeleteScript(index){
      if(confirm("Are you sure to delete this offering!")){
       this.site_offerings.splice(index,1);
      }
    },


    addSiteOfferingEditScript(index){
      this.editOfferingModal = true;  
      this.editOfferingIndex = index;

      //to setup values guideline
      this.meal_type_id = this.site_offerings[index].meal_type_id;
      this.age_grade_id = this.site_offerings[index].age_grade_id;
      this.days_id = this.site_offerings[index].days_id;
      this.updateGuidelineValues();

      this.offering_id = this.site_offerings[index].id;
      this.offering_name = this.site_offerings[index].name;
      this.offering_guideline = {
        'id':this.site_offerings[index].guidelineId,
        'text':this.site_offerings[index].guidelineText,
      };
      this.offering_menu_admin = {
        'id':this.site_offerings[index].menuId,
        'text':this.site_offerings[index].menuText,
      };
      this.offering_order_admin = {
        'id':this.site_offerings[index].orderId,
        'text':this.site_offerings[index].orderText,
      };
      this.offering_prep_site = {
        'id':this.site_offerings[index].prepId,
        'text':this.site_offerings[index].prepText,
      };
      this.offering_cook_site = {
        'id':this.site_offerings[index].cookId,
        'text':this.site_offerings[index].cookText,
      };


      if(this.site_offerings[index].menuType == "user"){  
        this.offering_menu_admin_type = "user";      
        this.offering_menuadmins = this.offering_menuadmins_user;
      }
      if(this.site_offerings[index].menuType == "group"){
        this.offering_menu_admin_type = "group";
        this.offering_menuadmins = this.offering_menuadmins_group;
      }
      if(this.site_offerings[index].orderType == "user"){
        this.offering_order_admin_type = "user";
        this.offering_orderadmins = this.offering_orderadmins_user;
      }
      if(this.site_offerings[index].orderType == "group"){
        this.offering_order_admin_type = "group";
        this.offering_orderadmins = this.offering_orderadmins_group;
      }  
    },


    addSiteOfferingEditModalProcess(){

    if(this.offering_name == "" || this.offering_guideline.length == 0 ){
    this.offering_validation = true;
    }else{

      var edit_offering_data = {
        'id':'',
        'name':this.offering_name,
        'guidelineId':this.offering_guideline.id,
        'guidelineText':this.offering_guideline.text,
        'menuType':this.offering_menu_admin_type,
        'menuId':this.offering_menu_admin.id,
        'menuText':this.offering_menu_admin.text,
        'orderType':this.offering_order_admin_type,
        'orderId':this.offering_order_admin.id,
        'orderText':this.offering_order_admin.text,
        'prepId':this.offering_prep_site.id,
        'prepText':this.offering_prep_site.text,
        'cookId':this.offering_cook_site.id,
        'cookText':this.offering_cook_site.text,
        'meal_type_id' : this.meal_type_id,
        'age_grade_id' : this.age_grade_id,
        'days_id' : this.days_id,
      };
      
      this.site_offerings[this.editOfferingIndex] = edit_offering_data;
      
      this.offering_id = '';
      this.offering_name = '';
      this.offering_guideline = [];
      this.offering_menu_admin = [];
      this.offering_order_admin =[];
      this.offering_prep_site = [];
      this.offering_cook_site = [];

      this.meal_type_id = '';
      this.age_grade_id = '';
      this.days_id = '';
            
      this.editOfferingModal = false;
      this.editOfferingIndex = '';
    }

    },






    addSiteUserModalOpen() {

      this.addUsersModal = true; 

      this.search_user_term = "";
      this.searched_users = [];

    },

    userSearchScriptModal() {

            if(this.search_user_term == ""){
            this.$toast.error('Error: Search value required!');
            }else{
            let exist_users = [];
            this.site_users.forEach((value,index) => {exist_users.push(value['id']);});  
            axios.post('/group-user-search-modal',{term:this.search_user_term,ex_ids:exist_users})
                    .then((response)=>{
                       this.searched_users = response.data;                    
                     })
                    .catch(error => console.error(error));
            }
    },

    addSiteUserAddScript(user_array, index) {
               
            this.searched_users.splice(index,1);

            user_array['user_permission_view']    = 1;
            user_array['user_permission_admin']   = 0;

            this.user_permission_check[user_array['id']] = [];

            this.site_users.push(user_array);

    },

    addSiteUserDeleteScript(user_id) {
            this.site_users.forEach((value,index) => {
                 if(user_id == value['id']){
                  this.site_users.splice(index,1);
                 }
            });
    },


    onChangeUserPermissions(user_id, index){
         //console.log(this.user_permission_check);
         if(this.user_permission_check[user_id].indexOf("view") !== -1){
            this.site_users[index].user_permission_view  = 1;
         }else{
            this.site_users[index].user_permission_view  = 0;
         }
         
         if(this.user_permission_check[user_id].indexOf("admin") !== -1){
            this.user_permission_check[user_id] = ['view','admin'];
            this.site_users[index].user_permission_admin = 1;
            this.site_users[index].user_permission_view  = 1;
         }else{            
            this.site_users[index].user_permission_admin = 0;
         }
    },

    getMealTypeName(mTypeId){
      let mType = this.mealtype_data.find(element => element.id == mTypeId);
      if(mType){
        return mType.name;
      } else {
        return '';
      }
    },
    getAgeRangeName(mTypeId){
      let mType = this.agerange_data.find(element => element.id == mTypeId);
      if(mType){
        return mType.name;
      } else {
        return '';
      }
    },
    getDaysName(mTypeId){
      let mType = this.days_data.find(element => element.id == mTypeId);
      if(mType){
        return mType.name;
      } else {
        return '';
      }
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
