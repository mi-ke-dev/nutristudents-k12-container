<template>
  <Head>
  <title>Users | NutriStudents K-12</title>
  <meta name="description" content="Users">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
    </BreadcrumLayout>
    <PageTitleLayout>
      <div class="lg:mb-0 mb-4">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">Users</h1>
      </div>
      <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center">
        <button >
          <inertia-link :href="route('add-user')" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 mt-10  inline-block">
          CREATE NEW USER
          </inertia-link>
        </button>
      </div>
    </PageTitleLayout>

    <TableFilterLayout @messageFromChild="userSearchData" />

    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-auto">
            <table class="min-w-full">
          <thead class="header-bg-color">
            <tr>
              <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                NAME
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                EMAIL
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                USER TYPE
              </th> 
            </tr>
          </thead>
          <tbody>
            

            <tr v-if="!users.length" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No User Found</td>
            </tr>

            <!-- Odd row -->
            <tr v-for="(user,index) in users" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                <td class="px-6 py-4 whitespace-nowrap text-base font-bold id-color">
                    {{user.name}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                    {{user.email}}
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                   {{user.type}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap  id-color text-xl  font-extrabold">

                    <inertia-link :href="route('edit-user', { id: user.id })" class="">
                        <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>  
                    </inertia-link>

                    <button v-if="user.type !=	'Super Admin'" type="button" @click="user_delete_script(user.id)" class="">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </td>  
            </tr>
          </tbody>
        </table>
          </div>
        </div>
      </div>
      <div class="mt-12 flex justify-end pr-10 w-full mb-8">
        <button >
          <inertia-link :href="route('add-user')" class="button-color text-white font-bold py-1.5 px-4 mb- rounded focus:outline-none  inline-block">
            CREATE NEW USER
          </inertia-link>
        </button>
      </div>
    </TableIndexLayout>
  </default-layout>
  <jet-dialog-modal :show="deleteUser" @close="deleteUser = false">
    <template #title>
      <div class="flex justify-between items-center">
        Attribute all content to:          
      </div>
    </template>

    <template #content>
      <TableIndexLayout>
        <div class="-my-2">
          <div class="py-2 align-middle inline-block px-2 w-full">
            <div class="flex overflow-x-auto">
              <div class="relative focus:outline-none lg:w-56 sm:w-1/2 w-full mr-3 xl:mt-0">
                <select v-model="form.other_user_id" class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height">
                  <option value="">Select User</option>
                  <option v-for="user in getUsers" :value="user.id">
                    {{ user.name }}
                  </option>
                </select>
                <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc" aria-hidden="true"></i>
                </div>
              </div> 
              
              
            </div>
          </div>
        </div>
      </TableIndexLayout>
    </template>

    <template #footer>
      <button type="button" class="float-left" @click="deleteUser = false">
      <a class="w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase bg-gray-500 text-white focus:outline-none sm:w-40" href="javascript:void(0)">Cancel</a></button>

      <button type="button" @click="user_delete" class="menu1-background-color  inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase button-color text-white focus:outline-none sm:ml-3  mt-3 sm:mt-0">Confirm User Removel</button>

      <!-- <jet-secondary-button class="btn cursor-pointer" @click="deleteUser = false">Close</jet-secondary-button> -->
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
import JetDialogModal from "@/Jetstream/DialogModal";

export default {
  props:['all_users'],
  components: {
    DefaultLayout,
    Welcome,
    BreadcrumLayout,
    PageTitleLayout,
    TableFilterLayout,
    TableIndexLayout,
    JetDialogModal
  },
  data(){
    return {
      users:this.all_users,
      deleteUser:false,
      deleteUserId:'',
      form: this.$inertia.form({
        other_user_id:''
      })
    }
  },
  computed: {
    getUsers: function(){
      let $this= this;
      return this.users.filter(e => e.id != $this.deleteUserId);
    }
  },
  methods:{
    user_delete() {
      if(this.form.other_user_id != ''){
        this.form.post(this.route('delete-user', this.deleteUserId), {
          onSuccess: () => {
            this.$toast.success('User deleted successfully!');
            setTimeout(function(){
              window.location.reload();
            }, 1000);
          }
        });
      } else {
        this.$toast.error('Please select user');
      }
            
    },
        user_delete_script(userid) {
          this.form.other_user_id ='';
          this.deleteUserId = userid;
          this.deleteUser = true;
          
          // if(confirm("Are you sure you want to delete this user?")){
          // this.form.post(this.route('delete-user', userid), {
          //       onSuccess: () => {
          //         this.$toast.success('User deleted successfully!');
          //         setTimeout(function(){
          //           window.location.reload();
          //         }, 1000);
          //       }
          //     });
          // }
        },

        userSearchData(search){
            
            if(search == ""){
              this.users = this.all_users;
            // this.$toast.error('Error: Search value required!');
            // return false;
            }else{
            axios.post('/user-search',{term:search})
                    .then((response)=>{
                       this.users = response.data;
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
</style>
