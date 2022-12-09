<template>
  <Head>
  <title>Help States | NutriStudents K-12</title>
  <meta name="description" content="Help States">
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
    </BreadcrumLayout>
    <PageTitleLayout>
      <div class="lg:mb-0 mb-4 w-1/2">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">Help States</h1>
      </div>
      <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center">
        <button >
          <inertia-link :href="route('add-help-state')" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 mt-10  inline-block">
          CREATE NEW HELP STATE
          </inertia-link>
        </button>
      </div>
    </PageTitleLayout>

    <TableFilterLayout @messageFromChild="helpstateSearchData" />

    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow">
            <table class="min-w-full">
          <thead class="header-bg-color">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                NAME
              </th>
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">
                PAGE URL
              </th> 
              <th scope="col" class="px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider">                
              </th>
            </tr>
          </thead>
          <tbody>
            

            <tr v-if="!helpstates.length" class="bg-white">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Help State Found</td>
            </tr>

            <!-- Odd row -->
            <tr v-for="(helpstate,index) in helpstates" :class="{'bg-white':index%2 == 0, 'tr-background-color':index%2 != 0}">
                <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                   {{helpstate.name}}
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color td-background-color">
                   {{helpstate.page_url}}
                </td>

                <td class="px-6 py-4 whitespace-nowrap text-base text-color">  
                   <div class="flex">
                   <div class="preview_box relative mr-2">
                    <a href="#" class="link-color">Preview</a>

                     <div v-if="helpstate.youtube_id || helpstate.content" class="absolute py-5 px-8 bg-preview_box help_info">
                        <div v-if="helpstate.youtube_id">
                          <iframe width="100%" height="120" :src="'https://www.youtube.com/embed/' +helpstate.youtube_id" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div v-if="helpstate.youtube_id && helpstate.content" class="w-full border-t border-gray-500 my-4"></div>
                        <div v-html="helpstate.content"></div>
                      </div> 
                      <div v-else class="absolute py-5 px-8 bg-preview_box help_info">Preview Not Found</div>

                   </div><!--  | 
                   <a :href="$page.props.site_url +'/' +helpstate.page_url" class="ml-2 link-color"> Go to Page</a> --> 
                   </div>

                </td> 
                
                <td class="px-6 py-4 whitespace-nowrap  id-color text-xl  font-extrabold">
                    <inertia-link :href="route('edit-help-state', { id: helpstate.id })" class="">
                        <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>  
                    </inertia-link>
                    <button type="button" @click="helpstate_delete_script(helpstate.id)" class="">
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
          <inertia-link :href="route('add-help-state')" class="button-color text-white font-bold py-1.5 px-4 mb- rounded focus:outline-none  inline-block">
          CREATE NEW HELP STATE
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
  props:['helpstates_data'],
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
      helpstates:this.helpstates_data,

      form: this.$inertia.form({

      })
    }
  },
  methods:{          

        helpstate_delete_script(id) {
          if(confirm("Are you sure you want to delete this helpstate?")){
          this.form.post(this.route('delete-help-state', id), {
                onSuccess: () => {
                  this.$toast.success('Help State deleted successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
              });
          }
        },

        helpstateSearchData(search){
            
            if(search == ""){
              this.helpstates = this.helpstates_data;
            // this.$toast.error('Error: Search value required!');
            // return false;
            }else{
            axios.post('/search-help-state',{term:search})
                    .then((response)=>{
                       this.helpstates = response.data;
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
.preview_box:hover .help_info{
  visibility: visible;
  opacity: 1;
}
.bg-preview_box{
    background-color: #29447e;
}
.bg-preview_box.help_info {
    top: 0;
    right: auto;
    left: 65px;
    white-space: normal;
}
</style>
