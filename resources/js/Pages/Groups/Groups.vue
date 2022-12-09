<template>
  <Head>
  <title>Groups | NutriStudents K-12</title>
  <meta name="description" content="Groups">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
    </BreadcrumLayout>
    <PageTitleLayout>
      <div class="lg:mb-0 mb-4">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">Groups</h1>
      </div>
      <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center">
        <button v-if="$page.props.isUserSuperAdmin" >
          <inertia-link :href="route('add-group')" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 mt-10">
          CREATE NEW GROUP
          </inertia-link>
        </button>
      </div>
    </PageTitleLayout>

    <TableFilterLayout @messageFromChild="groupSearchData" />

    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-auto">
            <table class="min-w-full">
          <thead class="header-bg-color">
            <tr>
              <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                GROUP NAME
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                TYPE OF GROUP
              </th>
            </tr>
          </thead>
          <tbody>
            

            <tr v-if="!groups.length" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Group Found</td>
            </tr>

            <!-- Odd row -->
            
            <tr v-for="(group,index) in groups" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
            <template v-if="$page.props.isUserSuperAdmin || group.is_view">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                    {{group.name}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                    {{group.group_type}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap  id-color text-xl  font-extrabold">

                    <inertia-link v-if="$page.props.isUserSuperAdmin || group.is_edit" :href="route('edit-group', { id: group.id })" class="">
                        <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>  
                    </inertia-link>

                    <button v-if="$page.props.isUserSuperAdmin" type="button" @click="group_delete_script(group.id)" class="">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                    </button>
                </td> 
            </template>               
            </tr>
            

          </tbody>
        </table>
          </div>
        </div>
      </div>
      <div class="mt-12 flex justify-end pr-10 w-full mb-8">
        <button v-if="$page.props.isUserSuperAdmin" >
          <inertia-link :href="route('add-group')" class="button-color text-white font-bold py-1.5 px-4 mb- rounded focus:outline-none">
            CREATE NEW GROUP
          </inertia-link>
        </button>
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

export default {
  props:['all_groups'],
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
      groups:this.all_groups,

      form: this.$inertia.form({

      })
    }
  },
  methods:{
          

        group_delete_script(groupid) {
          if(confirm("Are you sure you want to delete this group?")){
          this.form.post(this.route('delete-group', groupid), {
                onSuccess: () => {
                  this.$toast.success('Group deleted successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
              });
          }
        },

        groupSearchData(search){
          console.log("search", search)
            
            if(search == ""){
              this.groups = this.all_groups;
            // this.$toast.error('Error: Search value required!');
            // return false;
            }else{
            axios.post('/group-search',{term:search})
                    .then((response)=>{
                       this.groups = response.data;
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
