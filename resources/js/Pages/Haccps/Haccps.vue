<template>
  <Head>
  <title>HACCP Snippets | NutriStudents K-12</title>
  <meta name="description" content="HACCP Snippets">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
    </BreadcrumLayout>
    <PageTitleLayout>
      <div class="lg:mb-0 mb-4">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">HACCP Snippets</h1>
      </div>
      <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center">
        <button >
          <inertia-link :href="route('haccp-snippet-add')" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 mt-10 inline-block">
          CREATE NEW HACCP SNIPPET
          </inertia-link>
        </button>
      </div>
    </PageTitleLayout>

    <TableFilterLayout @messageFromChild="haccpSearchData" />

    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-auto">
            <table class="min-w-full">
          <thead class="header-bg-color">
            <tr>
              <!-- <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                ID<i class="fa fa-sort-asc" aria-hidden="true"></i><i class="fa fa-sort-desc" aria-hidden="true"></i>
              </th> -->
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                NAME OF RULE
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                PROCESS
              </th> 
              <!-- <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                AUTHOR
              </th> -->
            </tr>
          </thead>
          <tbody>
            

            <tr v-if="!haccps.length" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No HACCP Snippet Found</td>
            </tr>

            <!-- Odd row -->
            <tr v-for="(haccp,index) in haccps" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                <!-- <td class="px-6 py-4 whitespace-nowrap text-base font-bold underline id-color">
                   {{index+1}}
                </td> -->
                <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                   {{haccp.name}}
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                   {{haccp.type}}
                </td> 
                <!-- <td class="px-6 py-4 whitespace-nowrap text-base text-color">
                   {{haccp.user_id}}
                </td> -->
                <td class="px-6 py-4 whitespace-nowrap  id-color text-xl  font-extrabold">
                    <button type="button" @click="haccp_copy_script(haccp.id)" class="">
                    <i class="fa fa-clone pr-3" aria-hidden="true"></i>
                    </button>

                    <inertia-link :href="route('haccp-snippet-edit', { id: haccp.id })" class="">
                        <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>  
                    </inertia-link>

                    <button v-if="haccp.is_tenant_admin" type="button" @click="haccp_delete_script(haccp.id)" class="">
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
          <inertia-link :href="route('haccp-snippet-add')" class="button-color text-white font-bold py-1.5 px-4 mb- rounded focus:outline-none  inline-block">
            CREATE NEW HACCP SNIPPET
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
  props:['haccp_data'],
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
      haccps:this.haccp_data,

      form: this.$inertia.form({

      })
    }
  },
  methods:{
    
        haccp_copy_script(rid) {
          if(confirm("Are you sure you want to duplicate this HACCP snippet?")){
          this.form.post(this.route('haccp-snippet-copy', rid), {
                onSuccess: () => {    
                  this.$toast.success('HACCP copied successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
              });
          }
        },

        haccp_delete_script(rid) {
          if(confirm("Are you sure you want to delete this HACCP snippet?")){
          this.form.post(this.route('haccp-snippet-delete', rid), {
                onSuccess: () => {
                  this.$toast.success('HACCP deleted successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
              });
          }
        },

        haccpSearchData(search){
            
            if(search == ""){
              this.haccps = this.haccp_data;
            // this.$toast.error('Error: Search value required!');
            // return false;
            }else{
            axios.post('/haccp-search-filter',{type:'search',term:search})
                    .then((response)=>{
                       this.haccps = response.data;
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
