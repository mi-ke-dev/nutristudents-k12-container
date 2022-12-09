<template>
  <Head>
    <title>No Meal Service | NutriStudents K-12</title>
    <meta name="description" content="Help States" />
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <!-- <a href="#" class="link-color"> --><U>Settings</U
      ><!-- </a> -->
    </BreadcrumLayout>
    <PageTitleLayout>
      <div
        class="
          w-full
          flex
          xl:flex-nowrap
          flex-wrap
          justify-end
          items-center
          bg-white
          drop-shadow-sm
          rounded-t-lg
          py-5
        "
      >
        <div
          class="xl:w-2/5 w-full md:flex xl:flex-nowrap flex-wrap items-center"
        >
          <h1 class="text-2xl color-24 font-black pl-1 pr-2">
            <inertia-link
              :href="
                $page.props.site_url +
                '/special-days' +
                '?month=' +
                pre_month +
                '&year=' +
                currentYear +
                '&site=' +
                site
              "
              ><i class="text-lg fa fa-chevron-left px-2" aria-hidden="true"></i
            ></inertia-link>
            {{ currentMonthName }} {{ get_year }}
            <inertia-link
              :href="
                $page.props.site_url +
                '/special-days' +
                '?month=' +
                next_month +
                '&year=' +
                currentYear +
                '&site=' +
                site
              "
              ><i
                class="text-lg fa fa-chevron-right px-2"
                aria-hidden="true"
              ></i
            ></inertia-link>
          </h1>

          <div class="flex p-color mt-3 md:mt-0 items-center">
            <inertia-link
              :href="
                $page.props.site_url +
                '/special-days' +
                '?month=' +
                currentMonth +
                '&year=' +
                currentYear +
                '&site=' +
                site
              "
              class="px-2 p-color md:text-base text-sm underline"
              >Today</inertia-link
            >
            |
            <a
              href="#"
              @click="changeMonthYearModalOpen"
              class="pl-2 p-color md:text-base text-sm underline"
              >Jump to...</a
            >
          </div>
        </div>

        <div
          class="
            xl:w-3/5
            w-full
            xl:pl-12
            pl-4
            xl:pt-0
            pt-6
            flex
            md:flex-nowrap
            flex-wrap
            items-center
            xl:justify-end
            justify-start
          "
        >
          <div
            class="
              relative
              focus:outline-none
              lg:w-56
              sm:w-1/2
              w-full
              mr-3
              xl:mt-0
            "
          >
            <select
              class="
                shadow-sm
                focus:border-none
                block
                sm:text-sm
                border-gray-300
                rounded-lg
                w-full
                select-menu-height
              "
              v-model="site"
              @change="changeSite($event)"
            >
              <option value="">Choose Site</option>
              <option v-for="(site, ids) in sites" :value="ids">
                {{ site }}
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
          </div>
        </div>
      </div>
    </PageTitleLayout>

    <TableIndexLayout>
      <div class="-my-2">
        <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow">
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
                    Date
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
                  ></th>
                </tr>
              </thead>
              <tbody>
                <tr v-if="!helpstates.length" class="bg-white">
                  <td
                    v-if="site && site != ''"
                    class="
                      px-6
                      py-4
                      whitespace-nowrap
                      text-base text-color text-center
                    "
                    colspan="7"
                  >
                    No Help State Found
                  </td>
                  <td
                    v-else
                    class="
                      px-6
                      py-4
                      whitespace-nowrap
                      text-base text-color text-center
                    "
                    colspan="7"
                  >
                    Please select site
                  </td>
                </tr>

                <!-- Odd row -->
                <tr
                  v-for="(helpstate, index) in helpstates"
                  :class="{
                    'bg-white': index % 2 == 0,
                    'tr-background-color': index % 2 != 0,
                  }"
                >
                  <td
                    class="
                      px-6
                      py-4
                      whitespace-nowrap
                      text-base text-color
                      td-background-color
                    "
                  >
                    {{ helpstate.date }}
                  </td>
                  <td
                    class="
                      px-6
                      py-4
                      whitespace-nowrap
                      text-base text-color
                      td-background-color
                    "
                  > 
                    <span v-if="helpstate.offering != null">
                      {{ (helpstate.offering)?helpstate.offering.name:'' }}</span
                    >
                  </td>

                  <td
                    class="
                      px-6
                      py-4
                      whitespace-nowrap
                      text-base text-color
                      td-background-color
                    "
                  >
                    {{ helpstate.page_url }}
                  </td>

                  <td
                    class="
                      px-6
                      py-4
                      whitespace-nowrap
                      id-color
                      text-xl
                      font-extrabold
                    "
                  >
                    <button
                      type="button"
                      @click="helpstate_delete_script(helpstate.id)"
                      class=""
                    >
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
        <button
          class="
            uppercase
            button-color
            text-white
            font-bold
            py-1.5
            px-4
            mb-
            rounded
            focus:outline-none
          "
        >
          <inertia-link
            :href="route('add-special-days', { site: site })"
            class=""
          >
            CREATE NEW No Meal Service
          </inertia-link>
        </button>
      </div>
    </TableIndexLayout>
  </default-layout>

  <jet-dialog-modal
    :show="changeMonthYearModal"
    @close="changeMonthYearModal = false"
  >
    <template #title>
      <div class="flex justify-between items-center">Select Month and Year</div>
    </template>

    <template #content>
      <TableIndexLayout>
        <div class="-my-2">
          <div class="py-2 align-middle inline-block px-2 w-full">
            <div
              class="
                shadow
                overflow-x-auto
                max-height
                px-6
                md:py-4
                pb-4
                pt-0
                flex
              "
            >
              <div
                class="
                  relative
                  focus:outline-none
                  xl:w-56
                  w-48
                  mr-3
                  md:mt-0
                  mt-4
                "
              >
                <select
                  v-model="searchForm.month"
                  class="
                    shadow-sm
                    focus:border-none
                    block
                    sm:text-sm
                    border-gray-300
                    rounded-lg
                    w-full
                    select-menu-height
                  "
                >
                  <option v-for="(month, index) in months" :value="index + 1">
                    {{ month }}
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
              </div>

              <div class="relative focus:outline-none w-40 mr-3 md:mt-0 mt-4">
                <select
                  v-model="searchForm.year"
                  class="
                    shadow-sm
                    focus:border-none
                    block
                    sm:text-sm
                    border-gray-300
                    rounded-lg
                    w-full
                    select-menu-height
                  "
                >
                  <option v-for="year_list in year_lists" :value="year_list">
                    {{ year_list }}
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
              </div>
              <button
                type="button"
                class="
                  button-color
                  text-white text-sm
                  font-bold
                  py-2
                  px-4
                  rounded
                  uppercase
                  mt-0
                "
                @click="changeMonthYearRedirection"
              >
                Go to Calendar
              </button>
            </div>
          </div>
        </div>
      </TableIndexLayout>
    </template>

    <template #footer>
      <jet-secondary-button @click="changeMonthYearModal = false"
        ><a href="" class="bg-white px-4 py-2">Close</a></jet-secondary-button
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
import JetDialogModal from "@/Jetstream/DialogModal";

export default {
  props: [
    "excludeDays",
    "sites",
    "site",
    "get_month",
    "get_year",
    "next_month",
    "pre_month",
    "year_lists",
  ],
  components: {
    DefaultLayout,
    Welcome,
    BreadcrumLayout,
    PageTitleLayout,
    TableFilterLayout,
    TableIndexLayout,
    JetDialogModal,
  },
  data() {
    return {
      log: console.log,
      helpstates: this.excludeDays,
      currentMonth: "",
      currentYear: "",
      currentMonthName: "",
      changeMonthYearModal: false,

      form: this.$inertia.form({}),
      searchForm: this.$inertia.form({
        month: "",
        year: "",
      }),
    };
  },
  mounted() {
    let date = new Date();
    this.months = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    this.currentMonthName = this.months[this.get_month - 1];
    this.currentMonth = date.getMonth() + 1;
    this.currentYear = date.getFullYear();
  },
  methods: {
    changeMonthYearModalOpen() {
      this.changeMonthYearModal = true;
    },

    changeSite() {
      this.$inertia.visit(route("special-days"), {
        method: "get",
        data: { month: this.get_month, year: this.get_year, site: this.site },
      });
    },

    changeMonthYearRedirection() {
      this.$inertia.visit(route("special-days"), {
        method: "get",
        data: {
          month: this.searchForm.month,
          year: this.searchForm.year,
          site: this.site,
        },
      });
    },

    helpstate_delete_script(id) {
      if (confirm("Are you sure you want to delete this No Meal Service?")) {
        this.form.post(this.route("delete-special-days", id), {
          onSuccess: () => {
            this.$toast.success("No Meal Service deleted successfully!");
            setTimeout(function () {
              window.location.reload();
            }, 1000);
          },
        });
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
  padding-left: 7px;
  color: #219fd5;
}

.id_arrow .fa-sort-asc:before {
  content: "\f0de";
  color: #219fd5;
  padding-left: 7px;
  position: absolute;
  top: 17px;
  left: 43px;
}
.preview_box:hover .help_info {
  visibility: visible;
  opacity: 1;
}
.bg-preview_box {
  background-color: #29447e;
}
.bg-preview_box.help_info {
  top: 0;
  right: auto;
  left: 65px;
  white-space: normal;
}
</style>
