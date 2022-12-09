<template>
  <Head>
  <title>{{group.name}} - Edit Group | NutriStudents K-12</title>
  <meta name="description" content="Edit Group">
  </Head>
  <default-layout>

    <BreadcrumLayout>
      <div class="flex">
        <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
        <inertia-link :href="route('groups')" class="link-color"><U>Groups</U></inertia-link></div>
      </BreadcrumLayout>



      <form action="#" @submit.prevent="false">

        <PageTitleLayout>
          <div class="lg:mb-0 mb-4 w-4/6">
            <h1 class="heading-color  2xl:text-2xl text-xl font-bold">{{group.name}}</h1>
          </div>
          <div class="w-full flex lg:flex-nowrap flex-wrap md:justify-end items-center">

            <button type="button" class="">
              <inertia-link :href="route('groups')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
            </button>

            <button v-if="$page.props.isUserSuperAdmin || group.is_edit" type="button" @click="group_edit_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3 sm:mt-0">Update</button>


          </div>
        </PageTitleLayout>


        <PageTitleLayout>
          <div class="w-full">
            <div class="block justify-between shadow py-4 mt-4 align-middle inline-block min-w-full   bg-white rounded-t-lg lg:divide-y-2 border-gray-300 w-full overflow-x-auto">
              <div class="w-full">
                <div class="xl:flex block xl:items-center p-5">
                  <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Name*</label>
                  <div>
                   <input type="text" id="group_name" name="group_name" v-model="form.group_name"
                   class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 2xl:w-80 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background" :disabled="!$page.props.isUserSuperAdmin">   
                   <div v-if="form.errors.group_name" class="validation_error_msg">{{ form.errors.group_name }}</div> 
                 </div>
               </div>
             </div>
             <div class="w-full">
               <div class="xl:flex block xl:items-center p-5">
                 <label class="font-bold text-gray-700  2xl:text-lg text-base w-full md:w-40">Type*</label>
                 <div>
                   <div class="relative pl-0 2xl:w-80 xl:w-80 w-72 xl:mt-0 mt-4 2xl:text-lg text-xs text-gray-400">

                  <select
                    id="group_type"
                    name="group_type"
                    autocomplete="" v-model="form.group_type"
                    class="sm:text-sm text-xs  shadow-sm focus:border-color block  border-gray-300 rounded-lg w-full select-menu-height-edit2 input-background text-gray-500" :disabled="!$page.props.isUserSuperAdmin"
                    > <option value="">Select</option>
                    <option value="Menu">Menu</option>
                    <option value="Order">Order</option>
                    <option value="Prep">Prep</option>
                    <option value="Cook">Cook</option>
                  </select>
                  <div class="absolute flex justify-center items-center searching-background-color select-menu-height-edit2 w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"
                  >
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>
                </div>

                
              </div>    

              <div v-if="form.errors.group_type" class="validation_error_msg">{{ form.errors.group_type }}</div>
            </div>
          </div>
        </div>        
      </div>
    </div>
  </PageTitleLayout>    


  <!-- add site section  -->

  <header class="mx-8 searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg mt-8">
  <h2 class="text-white text-lg font-bold w-11/12">Site Belonging This Group</h2>

  <a href="#" @click="addGroupSiteModalOpen">
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
                     
                      <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                  
                      </th> 
                      </tr>
                    </thead>


                    <tbody>
                      <!-- Odd row -->

                      <tr v-if="!group_sites.length" class="bg-white"><td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="9">No Attached Sites Found!</td></tr>


                      <tr v-else v-for="(group_site,index) in group_sites" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">

                        <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                        {{group_site.name}}
                        </td>
                        
                         <td class="px-6 py-4 whitespace-nowrap  id-color text-xl  font-extrabold">
                          <button type="button" @click="addGroupSiteDeleteScript(group_site.id, index)" class=""><i class="fa fa-trash" aria-hidden="true"></i></button>
                         </td>
                      </tr>
                                                      

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


  <!-- add User section  -->

  <header class="mx-8 searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg mt-8">
  <h2 class="text-white text-lg font-bold w-11/12">Users With Permissions</h2>

  <a href="#" @click="addGroupUserModalOpen">
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
                      <!-- Odd row -->

                      <tr v-if="!group_users.length" class="bg-white"><td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="9">No Attached Users Found!</td></tr>


                      <tr v-else v-for="(group_user,index) in group_users" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">

                        <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                        {{group_user.name}}
                        </td>

                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                          <input type="checkbox" v-model="user_permission_check[group_user.id]" value="view" @change="onChangeUserPermissions(group_user.id, index)">
                        </td>
                        <td class="px-3 py-3 whitespace-nowrap text-sm text-gray-500 text-center">
                          <input type="checkbox" v-model="user_permission_check[group_user.id]" value="admin" @change="onChangeUserPermissions(group_user.id, index)">
                        </td>

                         <td class="px-6 py-4 whitespace-nowrap  id-color text-xl  font-extrabold text-center">
                          <button type="button" @click="addGroupUserDeleteScript(group_user.id, index)" class=""><i class="fa fa-trash" aria-hidden="true"></i></button>
                         </td>
                      </tr>
                                                      

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>    


  <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center mb-6 px-10 mt-6">

    <button type="button" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">
    <inertia-link :href="route('groups')" >Cancel</inertia-link>
    </button>

    <button v-if="$page.props.isUserSuperAdmin || group.is_edit" type="button" @click="group_edit_save_script" class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3  sm:mt-0">Update</button>

  </div>

</form>

</default-layout>

<!-- group add site modal -->
<jet-dialog-modal :show="addSitesModal" @close="addSitesModal = false">
 <template #title>
  <div class="flex justify-between items-center">
  Search Sites to Add/Attach with Group
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

                    <button type="button" @click="addGroupSiteAddScript(site, index)" class="">
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


<!-- group add user modal -->
<jet-dialog-modal :show="addUsersModal" @close="addUsersModal = false">
 <template #title>
  <div class="flex justify-between items-center">
  Search User to Add/Attach with Group
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

                    <button type="button" @click="addGroupUserAddScript(user, index)" class="">
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
  import JetButton from '@/Jetstream/Button';
  import JetSecondaryButton from '@/Jetstream/SecondaryButton';
  import JetDialogModal from '@/Jetstream/DialogModal';

  export default {
    props:['group','group_sites_data','group_users_data'],
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
        addUsersModal:false,

        group_sites:this.group_sites_data,
        group_users:this.group_users_data,
     
        search_site_term:'',
        searched_sites:[],

        search_user_term :'',
        searched_users : [],

        user_permission_check:[],  

        form: this.$inertia.form({
          group_name:this.group.name,
          group_type:this.group.group_type,
          attached_sites:[],
          attached_users:[],    
        })

      }
    },


    mounted(){

    this.group_users_data.forEach((value,index) => {
      this.user_permission_check[value['id']] = [];
      if(value['user_permission_view']){this.user_permission_check[value['id']].push('view');}
      if(value['user_permission_admin']){this.user_permission_check[value['id']].push('admin');}
    });

    },


    methods:{


      group_edit_save_script(){
        
        this.group_sites.forEach((value,index) => {
          this.form.attached_sites.push(value['id']);
        });
        this.form.attached_users = this.group_users;

        this.form.post(this.route('edit-group-save', this.group.id), {
          onSuccess: () => {    
            this.$toast.success('Group updated successfully!');
          },
        });
        
      },

      addGroupSiteModalOpen() {

        this.addSitesModal = true; 

        this.search_site_term = "";
        this.searched_sites = [];

      },


      siteSearchScriptModal() {

            if(this.search_site_term == ""){
            this.$toast.error('Error: Search value required!');
            }else{
            let exist_sites = [];
            this.group_sites.forEach((value,index) => {exist_sites.push(value['id']);});  
            axios.post('/group-site-search-modal',{term:this.search_site_term,ex_ids:exist_sites})
                    .then((response)=>{
                       this.searched_sites = response.data;                    
                     })
                    .catch(error => console.error(error));
            }
    },


    addGroupSiteAddScript(site_array, index) {
               
            this.searched_sites.splice(index,1);

            this.group_sites.push(site_array);            

    },

    addGroupSiteDeleteScript(site_id) {
            this.group_sites.forEach((value,index) => {
                 if(site_id == value['id']){
                  this.group_sites.splice(index,1);   
                 }
            });
    }, 





    addGroupUserModalOpen() {

        this.addUsersModal = true; 

        this.search_user_term = "";
        this.searched_users = [];

      },

    userSearchScriptModal() {

            if(this.search_user_term == ""){
            this.$toast.error('Error: Search value required!');
            }else{
            let exist_users = [];
            this.group_users.forEach((value,index) => {exist_users.push(value['id']);});  
            axios.post('/group-user-search-modal',{term:this.search_user_term,ex_ids:exist_users})
                    .then((response)=>{
                       this.searched_users = response.data;                    
                     })
                    .catch(error => console.error(error));
            }
    },

    addGroupUserAddScript(user_array, index) {
               
            this.searched_users.splice(index,1);

            user_array['user_permission_view']    = 1;
            user_array['user_permission_admin']   = 0;

            this.user_permission_check[user_array['id']] = [];

            this.group_users.push(user_array);

    },

    addGroupUserDeleteScript(user_id) {
            this.group_users.forEach((value,index) => {
                 if(user_id == value['id']){
                  this.group_users.splice(index,1);
                 }
            });
    },


    onChangeUserPermissions(user_id, index){
         //console.log(this.user_permission_check);
         if(this.user_permission_check[user_id].indexOf("view") !== -1){
            this.group_users[index].user_permission_view  = 1;
         }else{
            this.group_users[index].user_permission_view  = 0;
         }
         
         if(this.user_permission_check[user_id].indexOf("admin") !== -1){
            this.user_permission_check[user_id] = ['view','admin'];
            this.group_users[index].user_permission_admin = 1;
            this.group_users[index].user_permission_view  = 1;
         }else{            
            this.group_users[index].user_permission_admin = 0;
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
