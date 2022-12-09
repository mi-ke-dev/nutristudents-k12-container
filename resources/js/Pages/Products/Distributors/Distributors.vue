<template>
  <Head>
  <title>Product Distributors | NutriStudents K-12</title>
  <meta name="description" content="Product Distributors">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
    </BreadcrumLayout>
    <PageTitleLayout>
      <div class="lg:mb-0 mb-4 w-1/2">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">Product Distributors</h1>
      </div>
      <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center">
        <button >
          <inertia-link :href="route('add-product-distributor')" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 mt-10  inline-block">
          CREATE NEW DISTRIBUTOR
          </inertia-link>
        </button>
      </div>
    </PageTitleLayout>

    <TableFilterLayout @messageFromChild="distributorSearchData" />

    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-auto">
            <table class="min-w-full">
          <thead class="header-bg-color">
            <tr>
              <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                DISTRIBUTOR NAME
              </th>
            </tr>
          </thead>
          <tbody>
            

            <tr v-if="!distributors.length" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Distributor Found</td>
            </tr>

            <!-- Odd row -->
            <tr v-for="(distributor,index) in distributors" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                    {{distributor.name}}
                </td>
                <td class="px-6 py-4 whitespace-nowrap id-color text-xl  font-extrabold">

                    <inertia-link :href="route('edit-product-distributor', { id: distributor.id })" class="">
                        <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>  
                    </inertia-link>

                    <button v-if="distributor.is_tenant_admin" type="button" @click="distributor_delete_script(distributor.id)" class="">
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
          <inertia-link :href="route('add-product-distributor')" class="button-color text-white font-bold py-1.5 px-4 mb- rounded focus:outline-none  inline-block">
            CREATE NEW DISTRIBUTOR
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
  props:['all_distributors'],
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
      distributors : this.all_distributors,
      form: this.$inertia.form({

      })
    }
  },
  methods:{
          

        distributor_delete_script(distributorid) {
          if(confirm("Are you sure you want to delete this distributor?")){
          this.form.post(this.route('delete-product-distributor', distributorid), {
                onSuccess: () => {
                  this.$toast.success('Distributor deleted successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
              });
          }
        },

        distributorSearchData(search){
            
            if(search == ""){
              this.distributors = this.all_distributors ;
            // this.$toast.error('Error: Search value required!');
            // return false;
            }else{
            axios.post('/search-product-distributor',{term:search})
                    .then((response)=>{
                       this.distributors = response.data;
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
