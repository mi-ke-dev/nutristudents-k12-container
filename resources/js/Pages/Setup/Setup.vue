<template>
  
  <Head>
  <title>Setup - MealType & Age/Grade & Days | NutriStudents K-12</title>
  <meta name="description" content="Setup - MealType, Age/Grade, Days">
  </Head>

  <default-layout>
    <BreadcrumLayout>
      <!-- <a href="#" class="link-color"> --><U>Settings</U><!-- </a> -->
    </BreadcrumLayout>
    <PageTitleLayout>
      <div class="lg:mb-0 mb-4">
        <h1 class="heading-color xl:text-4xl text-2xl font-bold">Setup</h1>
      </div>
      <div class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center">

        <button @click="addMealTypeModalOpen" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 mt-10">          
          ADD MEALTYPE          
        </button>
            
        <button @click="addAgeGradeModalOpen" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 mt-10">          
          ADD AGE/GRADE OFFERING
        </button>
      
        <button @click="addDaysModalOpen" class="button-color text-white font-bold py-3 xl:px-4 px-2 lg:ml-6 sm:ml-6 ml-6 rounded lg:mt-0 sm:mt-0 mt-10">          
          ADD DAYS OFFERED
        </button>

      </div>
    </PageTitleLayout>

    <!-- <TableFilterLayout @messageFromChild="siteSearchData" /> -->

    <TableIndexLayout>
      <div class="">
        <div class="searching xl:px-10 px-5 md:pt-10 pt-8 w-full">
          <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
            <div class="text-lg text-white">
              Meals Offered
            </div>
            <a href="#" @click="addMealTypeModalOpen">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-6 text-white" viewBox="0 0 24 24" stroke="currentColor" fill="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
            </a>
          </header>
        </div>
        <div class="-my-2">
          <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
            <div class="shadow overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="header-bg-color">
                  <tr>
                    <th scope="col" colspan="2" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                      MEAL TYPE
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                 <tr v-if="!mealTypes.length" class="bg-white">
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Meal Types Found</td>
                 </tr>

                  <tr v-for="(mealtype,index) in mealTypes" class="bg-white">
                    <td class="px-6 py-4 whitespace-nowrap text-base font-bold text-blue-400">{{mealtype.name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-400 text-xl font-extrabold">
                      <div class="flex items-center w-full justify-end">
                        <a href="#" @click="mealtype_edit_script(mealtype.id)">
                        <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>  
                        </a>
                        <button type="button" @click="mealtype_delete_script(mealtype.id)">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>

                      </div>
                    </td>
                  </tr>                           


                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="">
        <div class="searching xl:px-10 px-5 md:pt-10 pt-8 w-full">
          <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
            <div class="text-lg text-white">
              Age/Grade Offering
            </div>
            <a href="#" @click="addAgeGradeModalOpen">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-6 text-white" viewBox="0 0 24 24" stroke="currentColor" fill="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
            </a>
          </header>
        </div>
        <div class="-my-2">
          <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
            <div class="shadow overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="header-bg-color">
                  <tr>
                    <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                      Name
                    </th>
                    <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                      Starting
                    </th>
                    <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                      End
                    </th>
                    <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                      &nbsp;
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">

                  <tr v-if="!ageGrades.length" class="bg-white">
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Age/Grade Offering Found</td>
                  </tr>

                  <tr v-for="(agegrade,index) in ageGrades" class="bg-white">
                    <td class="px-6 py-4 whitespace-nowrap text-base font-bold text-blue-400">{{agegrade.name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-base font-bold">{{agegrade.starting}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-base font-bold">{{agegrade.ending}}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-400 text-xl font-extrabold">
                      <div class="flex items-center w-full justify-end">
                        <a href="#" @click="agegrade_edit_script(agegrade.id)" class="inline-block mr-5">
                          <i class="fa fa-pencil-square-o pr-3" aria-hidden="true"></i>
                        </a>
                        <button type="button" @click="agegrade_delete_script(agegrade.id)">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>                        
                      </div>
                    </td>
                  </tr>                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="mb-10">
        <div class="searching xl:px-10 px-5 md:pt-10 pt-8 w-full">
          <header class="searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg">
            <div class="text-lg text-white">
              Days Offered
            </div>
            <a href="#" @click="addDaysModalOpen">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-6 text-white" viewBox="0 0 24 24" stroke="currentColor" fill="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
            </a>
          </header>
        </div>
        <div class="-my-2">
          <div class="py-2 align-middle inline-block xl:px-10 px-5 w-full">
            <div class="shadow overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="header-bg-color">
                  <tr>
                    <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                      Name
                    </th>
                    <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                      Days
                    </th>
                    <th scope="col" class="id_arrow px-6 py-3 text-left text-base font-bold text-black-800 uppercase tracking-wider relative">
                      &nbsp;
                    </th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                  
                  <tr v-if="!Days.length" class="bg-white">
                  <td class="px-6 py-4 whitespace-nowrap text-base text-color text-center" colspan="7">No Days Found</td>
                  </tr>

                  <tr v-for="(day, index) in Days" class="bg-white">
                    <td class="px-6 py-4 whitespace-nowrap text-base font-bold text-blue-400">{{day.name}}</td>
                    
                    <td>
                    <div class="flex">
                    <div v-if="day.mon" class="px-6 py-4 whitespace-nowrap text-base font-bold">MON</div>
                    <div v-if="day.tue" class="px-6 py-4 whitespace-nowrap text-base font-bold">TUE</div>
                    <div v-if="day.wed" class="px-6 py-4 whitespace-nowrap text-base font-bold">WED</div>
                    <div v-if="day.thu" class="px-6 py-4 whitespace-nowrap text-base font-bold">THU</div>
                    <div v-if="day.fri" class="px-6 py-4 whitespace-nowrap text-base font-bold">FRI</div>
                    <div v-if="day.sat" class="px-6 py-4 whitespace-nowrap text-base font-bold">SAT</div>
                    <div v-if="day.sun" class="px-6 py-4 whitespace-nowrap text-base font-bold">SUN</div>
                    </div>
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap text-gray-400 text-xl font-extrabold">
                      <div class="flex items-center w-full justify-end">
                        
                        <a href="#" @click="days_edit_script(day.id)" class="inline-block mr-5"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

                        <button type="button" @click="days_delete_script(day.id)">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>

                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      
    </TableIndexLayout>
  </default-layout>  


  <MealTypeModal v-if="openMealTypeModal" :openMealTypeModal="openMealTypeModal" :editMealType="editMealType" @closeModal="closeModalMealType"/>

  <AgeGradeModal v-if="openAgeGradeModal" :openAgeGradeModal="openAgeGradeModal" :editAgeGrade="editAgeGrade" @closeModalAG="closeModalAgeGrade"/>

  <DaysModal v-if="openDaysModal" :openDaysModal="openDaysModal" :editDays="editDays" @closeModalDays="closeModalDayss"/>  

</template>
<script>
import DefaultLayout from "@/Layouts/DefaultLayout";
import Welcome from "@/Jetstream/Welcome";
import BreadcrumLayout from "@/Pages/Common/Breadcrumbs";
import PageTitleLayout from "@/Pages/Common/PageTitle";
import TableFilterLayout from "@/Pages/Common/TableFilters";
import TableIndexLayout from "@/Pages/Common/TableIndex";

import MealTypeModal from "@/Pages/Setup/MealType";
import AgeGradeModal from "@/Pages/Setup/AgeGrade";
import DaysModal from "@/Pages/Setup/Days";

export default {
  props:['mealtypes','agegrades','days'],
  components: {
    DefaultLayout,
    Welcome,
    BreadcrumLayout,
    PageTitleLayout,
    TableFilterLayout,
    TableIndexLayout,
    MealTypeModal,
    AgeGradeModal,
    DaysModal
  },
  data(){
    return {
      mealTypes:this.mealtypes,
      ageGrades:this.agegrades,
      Days:this.days,

      openMealTypeModal:false,
      openAgeGradeModal:false,
      openDaysModal:false,

      editMealType:'',
      editAgeGrade:'',
      editDays:'',

      form: this.$inertia.form({

      })
    }
  },
  methods:{   

  addMealTypeModalOpen() {
    this.openMealTypeModal = true;
  },
  closeModalMealType() {
    this.openMealTypeModal = false;
  },

  mealtype_edit_script(mtid){    
    axios.post('/edit-mealtype',{id:mtid})
        .then((response)=>{
        this.editMealType = response.data;        
        this.openMealTypeModal = true;
        }).catch(error => console.error(error));
  },

  mealtype_delete_script(mtid){
    if(confirm("Are you sure you want to delete this meal type?")){
          this.form.post(this.route('delete-mealtype', mtid), {
                onSuccess: () => {
                  this.$toast.success('Meal Type deleted successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
          });
    }
  },

  addAgeGradeModalOpen() {
    this.openAgeGradeModal = true;
  },
  closeModalAgeGrade() {
    this.openAgeGradeModal = false;
  },
  agegrade_edit_script(agid){    
    axios.post('/edit-agegrade-offering',{id:agid})
        .then((response)=>{
        this.editAgeGrade = response.data;        
        this.openAgeGradeModal = true;
        }).catch(error => console.error(error));
  },

  agegrade_delete_script(agid){
    if(confirm("Are you sure you want to delete this age/grade offering?")){
          this.form.post(this.route('delete-agegrade-offering', agid), {
                onSuccess: () => {
                  this.$toast.success('Age/Grade offering deleted successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
          });
    }
  },

  
  addDaysModalOpen() {
    this.openDaysModal = true;
  },
  closeModalDayss() {
    this.openDaysModal = false;
  },             
  days_edit_script(did){    
    axios.post('/edit-days',{id:did})
        .then((response)=>{
        this.editDays = response.data;        
        this.openDaysModal = true;
        }).catch(error => console.error(error));
  },

  days_delete_script(did){
    if(confirm("Are you sure you want to delete this day?")){
          this.form.post(this.route('delete-days', did), {
                onSuccess: () => {
                  this.$toast.success('Day offered deleted successfully!');
                  setTimeout(function(){
                    window.location.reload();
                  }, 1000);
                }
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
.select-menu-height-edit2 {
    height: 2.8rem;
}

.validation_error_msg {
    font-weight: 400;
    margin: 6px 0 0 !important;
    color: red;
}

td.text-gray-400 {
    color: #0092d0;
}
</style>
