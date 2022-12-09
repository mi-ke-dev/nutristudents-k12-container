<template>    

    <jet-dialog-modal :show="openMealTypeModalVal" @close="openMealTypeModalVal = false">
        
        <template #title>
            <div v-if="!editMealType.length" class="flex justify-between items-center font-semibold">Add Meal Type</div>
            <div v-else class="flex justify-between items-center font-semibold">Edit Meal Type</div>
            <hr class="mt-5">
        </template>

        <template #content>
          <div class="w-full">
            <div class="xl:flex block xl:items-center py-5">
              <label class="font-bold text-gray-700 2xl:text-lg text-base w-full md:w-40">Name</label>
              <div>
                <input type="text" id="mealtype_name" name="mealtype_name" v-model="form.mealtype_name" class="2xl:text-base text-sm text-gray-400 xl:mt-0 mt-4 xl:w-80 w-60 shadow-sm focus:border-none block sm:text-sm border-gray-300  rounded-lg select-menu-height input-background">
                <div v-if="form.errors.mealtype_name" class="validation_error_msg w-60">
                {{ form.errors.mealtype_name }}
                </div>
              </div>
            </div>
          </div>
        </template>

      <template #footer>
        <jet-secondary-button v-if="!editMealType.length" @click="mealtype_add_save_script">Save</jet-secondary-button>
        <jet-secondary-button v-else @click="mealtype_edit_save_script">Update</jet-secondary-button>
        <jet-secondary-button @click="closeMealTypeModal">Close</jet-secondary-button>
      </template>

    </jet-dialog-modal>

</template>

<script>
  import DefaultLayout from "@/Layouts/DefaultLayout";
  import Welcome from "@/Jetstream/Welcome";  
  import JetSecondaryButton from '@/Jetstream/SecondaryButton';
  import JetDialogModal from '@/Jetstream/DialogModal';

  export default {
    props:['openMealTypeModal', 'editMealType'],
    components: {
      DefaultLayout,
      Welcome,
      JetSecondaryButton,
      JetDialogModal,
    },

    data(){
      return {       
      openMealTypeModalVal:this.openMealTypeModal,

      form: this.$inertia.form({
        mealtype_name:'',
      })

      }
    },

    mounted(){      
      if(this.editMealType){
        this.form.mealtype_name = this.editMealType[0].name;
      }
    },

    methods:{

      closeMealTypeModal: function(){       
      this.openMealTypeModalVal = false;
      this.$emit('closeModal');
      },


      mealtype_add_save_script(){      
        this.form.post(this.route('add-mealtype-save'), {
          onSuccess: () => {
            this.closeMealTypeModal();
            this.$toast.success('Mealtype created successfully!');
            setTimeout(function(){
              window.location.reload();
            }, 1000);
          },
        });
      }, 


      mealtype_edit_save_script(){             
        this.form.post(this.route('edit-mealtype-save',this.editMealType[0].id), {
          onSuccess: () => {
            this.closeMealTypeModal();
            this.$toast.success('Mealtype updated successfully!');
            setTimeout(function(){
              window.location.reload();
            }, 1000);
          },
        });
      },    


    },

  };
</script>
