<template>
  <Head>
    <title>Menu Planner | NutriStudents K-12</title>
    <meta name="description" content="Calendar" />
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <div
        class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center"
      >
        <div class="lg:w-8/12 md:w-6/12 w-full">
          <h1 class="heading-color xl:text-4xl text-2xl font-bold">
            Menu Planner
          </h1>
        </div>
        <div
          class="
            lg:w-4/12
            md:w-6/12
            w-full
            flex
            lg:flex-nowrap
            flex-wrap
            lg:justify-end
            md:justify-end
            justify-start
          "
        >
          
          <button
            v-if="is_week_available && form.type != 'group' && isShowHeadCount"
            class="
              button-color
              text-white text-sm
              font-bold
              py-2
              xl:px-4
              px-2
              rounded
              lg:mt-0
              sm:mt-4
              uppercase
            "
          >
          
            <StudentCounts
              @loadCalendar="loadCalendar"
              :calenderdays="calenderdays"
              model_string="Add/Review Headcount"
              :meal_type_id="this.form.meal_type"
              :site_id="this.form.site"
              :age_range_id="this.form.age_grade_offering"
              :day="this.form.day"
              :year="this.form.year"
              :month="this.form.month"
              :offering_id="this.form.offering_id"
              :guide_line_id="this.form.guide_line_id"
              @loadExcludedDates="loadExcludedDates"
              :excludedDates="this.excludedDates"
            />
          </button>

          <!--button
            class="
              button-color
              text-white text-sm
              font-bold
              py-2
              xl:px-4
              px-2
              ml-3
              rounded
              lg:mt-0
              sm:mt-4
              uppercase
            "
          >
            Add to Order
          </button-->
        </div>
      </div>
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
                '/menu-planner' +
                '?month=' +
                pre_month +
                '&year=' +
                get_year +
                '&site=' +
                form.site +
                '&guide_line_id=' +
                form.guide_line_id +
								'&type=' +
								form.type
                + '&offering_id=' + form.offering_id
              "
              ><i class="text-lg fa fa-chevron-left px-2" aria-hidden="true"></i
            ></inertia-link>
            {{ currentMonthName }} {{ get_year }}
            <inertia-link
              :href="
                $page.props.site_url +
                '/menu-planner' +
                '?month=' +
                next_month +
                '&year=' +
                get_year +
                '&site=' +
                form.site +
                '&guide_line_id=' +
                form.guide_line_id +
								'&type=' +
								form.type
                + '&offering_id=' + form.offering_id
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
                '/menu-planner' +
                '?month=' +
                currentMonth +
                '&year=' +
                currentYear +
                '&site=' +
                form.site +
                '&guide_line_id=' +
                form.guide_line_id +
								'&type=' +
								form.type 
                + '&offering_id=' + form.offering_id
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
              v-model="form.site"
              @change="getOffering($event)"
              
            >
              <option value="">Choose Site</option>
                <option v-for="site in sites" :value="site.id" :type="site.type">
                  {{ site.name }}
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
            v-if="form.type != 'group'"
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
               v-model="form.offering_id"
               @change="getGuidline($event)"
            >
              <option value="">Choose Offerings</option>
              <option v-for="offer in offrings" :value="offer.id">
                {{ offer.name }}
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

         <a
         href="#"
          @click="loadIsPrint(is_print)"           
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="
              xl:h-5
              w-5
              lg:h-5
              w-5
              md:h-10
              w-10
              mr-3
              arrow-color
              md:mt-0
              mt-4
            "
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path
              fill-rule="evenodd"
              d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z"
              clip-rule="evenodd"
            />
          </svg>
          </a>
        </div>
      </div>
    </PageTitleLayout>
    <TableIndexLayout v-if="is_show_calendar">
      <div class="w-full">
        <div class="py-14 align-middle inline-block xl:px-10 px-5 w-full">
          <div class="shadow overflow-x-visible overflow-y-visible">
            <table
              class="
                min-w-full
                shadow
                rounded-t-lg
                table-background
              "
            >
              <thead>
                <tr class="searching-background-color">
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-lg
                      font-black
                      text-white
                      tracking-wider
                    "
                  >
                    Monday
                  </th>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-lg
                      font-black
                      text-white
                      tracking-wider
                    "
                  >
                    Tuesday
                  </th>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-lg
                      font-black
                      text-white
                      tracking-wider
                    "
                  >
                    Wednesday
                  </th>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-lg
                      font-black
                      text-white
                      tracking-wider
                    "
                  >
                    Thursday
                  </th>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-lg
                      font-black
                      text-white
                      tracking-wider
                    "
                  >
                    Friday
                  </th>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-lg
                      font-black
                      text-white
                      tracking-wider
                    "
                  >
                    Saturday
                  </th>
                  <th
                    scope="col"
                    class="
                      px-6
                      py-3
                      text-left text-lg
                      font-black
                      text-white
                      tracking-wider
                    "
                  >
                    Sunday
                  </th>
                </tr>
              </thead>
              <tbody>
                <!-- Odd row -->
                <week-cycle
                  v-for="(weeks, index) in calenderdays.weeks"
                  @loadMenuCycle="loadMenuCycle"
                  :weeks="weeks"
                  :index="index"
                  :graderanges="grade_ranges"
                  :mealTypeImport="mealTypeImport"
                  :daysImport="daysImport"
                  :searchForm="form"
                  :sites="sites"
                  @copyData="loadCopyData"
                  :copiedDataId="copiedDataId"
                  @loadCalendar="loadCalendar"
                  :excludeDays="excludeDays"
                  @loadExcludedDateDataOnLoad="loadExcludedDateDataOnLoad"
                  :isMenuPlanner="isMenuPlanner"
                  :users="users"
                ></week-cycle>
              </tbody>
            </table>
          </div>

          <div
            class="
              w-full
              flex
              lg:flex-nowrap
              flex-wrap
              justify-end
              items-center
              mt-10
            "
          >
            <div
              class="
                lg:w-4/12
                md:w-6/12
                w-full
                flex
                lg:flex-nowrap
                flex-wrap
                lg:justify-end
                md:justify-end
                justify-start
              "
            >
              <!-- <button
                class="
                  button-color
                  text-white text-sm
                  font-bold
                  py-2
                  xl:px-4
                  px-2
                  rounded
                  lg:mt-0
                  sm:mt-4
                  uppercase
                "
              >
                <inertia-link :href="route('add-count')" class="">
                  Add/Review Headcount
                </inertia-link>
              </button> -->

              <!-- <button
                class="
                  button-color
                  text-white text-sm
                  font-bold
                  py-2
                  xl:px-4
                  px-2
                  ml-3
                  rounded
                  lg:mt-0
                  sm:mt-4
                  uppercase
                "
              >
                Add to Order
              </button> -->
            </div>
          </div>
        </div>
      </div>
    </TableIndexLayout>
    <div v-else class="xl:px-10 px-5 mt-20 text-center text-xl">
      Please select a site/group and offering (if applicable) to view the Menu Planner.
    </div>
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
                flex flex-wrap
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
                  v-model="form.month"
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
                  v-model="form.year"
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
                  <option value="2017">2017</option>
                  <option value="2018">2018</option>
                  <option value="2019">2019</option>
                  <option value="2020">2020</option>
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
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
        >Close</jet-secondary-button
      >
    </template>
  </jet-dialog-modal>
  {{log(this.site)}}
</template>
<script>
import DefaultLayout from "@/Layouts/DefaultLayout";
import Welcome from "@/Jetstream/Welcome";
import BreadcrumLayout from "@/Pages/Common/Breadcrumbs";
import PageTitleLayout from "@/Pages/Common/PageTitle";
import TableFilterLayout from "@/Pages/Common/TableFilters";
import TableIndexLayout from "@/Pages/Common/TableIndex";
import WeekCycle from "@/Pages/Calendar/WeekCycle";
import StudentCounts from "@/Pages/Calendar/StudentCounts";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import $ from 'jquery';

export default {
  props: [
    "calender_days",
    "get_month",
    "get_year",
    "next_month",
    "next_year",
    "pre_month",
    "pre_year",
    "mealTypeImport",
    "daysImport",
    "grade_ranges",
    "meal_type",
    "age_grade_offering",
    "day",
    "site",
    "sites",
    'guide_line_id',
		'type',
		'offering_id',
    'users'
  ],

  components: {
    DefaultLayout,
    Welcome,
    BreadcrumLayout,
    PageTitleLayout,
    TableFilterLayout,
    TableIndexLayout,
    WeekCycle,
    StudentCounts,
    JetDialogModal,
    JetSecondaryButton,
  },

  data() {
    return {
      changeMonthYearModal: false,
      is_print: 0,

      currentMonth: "",
      currentYear: "",
      currentMonthName: "",

      months: "",

      siteFilterVal: "",
      graderangeFilterVal: "",
      mealFilterVal: "",

      meal_types: [],

      calenderdays: [],
      offrings: [],
      excludeDays:[],

    
      copyData:'',
      copiedDataId:'',
      excludedDates: [],
      form: this.$inertia.form({
        meal_type: this.meal_type,
        age_grade_offering: this.age_grade_offering,
        day: this.day,
        month: this.get_month,
        year: this.get_year,
        site: this.site,
        guide_line_id: this.guide_line_id,
        type: this.type,
				offering_id: this.offering_id,
				group_id: this.group_id
      }),
      log : console.log
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
    this.calenderdays = JSON.parse(JSON.stringify(this.calender_days));
    this.currentMonthName = this.months[this.get_month - 1];
    this.currentMonth = date.getMonth() + 1;
    this.currentYear = date.getFullYear();
    if(this.site != '' && this.offering_id != ''){
      this.loadExcludedDateDataOnLoad(this.site,this.offering_id);
    }
    this.loadCalendar(this.site,this.offering_id);
		if(this.type == 'group'){
			this.loadOffringsForGroup(this.site,this.guide_line_id);
		}
		if(this.type == 'site'){
			this.loadOffrings(this.site,this.offering_id);
		}
  },
  computed: {
    isShowHeadCount: function(){
      if(this.form.offering_id != ''){
        if(this.offrings.length > 0){
          let offr = this.offrings.find(x => x.id === this.form.offering_id);
          if(offr){
            return offr.is_headcount;
          } else {
            return false;
          }
        } 
        else {
          return false;
        }
      } else {
        return false;
      }
    },
    isMenuPlanner: function (){
      if(this.form.type == 'group'){
        return true;
      }
      else if(this.form.offering_id != ''){
        if(this.offrings.length > 0){
          let offr = this.offrings.find(x => x.id === this.form.offering_id);
          if(offr){
            return offr.is_menuplanner;
          } else {
            return false;
          }
        } 
        else {
          return false;
        }
      } else {
        return false;
      }
    },
    is_show_calendar: function () {
      if (
        this.form.meal_type &&
        this.form.meal_type != "" &&
        this.form.age_grade_offering &&
        this.form.age_grade_offering != "" &&
        this.form.day &&
        this.form.day != "" &&
        this.form.site != '' 
      ) {
        return true;
      } else {
        return false;
      }
    },
    is_week_available: function () {
      let is_munu = false;
      if (this.calenderdays && this.calenderdays.weeks) {
        this.calenderdays.weeks.forEach((el1) => {
          if (el1.menuCycle && el1.menuCycle != "") {
            is_munu = true;
          }
        });
      }

      return is_munu;
    },
  },

  methods: {
    getJsonToData(json_url){
       let $this= this;
       console.log("getJsonToData", json_url);
       $.getJSON(json_url, function(json_data) {
         console.log("getJsonToData in ", json_data);
            $this.convertDataShowingCalendar(json_data);
            $this.hideShowLoader('hide');         
        })
        .fail(function(e) { 
          console.log("getJsonToData error ", e);
          // $this.menu_cycles = []; 
          $this.hideShowLoader('hide'); 
        });
     },
    loadMenuCycle(menuCycle, index) {
      this.calenderdays.weeks[index]["menuCycle"] = menuCycle;
    },
    loadIsPrint(is_print) {
      this.is_print = !is_print;
      if(this.is_print == true && this.form.site != '' && this.form.guide_line_id != ''){
        var url = route("calendars", { month: this.form.month, year: this.form.year, site: this.form.site, guide_line_id: this.form.guide_line_id, is_print: 1, type: this.form.type })
        console.log(url);
        var w = window.open(url,"","width=800,height=600");
        // try {
        //   if(!document.execCommand('print', false, url)){
        //     w.print();
        //   }else{
        //     w.print();
        //   }
        // }
        // catch(e) {
        //   w.print();
        // }
        w.print();
        setTimeout(function() {
          w.close();
        }, 30000);
      }
    },
    changeMonthYearModalOpen() {
      this.changeMonthYearModal = true;
    },

    changeMonthYearRedirection() {
      this.$inertia.visit(route("calendars"), {
        method: "get",
        data: { month: this.form.month, year: this.form.year, site: this.form.site, guide_line_id: this.form.guide_line_id, type: this.form.type, offering_id: this.form.offering_id },
      });
    },
    hideShowLoader(types) {
      if (types == "show") {
        document.getElementById("full_loader").style.display = "flex";
      } else {
        document.getElementById("full_loader").style.display = "none";
      }
    },

    convertDataShowingCalendarByWeek(cal_week) {
      let $this = this;
      if(cal_week){
        $this.calenderdays.weeks[cal_week.week_number]["menuCycle"] =
            $this.$helpers.convertMenuCycleToShowingData(
              cal_week.menu_cycle,
              $this.calenderdays.weeks[cal_week.week_number]
            );
      }
      // if (cal_weeks.length > 0) {
      //   cal_weeks.forEach((cal_week) => {
      //     $this.calenderdays.weeks[cal_week.week_number]["menuCycle"] =
      //       $this.$helpers.convertMenuCycleToShowingData(
      //         cal_week.menu_cycle,
      //         $this.calenderdays.weeks[cal_week.week_number]
      //       );
      //   });
      // } 
    },

    loadCalendarByWeek(weeks) {
      let $this = this;
      this.emptyWeekCycles();
      if (this.is_show_calendar) {
        this.hideShowLoader("show");
        let oids = (this.form.offering_id != '')?this.form.offering_id:1 ;
        axios
          .get(
            "/load-menu-planner-by-week/" +
              this.form.meal_type +
              "/" +
              this.form.age_grade_offering +
              "/" +
              this.form.day +
              "/" +
              this.form.month +
              "/" +
              this.form.year +
              "/" +
              this.form.site +
              "/" +
              this.form.guide_line_id +
							"/" +
							this.form.type +
              "/" +
              oids + 
              "/" +
              weeks 
          )
          .then((response) => {
            console.log("response", response);
            if(response.data && response.data != ''){
              $this.convertDataShowingCalendarByWeek(response.data);
            } 
            $this.hideShowLoader('hide'); 
            //$this.$helpers.convertMenuCycleToShowingData(response.data, this.weeks);
          })
          .catch((error) => $this.hideShowLoader("hide"));
      }
    },

    loadCalendar() {
      let $this = this;
      this.emptyWeekCycles();
      if (this.is_show_calendar) {
        this.hideShowLoader("show");
        $this.calenderdays.weeks.forEach((weekNum, indx) => {
          console.log("weekNum", indx, weekNum);
          $this.loadCalendarByWeek(indx);
        });


        // loadCalendarByWeek

        // axios
        //   .get(
        //     "/load-menu-planner/" +
        //       this.form.meal_type +
        //       "/" +
        //       this.form.age_grade_offering +
        //       "/" +
        //       this.form.day +
        //       "/" +
        //       this.form.month +
        //       "/" +
        //       this.form.year +
        //       "/" +
        //       this.form.site +
        //       "/" +
        //       this.form.guide_line_id +
				// 			"/" +
				// 			this.form.type +
        //       "/" +
        //       this.form.offering_id
        //   )
        //   .then((response) => {
        //     console.log("response", response);
        //     if(response.data != ''){
        //       $this.getJsonToData(response.data);
        //     } else {
        //       $this.hideShowLoader('hide'); 
        //     }
            
            
        //     //$this.$helpers.convertMenuCycleToShowingData(response.data, this.weeks);
        //   })
        //   .catch((error) => $this.hideShowLoader("hide"));
      }
    },
    loadExcludedDateData() {
        axios
          .get(
            "/load-exclude-dates/" +
              this.form.site +
              "/" +
              this.form.offering_id
          )
          .then((response) => {
            this.excludeDays = response.data;
          })
         .catch((error) => console.error(error));
    },
    loadCopyData(id){
       this.copiedDataId = id;
    },
    loadExcludedDates(dates){
      this.excludedDates = dates;
    },
    loadOffrings(site,offering_id){
       axios
       .post("/get-offring", {
            site_id: site,
            user_id: this.$page.props.user.id,
            type : 'menu_planings,headcounts',
            is_headcount:true
        })
        .then((response) => {
          this.form.site = site;
          this.form.offering_id = offering_id;
          this.form.guide_line_id = this.guide_line_id;
          this.offrings = response.data;
          this.getGuidlineData(offering_id);
         
        })
        .catch((error) => console.error(error));
    },
		loadOffringsForGroup(site,guide_line_id){
       axios
       .post("/get-offring-for-group", {
            group_id: site,
        })
        .then((response) => {
          this.form.site = site;
          this.form.guide_line_id = guide_line_id;
          this.offrings = response.data;
          this.getGuidlineDataForGroup();
         
        })
        .catch((error) => console.error(error));
    },
    loadExcludedDateDataOnLoad(site,guide_line_id){
        axios
          .get(
            "/load-exclude-dates/" +
              site +
              "/" +
              guide_line_id
          )
          .then((response) => {
            this.excludeDays = response.data;
          })
         .catch((error) => console.error(error));
    },
    convertDataShowingCalendar(cal_weeks) {
      let $this = this;
      if (cal_weeks.length > 0) {
        cal_weeks.forEach((cal_week) => {
          $this.calenderdays.weeks[cal_week.week_number]["menuCycle"] =
            $this.$helpers.convertMenuCycleToShowingData(
              cal_week.menu_cycle,
              $this.calenderdays.weeks[cal_week.week_number]
            );
        });
      } 
    },
    emptyWeekCycles() {
      let $this = this;
      this.calenderdays.weeks.forEach((weeks, index) => {
        $this.calenderdays.weeks[index]["menuCycle"] = null;
      });
    },
    onGradeRangeChangeCalendarFilterMethod() {
      if (this.graderangeFilterVal == "") {
        this.$inertia.reload();
      } else {
        axios
          .post("/menu-cycle-get-meal-types", {
            grade_range: this.graderangeFilterVal,
          })
          .then((response) => {
            this.meal_types = response.data;
          })
          .catch((error) => console.error(error));
      }
    },
    getOffering(event){
       var options = event.target.options;
       var type = '';
        if (options.selectedIndex > -1) {
          type = options[options.selectedIndex].getAttribute('type');
        }
        this.form.type = type;

        if ('URLSearchParams' in window) {
          var searchParams = new URLSearchParams(window.location.search)
          searchParams.set("type", this.form.type);
          var newRelativePathQuery = window.location.pathname + '?' + searchParams.toString();
          history.pushState(null, '', newRelativePathQuery);
        }

      if(type === 'group'){
        axios
        .post("/get-offring-for-group", {
          group_id: event.target.value,
        })
        .then((response) => {
          this.form.site = event.target.value;
					this.form.group_id = event.target.value;
          this.offrings = response.data.offerings;
          this.getGuidlineDataForGroup();
        })
        .catch((error) => console.error(error));

      }
			if(type === 'site'){
        axios
        .post("/get-offring", {
          site_id: event.target.value,
          user_id: this.$page.props.user.id,
            type : 'menu_planings,headcounts',
            is_headcount:true
        })
        .then((response) => {
          this.form.site = event.target.value;
          this.offrings = response.data;
        })
        .catch((error) => console.error(error));
      }
     
    },
    getGuidline(event){
       axios
       .post("/get-guideline", {
            id: event.target.value,
        })
        .then((response) => {
          this.form.meal_type = response.data.meal_type_id;
          this.form.age_grade_offering = response.data.age_grade_id;
          this.form.day = response.data.days_id;
          this.form.month = this.form.month != '' ? this.form.month : this.currentMonth;
          this.form.year = this.form.year != '' ? this.form.year : this.currentYear;
          this.form.guide_line_id = response.data.id;
					this.form.offering_id = event.target.value; 
          this.loadExcludedDateData();
          this.loadCalendar();
        })
        .catch((error) => console.error(error));
    },
    getGuidlineData(guide_line_id){
			console.log('ewrq');
       axios
       .post("/get-guideline", {
            id: guide_line_id,
        })
        .then((response) => {
          this.form.meal_type = response.data.meal_type_id;
          this.form.age_grade_offering = response.data.age_grade_id;
          this.form.day = response.data.days_id;
          this.form.month = this.form.month != '' ? this.form.month : this.currentMonth;
          this.form.year = this.form.year != '' ? this.form.year : this.currentYear;
          this.form.offering_id = guide_line_id;
          this.form.guide_line_id = response.data.id;

          this.loadCalendar();
        })
        .catch((error) => console.error(error));
    },
		getGuidlineDataForGroup(){
      if(this.form.type === 'group'){
        this.form.group_id = this.form.site;
      }
      console.log('im in',this.form.type);
       axios
       .post("/get-guideline-for-group", {
            id: this.form.group_id,
        })
        .then((response) => {
          this.form.meal_type = response.data.meal_type_id;
          this.form.age_grade_offering = response.data.age_grade_id;
          this.form.day = response.data.days_id;
          this.form.month = this.form.month != '' ? this.form.month : this.currentMonth;
          this.form.year = this.form.year != '' ? this.form.year : this.currentYear;
          this.form.guide_line_id = response.data.id;
          this.loadCalendar();
        })
        .catch((error) => console.error(error));
    }
  },
};
</script>


<style>
.font-24 {
  font-size: 24px;
}

.color-24 {
  color: #636363;
}

.p-color {
  color: #969696;
}

.p-size {
  font-size: 15px;
}

.online-color {
  color: #22af4b;
}

.offline-color {
  color: #cb0000;
}

.number-background-color {
  background-color: #cb0000;
}

.online-background-color {
  background-color: #22af4b;
}

.offline-background-color {
  background-color: #cb0000;
}

.week-cycle-color {
  color: #38558e;
}

.week-cycle-fontsize {
  font-size: 14px;
}
.three-dot-color {
  color: #38558e;
}

.table-background {
  background-color: #f3f3f3;
}

.last-td-background {
  background-color: #f5f5f5;
}

.td-width {
  width: 14.28%;
  height: 170px;
  min-width: 170px;
}

.cart-color {
  color: #f7a53a;
}

.plus-font-size {
  font-size: 20px;
}
i.text-lg {
  font-size: 16px;
  line-height: inherit;
  vertical-align: top;
  position: relative;
  top: 1px;
}
.select-menu-height i,
.select-menu-height i:before {
  line-height: 0;
  display: inline-table;
}
</style>