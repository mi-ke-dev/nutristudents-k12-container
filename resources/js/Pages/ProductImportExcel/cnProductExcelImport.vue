<template>
  <Head>
  <title>Products from CN24 | NutriStudents K-12</title>
  <meta name="description" content="Add New Product">
  </Head>
  <default-layout>

    <BreadcrumLayout>
      <div class="flex">
        <!-- <a href="#" class="link-color"> --><U>Templates</U><!-- </a> -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd"
            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
            clip-rule="evenodd" />
        </svg>
        <inertia-link :href="route('product-world-Sync-excel-import')" class="link-color"><U>Products from CN24.</U></inertia-link>
      </div>
    </BreadcrumLayout>


    <form action="#" @submit.prevent="false" enctype="multipart/form-data" ref="form_1">

      <PageTitleLayout>
        <div class="lg:mb-0 mb-4 md:w-4/6">
          <h1 class="heading-color  2xl:text-2xl text-xl font-bold">Products from CN24</h1>
        </div>
        <div class="w-full flex lg:flex-nowrap flex-wrap md:justify-end items-center">

          <button type="button"
            >
            <inertia-link :href="route('product-cn-excel-import')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
          </button>

          <button type="button" @click="product_add_save_excel_script"
            class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-3.5 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3 sm:mt-0">
            Import
          </button>
        </div>
      </PageTitleLayout>
      <PageTitleLayout>
        <div class="lg:mb-0 mb-4 w-full md:mt-0 mt-6">
          <h1 class="text-base text-gray-500 font-bold" id="response_msg"></h1>
        </div>
      </PageTitleLayout>
      <PageTitleLayout>
        <div
          class="md:flex block justify-between shadow py-8 mt-4 align-middle inline-block min-w-full bg-white rounded-t-lg xl:divide-x-2 divide-gray-300 border-b-4 border-gray-300 w-full overflow-x-auto">
          <div class="w-6/12">

            <div class="xl:grid xl:gap-1 xl:grid-cols-3 block items-center pl-5">
              <label class="font-bold text-gray-700">Excel to CN24 *</label>
              <div>
                <input type="file" id="cnfile" name="cnfile" v-on:change="onCnfileImportChange" ref="file"
                  class="xl:mt-0
                    mt-4
                    sm:w-64
                    w-48
                    shadow-sm
                    focus:border-none
                    block
                    sm:text-sm
                    border
                    p-1
                    border-gray-300
                    rounded-lg
                    select-menu-height
                    input-background" required accept=".xlsx, .xls, .csv"
                    v-show="!uploadProgress"
                    />
                <div v-if="form.errors.cnfile" class="validation_error_msg">{{ form.errors.cnfile }}</div>
                <div class="loader-15" v-if="uploadProgress"></div>
              </div>
            </div>


          </div>
        </div>

      </PageTitleLayout>


      <div class="w-full flex lg:flex-nowrap flex-wrap md:justify-end items-center px-10 mt-4 pb-6 md:ml-0 ml-6">

        <button type="button"
          >
          <inertia-link :href="route('product-cn-excel-import')" class="w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase bg-gray-500 text-white  focus:outline-none sm:w-40">Cancel</inertia-link>
        </button>

        <button  type="button" @click="product_add_save_excel_script"
          class="menu1-background-color w-full inline-flex justify-center rounded-md font-bold px-4 py-2 uppercase button-color text-white  focus:outline-none sm:ml-3 sm:w-40 mt-3 sm:mt-0">
          Import
        </button>
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
    props: ['allergens', 'categories', 'distributors', 'menu_users', 'mass_measurements', 'unit_measurements', 'volume_measurements'],
    components: {
      DefaultLayout,
      Welcome,
      BreadcrumLayout,
      PageTitleLayout,
      TableFilterLayout,
      TableIndexLayout,
    },
    data() {
      return {
        uploadProgress:false,
        form: this.$inertia.form({

          cnfile: ''
        })
      }
    },
    methods: {
      onCnfileImportChange(e) {
      let img_file = e.target.files || e.dataTransfer.files;
      if (!img_file.length) {
        return;
      } else {
          this.uploadProgress = true;
          let $this = this;
          
          Vapor.store(e.target.files[0], {
            progress: (progress) => {},
          }).then((response) => {
            $this.uploadProgress = false;
            $this.form.cnfile = response;
            console.log("vapor response", response);
          });
      }
    },

    product_add_save_excel_script() {
      this.form.post(this.route("import_cn_product_store"), {
        onSuccess: () => {
          this.$refs.form_1.reset();
          this.$toast.success("Excel Import Added Successfully!");
          
        },
      });
    }
    },
  };
</script>
<style>
  .min-height-third {
    min-height: 400px;
  }

  .sm\:text-sm {
    font-size: 0.850rem;
    line-height: 1.25rem;
  }

  .w-52-rec {
    width: 13.2rem;
  }

  .input-background {
    background-color: #f8f8f8;
  }

  .text-base-heading {
    font-size: 14px;
  }

  .button-bg-color-wed-menu2-gray {
    border: none !important;
    min-height: 35px;
    min-width: 35px;
  }

  .menu1-background-color {
    background-color: #FAA43D;
  }

  .products-edit-minus-color {
    color: #f7a53a;
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
    color: #F7A53A;
  }

  .bg-button-color {
    background-color: #cb0000;
  }

  .min-w-min-button {
    min-height: 26px;
    min-width: 53px;

  }

  .w-150 {
    width: 150px;
  }

  .max-w-0-menu1 {
    max-width: 4rem;
  }

  .bg-button-color-green {
    background-color: #22af4b;
  }

  .plus-font-size {
    font-size: 20px;
  }

  .bg-button-color-gray {
    background-color: #636363;
  }

  .bg-hard-grey {
    background-color: #f4f4f4;
  }

  .font-size-edit {
    font-size: 10.5px;
  }

  .w-96-edit-recipes {
    width: 35rem;
  }

  .select-menu-height-edit2 {
    height: 2.8rem;
  }

  .pl-60-plus-icon {
    padding-left: 14.50rem;
  }

  .current_tag.fa-minus-circle:before {
    content: "\f056";
    position: relative;
    top: 1px;
    left: 30px;
  }

  .validation_error_msg {
    font-weight: 400;
    margin: 6px 0 0 !important;
    color: red;
    width: 190px;
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
