<template>
  <Head>
  <title>Add New User | NutriStudents K-12</title>
  <meta name="description" content="Add New User">
  </Head>
  <default-layout>

    <BreadcrumLayout>
      <div class="flex">
        <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
        <inertia-link :href="route('users')" class="link-color"><U>Users</U></inertia-link></div>
      </BreadcrumLayout>



      <form action="#" @submit.prevent="false">

        <PageTitleLayout>
          <div class="lg:mb-0 mb-4 w-4/6">
            <h1 class="heading-color  2xl:text-2xl text-xl font-bold">Add New User</h1>
          </div>
          <div class="w-full flex lg:flex-nowrap flex-wrap md:justify-end items-center">

            <button type="button" >
              <inertia-link :href="route('users')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
            </button>

            <button type="button" @click="user_add_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3 sm:mt-0">Save</button>

          </div>
        </PageTitleLayout>


        <PageTitleLayout>
          <div class="w-full">
            <div class="block justify-between shadow py-8 mt-4 align-middle inline-block min-w-full   bg-white rounded-t-lg lg:divide-y-2 border-gray-300 w-full overflow-x-auto">
              <div class="w-full">
                <div class="xl:flex block xl:items-center p-5">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Name*</label>
                  <div>
                   <input type="text" id="user_name" name="user_name" v-model="form.user_name"
                   class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">   
                   <div v-if="form.errors.user_name" class="validation_error_msg">{{ form.errors.user_name }}</div> 
                 </div>
               </div>
             </div>
             <div class="w-full">
               <div class="xl:flex block xl:items-center p-5">
                 <label class="font-bold text-gray-700  2xl:text-lg text-base w-full md:w-40">Type*</label>
                 <div>
                   <div class="relative pl-0 2xl:w-80 xl:w-80 w-72 xl:mt-0 mt-4 2xl:text-lg text-xs text-gray-400">

                  <select
                    id="user_type"
                    name="user_type"
                    autocomplete="" v-model="form.user_type"
                    class="sm:text-sm text-xs  shadow-sm focus:border-color block  border-gray-300 rounded-lg w-full select-menu-height-edit2 input-background text-gray-500"
                    > <option value="">Select</option>
                    <option value="User">User</option>
                    <option value="Super Admin">Super Admin</option>
                  </select>
                  <div class="absolute flex justify-center items-center searching-background-color select-menu-height-edit2 w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
                  >
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>
                </div>

                
              </div>    

              <div v-if="form.errors.user_type" class="validation_error_msg">{{ form.errors.user_type }}</div>
            </div>
          </div>
        </div>
        <div class="w-full">
          <div class="xl:flex block p-5">
            <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40 mt-2">Email Address*</label>
            <div>
            <input type="text" id="user_email" name="user_email" v-model="form.user_email"
                   class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">
            <div v-if="form.errors.user_email" class="validation_error_msg">{{ form.errors.user_email }}</div> 
            </div>
          </div>
          <div class="xl:flex block p-5">
            <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40 mt-2">Confirm Email*</label>
            <div>
            <input type="text" id="user_email_confirmation" name="user_email_confirmation" v-model="form.user_email_confirmation"
                   class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">
            <div v-if="form.errors.user_email_confirmation" class="validation_error_msg">{{ form.errors.user_email_confirmation }}</div> 
            </div>
          </div>
        </div>
      </div>
    </div>
  </PageTitleLayout>  
 




  <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center mb-6 px-10 mt-6">

    <button type="button" >
    <inertia-link :href="route('users')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
    </button>

    <button type="button" @click="user_add_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3  sm:mt-0">Save</button>

  </div>

</form>

</default-layout>


<!-- user add site modal -->
<jet-dialog-modal :show="addSitesModal" @close="addSitesModal = false">
 <template #title>
  <div class="flex justify-between items-center">
  Search Sites to Add/Attach with User
  <div class="relative md:w-56 ">
    <input class="border-2 border-gray-300 bg-white h-10 px-3 pr-10 rounded-lg text-sm focus:outline-none w-full" type="search" name="search_site_term" placeholder="Search" v-model="search_site_term">
    <button type="button" class="absolute right-0 top-0 mt-2 mr-4 outline-none" @click="siteSearchScriptModal"><i class="fa fa-search" aria-hidden="true"></i></button>
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
                  <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">SITE NAME</th>               
                  <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider" ></th>
                </tr>
              </thead>
              <tbody>

                <!-- Odd row -->
                <tr v-if="!searched_sites.length" class="bg-white">
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Site Available!</td>
                </tr>

                <tr v-for="(site,index) in searched_sites" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                  
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                    {{site.name}}
                  </td>                  
                  
                  <td class="px-6 py-4 whitespace-nowrap id-color text-xl font-extrabold">

                    <button type="button" @click="addUserSiteAddScript(site, index)" class="">
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
  <jet-secondary-button @click="addSitesModal = false">Close</jet-secondary-button>
  </template>
</jet-dialog-modal>


<!-- user add group modal -->
<jet-dialog-modal :show="addGroupsModal" @close="addGroupsModal = false">
 <template #title>
  <div class="flex justify-between items-center">
  Search Group to Add/Attach with User
  <div class="relative md:w-56 ">
    <input class="border-2 border-gray-300 bg-white h-10 px-3 pr-10 rounded-lg text-sm focus:outline-none w-full" type="search" name="search_group_term" placeholder="Search" v-model="search_group_term">
    <button type="button" class="absolute right-0 top-0 mt-2 mr-4 outline-none" @click="groupSearchScriptModal"><i class="fa fa-search" aria-hidden="true"></i></button>
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
                  <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">GROUP NAME</th>               
                  <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider" ></th>
                </tr>
              </thead>
              <tbody>

                <!-- Odd row -->
                <tr v-if="!searched_groups.length" class="bg-white">
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Group Available!</td>
                </tr>

                <tr v-for="(group,index) in searched_groups" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                  
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                    {{group.name}}
                  </td>                  
                  
                  <td class="px-6 py-4 whitespace-nowrap id-color text-xl font-extrabold">

                    <button type="button" @click="addUserGroupAddScript(group, index)" class="">
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
  <jet-secondary-button @click="addGroupsModal = false">Close</jet-secondary-button>
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
  import JetButton from '@/Jetstream/Button';
  import JetSecondaryButton from '@/Jetstream/SecondaryButton';
  import JetDialogModal from '@/Jetstream/DialogModal';

  export default {

    components: {
      DefaultLayout,
      Welcome,
      BreadcrumLayout,
      PageTitleLayout,
      TableFilterLayout,
      TableIndexLayout,      
      JetButton,
      JetSecondaryButton,
      JetDialogModal,
    },

    data(){
      return {      
        
        addSitesModal:false,
        addGroupsModal:false,

        user_sites:[],
        user_groups:[],
     
        search_site_term:'',
        searched_sites:[],

        search_group_term : '',
        searched_groups : [],

        site_permission_check:[],
        group_permission_check:[],

        form: this.$inertia.form({
          user_name:'',
          user_type:'',
          user_email:'', 
          user_email_confirmation:'', 
          attached_sites:[],
          attached_groups:[],    
        })

      }
    },

    methods:{


      user_add_save_script(){

        this.form.attached_sites = this.user_sites;
        this.form.attached_groups = this.user_groups;

        this.form.post(this.route('add-user-save'), {
          onSuccess: () => {    
            this.$toast.success('User created successfully!');
          },
        });
      },





     addUserSiteModalOpen() {

        this.addSitesModal = true; 

        this.search_site_term = "";
        this.searched_sites = [];

      },

    siteSearchScriptModal() {

            if(this.search_site_term == ""){
            this.$toast.error('Error: Search value required!');
            }else{
            let exist_sites = [];
            this.user_sites.forEach((value,index) => {exist_sites.push(value['id']);});  
            axios.post('/user-site-search-modal',{term:this.search_site_term,ex_ids:exist_sites})
                    .then((response)=>{
                       this.searched_sites = response.data;                    
                     })
                    .catch(error => console.error(error));
            }
    },

    addUserSiteAddScript(site_array, index) {
               
            this.searched_sites.splice(index,1);
            
            site_array['site_permission_view']    = 1;
            site_array['site_permission_admin']   = 0;
            site_array['site_permission_menu']    = 0;
            site_array['site_permission_order']   = 0;
            site_array['site_permission_student'] = 0;

            this.site_permission_check[site_array['id']] = [];

            this.user_sites.push(site_array);            

    },

    addUserSiteDeleteScript(site_id) {
            this.user_sites.forEach((value,index) => {
                 if(site_id == value['id']){
                  this.user_sites.splice(index,1);   
                 }
            });
    }, 

    onChangeSitePermissions(site_id, index){
         //console.log(this.site_permission_check);

         if(this.site_permission_check[site_id].indexOf("admin") !== -1){            
            this.site_permission_check[site_id] = ['admin','menu','order','student'];
            this.user_sites[index].site_permission_admin  = 1;
            this.user_sites[index].site_permission_menu  = 1;
            this.user_sites[index].site_permission_order  = 1;
            this.user_sites[index].site_permission_student  = 1;
         }else{
            this.user_sites[index].site_permission_admin  = 0;
         }
         
         if(this.site_permission_check[site_id].indexOf("menu") !== -1){
            this.user_sites[index].site_permission_menu  = 1;
         }else{
            this.user_sites[index].site_permission_menu  = 0;
         }

         if(this.site_permission_check[site_id].indexOf("order") !== -1){
            this.user_sites[index].site_permission_order  = 1;
         }else{
            this.user_sites[index].site_permission_order  = 0;
         }
         
         if(this.site_permission_check[site_id].indexOf("student") !== -1){
            this.user_sites[index].site_permission_student  = 1;
         }else{
            this.user_sites[index].site_permission_student  = 0;
         }

    },






    addUserGroupModalOpen() {

        this.addGroupsModal = true; 

        this.search_group_term = "";
        this.searched_groups = [];

      },

    groupSearchScriptModal() {

            if(this.search_group_term == ""){
            this.$toast.error('Error: Search value required!');
            }else{
            let exist_groups = [];
            this.user_groups.forEach((value,index) => {exist_groups.push(value['id']);});  
            axios.post('/user-group-search-modal',{term:this.search_group_term,ex_ids:exist_groups})
                    .then((response)=>{
                       this.searched_groups = response.data;                    
                     })
                    .catch(error => console.error(error));
            }
    },

    addUserGroupAddScript(group_array, index) {
               
            this.searched_groups.splice(index,1);

            group_array['group_permission_view']    = 1;
            group_array['group_permission_admin']   = 0;

            this.group_permission_check[group_array['id']] = [];

            this.user_groups.push(group_array);

    },

    addUserGroupDeleteScript(group_id) {
            this.user_groups.forEach((value,index) => {
                 if(group_id == value['id']){
                  this.user_groups.splice(index,1);
                 }
            });
    },


    onChangeGroupPermissions(group_id, index){
         //console.log(this.group_permission_check);
         if(this.group_permission_check[group_id].indexOf("view") !== -1){
            this.user_groups[index].group_permission_view  = 1;
         }else{
            this.user_groups[index].group_permission_view  = 0;
         }
         
         if(this.group_permission_check[group_id].indexOf("admin") !== -1){
            this.group_permission_check[group_id] = ['view','admin'];
            this.user_groups[index].group_permission_admin = 1;
            this.user_groups[index].group_permission_view  = 1;
         }else{            
            this.user_groups[index].group_permission_admin = 0;
         }
    },



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
