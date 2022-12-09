<template>
  <div class="w-full">
    <div
      v-if="showModal"
      class="
        overflow-x-hidden overflow-y-auto
        fixed
        inset-0
        z-50
        outline-none
        focus:outline-none
      "
    >
      <div
        class="
          justify-center
          items-center
          flex
          my-8
          mx-auto
          w-auto
          xl:max-w-7xl
          lg:max-w-4xl
          md:max-w-2xl
          sm:max-w-xl
          max-w-xs
        "
        style="min-height: calc(100% - 3.5rem)"
      >
        <div class="w-full">
          <!--content-->
          <div
            class="
              border-0
              rounded-lg
              shadow-lg
              relative
              flex flex-col
              w-full
              bg-white
              outline-none
              focus:outline-none
            "
          >
            <!--header-->
            <div
              class="
                flex
                items-start
                justify-between
                p-5
                border-b border-solid border-blueGray-200
                rounded-t
              "
            >
              <h3 class="text-3xl font-semibold uppercase">
                Option {{ optionNumber }}
              </h3>
              <button
                class="
                  rounded-full
                  menu1-background-color
                  flex
                  items-center
                  justify-center
                  p-1
                  ml-auto
                  bg-transparent
                  border-0
                  text-black
                  opacity-1
                  float-right
                  text-3xl
                  leading-none
                  font-semibold
                  outline-none
                  focus:outline-none
                "
                v-on:click="closeOptionModal()"
              >
                <span
                  class="
                    flex
                    items-center
                    justify-center
                    bg-transparent
                    text-black
                    opacity-100
                    h-6
                    w-6
                    text-2xl
                    block
                    outline-none
                    focus:outline-none
                  "
                >
                  ×
                </span>
              </button>
            </div>
            <!--body-->
            <div class="relative p-6 flex-auto">
              <div>
                <input
                  type="text"
                  v-model="name"
                  placeholder="name"
                  class="
                    w-1/2
                    shadow-sm
                    focus:border-none
                    inline-block
                    sm:text-sm
                    border-gray-300
                    rounded-lg
                    select-menu-height
                    input-background
                    mb-5
                  "
                />

                <div class="w-1/2 inline-block pl-5" >
                  <label v-show="is_fav_show" class="items-center uppercase font-semibold"
                    >Favorite
                    <input
                      type="checkbox"
                      v-model="is_favorite"
                      class="
                        ml-1.5
                        w-5
                        h-5
                        appearance-none
                        checked:bg-blue-600
                        rounded-sm
                        bg-gray-100
                        border-gray-300
                        focus:ring-0 focus:ring-offset-0
                        cursor-pointer
                      "
                    />
                  </label>

                  <label class=" float-right items-center uppercase font-semibold"
                    >A La Carte Option
                    <input
                      type="checkbox"
                      v-model="a_la_carte"
                      class="
                        ml-1.5
                        w-5
                        h-5
                        appearance-none
                        checked:bg-blue-600
                        rounded-sm
                        bg-gray-100
                        border-gray-300
                        focus:ring-0 focus:ring-offset-0
                        cursor-pointer
                      "
                    />
                  </label>
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
                  w-
                "
              >
                <h2 class="text-white text-lg font-bold w-11/12">Assembly Instructions</h2>
                <svg @click="expandAssembly" v-show="this.collapseAssemblyStates == false" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2 font-bold" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                </svg>
                <svg @click="expandAssembly" v-show="this.collapseAssemblyStates == true" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2 font-bold" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </header>


              <b-collapse id="accordion-2" v-model="collapseAssemblyStates">
              <div class="flex flex-col mb-6" v-show="this.collapseAssemblyStates == true">
                <div class="overflow-x-auto">
                  <div class="align-middle inline-block min-w-full">
                    <div
                      class="
                        shadow
                        overflow-hidden
                      "
                    >
                      <div
                        class="
                          flex
                          pt-6
                          items-center
                          mb-5
                          justify-between
                        "
                      >
                        <div class="flex items-center w-full">
                          <label class="font-bold text-gray-700 mr-5 whitespace-nowrap"
                            >Serving Size</label
                          >
                          
                          <input
                            type="text"
                            id="assembly_serving_free_text"
                            name="assembly_serving_free_text"
                            v-model="assembly_serving_free_text"
                            class="
                              w-full p-3 shadow-sm focus:border-none inline-block sm:text-sm border-gray-300 rounded-lg select-menu-height input-background
                            "
                          />
                          <!-- <input
                            type="number"
                            id="recipe_serving"
                            min="0"
                            step="any"
                            name="recipe_serving"
                            v-model="assembly_serving"
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
                              ml-10
                              mr-5
                            "
                          /> -->
                          <!-- <div class="relative focus:outline-none W-48">
                            <select
                              id="recipe_serving_unit"
                              autocomplete=""
                              v-model="assembly_serving_unit"
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
                          </div> -->
                        </div>
                        <!-- <label class="items-center uppercase font-semibold flex whitespace-nowrap"
                          >Exclude From Export
                          <input
                            type="checkbox"
                            name="is_exclude_from_export"
                            v-model="is_exclude_from_export"
                            class="
                              ml-2
                              w-5
                              h-5
                              appearance-none
                              checked:bg-blue-600
                              rounded-sm
                              bg-gray-100
                              border-gray-300
                              focus:ring-0 focus:ring-offset-0
                              cursor-pointer
                            "

                          />
                        </label> -->
                      </div>
                      <div class="flex flex-wrap">
                        <div class="bg-gray-100 mt-2 mb-5 w-full">
                          <textarea
                            id="recipe_instructions"
                            name="recipe_instructions"
                            v-model="assembly_instructions"
                            style="display: none"
                          ></textarea>
                          <quill-editor
                            theme="snow"
                            style="height: 250px"
                            id="quill_assembly_instructions"
                          ></quill-editor>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </b-collapse>

              

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
                  mt-10
                "
              >
                <h2 class="text-white text-lg font-bold w-11/12">Image</h2>
                <svg @click="expandAll" v-show="this.collapseStates == false" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2 font-bold" fill="none" viewBox="0 0 24 24" stroke="#fff" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                </svg>
                <svg @click="expandAll" v-show="this.collapseStates == true" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white mr-2 font-bold" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </header>
              <b-collapse id="accordion-1" v-model="collapseStates">
              <div class="flex flex-col mb-6" v-show="this.collapseStates == true">
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
                          <div class="w-full min-h-full-menu1 bg-gray-50">
                            <div
                              class="
                                w-full
                                border-property
                                min-h-full-menu1
                                pt-8
                                bg-gray-20
                                pb-4
                              "
                            >
                              <div
                                class="loader-15"
                                v-if="uploadProgress"
                              ></div>
                              <div class="w-24 m-auto" v-else>
                                <div
                                  v-if="optionSetimage"
                                  class="relative w-24 mt-2"
                                >
                                  <img
                                    :src="optionSetimage"
                                    class="xl:mt-0 w-full h-24 object-cover"
                                    width="100"
                                    height="100"
                                  />
                                  <button
                                    @click="clearImage"
                                    class="
                                      rounded-full
                                      menu1-background-color
                                      flex
                                      items-center
                                      justify-center
                                      p-1
                                      ml-auto
                                      bg-transparent
                                      border-0
                                      text-black
                                      opacity-1
                                      float-right
                                      text-3xl
                                      leading-none
                                      font-semibold
                                      outline-none
                                      focus:outline-none
                                      absolute
                                      -top-3
                                      -right-3
                                    "
                                  >
                                    <span
                                      class="
                                        flex
                                        items-center
                                        justify-center
                                        bg-transparent
                                        text-black
                                        opacity-100
                                        h-5
                                        w-5
                                        text-2xl
                                        outline-none
                                        focus:outline-none
                                      "
                                    >
                                      ×
                                    </span>
                                  </button>
                                  <!-- <i class="cursor-pointer fa fa-times absolute top-0 right-0" aria-hidden="true"
                                      ></i> -->
                                </div>

                                <div
                                  v-else-if="optionEditimage"
                                  class="relative w-24 mt-2"
                                >
                                  <img
                                    v-if="typeof optionEditimage === 'string'"
                                    :src="
                                      $page.props.storage_image_url +
                                      optionEditimage
                                    "
                                    class="
                                      xl:mt-0
                                      w-full
                                      h-24
                                      object-cover
                                      simple
                                    "
                                    width="100"
                                    height="100"
                                  />
                                  <img
                                    v-else
                                    :src="
                                      $page.props.storage_image_url +
                                      optionEditimage.key
                                    "
                                    class="
                                      xl:mt-0
                                      w-full
                                      h-24
                                      object-cover object
                                    "
                                    width="100"
                                    height="100"
                                  />

                                  <button
                                    @click="clearImageDB"
                                    class="
                                      rounded-full
                                      menu1-background-color
                                      flex
                                      items-center
                                      justify-center
                                      p-1
                                      ml-auto
                                      bg-transparent
                                      border-0
                                      text-black
                                      opacity-1
                                      float-right
                                      text-3xl
                                      leading-none
                                      font-semibold
                                      outline-none
                                      focus:outline-none
                                      absolute
                                      -top-3
                                      -right-3
                                    "
                                  >
                                    <span
                                      class="
                                        flex
                                        items-center
                                        justify-center
                                        bg-transparent
                                        text-black
                                        opacity-100
                                        h-5
                                        w-5
                                        text-2xl
                                        outline-none
                                        focus:outline-none
                                      "
                                    >
                                      ×
                                    </span>
                                  </button>
                                  <!-- <i class="cursor-pointer fa fa-times absolute top-0 right-0" aria-hidden="true"
                                      ></i> -->
                                </div>

                                <div v-else class="relative w-24 mt-2">
                                  <img
                                    :src="
                                      $page.props.asset_url +
                                      '/images/pizza_img.png'
                                    "
                                    class="xl:mt-0 w-full h-24 object-cover"
                                    width="100"
                                    height="100"
                                  />
                                </div>

                                <!-- <img
                                  v-if="optionSetimage"
                                  :src="optionSetimage"
                                /> -->
                                <!-- <img
                                  v-else-if="optionEditimage"
                                  :src="
                                    $page.props.storage_image_url +
                                    optionEditimage
                                  "
                                /> -->
                                <!-- <img
                                  v-else
                                  :src="
                                    $page.props.asset_url +
                                    'images/pizza_img.png'
                                  "
                                /> -->
                              </div>

                              <div
                                v-show="!optionSetimage && !optionEditimage"
                                class="text-base text-gray-500 text-center"
                              >
                                <p>Add an image to the Option!</p>
                                <p
                                  class="
                                    text-center
                                    m-auto
                                    underline
                                    text-base text-gray-500
                                    flex
                                    justify-center
                                    mt-2
                                  "
                                >
                                  <input
                                    type="file"
                                    accept="image/*"
                                    id="mc_option_image"
                                    name="mc_option_image"
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
                                    v-on:change="onMCOptionImageChange"
                                  />
                                </p>
                              </div>
                            </div>
                          </div>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              </b-collapse>

              <WeekCyclesOptionTotals :avg_products="dayTotals" />

              <header
                class="
                  searching-background-color
                  sm:flex
                  block
                  justify-between
                  items-center
                  py-2
                  pl-6
                  shadow
                  rounded-t-lg
                  mt-10
                "
              >
                <h2
                  class="
                    text-white
                    sm:text-lg
                    text-lg
                    font-bold
                    lg:w-11/12
                    md:w-36
                    w-28
                  "
                >
                  Recipes
                </h2>
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="md:h-8 md:w-8 h-6 w-6 text-white md:mr-3 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
  </svg> -->
                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="md:h-8 md:w-8 h-6 w-6 text-white md:mr-3 mr-2" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
  </svg> -->

                <div
                  class="
                    relative
                    focus:outline-none
                    lg:w-96
                    sm:w-64
                    w-40
                    mr-3
                    sm:mt-0
                    mt-2
                  "
                >
                  <select
                    id="mc_option_recipe_cat"
                    name="mc_option_recipe_cat"
                    autocomplete="off"
                    class="
                      pt-2-space
                      shadow-sm
                      focus:border-none
                      block
                      md:text-base
                      text-sm
                      border-gray-300
                      rounded-lg
                      w-full
                      select-menu-height
                      items-center
                    "
                    v-model="optionSearchRecipeCat"
                  >
                    <option value="">Select Category</option>
                    <option
                      v-for="(category, index) in categories"
                      :value="index"
                    >
                      {{ category }}
                    </option>
                    <!-- <option value="Entree">Entree</option>
              <option value="Side">Side</option>
              <option value="Sauce">Sauce</option> -->
                    <!-- <option value="Extra MMA">Extra MMA</option>
              <option value="Extra WGR">Extra WGR</option>
              <option value="VegRO">VEG:R/O</option> -->
                  </select>

                  <div
                    class="
                      absolute
                      flex
                      justify-center
                      items-center
                      menu1-background-color
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
                    lg:w-96
                    sm:w-64
                    w-40
                    mr-3
                    sm:mt-0
                    mt-2
                  "
                >
                  <div class="relative">
                    <input
                      class="select-menu-height pr-10"
                      type="text"
                      id="mc_option_recipe_search"
                      v-model="optionSearchRecipeName"
                      @input="
                        mc_option_recipe_search_method(
                          optionSearchRecipeCat,
                          $event
                        )
                      "
                      placeholder="Search Recipe..."
                    />
                    <span
                      v-if="showSearchBoxCancel"
                      class="
                        flex
                        items-center
                        justify-center
                        bg-transparent
                        text-black
                        opacity-100
                        h-6
                        w-6
                        text-2xl
                        block
                        outline-none
                        focus:outline-none
                        cursor-pointer
                        absolute
                        top-0
                        right-0
                        mt-1
                      "
                      @click="cancelRecipeSearchValue"
                      >x</span
                    >
                    <div
                      class="
                        absolute
                        bg-white
                        max-w-2xl
                        overflow-x-auto
                        w-full
                        max-h-150
                      "
                    >
                      <div
                        v-for="searched_recipe in searched_recipes"
                        class="py-1 px-3 cursor-pointer hover:bg-gray-100"
                        @click="selectRecipesIdToAdd(searched_recipe)"
                      >
                        {{ searched_recipe.custom_id }} -
                        {{ searched_recipe.name
                        }}{{ searched_recipe.is_favorite ? " - Favorite" : "" }}
                      </div>
                    </div>
                  </div>
                </div>

                <button
                  type="button"
                  class="
                    lg:w-1/5
                    w-16
                    xl:inline-flex
                    justify-center
                    rounded-md
                    font-bold
                    px-4
                    py-2
                    uppercase
                    menu1-background-color
                    text-white
                    focus:outline-none
                    mr-3
                    sm:mt-0
                    mt-2
                  "
                  @click="addOptionRecipeButton"
                >
                  ADD
                </button>
              </header>

              <div class="mb-6 bg-gray-100 py-6 px-4 max-h-650 overflow-x-auto">
                <div
                  v-if="!attached_recipes.length"
                  class="text-base text-gray-500 text-center"
                >
                  Search Recipes to add here!
                </div>

                <div
                  class="mb-4 overflow-x-auto"
                  v-for="(attached_recipe, index) in sortedArray"
                >
                  <div class="align-middle inline-block min-w-full">
                    <div
                      class="shadow overflow-hidden border-b-2 border-gray-200"
                    >
                      <div
                        class="
                          full
                          min-height-fourth
                          bg-white
                          rounded-lg
                          pt-4
                          pb-4
                        "
                      >
                        <div
                          class="flex flex-nowrap justify-end h-1.5 relative"
                        >
                          <svg
                            @click="toggleExpansion(index)"
                            xmlns="http://www.w3.org/2000/svg"
                            class="
                              h-7
                              w-7
                              menu1-icon-color
                              cursor-pointer
                              mr-2
                              relative
                              -top-1
                            "
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            :class="{ expand_recipe: isExpanded(index) }"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"
                            />
                          </svg>
                          <svg
                            xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 menu1-icon-color mr-4 cursor-pointer"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                            v-on:click="onClickOutsidePopUp(index)"
                          >
                            <path
                              d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z"
                            />
                          </svg>

                          <div
                            v-if="is_show == index"
                            v-click-outside="onClickOutside"
                            class="
                              bg-white
                              popup-shadow
                              py-3
                              absolute
                              right-10
                              top-2
                              rounded-md
                              box-border
                              z-10
                            "
                          >
                            <ul class="w-full cursor-default">
                              <!-- <li class="px-4 text-black hover:bg-gray-200"><button type="button" @click="duplicateOptionRecipeButton(attached_recipe)">Duplicate Recipe</button></li> -->
                              <li class="px-4 text-black hover:bg-gray-200">
                                <button
                                  type="button"
                                  @click="
                                    deleteOptionRecipeButton(
                                      attached_recipe,
                                      attached_recipe.new_index
                                    )
                                  "
                                >
                                  Remove Recipe
                                </button>
                              </li>
                            </ul>
                          </div>
                        </div>

                        <div class="flex flex-nowrap justify-between">
                          <div class="text-sm font-bold pl-4 menu1-text-color">
                            <p class="pb-3 text-xl">
                              {{ attached_recipe.category }}
                            </p>
                            <p class="underline">
                              <a
                                target="_blank"
                                :href="
                                  route('recipes-edit', {
                                    id: attached_recipe.id,
                                  })
                                "
                                >{{ attached_recipe.name }}</a
                              >
                            </p>
                            <p class="text-red-600" v-if="attached_recipe.allergens_name != ''">Allergen Warning: {{ attached_recipe.allergens_name }}</p>
                          </div>
                          <!-- <div class="pr-20 text-gray-500 text-sm">
                  1 Each
                  </div> -->
                        </div>

                        <div class="flex flex-nowrap justify-end pr-6 pt-1">
                          <!-- <div class="text-sm font-bold pl-4">
                            <p>DO NOT COUNTpp</p>
                          </div> -->
                          <span
                            class="flex items-center uppercase font-semibold"
                            >Override Values
                            <input
                              type="checkbox"
                              class="
                                ml-1.5
                                w-5
                                h-5
                                appearance-none
                                checked:bg-blue-600
                                rounded-sm
                                bg-gray-100
                                border-gray-300
                                focus:ring-0 focus:ring-offset-0
                                cursor-pointer
                              "
                              v-model="attached_recipe.is_override"
                              value="1"
                          /></span>
                        </div>

                        <div class="px-3 flex items-start">
                          <table class="mt-2">
                            <thead>
                              <tr class="">
                                <th
                                  scope="col"
                                  class="
                                    px-4
                                    py-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                    font-bold
                                  "
                                >
                                  MMA
                                </th>
                                <th
                                  scope="col"
                                  class="
                                    px-4
                                    py-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                    font-bold
                                  "
                                >
                                  wgr
                                </th>

                                <th
                                  scope="col"
                                  class="
                                    px-4
                                    py-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                    font-bold
                                  "
                                >
                                  fru
                                </th>

                                <th
                                  scope="col"
                                  class="
                                    px-4
                                    py-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                    font-bold
                                  "
                                >
                                  mlk
                                </th>

                                <th
                                  scope="col"
                                  class="
                                    px-4
                                    py-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                    font-bold
                                  "
                                >
                                  veg
                                </th>

                                <th
                                  scope="col"
                                  class="
                                    px-4
                                    py-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                    font-bold
                                  "
                                >
                                  dg
                                </th>

                                <th
                                  scope="col"
                                  class="
                                    px-4
                                    py-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                    font-bold
                                  "
                                >
                                  R/O
                                </th>

                                <th
                                  scope="col"
                                  class="
                                    px-4
                                    py-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                    font-bold
                                  "
                                >
                                  leg
                                </th>
                                <th
                                  scope="col"
                                  class="
                                    px-4
                                    py-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                    font-bold
                                  "
                                >
                                  star
                                </th>

                                <th
                                  scope="col"
                                  class="
                                    px-1
                                    py-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                    font-bold
                                  "
                                >
                                  oth
                                </th>
                              </tr>
                            </thead>

                            <tbody>
                              <tr class="">
                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="text"
                                    disabled
                                    :value="attached_recipe.total_val.MMA"
                                    class="
                                      bg-button-color-gray
                                      rounded
                                      min-w-min-button
                                      text-white
                                      w-16
                                      h-9
                                      text-center
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="text"
                                    disabled
                                    :value="attached_recipe.total_val.WGR"
                                    class="
                                      bg-button-color-gray
                                      rounded
                                      min-w-min-button
                                      text-white
                                      w-16
                                      h-9
                                      text-center
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="text"
                                    disabled
                                    :value="attached_recipe.total_val.FRU"
                                    class="
                                      bg-button-color-gray
                                      rounded
                                      min-w-min-button
                                      text-white
                                      w-16
                                      h-9
                                      text-center
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="text"
                                    disabled
                                    :value="attached_recipe.total_val.MLK"
                                    class="
                                      bg-button-color-gray
                                      rounded
                                      min-w-min-button
                                      text-white
                                      w-16
                                      h-9
                                      text-center
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="text"
                                    disabled
                                    :value="attached_recipe.total_val.VEG"
                                    class="
                                      bg-button-color-gray
                                      rounded
                                      min-w-min-button
                                      text-white
                                      w-16
                                      h-9
                                      text-center
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="text"
                                    disabled
                                    :value="attached_recipe.total_val.DG"
                                    class="
                                      bg-button-color-gray
                                      rounded
                                      min-w-min-button
                                      text-white
                                      w-16
                                      h-9
                                      text-center
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="text"
                                    disabled
                                    :value="attached_recipe.total_val.RO"
                                    class="
                                      bg-button-color-gray
                                      rounded
                                      min-w-min-button
                                      text-white
                                      w-16
                                      h-9
                                      text-center
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="text"
                                    disabled
                                    :value="attached_recipe.total_val.LEG"
                                    class="
                                      bg-button-color-gray
                                      rounded
                                      min-w-min-button
                                      text-white
                                      w-16
                                      h-9
                                      text-center
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="text"
                                    disabled
                                    :value="attached_recipe.total_val.STAR"
                                    class="
                                      bg-button-color-gray
                                      rounded
                                      min-w-min-button
                                      text-white
                                      w-16
                                      h-9
                                      text-center
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="text"
                                    disabled
                                    :value="attached_recipe.total_val.OTH"
                                    class="
                                      bg-button-color-gray
                                      min-w-min-button
                                      text-white
                                      w-16
                                      h-9
                                      text-center
                                      rounded-sm
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>
                              </tr>

                              <tr class="" v-if="attached_recipe.is_override">
                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="number"
                                    min="0"
                                    step="0.125"
                                    @keypress="validateNumber"
                                    v-model="
                                      attached_recipe.total_val_override.MMA
                                    "
                                    class="
                                      w-16
                                      h-9
                                      text-center
                                      rounded-sm
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="number"
                                    min="0"
                                    step="0.125"
                                    @keypress="validateNumber"
                                    v-model="
                                      attached_recipe.total_val_override.WGR
                                    "
                                    class="
                                      w-16
                                      h-9
                                      text-center
                                      rounded-sm
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="number"
                                    min="0"
                                    step="0.125"
                                    @keypress="validateNumber"
                                    v-model="
                                      attached_recipe.total_val_override.FRU
                                    "
                                    class="
                                      w-16
                                      h-9
                                      text-center
                                      rounded-sm
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="number"
                                    min="0"
                                    step="0.125"
                                    @keypress="validateNumber"
                                    v-model="
                                      attached_recipe.total_val_override.MLK
                                    "
                                    class="
                                      w-16
                                      h-9
                                      text-center
                                      rounded-sm
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="number"
                                    min="0"
                                    step="0.125"
                                    @keypress="validateNumber"
                                    v-model="
                                      attached_recipe.total_val_override.VEG
                                    "
                                    class="
                                      w-16
                                      h-9
                                      text-center
                                      rounded-sm
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="number"
                                    min="0"
                                    step="0.125"
                                    @keypress="validateNumber"
                                    v-model="
                                      attached_recipe.total_val_override.DG
                                    "
                                    class="
                                      w-16
                                      h-9
                                      text-center
                                      rounded-sm
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="number"
                                    min="0"
                                    step="0.125"
                                    @keypress="validateNumber"
                                    v-model="
                                      attached_recipe.total_val_override.RO
                                    "
                                    class="
                                      w-16
                                      h-9
                                      text-center
                                      rounded-sm
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="number"
                                    min="0"
                                    step="0.125"
                                    @keypress="validateNumber"
                                    v-model="
                                      attached_recipe.total_val_override.LEG
                                    "
                                    class="
                                      w-16
                                      h-9
                                      text-center
                                      rounded-sm
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="number"
                                    min="0"
                                    step="0.125"
                                    @keypress="validateNumber"
                                    v-model="
                                      attached_recipe.total_val_override.STAR
                                    "
                                    class="
                                      w-16
                                      h-9
                                      text-center
                                      rounded-sm
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>

                                <td
                                  scope="col"
                                  class="
                                    px-2
                                    pb-2
                                    text-center text-xs
                                    font-white
                                    text-black
                                    uppercase
                                    tracking-wider
                                  "
                                >
                                  <input
                                    type="number"
                                    min="0"
                                    step="0.125"
                                    @keypress="validateNumber"
                                    v-model="
                                      attached_recipe.total_val_override.OTH
                                    "
                                    class="
                                      w-16
                                      h-9
                                      text-center
                                      rounded-sm
                                      bg-gray-100
                                      border-gray-300
                                      focus:ring-0 focus:ring-offset-0
                                      text-sm
                                    "
                                  />
                                </td>
                              </tr>
                            </tbody>
                          </table>

                          <div class="flex flex-wrap">
                            <label class="items-center uppercase font-semibold  whitespace-nowrap ml-auto mr-3 mt-2"
                          >Exclude From Recipe Cards
                          <input
                            type="checkbox"
                            name="is_exclude_export"
                            v-model="attached_recipe.is_exclude_export"
                            class="
                              ml-2
                              w-5
                              h-5
                              appearance-none
                              checked:bg-blue-600
                              rounded-sm
                              bg-gray-100
                              border-gray-300
                              focus:ring-0 focus:ring-offset-0
                              cursor-pointer
                            "
                          />
                        </label>
                        <br>
                        <label class="items-center uppercase font-semibold  whitespace-nowrap ml-auto mr-3 mt-2"
                          >exclude from printable calendar
                          <input
                            type="checkbox"
                            name="is_exclude_export"
                            v-model="attached_recipe.is_exclude_from_printable_calendar"
                            class="
                              ml-2
                              w-5
                              h-5
                              appearance-none
                              checked:bg-blue-600
                              rounded-sm
                              bg-gray-100
                              border-gray-300
                              focus:ring-0 focus:ring-offset-0
                              cursor-pointer
                            "
                          />
                        </label>
                          </div>


                        </div>

                        <span v-show="isExpanded(index)">
                          <div class="flex flex-nowrap justify-between pt-4">
                            <div class="text-sm font-bold pl-4">
                              <p>COOKING INSTRUCTIONS</p>
                            </div>
                          </div>

                          <div
                            class="border-gray-300 bg-gray-100 mt-2 ml-4 mr-4"
                          >
                            <textarea
                              :id="'mc_option_recipe_instructions_' + index"
                              name="mc_option_recipe_instructions"
                              v-model="
                                mc_option_recipe_instructions[
                                  attached_recipe.id
                                ]
                              "
                              style="display: none"
                            ></textarea>
                            <quill-editor
                              theme="snow"
                              style="height: 250px"
                              :id="
                                'mc_option_quill_editor_instructions_' + index
                              "
                            ></quill-editor>
                          </div>

                          <div class="flex flex-nowrap justify-between pt-6">
                            <div class="text-sm font-bold pl-4">
                              <p>SMART SNACK</p>
                            </div>
                          </div>
                          <div class="flex flex-nowrap pl-4 pr-4 pt-2">
                            <input
                              type="checkbox"
                              value="Yes"
                              v-model="
                                mc_option_recipe_smartsnack[attached_recipe.id]
                              "
                              class="
                                w-5
                                h-5
                                appearance-none
                                checked:bg-blue-600
                                rounded-sm
                                bg-gray-100
                                border-gray-300
                                focus:ring-0 focus:ring-offset-0
                                cursor-pointer
                              "
                            />
                            <p class="pl-2">This component is a smart snack.</p>
                          </div>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--footer-->
            <div
              class="
                flex
                items-center
                justify-end
                p-6
                border-t border-solid border-blueGray-200
                rounded-b
              "
            >
              <button
                v-if="this.editOptionData.recipes !== undefined"
                class="
                  text-green-500
                  bg-transparent
                  border border-solid border-green-500
                  hover:bg-green-500 hover:text-white
                  active:bg-green-600
                  font-bold
                  uppercase
                  text-sm
                  px-6
                  py-3
                  rounded
                  outline-none
                  focus:outline-none
                  mr-1
                  mb-1
                  ease-linear
                  transition-all
                  duration-150
                "
                type="button"
                v-on:click="addOptionDayModal()"
              >
                Update Option
              </button>
              <button
                v-else
                class="
                  text-green-500
                  bg-transparent
                  border border-solid border-green-500
                  hover:bg-green-500 hover:text-white
                  active:bg-green-600
                  font-bold
                  uppercase
                  text-sm
                  px-6
                  py-3
                  rounded
                  outline-none
                  focus:outline-none
                  mr-1
                  mb-1
                  ease-linear
                  transition-all
                  duration-150
                "
                type="button"
                v-on:click="addOptionDayModal()"
              >
                Add Option
              </button>

              <button
                class="
                  text-red-500
                  bg-transparent
                  border border-solid border-red-500
                  hover:bg-red-500 hover:text-white
                  active:bg-red-600
                  font-bold
                  uppercase
                  text-sm
                  px-6
                  py-3
                  rounded
                  outline-none
                  focus:outline-none
                  mr-1
                  mb-1
                  ease-linear
                  transition-all
                  duration-150
                "
                type="button"
                v-on:click="closeOptionModal()"
              >
                Close
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div v-if="showModal" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
  </div>
</template>

<script>
import DefaultLayout from "@/Layouts/DefaultLayout";
import Welcome from "@/Jetstream/Welcome";
import MenuOption from "@/Pages/MenuCycle/MenuOption";
import WeekCycleDayList from "@/Pages/WeekCycles/WeekCycleDayList";
import WeekCyclesOptionTotals from "@/Pages/WeekCycles/WeekCyclesOptionTotals";
import { Inertia } from "@inertiajs/inertia";
import vClickOutside from "click-outside-vue3";

export default {
  props: [
    "addRecipesOptionModal",
    "dayNumber",
    "optionNumber",
    "editOptionData",
    "categories",
    "name",
    "is_fav_show",
    "mass_measurements",
    "volume_measurements",
    "unit_measurements",
  ],
  directives: {
    clickOutside: vClickOutside.directive,
  },

  components: {
    DefaultLayout,
    Welcome,
    WeekCycleDayList,
    WeekCyclesOptionTotals,
    MenuOption,
  },
  name: "large-modal",
  data() {
    return {
      collapseStates: false,
      collapseAssemblyStates: false,
      typing: null,
      debounce: null,

      uploadProgress: false,
      showModal: this.addRecipesOptionModal,
      optionImage: "",
      is_favorite: false,
      a_la_carte:false,
      optionSetimage: "",
      assembly_serving_free_text: "",
      assembly_serving: "",
      assembly_serving_unit: "",
      assembly_instructions: "",
      is_exclude_from_export: false,
      is_exclude_export: false,

      mc_option_recipe_dont_count: [],
      mc_option_recipe_instructions: [],
      mc_option_recipe_smartsnack: [],
      optionEditimage: "",

      optionSearchRecipeCat: "",
      optionSearchRecipeName: "",
      showSearchBoxCancel: false,
      searched_recipes: [],
      attached_recipe_object: [],
      attached_recipes: [],

      attached_option_data: [],

      avg_products: [],
      ing_prefer_products: [],
      ing_recipes_prefer_products: [],

      recipes_total_meat_values: [],
      recipes_total_grain_values: [],
      is_show: -1,
      // isExpanded: false,
      expandedGroup: [],
    };
  },

  computed: {
    // a computed getter
    dayTotals: function () {
      return this.$helpers.getRecipeTotal(this.attached_recipes);
    },
    sortedArray: function () {
      this.attached_recipes.map(function (event, ind) {
        event.new_index = ind;
      });
      let a = _.orderBy(this.attached_recipes, "name", "asc");
      a = _.orderBy(a, "category_sort", "asc");

      return a;
    },
  },

  mounted() {
    console.log("editOptionData", this.editOptionData);
    if (this.editOptionData.recipes !== undefined) {
      if (this.editOptionData.is_favorite) {
        this.is_favorite = this.editOptionData.is_favorite;
      }
      //a_la_carte
      if (this.editOptionData.a_la_carte) {
        this.a_la_carte = this.editOptionData.a_la_carte;
      }
      
      this.assembly_serving_free_text = this.editOptionData.assembly_serving_free_text;
      this.assembly_serving = this.editOptionData.assembly_serving;
      this.assembly_serving_unit = this.editOptionData.assembly_serving_unit;
      this.assembly_instructions = this.editOptionData.assembly_instructions;
      this.is_exclude_from_export = this.editOptionData.is_exclude_from_export;
      

      // quill_assembly_instructions

      console.log(
        "editOptionData is_favorite",
        this.editOptionData.is_favorite
      );
      this.attached_recipes = JSON.parse(
        JSON.stringify(this.editOptionData.recipes)
      );

      console.log("this.attached_recipes", this.attached_recipes);

      this.optionEditimage = this.editOptionData.photo;
      this.optionImage = this.editOptionData.photo;

      if (this.editOptionData.photo.type !== undefined) {
        this.optionEditimage = this.createMCOptionImage(
          this.editOptionData.photo
        );
      }

      this.attached_recipes.forEach((value, index) => {
        if (value["prefer_products"] !== undefined) {
          value["prefer_products"].forEach((value2, index2) => {
            this.ing_prefer_products.push(value2);
          });
        }

        //this.ing_recipes_prefer_products[value['id']] = this.ing_prefer_products;

        this.recipes_total_meat_values[value["id"]] = value["meat_total"];
        this.recipes_total_grain_values[value["id"]] = value["grain_total"];

        this.mc_option_recipe_dont_count[value["id"]] = value["dont_count"];
        this.mc_option_recipe_smartsnack[value["id"]] =
          value["smartsnack"] == 1 ? true : false;
      });

      setTimeout(() => {
        //console.log('im here in',this.assembly_instructions);
        var quill_editor_set = document.querySelector(
          "#quill_assembly_instructions"
        );
        quill_editor_set.children[0].innerHTML = this.assembly_instructions;

        this.attached_recipes.forEach((value, index) => {
          var quill_editor_set = document.querySelector(
            "#mc_option_quill_editor_instructions_" + index
          );
          quill_editor_set.children[0].innerHTML = value["instructions"];
        });

        // this.avg_products = this.$helpers.sum_products_week_popup_totals_new(
        //   this.ing_prefer_products
        // );
        this.avg_products = this.$helpers.getRecipeTotal(this.attached_recipes);
      }, 5000);
    }
  },

  methods: {
    expandAll() {
        this.collapseStates = !this.collapseStates
      },
    expandAssembly() {
        this.collapseAssemblyStates = !this.collapseAssemblyStates
      },
    clearImage() {
      // document.getElementById('your_input_id').value= null;
      document.getElementById("mc_option_image").value = "";
      // var elm=$('#mc_option_image')[0].files;
      // console.log("elm", elm);
      // get position element in array and delete it.
      // for(var i = 0; i < elm.length; i++) {
      //     if(elm[i].name === namefileRemoved) {
      //       elm.splice(0, i);
      //     }
      // }
      this.optionSetimage = "";
      this.optionImage = "";
      this.optionEditimage = "";
    },
    clearImageDB() {
      if (confirm("Are you sure, you want to delete this recipe image?")) {
        this.optionEditimage = "";
        this.optionSetimage = "";
        this.optionImage = "";
      }
    },
    validateNumber: (event) => {
      let keyCode = event.keyCode;
      console.log("keyCode", keyCode);
      if (keyCode < 48 || keyCode > 57) {
        if (keyCode != 46) {
          event.preventDefault();
        }
      }
    },
    isExpanded(index) {
      return this.expandedGroup.indexOf(index) !== -1;
    },
    toggleExpansion(index) {
      if (this.isExpanded(index))
        this.expandedGroup.splice(this.expandedGroup.indexOf(index), 1);
      else this.expandedGroup.push(index);
    },
    onClickOutside(event) {
      this.is_show = -1;
    },
    closeOptionModal: function () {
      this.showModal = false;

      if (this.editOptionData.recipes !== undefined) {
        this.$emit(
          "closeEditModal",
          "",
          "",
          "",
          "",
          this.name,
          this.is_favorite,
          this.assembly_serving_free_text,
          this.assembly_serving,
          this.assembly_serving_unit,
          this.assembly_instructions,
          this.is_exclude_from_export,
          this.a_la_carte
        );
      } else {
        this.$emit(
          "closeModal",
          "",
          "",
          "",
          "",
          this.name,
          this.is_favorite,
           this.assembly_serving_free_text,
          this.assembly_serving,
          this.assembly_serving_unit,
          this.assembly_instructions,
          this.is_exclude_from_export,
          this.a_la_carte
        );
      }
      this.name = "";
    },
    onClickOutsidePopUp(index) {
      if (index === this.is_show) {
        this.is_show = -1;
      } else {
        this.is_show = index;
      }
    },

    onMCOptionImageChange(e) {
      let $this = this;
      // this.optionImage = e.target.files[0];
      let img_file = e.target.files || e.dataTransfer.files;
      if (!img_file.length) {
        return;
      } else {
        console.log('hello3');
        this.uploadProgress = true;
        this.createMCOptionImage(img_file[0]);
        Vapor.store(e.target.files[0], {
          progress: (progress) => {},
        }).then((response) => {
          this.uploadProgress = false;
          $this.optionImage = response;
          console.log("vapor response", response);
          // axios.post('/api/profile-photo', {
          //     uuid: response.uuid,
          //     key: response.key,
          //     bucket: response.bucket,
          //     name: this.$refs.file.files[0].name,
          //     content_type: this.$refs.file.files[0].type,
          // })
        });
      }
    },

    createMCOptionImage(file) {
      let reader = new FileReader();
      let vm = this;
      reader.onload = (e) => {
        vm.optionSetimage = e.target.result;
      };
      reader.readAsDataURL(file);
    },

    mc_option_recipe_search_method(SearchRecipeCat, e) {
      let $this= this;
      let search_term = e.target.value;
      this.$toast.clear();
      clearTimeout(this.debounce)
      if (search_term == "") {
        this.searched_recipes = [];
        this.$toast.error("Error: Search value required!");
        // } else if (SearchRecipeCat == "") {
        //   this.searched_recipes = [];
        //   this.$toast.error("Error: Select Recipe Category!");
      } else {
        this.debounce = setTimeout(() => {
        axios
          .post("/menu-cycle-recipes-search-modal", {
            term: search_term,
            recipeCat: SearchRecipeCat,
          })
          .then((response) => {
            $this.searched_recipes = [];
            $this.searched_recipes = response.data;
          })
          .catch((error) => console.error(error));
      }, 900);
        
      }
    },
    // duplicateOptionRecipeButton(recipeObj){
    //   console.log('recipeObj',recipeObj);
    //   this.attached_recipe_object = recipeObj;

    //    this.attached_recipes.push(this.attached_recipe_object);

    //    this.mc_option_recipe_dont_count[this.attached_recipe_object.id]=[];
    //    this.mc_option_recipe_instructions[this.attached_recipe_object.id]=[];
    //    this.mc_option_recipe_smartsnack[this.attached_recipe_object.id]=[];

    //    this.ing_recipes_prefer_products[this.attached_recipe_object.id]=[];
    //    //console.log('2',this.ing_recipes_prefer_products);
    //    this.recipes_total_meat_values[this.attached_recipe_object.id]=0;
    //    this.recipes_total_grain_values[this.attached_recipe_object.id]=0;

    //    this.attached_recipe_object.ingredients.forEach((value,index) => {
    //    //ajax to get products related tp selected ingredient
    //         axios.post('/get_recipe_ingredient_prefer_product',{ingredient_id:value['id'],recipe_id:this.attached_recipe_object.id})
    //                 .then((response)=>{
    //                  if(response.data.id){
    //                   this.ing_prefer_products.push(response.data);
    //                   console.log('3',this.ing_prefer_products);

    //                   this.ing_recipes_prefer_products[this.attached_recipe_object.id].push(response.data);

    //                   this.recipes_total_meat_values[this.attached_recipe_object.id] = parseFloat(this.recipes_total_meat_values[this.attached_recipe_object.id]) + parseFloat(response.data.usda_componenent_serving_meat);

    //                   this.recipes_total_grain_values[this.attached_recipe_object.id] = parseFloat(this.recipes_total_grain_values[this.attached_recipe_object.id]) + parseFloat(response.data.usda_componenent_serving_grain);
    //                  }
    //                 }).catch(error => console.error(error));
    //     });

    //    //console.log('4',this.ing_recipes_prefer_products);

    //   setTimeout(()=>{
    //   //console.log('5',this.ing_recipes_prefer_products);
    //   var instructionId = this.attached_recipes.length-1;
    //   //alert(instructionId);
    //   var quill_editor_set = document.querySelector('#mc_option_quill_editor_instructions_' +instructionId);
    //   quill_editor_set.children[0].innerHTML = this.attached_recipe_object.cooking_instructions;

    //   this.avg_products = this.$helpers.sum_products_week_popup_totals(this.ing_prefer_products);
    //   //this.attached_recipe_object = [];
    //   },1000);

    // },
    deleteOptionRecipeButton(recipeObj, click_index) {
      console.log(recipeObj, this.attached_recipes);
      this.is_show = -1;
      if (confirm("Are you sure you want to delete this?")) {
        let $this = this;

        // var delete_prefer_products=[];
        this.attached_recipes.splice(click_index, 1);
        this.mc_option_recipe_dont_count.splice(recipeObj.id, 1);
        this.mc_option_recipe_instructions.splice(recipeObj.id, 1);
        this.mc_option_recipe_smartsnack.splice(recipeObj.id, 1);
        this.ing_recipes_prefer_products.splice(recipeObj.id, 1);
        this.recipes_total_meat_values.splice(recipeObj.id, 1);
        this.recipes_total_grain_values.splice(recipeObj.id, 1);

        // let ing_prefer_products = this.ing_prefer_products;

        if (recipeObj.option_component_id) {
          console.log(
            "recipeObj.option_component_id",
            recipeObj.option_component_id
          );
          Inertia.post(
            "/menu-cycle-option-recipe-delete/id/" +
              recipeObj.option_component_id,
            {}
          );
          if (
            recipeObj.prefer_products &&
            recipeObj.prefer_products.length > 0
          ) {
            recipeObj.prefer_products.forEach((value, index) => {
              $this.ing_prefer_products = $this.removeById(
                $this.ing_prefer_products,
                value.id
              );
            });
          }

          // deleteOptionRecipeModel
        }

        $this.$emit(
          "deleteOptionRecipeModel",
          recipeObj,
          $this.dayNumber,
          $this.optionNumber
        );

        if (recipeObj.ingredients && recipeObj.ingredients.length > 0) {
          recipeObj.ingredients.forEach((value, index) => {
            //ajax to get products related tp selected ingredient
            axios
              .post("/get_recipe_ingredient_prefer_product", {
                ingredient_id: value["id"],
                recipe_id: this.attached_recipe_object.id,
              })
              .then((response) => {
                if (response.data.id) {
                  $this.ing_prefer_products = $this.removeById(
                    $this.ing_prefer_products,
                    response.data.id
                  );
                  // this.ing_prefer_products.push(response.data);
                }
              })
              .catch((error) => console.error(error));
          });
        }

        setTimeout(() => {
          //console.log('5',this.ing_recipes_prefer_products);
          var instructionId = $this.attached_recipes.length - 1;
          //alert(instructionId);
          // var quill_editor_set = document.querySelector('#mc_option_quill_editor_instructions_' +instructionId);
          // quill_editor_set.children[0].innerHTML = this.attached_recipe_object.cooking_instructions;

          // $this.avg_products = $this.$helpers.sum_products_week_popup_totals_new(
          //   $this.ing_prefer_products
          // );
          $this.avg_products = $this.$helpers.getRecipeTotal(
            $this.attached_recipes
          );
          //this.attached_recipe_object = [];
        }, 1000);
      }
    },

    removeById(arr, id) {
      // console.log('removeById', id);
      // console.log('removeById', String(id));
      const requiredIndex = arr.findIndex((el) => {
        // console.log("el", id, el.id)
        return el.id === id;
      });
      // console.log('requiredIndex', requiredIndex);
      if (requiredIndex === -1) {
        return false;
      }
      // console.log('arr', arr);
      arr.splice(requiredIndex, 1);
      // console.log('arr', arr);
      return arr;
    },

    selectRecipesIdToAdd(recipeObj) {
      this.optionSearchRecipeName = recipeObj.name;
      this.attached_recipe_object = [];
      this.attached_recipe_object = recipeObj;
      this.searched_recipes = [];
      this.showSearchBoxCancel = true;
    },

    addOptionRecipeButton() {
      //console.log('1',this.ing_recipes_prefer_products);
      this.$toast.clear();
      let $this = this;
      if (this.attached_recipe_object.length == 0) {
        this.$toast.error("Error: Select Recipe to add!");
      } else {
        console.log("this.attached_recipe_object", this.attached_recipe_object);
        this.attached_recipe_object.is_override = false;
        this.attached_recipe_object.total_val_override =
          $this.$helpers.getBlankObject();
        this.mc_option_recipe_dont_count[this.attached_recipe_object.id] = [];
        this.mc_option_recipe_instructions[this.attached_recipe_object.id] = [];
        this.mc_option_recipe_smartsnack[this.attached_recipe_object.id] = [];
        this.ing_recipes_prefer_products[this.attached_recipe_object.id] = [];
        //console.log('2',this.ing_recipes_prefer_products);
        this.recipes_total_meat_values[this.attached_recipe_object.id] = 0;
        this.recipes_total_grain_values[this.attached_recipe_object.id] = 0;

        axios
          .get("/get-recipe-total-vals/" + this.attached_recipe_object.id)
          .then((response) => {
            console.log("get-recipe-total-vals response", response);
            if (response.data) {
              $this.attached_recipe_object.total_val =
                $this.$helpers.sum_products_week_popup_totals_new(
                  response.data
                );
              console.log(
                "$this.attached_recipe_object.total_val",
                $this.attached_recipe_object.total_val
              );
              console.log(
                "$this.attached_recipe_object",
                $this.attached_recipe_object
              );
            }
            $this.attached_recipes.push($this.attached_recipe_object);
            console.log("attached_recipes", $this.attached_recipes);

            setTimeout(() => {
              var instructionId = $this.attached_recipes.length - 1;
              console.log(
                "mc_option_quill_editor_instructions_",
                "mc_option_quill_editor_instructions_" + instructionId
              );
              //alert(instructionId);
              var quill_editor_set = document.querySelector(
                "#mc_option_quill_editor_instructions_" + instructionId
              );
              quill_editor_set.children[0].innerHTML =
                $this.attached_recipe_object.cooking_instructions;

              // $this.avg_products = $this.$helpers.sum_products_week_popup_totals_new(
              //   $this.ing_prefer_products
              // );
              //getRecipeTotal
              $this.avg_products = $this.$helpers.getRecipeTotal(
                $this.attached_recipes
              );
              $this.attached_recipe_object = [];
            }, 1000);
          })
          .catch((error) => console.error(error));

        // this.attached_recipe_object.ingredients.forEach((value, index) => {
        //   //ajax to get products related tp selected ingredient
        //   axios
        //     .post("/get_recipe_ingredient_prefer_product", {
        //       ingredient_id: value["id"],
        //       recipe_id: this.attached_recipe_object.id,
        //     })
        //     .then((response) => {
        //       if (response.data.id) {
        //         this.ing_prefer_products.push(response.data);
        //         //console.log('3',this.ing_recipes_prefer_products);

        //         this.ing_recipes_prefer_products[
        //           this.attached_recipe_object.id
        //         ].push(response.data);

        //         this.recipes_total_meat_values[this.attached_recipe_object.id] =
        //           parseFloat(
        //             this.recipes_total_meat_values[
        //               this.attached_recipe_object.id
        //             ]
        //           ) + parseFloat(response.data.usda_componenent_serving_meat);

        //         this.recipes_total_grain_values[
        //           this.attached_recipe_object.id
        //         ] =
        //           parseFloat(
        //             this.recipes_total_grain_values[
        //               this.attached_recipe_object.id
        //             ]
        //           ) + parseFloat(response.data.usda_componenent_serving_grain);
        //       }
        //     })
        //     .catch((error) => console.error(error));
        // });

        //console.log('4',this.ing_recipes_prefer_products);
      }

      this.optionSearchRecipeName = "";
      this.optionSearchRecipeCat = "";
      this.showSearchBoxCancel = false;
      //console.log('6',this.ing_recipes_prefer_products);
    },

    cancelRecipeSearchValue() {
      this.optionSearchRecipeName = "";
      this.showSearchBoxCancel = false;
      this.attached_recipe_object = [];
    },

    addOptionDayModal() {
      if (this.attached_recipes.length == 0) {
        this.$toast.error("Error: Please add at least one recipe.");
      } else {
        let quill_assembly_instructions = document.querySelector(
          "#quill_assembly_instructions"
        );
        if (
          quill_assembly_instructions.children[0].innerHTML != "" &&
          quill_assembly_instructions.children[0].innerHTML != "<p><br></p>"
        ) {
          this.assembly_instructions =
            quill_assembly_instructions.children[0].innerHTML;
        } else {
          this.assembly_instructions = "";
        }

        this.attached_recipes.forEach((value, index) => {
          var quill_editor_get = document.querySelector(
            "#mc_option_quill_editor_instructions_" + index
          );

          if (
            quill_editor_get.children[0].innerHTML != "" &&
            quill_editor_get.children[0].innerHTML != "<p><br></p>"
          ) {
            this.mc_option_recipe_instructions[value["id"]] =
              quill_editor_get.children[0].innerHTML;
          } else {
            this.mc_option_recipe_instructions[value["id"]] = "";
          }

          this.attached_recipes[index]["dont_count"] =
            this.mc_option_recipe_dont_count[value["id"]];
          this.attached_recipes[index]["instructions"] =
            this.mc_option_recipe_instructions[value["id"]];
          this.attached_recipes[index]["smartsnack"] =
            this.mc_option_recipe_smartsnack[value["id"]];

          this.attached_recipes[index]["meat_total"] =
            this.recipes_total_meat_values[value["id"]];
          this.attached_recipes[index]["grain_total"] =
            this.recipes_total_grain_values[value["id"]];

          this.attached_recipes[index]["prefer_products"] =
            this.ing_recipes_prefer_products[value["id"]];
        });

        this.showModal = false;
        // alert(this.name);
        if (this.editOptionData.recipes !== undefined) {
          this.$emit(
            "closeEditModal",
            this.attached_recipes,
            this.optionImage,
            this.dayNumber,
            this.optionNumber,
            this.name,
            this.is_favorite,
            this.assembly_serving_free_text,
            this.assembly_serving,
            this.assembly_serving_unit,
            this.assembly_instructions,
            this.is_exclude_from_export,
            this.a_la_carte
          );
        } else {
          this.$emit(
            "closeModal",
            this.attached_recipes,
            this.optionImage,
            this.dayNumber,
            this.optionNumber,
            this.name,
            this.is_favorite,
            this.assembly_serving_free_text,
            this.assembly_serving,
            this.assembly_serving_unit,
            this.assembly_instructions,
            this.is_exclude_from_export,
            this.a_la_carte
          );
        }
      }
    },
  },
};
</script>

<style>
.searching-background-color {
  background-color: #38558e;
}

.button-bg-color-wed-menu2-gray {
  border: none !important;
  min-height: 35px;
  min-width: 35px;
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
.cancel-background-color {
  background-color: #8b8b8b;
}

.placeholder-background-color {
  background-color: #f8f8f8;
}

.mt-0-down {
  margin-top: -54px;
}
.button-bg-color-wed-menu1 {
  background-color: #cbcbcb45;
}
.text-color-first-li {
  color: #38558e;
}

.icon-star-color {
  color: #f7a53a;
}
.th-heading-background {
  background-color: #f4f4f4;
}
.button-bg-color-wed {
  background-color: #cbcbcb;
}
.input-background {
  background-color: #f8f8f8;
}
.white-shadow-box {
  box-shadow: 0px 2px 5px #0000005e;
}

.bg-button-color {
  background-color: #cb0000;
}

.min-w-min-button {
  min-height: 26px;
  min-width: 53px;
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

.min-w-min-button-menu1 {
  min-height: 27px;
  min-width: 26px;
  border: 1px solid lightgrey;
}

#inputUpload {
  display: none;
}

.custom-file-upload {
  cursor: pointer;
  font-size: inherit;
  color: #0c090d;
}

.min-h-full-menu1 {
  min-height: 200px;
}

.custom-file-upload:hover {
  text-decoration: underline;
}
.border-property {
  border: 1px solid gray;
  margin-top: 20px;
  border-style: dashed;
  border-bottom: none;
}
.menu1-background-color {
  background-color: #faa43d;
}

.menu1-text-color {
  color: #faa43d;
}

.min-height-third {
  min-height: 400px;
}

.select-menu-height {
  height: 2.3rem;
}

.min-height-fivth {
  min-height: 70px;
}
.icon-position-menu1 {
  position: absolute;
  top: -5px;
  right: 41px;
}
.icon-position-menu2 {
  position: absolute;
  top: -5px;
  right: -3px;
}
.position-cross {
  position: absolute;
  right: -21px;
  top: -25px;
  z-index: 1;
  overflow: auto;
}

/* .w-4/12-h2 {
  width: 29%;
} */

.pt-2-space {
  padding-top: 5px;
}

.-top-px {
  top: -4px;
}
.max-h-650 {
  max-height: 650px;
}
.max-h-150 {
  max-height: 150px;
}
.expand_recipe {
  transform: rotate(180deg);
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
