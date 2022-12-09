<template>
  <jet-dialog-modal :show="openAgeGradeModalVal" @close="openAgeGradeModalVal = false">
        <template #title>            
            <div v-if="!editAgeGrade.length" class="flex justify-between items-center font-semibold">Add Age/Grade Offering</div>
            <div v-else class="flex justify-between items-center font-semibold">Edit Age/Grade Offering</div>
            <hr class="mt-5">
        </template>

        <template #content>
          <div class="w-full">
            <div class="xl:flex block xl:items-center pb-5">
              <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Name</label>
              <div>
                <input type="text" id="agegrade_name" name="agegrade_name" v-model="form.agegrade_name"
                class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">
                <div v-if="form.errors.agegrade_name" class="validation_error_msg w-60">
                {{ form.errors.agegrade_name }}
                </div>
              </div>
            </div>
            <div class="xl:flex block xl:items-center pb-5">
              <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Type</label>
              <div>
              <div class="flex items-center pl-0 xl:w-40 w-72 xl:mt-0 mt-4 2xl:text-lg text-xs text-gray-400 relative">                
                <select id="agegrade_type" name="agegrade_type" v-model="form.agegrade_type" autocomplete="" class="sm:text-sm text-xs shadow-sm focus:border-color block border-gray-300 rounded-lg w-full select-menu-height-edit2 input-background text-gray-500">
                  <option value="Age">Age</option>
                  <option value="Grade">Grade</option>                  
                </select>
                <div class="absolute flex justify-center items-center searching-background-color select-menu-height-edit2 w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>                
              </div>
              <div v-if="form.errors.agegrade_type" class="validation_error_msg w-60">
                {{ form.errors.agegrade_type }}
                </div>
            </div>
          </div>
            <div v-if="form.agegrade_type == 'Grade'" class="xl:flex block xl:items-center pb-5">
              <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Starting</label>
              <div>
              <div class="flex items-center pl-0 xl:w-40 w-72 xl:mt-0 mt-4 2xl:text-lg text-xs text-gray-400 relative">                
                <select id="grade_starting" name="grade_starting" v-model="form.grade_starting" autocomplete="" class="sm:text-sm text-xs shadow-sm focus:border-color block border-gray-300 rounded-lg w-full select-menu-height-edit2 input-background text-gray-500" @change="gradeChangeStarting">
                  <option value="K">K</option>
                  <option v-for="grade_start_val in grade_starting_values" :value="grade_start_val">{{grade_start_val}}</option>
                </select>
                <div class="absolute flex justify-center items-center searching-background-color select-menu-height-edit2 w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>     
              </div>
              <div v-if="form.errors.grade_starting" class="validation_error_msg w-60">{{ form.errors.grade_starting }}</div>
              </div>
            </div>
            <div v-if="form.agegrade_type == 'Grade' && form.grade_starting != ''" class="xl:flex block xl:items-center pb-5">
              <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Ending</label>
              <div>
              <div class="flex items-center pl-0 xl:w-40 w-72 xl:mt-0 mt-4 2xl:text-lg text-xs text-gray-400 relative">                
                <select id="grade_ending" name="grade_ending" v-model="form.grade_ending" autocomplete="" class="sm:text-sm text-xs shadow-sm focus:border-color block border-gray-300 rounded-lg w-full select-menu-height-edit2 input-background text-gray-500">                  
                  <option v-for="grade_end_val in grade_ending_values" :value="grade_end_val">{{grade_end_val}}</option>
                </select>
                <div class="absolute flex justify-center items-center searching-background-color select-menu-height-edit2 w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none"><i class="fa fa-sort-desc" aria-hidden="true"></i></div>                
              </div>
              <div v-if="form.errors.grade_ending" class="validation_error_msg w-60">
                {{ form.errors.grade_ending }}
              </div>
              </div>
            </div>
            <div v-if="form.agegrade_type == 'Age'" class="xl:flex block xl:items-center pb-5">
              <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Starting</label>
              <div>
                <input type="text" id="age_starting" name="age_starting" v-model="form.age_starting" class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 xl:w-40 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">
                <div v-if="form.errors.age_starting" class="validation_error_msg w-60">
                {{ form.errors.age_starting }}
              </div>
              </div>
            </div>
            <div v-if="form.agegrade_type == 'Age'" class="xl:flex block xl:items-center pb-5">
              <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Ending</label>
              <div>
                <input type="text" id="age_ending" name="age_ending" v-model="form.age_ending" class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 xl:w-40 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">
                <div v-if="form.errors.age_ending" class="validation_error_msg w-60">
                {{ form.errors.age_ending }}
                </div>
              </div>
            </div>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button v-if="!editAgeGrade.length" @click="agegrade_add_save_script">Save</jet-secondary-button>
          <jet-secondary-button v-else @click="agegrade_edit_save_script">Update</jet-secondary-button>
          <jet-secondary-button @click="closeAgeGradeModal">Close</jet-secondary-button>
        </template>
    </jet-dialog-modal>



</template>

<script>
  import DefaultLayout from "@/Layouts/DefaultLayout";
  import Welcome from "@/Jetstream/Welcome";  
  import JetSecondaryButton from '@/Jetstream/SecondaryButton';
  import JetDialogModal from '@/Jetstream/DialogModal';

  export default {
    props:['openAgeGradeModal', 'editAgeGrade'],
    components: {
      DefaultLayout,
      Welcome,
      JetSecondaryButton,
      JetDialogModal,
    },

    data(){
      return { 
      
      openAgeGradeModalVal:this.openAgeGradeModal, 
      grade_starting_values:[1,2,3,4,5,6,7,8,9,10,11],
      grade_ending_values:[1,2,3,4,5,6,7,8,9,10,11,12],

      form: this.$inertia.form({
        agegrade_name:'',
        agegrade_type:'',
        grade_starting:'',
        grade_ending:'',
        age_starting:'',
        age_ending:'',
        })

      }
    },

    mounted(){      
      if(this.editAgeGrade){
        this.form.agegrade_name = this.editAgeGrade[0].name;
        this.form.agegrade_type = this.editAgeGrade[0].type;
        if(this.form.agegrade_type == "Grade"){
          this.form.grade_starting = this.editAgeGrade[0].starting;
          this.form.grade_ending = this.editAgeGrade[0].ending;

          this.grade_ending_values = [];
          for(var i = parseInt(this.form.grade_starting); i < 12; i++){
             this.grade_ending_values.push(i + 1);
          }
        }
        if(this.form.agegrade_type == "Age"){
          this.form.age_starting = this.editAgeGrade[0].starting;
          this.form.age_ending = this.editAgeGrade[0].ending;
        }        
      }
    },

    methods:{

      gradeChangeStarting(e){
        if(e.target.value > 0){
          this.grade_ending_values = [];
          for(var i = parseInt(e.target.value); i < 12; i++){
             this.grade_ending_values.push(i + 1);
          }
        }else{
          this.grade_ending_values = [1,2,3,4,5,6,7,8,9,10,11,12];
        }
      },

      closeAgeGradeModal: function(){       
      this.openAgeGradeModalVal = false;
      this.$emit('closeModalAG');
      },


      agegrade_add_save_script(){ 

        if(parseInt(this.form.age_starting) >= parseInt(this.form.age_ending) && parseInt(this.form.age_ending) > 1 && parseInt(this.form.age_ending) < 100){
          this.form.errors.age_ending = "Value must be greater than age starting!";
          return false;
        }

        this.form.post(this.route('add-agegrade-offering-save'), {
          onSuccess: () => {
            this.closeAgeGradeModal();
            this.$toast.success('Age/Grade offering created successfully!');
            setTimeout(function(){
              window.location.reload();
            }, 1000);
          },
        });
      }, 


      agegrade_edit_save_script(){

        if(parseInt(this.form.age_starting) >= parseInt(this.form.age_ending) && parseInt(this.form.age_ending) > 1 && parseInt(this.form.age_ending) < 100){
          this.form.errors.age_ending = "Value must be greater than age starting!";
          return false;
        }

        this.form.post(this.route('edit-agegrade-offering-save',this.editAgeGrade[0].id), {
          onSuccess: () => {
            this.closeAgeGradeModal();
            this.$toast.success('Age/Grade offering updated successfully!');
            setTimeout(function(){
              window.location.reload();
            }, 1000);
          },
        });
      },    


    },

  };
</script>
<style>
.min-height-third{
 min-height: 400px; 
}

.sm\:text-sm {
  font-size: 0.850rem;
  line-height: 1.25rem;
}

.w-52-rec {
  width: 13.2rem;
}

.input-background{
  background-color: #f8f8f8;
}

.button-bg-color-wed-menu2-gray{
  border: none!important;
  min-height: 35px;
  min-width: 35px;
}

.menu1-background-color{
  background-color:#FAA43D;
}

.button-bg-color-wed-menu2{
  background-color: #38558e;
  border: none!important;
  min-height: 35px;
  min-width: 35px;
}
.menu1-icon-color{
  color: #38558e;
}

.id-color-menu-edit{
  color: #F7A53A;
}

.bg-button-color{
  background-color: #cb0000;
}

.min-w-min-button{
  min-height: 26px;
  min-width: 53px;

}

.w-150{
  width: 150px;
}

.max-w-0-menu1{
  max-width: 4rem;
}

.bg-button-color-green{
 background-color: #22af4b;
}

.bg-button-color-gray{
  background-color: #636363;
}
.bg-hard-grey{
  background-color: #f4f4f4;
}

.font-size-edit {
  font-size: 10.5px;
}
.w-96-edit-recipes{
  width: 35rem;
}

.select-menu-height-edit2 {
  height: 2.8rem;
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
    padding-left:7px;
    color: #219FD5;
  }

  .id_arrow .fa-sort-asc:before {
    content: "\f0de";
    color: #219FD5;
    padding-left:7px;
    position: absolute;
    top: 16px;
    left: 43px;
  }
}

@media screen and (max-width: 1499px){
  .id_arrow .fa-sort-asc:before {
    content: "\f0de";
    color: #219FD5;
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
    color: #219FD5;
  }



}

</style>
