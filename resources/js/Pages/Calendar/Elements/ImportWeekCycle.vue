<template>
  <div>
    <jet-dialog-modal :show="true">
      <template #title>
        <div class="flex justify-between items-center">
        <h2 class="sm:pt-4 pt-2 lg:text-2xl sm:text-lg text-sm">
          Import Week Cycle
        </h2>
        <jet-secondary-button @click="closeModel" class="cursor-pointer pt-4">Close</jet-secondary-button></div>
        <div class="flex flex-wrap justify-between items-center float-right">
          <div class="flex flex-wrap sm:py-4 pt-2">
            Filer By &nbsp;
            <div
              class="relative focus:outline-none w-56 mr-3 xl:mt-0 sm:mt-0 mt-4"
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
                v-model="user_id"
                @change="importWeekCycleFilterMethod"
              >
                <option value="">Select User</option>
                <option v-for="site in users" :value="site.id">
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
          
          </div>

          <!-- <div class="relative md:w-56">
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
                md:mt-0
                mt-4
              "
              @click="importWeekCycleFilterMethod"
            >
              Search
            </button>
          </div> -->
        </div>
      </template>

      <template #content>
        <TableIndexLayout>
          <div class="-my-2">
            <div class="py-2 align-middle inline-block w-full overflow-auto">
              <div class="shadow overflow-x-auto max-height h-screen-95">
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
                        NAME
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
                        User
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
                      >Action</th>
                    </tr>
                  </thead>
                  <tbody>

                    <tr class="bg-white" v-for="menuCylce in menuCylces">
                      <td
                        class="
                          px-6
                          py-4
                          whitespace-nowrap
                          text-base text-color 
                        "
                      >
                      <a :title="menuCylce.option_name" target="_blank" class="px-6 arrow-color font-bold text-lg text-decoration-line: underline" :href="route('menu-cycle-edit', menuCylce.id)">
                        {{ menuCylce.name }}</a>
                      </td>
                      <td
                        class="
                          px-6
                          py-4
                          whitespace-nowrap
                          text-base text-color 
                        "
                      >
                        {{ menuCylce.user.name }}
                      </td>
                      <td
                        
                      >
                        <button @click="importMenuCycle(menuCylce.id)" class="px-6 arrow-color font-bold text-lg text-decoration-line: underline">Import</button>
                      </td>
                    </tr>

                    <!-- Odd row -->
                    <tr v-if="menuCylces.length == 0" class="bg-white">
                      <td
                        class="
                          px-6
                          py-4
                          whitespace-nowrap
                          text-base text-color text-center
                        "
                        colspan="3"
                      >
                        No Week Cycle Found!
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
        <jet-secondary-button @click="closeModel" class="cursor-pointer">Close</jet-secondary-button>
      </template>
    </jet-dialog-modal>
  </div>
</template>

<script>
import vClickOutside from "click-outside-vue3";
import JetDialogModal from "@/Jetstream/DialogModal";

export default {
  directives: {
    clickOutside: vClickOutside.directive,
  },

  props: ["mealTypeImport", "graderangesImport", "daysImport", "weeks", "searchForm", "weekIndex", "users"],

  components: {
    vClickOutside,
    JetDialogModal,
  },

  data() {
    return {
      mealType: this.searchForm.meal_type,
      grageRange: this.searchForm.age_grade_offering,
      daysFilterVal: this.searchForm.day,
      menuCylces: [],
      menuCycle:'',
      user_id:''
    };
  },

  mounted(){
    this.importWeekCycleFilterMethod();
  },

  methods: {
    onClickOutside(event) {
      this.is_show = 0;
    },

    importWeekCycleFilterMethod() {
      console.log("importWeekCycleFilterMethod", this.mealType,this.grageRange,this.daysFilterVal);
      if (this.mealType == "" && this.grageRange == "" && this.daysFilterVal =="") {
        this.$toast.error("Select at least one fields");
      } else {
        console.log("importWeekCycleFilterMethod done");
        axios.post('/get-week-cycle-list',{meal:this.mealType,age_range:this.grageRange, days:this.daysFilterVal, user:this.user_id})
          .then((response)=>{
              this.menuCylces = response.data;
            })
          .catch(error => console.error(error));
      }
    },

    importMenuCycle(wcId){
      this.hideShowLoader('show');
      let $this = this;
      console.log("wcId", wcId);
      axios.post('/get-menu-cycle-calender/'+wcId, {is_create:true, form:this.searchForm, week_number:this.weekIndex})
          .then((response)=>{
               console.log("importMenuCycle", response.data);
              $this.menuCycle = $this.$helpers.convertMenuCycleToShowingData(response.data, this.weeks);
              console.log("importMenuCycle", this.menuCycle);
              $this.loadCalendar();
              setTimeout(() => {
                $this.loadMenuCycle();
              }, 1000);              
            })
          .catch(error => console.error(error));
    },
    closeModel(){
      console.log("closeModel");
      this.hideShowLoader('hide');
      this.$emit('closeModal');
    },
    loadMenuCycle(){
      this.$emit('loadMenuCycle', this.menuCycle);
      this.closeModel();
    },
    loadCalendar(){
      this.$emit('loadCalendar');
    },
    hideShowLoader(types){
      if(types == 'show'){
        document.getElementById('full_loader').style.display = 'flex';
      } else {
        document.getElementById('full_loader').style.display = 'none';
      }
    }
  },
};
</script>
<style>
.h-screen-95{
height: 95vh;
}
</style>