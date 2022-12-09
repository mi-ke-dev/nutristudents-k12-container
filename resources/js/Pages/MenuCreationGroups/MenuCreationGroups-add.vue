<template>
  <Head>
    <title>Add New Group | NutriStudents K-12</title>
    <meta name="description" content="Add New Recipe" />
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <div class="flex">
        <!-- <a href="#" class="link-color"> --><U>Settings</U
        ><!-- </a> -->
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5 mt-1"
          viewBox="0 0 20 20"
          fill="currentColor"
        >
          <path
            fill-rule="evenodd"
            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
            clip-rule="evenodd"
          />
        </svg>
        <inertia-link :href="route('menu-creation-groups')" class="link-color"
          ><U>Menu Creation Group</U></inertia-link
        >
      </div>
    </BreadcrumLayout>

    <form action="#" enctype="multipart/form-data">
      <PageTitleLayout>
        <div class="lg:mb-0 mb-4 w-6/12">
          <h1 class="heading-color xl:text-4xl sm:text-2xl text-base font-bold">
            Add New Menu Creation Group
          </h1>
        </div>
        <div
          class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center"
        >
          <button
            type="button"
            class="
              w-full
              inline-flex
              justify-center
              rounded-md
              font-bold
              px-4
              py-3.5
              uppercase
              bg-gray-500
              text-white
              focus:outline-none
              sm:w-40
              mx-2
            "
          >
            <inertia-link :href="route('menu-creation-groups')" class=""
              >Cancel</inertia-link
            >
          </button>

          <button
            type="button"
            @click="menu_creation_add_save_script"
            class="
              menu1-background-color
              w-full
              inline-flex
              justify-center
              rounded-md
              font-bold
              px-4
              py-3.5
              uppercase
              button-color
              text-white
              focus:outline-none
              sm:ml-3 sm:w-40
              mt-3
              sm:mt-0
              mx-2
            "
          >
            Save
          </button>
        </div>
      </PageTitleLayout>

      <PageTitleLayout>
        <div class="lg:mb-0 mb-4 w-full">
          <h1 class="text-base text-gray-500 font-bold"></h1>
        </div>
      </PageTitleLayout>

      <PageTitleLayout>
        <div
          class="
            flex
            justify-between
            shadow
            py-8
            mt-4
            align-middle
            min-w-full
            bg-white
            rounded-lg
            min-height-third
          "
        >
          <div class="sm:w-2/5 w-full">
            <div
              class="xl:grid xl:gap-1 xl:grid-cols-3 block pl-5 items-center"
            >
              <label class="font-bold text-gray-700">Name*</label>
              <div>
                <input
                  type="text"
                  placeholder="Name"
                  id="name"
                  v-model="form.name"
                  class="
                    xl:mt-0
                    mt-4
                    sm:w-64
                    w-48
                    shadow-sm
                    focus:border-none
                    block
                    sm:text-sm
                    border-gray-300
                    rounded-lg
                    select-menu-height
                    input-background
                  "
                />
                <div
                  v-if="form.errors.name"
                  class="validation_error_msg w-60"
                >
                  {{ form.errors.name }}
                </div>
              </div>
            </div>

            <div
              class="
                xl:grid xl:gap-1 xl:grid-cols-3
                block
                pl-5
                pt-6
                items-center
              "
            >
              <label class="font-bold text-gray-700">Meal Type*</label>
              <div class="relative pl-0 sm:w-64 w-48 lg:top-0 xl:mt-0 mt-4">
                <select
                  id="meal_type_id"
                  name="meal_type_id"
                  v-model="form.meal_type_id"
                  class="
                    shadow-sm
                    focus:border-color
                    block
                    sm:text-sm
                    border-gray-300
                    rounded-lg
                    w-full
                    select-menu-height
                    input-background
                    text-gray-500
                  "
                  @change="updateGuidelineValues"
                >
                  <option value="">Select</option>
                  <option
                    v-for="(category, index) in mealTypes"
                    :value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <div
                  class="
                    absolute
                    flex
                    justify-center
                    items-center
                    searching-background-color
                    select-menu-height
                    w-9
                    text-white
                    top-0
                    right-0
                    rounded-lg rounded-tl-none rounded-bl-none
                    pointer-events-none
                  "
                >
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>
                </div>
                <div
                  v-if="form.errors.recipe_category"
                  class="validation_error_msg"
                >
                  {{ form.errors.recipe_category }}
                </div>
              </div>
            </div>

           <div
              class="
                xl:grid xl:gap-1 xl:grid-cols-3
                block
                pl-5
                pt-6
                items-center
              "
            >
              <label class="font-bold text-gray-700">Age Range*</label>
              <div class="relative pl-0 sm:w-64 w-48 lg:top-0 xl:mt-0 mt-4">
                <select
                  id="age_grade_offering_id"
                  name="age_grade_offering_id"
                  v-model="form.age_grade_offering_id"
                  class="
                    shadow-sm
                    focus:border-color
                    block
                    sm:text-sm
                    border-gray-300
                    rounded-lg
                    w-full
                    select-menu-height
                    input-background
                    text-gray-500
                  "
                  @change="updateGuidelineValues"
                >
                  <option value="">Select</option>
                  <option
                    v-for="(category, index) in ageGradeOfferings"
                    :value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <div
                  class="
                    absolute
                    flex
                    justify-center
                    items-center
                    searching-background-color
                    select-menu-height
                    w-9
                    text-white
                    top-0
                    right-0
                    rounded-lg rounded-tl-none rounded-bl-none
                    pointer-events-none
                  "
                >
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>
                </div>
                <div
                  v-if="form.errors.age_grade_offering_id"
                  class="validation_error_msg"
                >
                  {{ form.errors.age_grade_offering_id }}
                </div>
              </div>
            </div>

            <div
              class="
                xl:grid xl:gap-1 xl:grid-cols-3
                block
                pl-5
                pt-6
                items-center
              "
            >
              <label class="font-bold text-gray-700">Days*</label>
              <div class="relative pl-0 sm:w-64 w-48 lg:top-0 xl:mt-0 mt-4">
                <select
                  id="day_id"
                  name="day_id"
                  v-model="form.day_id"
                  class="
                    shadow-sm
                    focus:border-color
                    block
                    sm:text-sm
                    border-gray-300
                    rounded-lg
                    w-full
                    select-menu-height
                    input-background
                    text-gray-500
                  "
                  @change="updateGuidelineValues"
                >
                  <option value="">Select</option>
                  <option
                    v-for="(category, index) in days"
                    :value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <div
                  class="
                    absolute
                    flex
                    justify-center
                    items-center
                    searching-background-color
                    select-menu-height
                    w-9
                    text-white
                    top-0
                    right-0
                    rounded-lg rounded-tl-none rounded-bl-none
                    pointer-events-none
                  "
                >
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>
                </div>
                <div
                  v-if="form.errors.day_id"
                  class="validation_error_msg"
                >
                  {{ form.errors.day_id }}
                </div>
              </div>
            </div>

            <div
              class="
                xl:grid xl:gap-1 xl:grid-cols-3
                block
                pl-5
                pt-6
                items-center
              "
            >
              <label class="font-bold text-gray-700">Guideline*</label>
              <div class="relative pl-0 sm:w-64 w-48 lg:top-0 xl:mt-0 mt-4">
                <select
                  id="guideline_id"
                  name="guideline_id"
                  v-model="form.guideline_id"
                  class="
                    shadow-sm
                    focus:border-color
                    block
                    sm:text-sm
                    border-gray-300
                    rounded-lg
                    w-full
                    select-menu-height
                    input-background
                    text-gray-500
                  "
                >
                  <option value="">Select</option>
                  <option
                    v-for="(category, index) in guidelines"
                    :value="category.id"
                  >
                    {{ category.name }}
                  </option>
                </select>
                <div
                  class="
                    absolute
                    flex
                    justify-center
                    items-center
                    searching-background-color
                    select-menu-height
                    w-9
                    text-white
                    top-0
                    right-0
                    rounded-lg rounded-tl-none rounded-bl-none
                    pointer-events-none
                  "
                >
                  <i class="fa fa-sort-desc" aria-hidden="true"></i>
                </div>
                <div
                  v-if="form.errors.guideline_id"
                  class="validation_error_msg"
                >
                  {{ form.errors.guideline_id }}
                </div>
              </div>
            </div> 
            
          </div>
        </div>
      </PageTitleLayout>

      <header
        class="
          mx-8
          searching-background-color
          flex
          justify-between
          items-center
          py-2
          pl-6
          shadow
          overflow-hidden
          rounded-t-lg
          mt-8
        "
      >
        <h2 class="text-white text-lg font-bold w-11/12">Sites Belonging This Group</h2>

        <a href="#" @click="addModalOpen">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6 text-white mr-3"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 6v6m0 0v6m0-6h6m-6 0H6"
            />
          </svg>
        </a>
      </header>
      <div class="mx-8 flex flex-col mb-6">
        <div class="overflow-x-auto">
          <div class="align-middle inline-block min-w-full">
            <div
              class="
                shadow
                overflow-hidden
                border-b-2 border-gray-200
                sm:rounded-lg
              "
            >
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-base
                        font-bold
                        text-black-800
                        uppercase
                        tracking-wider
                      "
                    >
                      Site
                    </th>

                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-base
                        font-bold
                        text-black-800
                        uppercase
                        tracking-wider
                        whitespace-nowrap
                      "
                    >
                      Offering
                    </th>

                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-base
                        font-bold
                        text-black-800
                        uppercase
                        tracking-wider
                        whitespace-nowrap
                      "
                    >
                      Action
                    </th>
                  </tr>
                </thead>

               <tbody>
                  <!-- Odd row -->

                  <tr v-if="!this.form.siteOfferings.length" class="bg-white">
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-base text-color text-center
                      "
                      colspan="15"
                    >
                      No Attached Offering Found!
                    </td>
                  </tr>

                  <offering-component
                    v-for="(rec_offering, index) in searched_site_offerings"
                    :offering="rec_offering"
                    :key="rec_offering.id"
                    :site_offering="this.form.siteOfferings"
                     @updateSiteOffering="
                      updateSiteOffering(index, $event)
                    "
                  />
                </tbody>
              
              </table>
            </div>
          </div>
        </div>
      </div>


      <div
        class="
          w-full
          flex
          lg:flex-nowrap
          flex-wrap
          justify-end
          items-center
          mb-6
          px-8
        "
      >
        <button
          type="button"
          class="
            w-full
            inline-flex
            justify-center
            rounded-md
            font-bold
            px-4
            py-2
            uppercase
            bg-gray-500
            text-white
            focus:outline-none
            sm:w-40
          "
        >
          <inertia-link :href="route('recipes')" class="">Cancel</inertia-link>
        </button>

        <button
          type="button"
          @click="menu_creation_add_save_script"
          class="
            menu1-background-color
            w-full
            inline-flex
            justify-center
            rounded-md
            font-bold
            px-4
            py-2
            uppercase
            button-color
            text-white
            focus:outline-none
            sm:ml-3 sm:w-40
            mt-3
            sm:mt-0
          "
        >
          Save
        </button>
      </div>
    </form>
  </default-layout>

  <jet-dialog-modal
    :show="addGroupModal"
    @close="addGroupModal = false"
  >
    <template #title>
      <div class="flex justify-between items-center">
         Add Site Offerings to the Menu Creation Group
       
      </div>
    </template>

    <template #content>
      <TableIndexLayout>
        <div class="-my-2">
          <div class="py-2 align-middle inline-block px-2 w-full">
            <div class="shadow overflow-x-auto max-height">
              <table class="min-w-full">
                <thead class="header-bg-color">
                  <tr>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-base
                        font-bold
                        text-black-800
                        uppercase
                        tracking-wider
                      "
                    >
                      Site
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-base
                        font-bold
                        text-black-800
                        uppercase
                        tracking-wider
                      "
                    >
                      Offering
                    </th>
                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-left text-base
                        font-bold
                        text-black-800
                        uppercase
                        tracking-wider
                      "
                    >
                      
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Odd row -->
                  <tr v-if="!searched_site_offerings.length" class="bg-white">
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-base text-color text-center
                      "
                      colspan="7"
                    >
                      No Offering Found
                    </td>
                  </tr>

                  <tr
                    v-for="(offer, index) in searched_site_offerings"
                    :class="{
                      'bg-white': index % 2 == 0,
                      'tr-background-color': index % 2 != 0,
                    }"
                    class="cursor-pointer"
                    
                  >
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-base text-color
                        td-background-color
                        id-color
                      "
                      v-if="!this.form.siteOfferings.includes(offer.id)"
                    >
                      <div class="tooltip">
                        <div class="trim_text">
                          <a
                          :href="route('edit-site', { id: offer.site.id })"
                          class=""
                          target="_blank"
                          ><i
                            class="fa fa-external-link pr-3"
                            aria-hidden="true"
                          ></i
                        > {{ offer.site.name }}</a>
                         
                          </div>
                       
                      </div>
                    </td>

                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        
                        text-xl
                        font-extrabold
                       
                      "
                      v-if="!this.form.siteOfferings.includes(offer.id)"
                    >
                    {{offer.name}}
                    </td>

                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        id-color
                        text-xl
                        font-extrabold
                        float-right
                      "
                      v-if="!this.form.siteOfferings.includes(offer.id)"
                    >
                     
                      <button v-if="!this.form.siteOfferings.includes(offer.id)" type="button" @click="addRow(offer.id,offer.name)">
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
      <jet-secondary-button @click="addGroupModal = false"
        >Close</jet-secondary-button
      >
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
import JetButton from "@/Jetstream/Button";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDialogModal from "@/Jetstream/DialogModal";

import OfferingComponent from "@/Pages/MenuCreationGroups/Offering";
import CalculatedTotalsComponent from "@/Pages/Recipes/Partials/CalculatedTotalsComponent";

export default {
  props: [
    "mealTypes",
    "ageGradeOfferings",
    "days"
  ],
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
    OfferingComponent,
    CalculatedTotalsComponent,
  },

  data() {
    return {
      rec_ingredients: [],
      ing_prefer_products: [],
      calculated_totals_sum: [],
      guidelines:[],
      searched_site_offerings: "",
      addGroupModal: false,
      recipeimage: "",
      search_term: "",
      searched_ingredients: "",
      haccp_names: "",
      haccp_description: "",
      uploadProgress: false,

      form: this.$inertia.form({
        name: "",
        meal_type_id: "",
        day_id: "",
        age_grade_offering_id: "",
        guideline_id: "",
        siteOfferings:[]
      }),
    };
  },

  methods: {
    changeComponentVals(update_prefer_prod) {
      //console.log(update_prefer_prod);
      this.calculated_totals_sum =
        this.$helpers.preferProductsCalculatedTotals(update_prefer_prod);
    },
    updateGuidelineValues(){
        if(this.form.meal_type_id && this.form.age_grade_offering_id && this.form.day_id){
        axios.post('/site-offering-get-guidelines',{
          meal_type:this.form.meal_type_id,
          age_range:this.form.age_grade_offering_id,
          days:this.form.day_id,
        }).then((response)=>{
        this.guidelines = response.data;
        //this.guideline_id= response.data[0]['id'];
        })
        .catch(error => console.error(error));
        }
    },

    addModalOpen() {
      this.addGroupModal = true;
      this.search_term = "";
      axios
      .post("/search-site-offerings",{form: this.form})
      .then((response) => {
        //console.log(response.data.search_data);
        this.searched_site_offerings = response.data;
      })
      .catch((error) => console.error(error));
    },
 
    menu_creation_add_save_script() {
      this.form.post(this.route("menu-creation-groups-add-save"), {
        onSuccess: () => {
          this.$toast.success("menu creation group added successfully!");
        },
      });
    },
    addRow(offering_id,name){
      var index = this.form.siteOfferings.indexOf(offering_id);
      if (index > -1) {
        this.form.siteOfferings.splice(index, 1);
      }
      this.form.siteOfferings.push(offering_id);
    },
    updateSiteOffering(index,e){
       this.form.siteOfferings.splice(e, 1);
    }
  },
};
</script>
<style>
.min-height-third {
  min-height: 400px;
}

.w-52-rec {
  width: 13.2rem;
}

.input-background {
  background-color: #f8f8f8;
}

.button-bg-color-wed-menu2-gray {
  border: none !important;
  min-height: 35px;
  min-width: 35px;
}

.menu1-background-color {
  background-color: #faa43d;
}

.button-bg-color-wed-menu2 {
  background-color: #38558e;
  border: none !important;
  min-height: 35px;
  min-width: 35px;
}

.menu1-icon-color {
  color: #38558e;
}

.id-color-menu-edit {
  color: #f7a53a;
}

.bg-button-color {
  background-color: #cb0000;
}

.min-w-min-button {
  min-height: 26px;
  min-width: 53px;
  line-height: 26px;
  text-transform: lowercase;
}

.max-w-0-menu1 {
  max-width: 4rem;
}

.bg-button-color-green {
  background-color: #22af4b;
}

.bg-button-color-gray {
  background-color: #636363;
}

.bg-hard-grey {
  background-color: #f4f4f4;
}

.w-96-edit-recipes {
  width: 35rem;
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
    padding-left: 7px;
    color: #219fd5;
  }

  .id_arrow .fa-sort-asc:before {
    content: "\f0de";
    color: #219fd5;
    padding-left: 7px;
    position: absolute;
    top: 16px;
    left: 43px;
  }
}

@media screen and (max-width: 1499px) {
  .id_arrow .fa-sort-asc:before {
    content: "\f0de";
    color: #219fd5;
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
    color: #219fd5;
  }
}

.max-height {
  max-height: 600px;
}

@media (min-width: 640px) {
  .mb-6.bg-white.rounded-lg.overflow-hidden.shadow-xl.transform.transition-all.sm\:w-full.sm\:mx-auto.sm\:max-w-2xl {
    max-width: 60rem;
  }
}

.trim_text {
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 250px;
}

.tooltip {
  display: inline-block;
  position: relative;
  text-align: left;
}

.tooltip .top {
  width: 250px;
  top: 50%;
  left: 100%;
  margin-left: 20px;
  transform: translate(0, -50%);
  padding: 5px 10px;
  color: #444444;
  background-color: #eeeeee;
  font-weight: normal;
  font-size: 14px;
  border-radius: 5px;
  position: absolute;
  z-index: 99999999;
  box-sizing: border-box;
  box-shadow: 0 1px 8px rgba(0, 0, 0, 0.5);
  display: none;
  white-space: normal;
}

.tooltip:hover .top {
  display: block;
}

.tooltip .top i {
  position: absolute;
  top: 50%;
  right: 100%;
  margin-top: -12px;
  width: 12px;
  height: 24px;
  overflow: hidden;
}

.tooltip .top i::after {
  content: "";
  position: absolute;
  width: 12px;
  height: 12px;
  left: 0;
  top: 50%;
  transform: translate(50%, -50%) rotate(-45deg);
  background-color: #eeeeee;
  box-shadow: 0 1px 8px rgba(0, 0, 0, 0.5);
}

.loader-15 {
  background: currentcolor;
  position: relative;
  animation: loader-15 1s ease-in-out infinite;
  animation-delay: 0.4s;
  width: 0.25em;
  height: 0.5em;
  margin: 37px auto;
}
.loader-15:after,
.loader-15:before {
  content: "";
  position: absolute;
  width: inherit;
  height: inherit;
  background: inherit;
  animation: inherit;
}
.loader-15:before {
  right: 0.5em;
  animation-delay: 0.2s;
}
.loader-15:after {
  left: 0.5em;
  animation-delay: 0.6s;
}

@keyframes loader-15 {
  0%,
  100% {
    box-shadow: 0 0 0 currentcolor, 0 0 0 currentcolor;
  }
  50% {
    box-shadow: 0 -0.25em 0 currentcolor, 0 0.25em 0 currentcolor;
  }
}
</style>
