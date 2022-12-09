<template>
  

  <jet-dialog-modal :show="openDaysModalVal" @close="openDaysModalVal = false">
        <template #title>            
            <div v-if="!editDays.length" class="flex justify-between items-center font-semibold">Add Days Offered</div>
            <div v-else class="flex justify-between items-center font-semibold">Edit Days Offered</div>
            <hr class="mt-5">
        </template>

        <template #content>
          <div class="w-full">
            <div class="xl:flex block xl:items-center pb-8">
              <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Name</label>
              <div>
                <input type="text" id="days_name" name="days_name" v-model="form.days_name"
                class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">
                <div v-if="form.errors.days_name" class="validation_error_msg w-60">
                {{ form.errors.days_name }}
                </div>
              </div>
            </div>
            <div class="grid md:grid-cols-7 grid-cols-3">
              <div>
                <label class="2xl:text-lg text-base flex justify-center items-center flex-col font-semibold cursor-pointer">
                  <input type="checkbox" class="mb-2" v-model="form.day_mon">
                  <span>MON</span>
                </label>
              </div>
              <label class="2xl:text-lg text-base flex justify-center items-center flex-col font-semibold cursor-pointer">
                <input type="checkbox" class="mb-2" v-model="form.day_tue">
                <span>TUE</span>
              </label>
              <label class="2xl:text-lg text-base flex justify-center items-center flex-col font-semibold cursor-pointer">
                <input type="checkbox" class="mb-2" v-model="form.day_wed">
                <span>WED</span>
              </label>
              <label class="2xl:text-lg text-base flex justify-center items-center flex-col font-semibold cursor-pointer">
                <input type="checkbox" class="mb-2" v-model="form.day_thu">
                <span>THU</span>
              </label>
              <label class="2xl:text-lg text-base flex justify-center items-center flex-col font-semibold cursor-pointer">
                <input type="checkbox" class="mb-2" v-model="form.day_fri">
                <span>FRI</span>
              </label>
              <label class="2xl:text-lg text-base flex justify-center items-center flex-col font-semibold cursor-pointer">
                <input type="checkbox" class="mb-2" v-model="form.day_sat">
                <span>SAT</span>
              </label>
              <label class="2xl:text-lg text-base flex justify-center items-center flex-col font-semibold cursor-pointer">
                <input type="checkbox" class="mb-2" v-model="form.day_sun">
                <span>SUN</span>
              </label>
              
              <div v-if="form.errors.days_check" class="validation_error_msg w-60">
                {{ form.errors.days_check }}
              </div>

            </div>
          </div>
        </template>

        <template #footer>
          <jet-secondary-button v-if="!editDays.length" @click="days_add_save_script">Save</jet-secondary-button>
          <jet-secondary-button v-else @click="days_edit_save_script">Update</jet-secondary-button>
          <jet-secondary-button @click="closeModalDays">Close</jet-secondary-button>
        </template>
    </jet-dialog-modal>



</template>

<script>
  import DefaultLayout from "@/Layouts/DefaultLayout";
  import Welcome from "@/Jetstream/Welcome";
  import JetSecondaryButton from '@/Jetstream/SecondaryButton';
  import JetDialogModal from '@/Jetstream/DialogModal';

  export default {
    props:['openDaysModal', 'editDays'],
    components: {
      DefaultLayout,
      Welcome,
      JetSecondaryButton,
      JetDialogModal,
    },

    data(){
      return { 
      
      openDaysModalVal:this.openDaysModal, 

      form: this.$inertia.form({
        days_name:'',
        day_mon:false,
        day_tue:false,
        day_wed:false,
        day_thu:false,
        day_fri:false,
        day_sat:false,
        day_sun:false,
        })

      }
    },

    mounted(){      
      if(this.editDays){
        this.form.days_name = this.editDays[0].name;
        this.form.day_mon = (this.editDays[0].mon == 1) ? true : false;
        this.form.day_tue = (this.editDays[0].tue == 1) ? true : false;
        this.form.day_wed = (this.editDays[0].wed == 1) ? true : false;
        this.form.day_thu = (this.editDays[0].thu == 1) ? true : false;
        this.form.day_fri = (this.editDays[0].fri == 1) ? true : false;
        this.form.day_sat = (this.editDays[0].sat == 1) ? true : false;
        this.form.day_sun = (this.editDays[0].sun == 1) ? true : false;
      }
    },

    methods:{


      closeModalDays: function(){       
      this.openDaysModalVal = false;
      this.$emit('closeModalDays');
      },


      days_add_save_script(){ 

        if(this.form.days_name != '' && this.form.day_mon == false && this.form.day_tue == false && this.form.day_wed == false && this.form.day_thu == false && this.form.day_fri == false && this.form.day_sat == false && this.form.day_sun == false ){
          this.form.errors.days_check = "Please check atleast one day!";
          return false;
        }

        this.form.post(this.route('add-days-save'), {
          onSuccess: () => {
            this.closeModalDays();
            this.$toast.success('Day offered created successfully!');
            setTimeout(function(){
              window.location.reload();
            }, 1000);
          },
        });
      }, 


      days_edit_save_script(){

        if(this.form.days_name != '' && this.form.day_mon == false && this.form.day_tue == false && this.form.day_wed == false && this.form.day_thu == false && this.form.day_fri == false && this.form.day_sat == false && this.form.day_sun == false ){
          this.form.errors.days_check = "Please check atleast one day!";
          return false;
        }

        this.form.post(this.route('edit-days-save',this.editDays[0].id), {
          onSuccess: () => {
            this.closeModalDays();
            this.$toast.success('Day offered updated successfully!');
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
