<template>
  <Head>
    <title>Add New Recipe | NutriStudents K-12</title>
    <meta name="description" content="Add New Recipe" />
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <div class="flex">
        <!-- <a href="#" class="link-color"> --><U>Templates</U
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
        <inertia-link :href="route('recipes')" class="link-color"
          ><U>Recipes</U></inertia-link
        >
      </div>
    </BreadcrumLayout>

    <form action="#" enctype="multipart/form-data">
      <PageTitleLayout>
        <div class="lg:mb-0 mb-4 w-6/12">
          <h1 class="heading-color xl:text-4xl sm:text-2xl text-base font-bold">
            Add New Recipe
          </h1>
        </div>
        <div
          class="w-full flex lg:flex-nowrap flex-wrap justify-end items-center"
        >
          <button
            type="button"
            
          >
            <inertia-link :href="route('recipes')" class="
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
              >Cancel</inertia-link
            >
          </button>

          <button
            type="button"
            @click="recipe_add_save_script"
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
              <label class="font-bold text-gray-700">Recipe Name*</label>
              <div>
                <input
                  type="text"
                  placeholder="Name"
                  id="recipe_name"
                  name="recipe_name"
                  v-model="form.recipe_name"
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
                  v-if="form.errors.recipe_name"
                  class="validation_error_msg w-60"
                >
                  {{ form.errors.recipe_name }}
                </div>
              </div>
            </div>


              <div
              class="xl:grid xl:gap-1 xl:grid-cols-3 block pl-5 items-center pt-6"
            >
              <label class="font-bold text-gray-700">Simplified Name</label>
              <div>
                <input
                  type="text"
                  placeholder="Simplified Name"
                  id="simplified_name"
                  name="simplified_name"
                  v-model="form.simplified_name"
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
                  v-if="form.errors.simplified_name"
                  class="validation_error_msg w-60"
                >
                  {{ form.errors.simplified_name }}
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
              <label class="font-bold text-gray-700">Category*</label>
              <div class="relative pl-0 sm:w-64 w-48 lg:top-0 xl:mt-0 mt-4">
                <select
                  id="recipe_category"
                  name="recipe_category"
                  v-model="form.recipe_category"
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
                    v-for="(category, index) in categories"
                    :value="index"
                  >
                    {{ category }}
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
              <label class="font-bold text-gray-700">Recipe Portion*</label>
              <div>
                <input
                  type="number"
                  id="recipe_portion"
                  min="0"
                  name="recipe_portion"
                  v-model="form.recipe_portion"
                  class="
                    xl:mt-0
                    mt-4
                    w-24
                    mr-
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
                  v-if="form.errors.recipe_portion"
                  class="validation_error_msg w-72"
                >
                  {{ form.errors.recipe_portion }}
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
              <label class="font-bold text-gray-700">Serving Size</label>
              <input
                type="number"
                id="recipe_serving"
                min="0"
                step="any"
                name="recipe_serving"
                v-model="form.recipe_serving"
                class="
                  xl:mt-0
                  mt-4
                  w-24
                  mr-
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
              <div class="relative focus:outline-none W-48">
                <select
                  id="recipe_serving_unit"
                  autocomplete=""
                  v-model="form.recipe_serving_unit"
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
                  <option value="">Select</option>
                  <optgroup label="Weight">
                    <option
                      v-for="mass_measurement in mass_measurements"
                      :value="mass_measurement.id"
                    >
                      {{ mass_measurement.name }}
                    </option>
                  </optgroup>
                  <optgroup label="Volume">
                    <option
                      v-for="volume_measurement in volume_measurements"
                      :value="volume_measurement.id"
                    >
                      {{ volume_measurement.name }}
                    </option>
                  </optgroup>
                  <optgroup label="Unit">
                    <option
                      v-for="unit_measurement in unit_measurements"
                      :value="unit_measurement.id"
                    >
                      {{ unit_measurement.name }}
                    </option>
                  </optgroup>
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

            <div class="xl:grid xl:gap-1 xl:grid-cols-3 block pl-5 pt-6">
              <label class="font-bold text-gray-700">Recipe Image</label>
              <div>
                <input
                  accept="image/*"
                  type="file"
                  id="recipe_image"
                  name="recipe_image"
                  class="
                    xl:mt-0
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
                    input-background
                  "
                  v-on:change="onRecipeImageChange"
                />

                <div v-if="recipeimage" class="relative w-20 mt-2">
                  <img
                    :src="recipeimage"
                    class="xl:mt-0 mt-4"
                    width="100"
                    height="100"
                  />
                  <i
                    class="fa fa-times absolute top-0 right-0"
                    aria-hidden="true"
                    @click="removeRecipeImage"
                  ></i>
                </div>
                <div
                  v-if="form.errors.recipe_image"
                  class="validation_error_msg"
                >
                  {{ form.errors.recipe_image }}
                </div>
                <div class="loader-15" v-if="uploadProgress"></div>
              </div>
            </div>
            <div class="xl:grid xl:gap-1 xl:grid-cols-3 block pl-5 pt-6 items-center">
                            <label class="font-bold text-gray-700">Favorite</label>
                            <div>
                            <input type="checkbox" id="recipe_portion" name="recipe_portion" v-model="form.is_favorite"
                                  >
                            </div> 
                        </div>
          </div>

          <div class="sm:w-6/12 w-full">
            <div class="flex justify-between items-center pl-5">
              <label class="font-bold text-gray-700"
                >Cooking Instructions*</label
              >
            </div>
            <div>
              <div class="border-gray-300 bg-gray-100 mt-2 ml-4 mr-4">
                <textarea
                  id="recipe_instructions"
                  name="recipe_instructions"
                  v-model="form.recipe_instructions"
                  style="display: none"
                ></textarea>
                <quill-editor
                  theme="snow"
                  :modules="modules" 
                  toolbar="minimal"
                  style="height: 250px"
                  id="quill_editor_instructions"
                ></quill-editor>
              </div>
              <div
                v-if="form.errors.recipe_instructions"
                class="validation_error_msg pl-4"
              >
                {{ form.errors.recipe_instructions }}
              </div>
            </div>

            <div class="w-96-edit-recipes flex justify-start pl-4 pt-4">
              <!-- <div class="flex justify-between items-center pr-5">
                                <label class="font-bold text-gray-700">HACCP</label>
                            </div>  -->

              <div class="relative focus:outline-none xl:w-40 w-72 mr-3">
                <select
                  id="recipe_haccp_type"
                  name="recipe_haccp_type"
                  autocomplete="recipe_haccp_type"
                  v-model="form.recipe_haccp_type"
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
                  @change="getHaccpNames($event)"
                >
                  <option value="">HACCP Type</option>
                  <option
                    v-for="haccp_type in haccp_types"
                    :value="haccp_type.type"
                  >
                    {{ haccp_type.type }}
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
              <div class="relative focus:outline-none xl:w-40 w-72 mr-3">
                <select
                  id="recipe_haccp_name"
                  name="recipe_haccp_name"
                  autocomplete="recipe_haccp_name"
                  v-model="form.recipe_haccp_id"
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
                  <option value="">Name of Rule</option>
                  <option
                    v-for="haccp_name in haccp_names"
                    :value="haccp_name.id"
                  >
                    {{ haccp_name.name }}
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
                  w-42
                  inline-flex
                  justify-center
                  items-center
                  rounded-md
                  font-bold
                  px-4
                  py-2
                  uppercase
                  menu1-background-color
                  text-white
                  focus:outline-none
                  mr-3
                "
                @click="updateHaccpDataIntoCookingInstructions"
              >
                ADD HACCP
              </button>
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
        <h2 class="text-white text-lg font-bold w-11/12">Ingredients</h2>

        <a href="#" @click="addIngredientRecipeModalOpen">
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
                      INGREDIENT
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
                      RECIPE AMOUNT*
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
                      SERVING AMOUNT*
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
                      MMA
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
                      WGR
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
                      FRU
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
                      MLK
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
                      VEG
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
                      DG
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
                      R/O
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
                      LEG
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
                      STAR
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
                      OTHER
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
                  <!-- Odd row -->

                  <tr v-if="!rec_ingredients.length" class="bg-white">
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-base text-color text-center
                      "
                      colspan="15"
                    >
                      No Attached Ingredients Found!
                    </td>
                  </tr>

                  <recipe-ingredients
                    v-if="rec_ingredients.length"
                    v-for="(rec_ingredient, index) in rec_ingredients"
                    :recipe_portion="this.form.recipe_portion"
                    :ingredient="rec_ingredient"
                    :key="rec_ingredient.id"
                    :recipe="recipe"
                    @onIngredientDelete="
                      addIngredientsDeleteScript(rec_ingredient.id, index)
                    "
                    @getDataRecipeIngredient="
                      getDataRecipeIngredient(index, $event)
                    "
                    @updateOptionalComponentsParent="
                      updateOptionalComponentsParent(index, $event)
                    "
                  />
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <header
        class="
          searching-background-color
          flex
          justify-between
          items-center
          py-2
          pl-6
          shadow
          overflow-hidden
          rounded-t-lg
          mx-8
          mt-8
        "
      >
        <h2 class="text-white text-lg font-bold w-11/12">Calculated Totals</h2>
        <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white  font-bold" viewBox="0 0 20 20" fill="currentColor">
               <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
             </svg> -->
        <!-- <svg
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
                            d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"
                          />
                        </svg> -->
      </header>

      <div class="flex flex-col mb-6 mx-6">
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
              <calculated-totals-component
                :sum_products_totals="calculated_totals_sum"
              />
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
          
        >
          <inertia-link :href="route('recipes')" class="
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
          ">Cancel</inertia-link>
        </button>

        <button
          type="button"
          @click="recipe_add_save_script"
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
    :show="addIngredientsModal"
    @close="addIngredientsModal = false"
  >
    <template #title>
      <div class="flex justify-between items-center">
        Search ingredients to Add/Attach with recipe
        <div class="relative md:w-56">
          <input
            class="
              border-2 border-gray-300
              bg-white
              h-10
              px-3
              pr-10
              rounded-lg
              text-sm
              focus:outline-none
              w-full
            "
            type="search"
            name="search_term"
            placeholder="Search"
            v-model="search_term"
            @keyup.enter="ingredientSearchScriptModal"
          />
          <button
            type="button"
            class="absolute right-0 top-0 mt-2 mr-4 outline-none"
            @click="ingredientSearchScriptModal"
          >
            <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </div>
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
                      INGREDIENT NAME
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
                  <!-- Odd row -->
                  <tr v-if="!searched_ingredients.length" class="bg-white">
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-base text-color text-center
                      "
                      colspan="7"
                    >
                      No Ingredient Found
                    </td>
                  </tr>

                  <tr
                    v-for="(ingredient, index) in searched_ingredients"
                    :class="{
                      'bg-white': index % 2 == 0,
                      'tr-background-color': index % 2 != 0,
                    }"
                    class="cursor-pointer"
                    @click="addIngredientAddScript(ingredient, index)"
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
                      <div class="tooltip">
                        <div class="trim_text">{{ ingredient.name }}</div>
                        <div class="top">
                          {{ ingredient.name }}
                          <i></i>
                        </div>
                      </div>
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
                    >
                      <a
                        :href="route('ingredients-edit', { id: ingredient.id })"
                        class=""
                        target="_blank"
                        ><i
                          class="fa fa-external-link pr-3"
                          aria-hidden="true"
                        ></i
                      ></a>

                      <button type="button">
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
      <jet-secondary-button @click="addIngredientsModal = false"
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

import RecipeIngredients from "@/Pages/Recipes/RecipeIngredients";
import CalculatedTotalsComponent from "@/Pages/Recipes/Partials/CalculatedTotalsComponent";

import HtmlEditButton from 'quill-html-edit-button'

export default {
  props: [
    "haccp_types",
    "mass_measurements",
    "volume_measurements",
    "unit_measurements",
    "categories",
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
    RecipeIngredients,
    CalculatedTotalsComponent,

    
  },

  setup: () => {
    const modules = {
      name: 'htmlEditButton',  
      module: HtmlEditButton, 
      options: {/* options */}
    }
    return { modules }
  },

  data() {
    return {
      rec_ingredients: [],
      ing_prefer_products: [],
      calculated_totals_sum: [],
      recipe: {is_tenant_admin:true},

      addIngredientsModal: false,
      recipeimage: "",
      search_term: "",
      searched_ingredients: "",
      haccp_names: "",
      haccp_description: "",
      uploadProgress: false,

      form: this.$inertia.form({
        recipe_name: "",
        recipe_category: "",
        recipe_portion: "",
        recipe_serving: "",
        recipe_serving_unit: "",
        recipe_image: "",
        recipe_instructions: "",
        recipe_haccp_type: "",
        recipe_haccp_id: "",
        attached_ingredients: [],
        is_favorite: false,
        simplified_name:null
      }),
    };
  },

  methods: {
    changeComponentVals(update_prefer_prod) {
      //console.log(update_prefer_prod);
      this.calculated_totals_sum =
        this.$helpers.preferProductsCalculatedTotals(update_prefer_prod);
    },

    updateOptionalComponentsParent(index, event) {
      //console.log(event);

      // if(this.ing_prefer_prod_optional.length > 0){
      // this.ing_prefer_prod_optional[index] = JSON.parse(JSON.stringify(this.rec_ingredients[index]));
      // }else{
      // this.ing_prefer_prod_optional = JSON.parse(JSON.stringify(this.rec_ingredients));
      // }

      //console.log(this.rec_ingredients);

      if (event != undefined) {
        let event_val = event[0];
        let optional_type = "optional_" + event_val["type"];
        let type = event_val["type"];

        if (!isNaN(event_val["value"]) && isFinite(event_val["value"])) {
          this.rec_ingredients[index][optional_type] = event_val["value"];
        } else {
          this.rec_ingredients[index][optional_type] =
            this.rec_ingredients[index][type];
        }
      } else {
        //console.log(this.rec_ingredients);

        this.rec_ingredients[index]["optional_component_mma"] = null;
        this.rec_ingredients[index]["optional_component_wgr"] = null;
        this.rec_ingredients[index]["optional_component_fru"] = null;
        this.rec_ingredients[index]["optional_component_mlk"] = null;
        this.rec_ingredients[index]["optional_component_veg"] = null;
        this.rec_ingredients[index]["optional_component_dg"] = null;
        this.rec_ingredients[index]["optional_component_ro"] = null;
        this.rec_ingredients[index]["optional_component_leg"] = null;
        this.rec_ingredients[index]["optional_component_star"] = null;
        this.rec_ingredients[index]["optional_component_other"] = null;
      }

      this.changeComponentVals(this.rec_ingredients);
      //console.log(this.rec_ingredients);
    },

    onRecipeImageChange(e) {
      let img_file = e.target.files || e.dataTransfer.files;
      if (!img_file.length) {
        return;
      } else {
        let sizes = Math.round(img_file[0].size / 1024);
        if (sizes <= 4096) {
          // this.$toast.error("This is righht image");
          // this.form.recipe_image = e.target.files[0];

          this.uploadProgress = true;
          let $this = this;
          
          Vapor.store(e.target.files[0], {
            progress: (progress) => {},
          }).then((response) => {
            $this.createRecipeImage(img_file[0]);
            $this.uploadProgress = false;
            $this.form.recipe_image = response;
            console.log("vapor response", response);
            // axios.post('/api/profile-photo', {
            //     uuid: response.uuid,
            //     key: response.key,
            //     bucket: response.bucket,
            //     name: this.$refs.file.files[0].name,
            //     content_type: this.$refs.file.files[0].type,
            // })
          });
          // e.target.value = '';
        } else {
          this.$toast.error(
            "Error: The size limit for images is 4MB. Please reduce the file size and try again."
          );
          e.target.value = "";
        }
        console.log(
          "File " +
            img_file[0].name +
            " is " +
            "sizes = " +
            sizes +
            " = " +
            img_file[0].size +
            " bytes in size"
        );
      }

      //console.log(e.target.files[0]);
      // this.form.recipe_image = e.target.files[0];
      // let img_file = e.target.files || e.dataTransfer.files;
      // if (!img_file.length)
      //     return;
      // this.createRecipeImage(img_file[0]);
    },

    createRecipeImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = (e) => {
        vm.recipeimage = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    removeRecipeImage() {
      this.form.recipe_image = "";
      this.recipeimage = "";
      document.querySelector("#recipe_image").value = "";
    },

    getHaccpNames(event) {
      let type = event.target.value;
      if (type != "") {
        axios
          .post("/get-recipe-haccps-names", { type: type })
          .then((response) => {
            this.haccp_names = response.data;
          })
          .catch((error) => console.error(error));
      }
    },

    updateHaccpDataIntoCookingInstructions() {
      if (this.form.recipe_haccp_id == "") {
        this.$toast.error("Error: HACCP value required!");
      } else {
        axios
          .post("/get-haccp-description-cooking-instructions", {
            haccp: this.form.recipe_haccp_id,
          })
          .then((response) => {
            this.haccp_description = response.data;
            var quill_editor_set = document.querySelector(
              "#quill_editor_instructions"
            );
            quill_editor_set.children[0].innerHTML += this.haccp_description;
          })
          .catch((error) => console.error(error));
      }
    },

    addIngredientRecipeModalOpen() {
      this.addIngredientsModal = true;

      this.search_term = "";
      this.searched_ingredients = [];
    },

    ingredientSearchScriptModal() {
      if (this.search_term == "") {
        this.$toast.error("Error: Search value required!");
      } else {
        let exist_ingredients = [];
        this.rec_ingredients.forEach((value, index) => {
          exist_ingredients.push(value["id"]);
        });
        axios
          .post("/recipe-ingredient-search-modal", {
            term: this.search_term,
            ex_ids: exist_ingredients,
          })
          .then((response) => {
            //console.log(response.data.search_data);
            this.searched_ingredients = response.data;
          })
          .catch((error) => console.error(error));
      }
    },

    async addIngredientAddScript(ing_array, index) {
      this.searched_ingredients.splice(index, 1);

      //ajax to get products related tp selected ingredient
      await axios
        .post("/get_ingredient_prefer_product", {
          ingredient_id: ing_array["id"],
        })
        .then((response) => {
          if (response.data.length > 0) {
            response.data = response.data[0];
          } else {
            //if no prefer product found
            response.data = [];
          }

          let prefer_prod = {};

          prefer_prod["measurement_serving_weight"] =
            response.data["serving_measurement_weight"];
          prefer_prod["measurement_serving_weight_uom"] =
            response.data["serving_measurement_weight_uom_name"];
          prefer_prod["measurement_serving_volume"] =
            response.data["serving_measurement_volume"];
          prefer_prod["measurement_serving_volume_uom"] =
            response.data["serving_measurement_volume_uom_name"];
          prefer_prod["measurement_serving_unit"] =
            response.data["serving_measurement_unit"];
          prefer_prod["measurement_serving_unit_uom"] =
            response.data["serving_measurement_unit_uom_name"];

          // prefer_prod['nutrition_facts_weight'] = response.data['nutrition_facts_weight'];
          // prefer_prod['nutrition_facts_weight_uom'] = response.data['nutrition_facts_weight_uom_name'];
          // prefer_prod['nutrition_facts_volume'] = response.data['nutrition_facts_volume'];
          // prefer_prod['nutrition_facts_volume_uom'] = response.data['nutrition_facts_volume_uom_name'];
          // prefer_prod['nutrition_facts_unit'] = response.data['nutrition_facts_unit'];
          // prefer_prod['nutrition_facts_unit_uom'] = response.data['nutrition_facts_unit_uom_name'];

          prefer_prod["component_mma"] = ing_array["component_mma"] =
            response.data["usda_componenent_serving_meat"];
          prefer_prod["component_wgr"] = ing_array["component_wgr"] =
            response.data["usda_componenent_serving_grain"];
          prefer_prod["component_fru"] = ing_array["component_fru"] =
            response.data["usda_componenent_serving_fruit"];
          prefer_prod["component_mlk"] = ing_array["component_mlk"] =
            response.data["usda_componenent_serving_milk"];
          prefer_prod["component_veg"] = ing_array["component_veg"] =
            response.data["usda_componenent_serving_veg"];
          prefer_prod["component_dg"] = ing_array["component_dg"] =
            response.data["usda_componenent_serving_veggrn"];
          prefer_prod["component_ro"] = ing_array["component_ro"] =
            response.data["usda_componenent_serving_vegred"];
          prefer_prod["component_leg"] = ing_array["component_leg"] =
            response.data["usda_componenent_serving_vegleg"];
          prefer_prod["component_star"] = ing_array["component_star"] =
            response.data["usda_componenent_serving_vegstar"];
          prefer_prod["component_other"] = ing_array["component_other"] =
            response.data["usda_componenent_serving_vegothr"];

          ing_array["component_nut_calories"] =
            response.data["nutrition_facts_calories"];
          ing_array["component_nut_sodium"] =
            response.data["nutrition_facts_sodium"];
          ing_array["component_nut_totalfat"] =
            response.data["nutrition_facts_totalfat"];
          ing_array["component_nut_protein"] =
            response.data["nutrition_facts_protein"];
          ing_array["component_nut_carbs"] =
            response.data["nutrition_facts_carbs"];

          ing_array["recipe_amount"] = null;
          ing_array["recipe_amount_uom"] = null;
          ing_array["serving_amount"] = null;
          ing_array["serving_amount_uom"] = null;

          //setup ingredient components for optional components
          ing_array["optional_component_mma"] = null;
          ing_array["optional_component_wgr"] = null;
          ing_array["optional_component_fru"] = null;
          ing_array["optional_component_mlk"] = null;
          ing_array["optional_component_veg"] = null;
          ing_array["optional_component_dg"] = null;
          ing_array["optional_component_ro"] = null;
          ing_array["optional_component_leg"] = null;
          ing_array["optional_component_star"] = null;
          ing_array["optional_component_other"] = null;

          ing_array["preferred_product_information"] = prefer_prod;

          this.ing_prefer_products.push(prefer_prod);
        })
        .catch((error) => console.error(error));

      this.rec_ingredients.push(ing_array);
      this.changeComponentVals(this.rec_ingredients);
    },

    addIngredientsDeleteScript(ingredient_id, click_index) {
      this.rec_ingredients.forEach((value, index) => {
        if (ingredient_id == value["id"]) {
          this.rec_ingredients.splice(index, 1);
        }
      });

      //ajax to delete products related to selected ingredient
      this.ing_prefer_products.splice(click_index, 1);

      this.changeComponentVals(this.rec_ingredients);
    },

    getDataRecipeIngredient(index, event) {
      //console.log(index, '--check updated data-----', event);
      this.rec_ingredients[index]["recipe_amount"] = event["recipe_amount"];
      this.rec_ingredients[index]["recipe_amount_uom"] =
        event["recipe_amount_uom"];
      this.rec_ingredients[index]["serving_amount"] = event["serving_amount"];
      this.rec_ingredients[index]["serving_amount_uom"] =
        event["serving_amount_uom"];

      this.rec_ingredients[index]["component_mma"] = event["component_mma"];
      this.rec_ingredients[index]["component_wgr"] = event["component_wgr"];
      this.rec_ingredients[index]["component_fru"] = event["component_fru"];
      this.rec_ingredients[index]["component_mlk"] = event["component_mlk"];
      this.rec_ingredients[index]["component_veg"] = event["component_veg"];
      this.rec_ingredients[index]["component_dg"] = event["component_dg"];
      this.rec_ingredients[index]["component_ro"] = event["component_ro"];
      this.rec_ingredients[index]["component_leg"] = event["component_leg"];
      this.rec_ingredients[index]["component_star"] = event["component_star"];
      this.rec_ingredients[index]["component_other"] = event["component_other"];

      // this.ing_prefer_products[index]['component_mma'] = event['component_mma'];
      // this.ing_prefer_products[index]['component_wgr'] = event['component_wgr'];
      // this.ing_prefer_products[index]['component_fru'] = event['component_fru'];
      // this.ing_prefer_products[index]['component_mlk'] = event['component_mlk'];
      // this.ing_prefer_products[index]['component_veg'] = event['component_veg'];
      // this.ing_prefer_products[index]['component_dg'] = event['component_dg'];
      // this.ing_prefer_products[index]['component_ro'] = event['component_ro'];
      // this.ing_prefer_products[index]['component_leg'] = event['component_leg'];
      // this.ing_prefer_products[index]['component_star'] = event['component_star'];
      // this.ing_prefer_products[index]['component_other'] = event['component_other'];

      this.rec_ingredients[index]["preferred_product_information"] =
        this.ing_prefer_products[index];

      this.changeComponentVals(this.rec_ingredients);

      //console.log(this.ing_prefer_products, '--check updated data-----', this.rec_ingredients);
    },

    recipe_add_save_script() {
      var quill_editor = document.querySelector("#quill_editor_instructions");
      //console.log(quill_editor.children[0].innerHTML);
      if (
        quill_editor.children[0].innerHTML != "" &&
        quill_editor.children[0].innerHTML != "<p><br></p>"
      ) {
        this.form.recipe_instructions = quill_editor.children[0].innerHTML;
      } else {
        this.form.recipe_instructions = "";
      }


      this.form.attached_ingredients = this.rec_ingredients;

      this.form.post(this.route("recipes-add-save"), {
        onSuccess: () => {
          this.$toast.success("Recipe Added Successfully!");
        },
      });
    },
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
