<template>
  <Head>
    <title>{{ user.name }} - Edit User | NutriStudents K-12</title>
    <meta name="description" content="Edit User" />
  </Head>
  <default-layout>
    <BreadcrumLayout>
      <div class="flex">
        <!-- <a href="#" class="link-color"> --><U>Settings</U
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
        <inertia-link :href="route('users')" class="link-color"
          ><U>Users</U></inertia-link
        >
      </div>
    </BreadcrumLayout>

    <form action="#" @submit.prevent="false">
      <PageTitleLayout>
        <div class="lg:mb-0 mb-4 w-4/6">
          <h1 class="heading-color 2xl:text-2xl text-xl font-bold">
            {{ user.name }}
          </h1>
        </div>
        <div
          class="
            w-full
            flex
            lg:flex-nowrap
            flex-wrap
            md:justify-end
            items-center
          "
        >
          <button type="button">
            <inertia-link
              :href="route('users')"
              class="
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
              "
              >Cancel</inertia-link
            >
          </button>

          <button
            type="button"
            @click="user_edit_save_script"
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
            "
          >
            Update
          </button>
        </div>
      </PageTitleLayout>

      <PageTitleLayout>
        <div class="w-full">
          <div
            class="
              block
              justify-between
              shadow
              py-8
              mt-4
              align-middle
              inline-block
              min-w-full
              bg-white
              rounded-t-lg
              lg:divide-y-2
              border-gray-300
              w-full
              overflow-x-auto
            "
          >
            <div class="w-full">
              <div class="xl:flex block xl:items-center p-5">
                <label
                  class="
                    font-bold
                    text-gray-700
                    2xl:text-lg
                    text-base
                    w-full
                    md:w-40
                  "
                  >Name*</label
                >
                <div>
                  <input
                    type="text"
                    id="user_name"
                    name="user_name"
                    v-model="form.user_name"
                    class="
                      2xl:text-base
                      text-sm text-gray-400
                      xl:mt-0
                      mt-4
                      2xl:w-80
                      xl:w-80
                      w-60
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
                    v-if="form.errors.user_name"
                    class="validation_error_msg"
                  >
                    {{ form.errors.user_name }}
                  </div>
                </div>
              </div>
            </div>
            <div class="w-full">
              <div class="xl:flex block xl:items-center p-5">
                <label
                  class="
                    font-bold
                    text-gray-700
                    2xl:text-lg
                    text-base
                    w-full
                    md:w-40
                  "
                  >Type*</label
                >
                <div>
                  <div
                    class="
                      relative
                      pl-0
                      2xl:w-80
                      xl:w-80
                      w-72
                      xl:mt-0
                      mt-4
                      2xl:text-lg
                      text-xs text-gray-400
                    "
                  >
                    <select
                      id="user_type"
                      name="user_type"
                      autocomplete=""
                      v-model="form.user_type"
                      class="
                        sm:text-sm
                        text-xs
                        shadow-sm
                        focus:border-color
                        block
                        border-gray-300
                        rounded-lg
                        w-full
                        select-menu-height-edit2
                        input-background
                        text-gray-500
                      "
                    >
                      <option value="">Select</option>
                      <option value="User">User</option>
                      <option value="Super Admin">Super Admin</option>
                    </select>
                    <div
                      class="
                        absolute
                        flex
                        justify-center
                        items-center
                        searching-background-color
                        select-menu-height-edit2
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
                    v-if="form.errors.user_type"
                    class="validation_error_msg"
                  >
                    {{ form.errors.user_type }}
                  </div>
                </div>
              </div>
            </div>
            <div class="w-full">
              <div class="xl:flex block p-5">
                <label
                  class="
                    font-bold
                    text-gray-700
                    2xl:text-lg
                    text-base
                    w-full
                    md:w-40
                    mt-2
                  "
                  >Email Address*</label
                >
                <input
                  type="text"
                  id="user_email"
                  name="user_email"
                  v-model="form.user_email"
                  disabled="disabled"
                  class="
                    2xl:text-base
                    text-sm text-gray-400
                    xl:mt-0
                    mt-4
                    2xl:w-80
                    xl:w-80
                    w-60
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
              </div>
            </div>
          </div>
        </div>
      </PageTitleLayout>
       <div class=" lg:flex items-center leading-3 xl:px-10 px-5 mt-10 w-full"><div class="   w-full"><h1 class="heading-color 2xl:text-2xl text-xl font-bold">Permissions</h1></div> </div> 
    
      <header
        class="
          mx-8 searching-background-color flex justify-between items-center py-2 pl-6 shadow overflow-hidden rounded-t-lg mt-5
        "
      >
         
        <h2 class="text-white text-lg font-bold w-11/12">Templates</h2>
     
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
                      Type
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
                      Access
                    </th>
                  </tr>
                </thead>

                <tbody>
                  <!-- Odd row -->

                   

                  <tr v-for="(vals , keys) in permission_templates" >
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-base text-color
                        td-background-color
                      "
                    >
                      {{ vals }}
                    </td>

                    <td
                      class="
                        px-6
                        py-3
                        whitespace-nowrap
                        text-sm text-gray-500 text-left  
                      "
                    >
                    
                    <input
                        type="checkbox"
                        v-model="form['templates'][keys]"
                        :value="true" 
                      />
                    </td>
                    
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Menu Planing -->
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
        <h2 class="text-white text-lg font-bold w-11/12">Menu Planning</h2>

        <a href="javascript:void(0)" @click="addUserSiteModalOpen('menu_planings')">
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
                      SITE/GROUP NAME
                    </th>

                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-center text-base
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
                        text-center text-base
                        font-bold
                        text-black-800
                        uppercase
                        tracking-wider
                      "
                    > 
                    </th>                  
                  </tr>
                </thead>

                <tbody>
                  <!-- Odd row -->

                  <tr v-if="form.menu_planings.length == 0 && form.menu_planings_group.length == 0" class="bg-white">
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-base text-color text-center
                      "
                      colspan="3"
                    >
                      No Attached Sites Found!
                    </td>
                  </tr>


                  <tr 
                    v-for="(user_site, index) in form.menu_planings_group"
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
                    {{ user_site.name }}
                      
                    </td>

                    <td
                      class="
                        px-3
                        py-3
                        whitespace-nowrap
                        text-sm text-gray-500 text-center
                      "
                    >
                       -
                    </td>
                    
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        id-color
                        text-xl text-center
                        font-extrabold
                      "
                    >
                      <button
                        type="button"
                        @click="addUserGroupDeleteScript(user_site.id, index, 'menu_planings')"
                        class=""
                      >
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                    </td>
                  </tr>

                  <tr 
                    v-for="(user_site, index) in form.menu_planings"
                    :class="{
                      'bg-white': (index +form.menu_planings_group.length) % 2 == 0,
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
                    {{ user_site.site.name }}
                      
                    </td>

                    <td
                      class="
                        px-3
                        py-3
                        whitespace-nowrap
                        text-sm text-gray-500 text-center
                      "
                    >
                       {{ user_site.name }}
                    </td>
                    
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        id-color
                        text-xl text-center
                        font-extrabold
                      "
                    >
                      <button
                        type="button"
                        @click="addUserSiteDeleteScript(user_site.id, index, 'menu_planings')"
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
      </div>


      <!-- HeadCounts -->
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
        <h2 class="text-white text-lg font-bold w-11/12">Headcounts</h2>

        <a href="javascript:void(0)" @click="addUserSiteModalOpen('headcounts')">
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
                      SITE NAME
                    </th>

                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-center text-base
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
                        text-center text-base
                        font-bold
                        text-black-800
                        uppercase
                        tracking-wider
                      "
                    > 
                    </th>

                  
                  </tr>
                </thead>

                <tbody>
                  <!-- Odd row -->

                  <tr v-if="!form.headcounts.length" class="bg-white">
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-base text-color text-center
                      "
                      colspan="3"
                    >
                      No Attached Sites Found!
                    </td>
                  </tr>

                  <tr
                    v-else
                    v-for="(user_site, index) in form.headcounts"
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
                    {{ user_site.site.name }}
                      
                    </td>

                    <td
                      class="
                        px-3
                        py-3
                        whitespace-nowrap
                        text-sm text-gray-500 text-center
                      "
                    >
                       {{ user_site.name }}
                    </td>
                    
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        id-color
                        text-xl text-center
                        font-extrabold
                      "
                    >
                      <button
                        type="button"
                        @click="addUserSiteDeleteScript(user_site.id, index, 'headcounts')"
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
      </div>


      <!-- food_preparation -->
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
        <h2 class="text-white text-lg font-bold w-11/12">Food Preparation</h2>

        <a href="javascript:void(0)" @click="addUserSiteModalOpen('food_preparation')">
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
                      SITE/GROUP NAME
                    </th>

                    <th
                      scope="col"
                      class="
                        px-6
                        py-3
                        text-center text-base
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
                        text-center text-base
                        font-bold
                        text-black-800
                        uppercase
                        tracking-wider
                      "
                    > 
                    </th>

                  
                  </tr>
                </thead>

                <tbody>
                  <!-- Odd row -->

                  <tr v-if="form.food_preparation.length == 0 && form.food_preparation_group == 0" class="bg-white">
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-base text-color text-center
                      "
                      colspan="3"
                    >
                      No Attached Groups/Sites Found!
                    </td>
                  </tr>

                  <tr 
                    v-for="(user_site, index) in form.food_preparation_group"
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
                    {{ user_site.name }}
                      
                    </td>

                    <td
                      class="
                        px-3
                        py-3
                        whitespace-nowrap
                        text-sm text-gray-500 text-center
                      "
                    >
                       -
                    </td>
                    
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        id-color
                        text-xl text-center
                        font-extrabold
                      "
                    >
                      <button
                        type="button"
                        @click="addUserGroupDeleteScript(user_site.id, index, 'food_preparation')"
                        class=""
                      >
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </button>
                    </td>
                  </tr>

                  <tr
                    
                    v-for="(user_site, index) in form.food_preparation"
                    :class="{
                      'bg-white': (index +form.food_preparation_group.length) % 2 == 0,
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
                    {{ user_site.site.name }}
                      
                    </td>

                    <td
                      class="
                        px-3
                        py-3
                        whitespace-nowrap
                        text-sm text-gray-500 text-center
                      "
                    >
                       {{ user_site.name }}
                    </td>
                    
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        id-color
                        text-xl text-center
                        font-extrabold
                      "
                    >
                      <button
                        type="button"
                        @click="addUserSiteDeleteScript(user_site.id, index, 'food_preparation')"
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
      </div>

      <!-- add site section  -->

      

      <div
        class="
          w-full
          flex
          lg:flex-nowrap
          flex-wrap
          justify-end
          items-center
          mb-6
          px-10
          mt-6
        "
      >
        <button type="button">
          <inertia-link
            :href="route('users')"
            class="
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
            "
            >Cancel</inertia-link
          >
        </button>

        <button
          type="button"
          @click="user_edit_save_script"
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
          Update
        </button>
      </div>
    </form>
  </default-layout>

  <!-- user add site modal -->
  <jet-dialog-modal :show="addSitesModal" @close="addSitesModal = false">
    <template #title>
      <div class="flex justify-between items-center">
        Search Sites to Add/Attach with User
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
            name="search_site_term"
            placeholder="Search"
            v-model="search_site_term"
            v-on:keyup.enter="siteSearchScriptModal" 
          />
          <button
            type="button"
            class="absolute right-0 top-0 mt-2 mr-4 outline-none"
            @click="siteSearchScriptModal"
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
            <div class="shadow overflow-x-auto">
              <table class="min-w-full" v-if="searchType != 'headcounts'">
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
                      GROUP NAME
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
                      &nbsp;
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
                  <tr v-if="!searched_groups.length" class="bg-white">
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-base text-color text-center
                      "
                      colspan="3"
                    >
                      No Groups Available!
                    </td>
                  </tr>

                  <tr
                    v-for="(site, index) in searched_groups"
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
                     {{ site.name }}
                      
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
                     &nbsp;
                      
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
                        @click="addUserGroupAddScript(site, index)"
                        class=""
                      >
                        <i class="fa fa-plus pr-3" aria-hidden="true"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <table class="min-w-full mt-5">
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
                      SITE NAME
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
                      Offering name
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
                  <tr v-if="!searched_sites.length" class="bg-white">
                    <td
                      class="
                        px-6
                        py-4
                        whitespace-nowrap
                        text-base text-color text-center
                      "
                      colspan="7"
                    >
                      No Site Available!
                    </td>
                  </tr>

                  <tr
                    v-for="(site, index) in searched_sites"
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
                     {{ site.site.name }}
                      
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
                     {{ site.name }}
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
                        @click="addUserSiteAddScript(site, index)"
                        class=""
                      >
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
      <jet-secondary-button @click="addSitesModal = false"
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

export default {
  props: ["user", "user_sites_data", "user_groups_data", 'permission_templates', 'templates', 'menu_planings', 'food_preparation', 'headcounts', 'menu_planings_group', 'food_preparation_group'],
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
  },

  data() {
    return {
      addSitesModal: false,
      addGroupsModal: false,

      searchType:'',
      excludeOfferIds:[],

      user_sites: this.user_sites_data,
      user_groups: this.user_groups_data,

      search_site_term: "",
      searched_sites: [],

      search_group_term: "",
      searched_groups: [],

      site_permission_check: [],
      group_permission_check: [],
      user_templates: this.templates,

      form: this.$inertia.form({
        user_name: this.user.name,
        user_type: this.user.type,
        user_email: this.user.email,
        templates: this.templates,
        menu_planings: this.menu_planings,
        menu_planings_group: this.menu_planings_group,
        food_preparation_group: this.food_preparation_group,
        headcounts: this.headcounts,
        food_preparation: this.food_preparation,
        attached_sites: [],
        attached_groups: [],
      }),
    };
  },

  mounted() {
  },

  methods: {
    user_edit_save_script() {
      this.form.attached_sites = this.user_sites;
      this.form.attached_groups = this.user_groups;

      this.form.post(this.route("edit-user-save", this.user.id), {
        onSuccess: () => {
          this.$toast.success("User updated successfully!");
        },
      });
    },

    addUserSiteModalOpen(sType) {
      this.addSitesModal = true;
      this.searchType = sType;
      this.excludeOfferIds = [];
      this.searched_groups = [];
      this.search_site_term = "";
      this.searched_sites = [];
      this.getExcludeIds();
      this.siteSearchScriptModal();

    },

    getExcludeIds(){
      this.excludeOfferIds = [];
      let $this = this;
      if(this.searchType == 'menu_planings' ){
        if(this.form.menu_planings.length > 0){
          this.form.menu_planings.forEach(function (arrayItem) {
            console.log("arrayItem", arrayItem);
              $this.excludeOfferIds.push(arrayItem.id);
          });
        }  

        //menu_planings_group
        if(this.form.menu_planings_group.length > 0){
          this.form.menu_planings_group.forEach(function (arrayItem) {
            console.log("arrayItem", arrayItem);
              $this.excludeOfferIds.push(arrayItem.id);
          });
        }
      }

      if(this.searchType == 'headcounts' ){
        if(this.form.headcounts.length > 0){
          this.form.headcounts.forEach(function (arrayItem) {
            console.log("arrayItem", arrayItem);
              $this.excludeOfferIds.push(arrayItem.id);
          });
        }        
      }

      if(this.searchType == 'food_preparation' ){
        if(this.form.food_preparation.length > 0){
          this.form.food_preparation.forEach(function (arrayItem) {
            console.log("arrayItem", arrayItem);
              $this.excludeOfferIds.push(arrayItem.id);
          });
        }
        
        if(this.form.food_preparation_group.length > 0){
          this.form.food_preparation_group.forEach(function (arrayItem) {
            console.log("arrayItem", arrayItem);
              $this.excludeOfferIds.push(arrayItem.id);
          });
        }
        
        
      }

      console.log("excludeOfferIds", this.excludeOfferIds);
    },

    hideShowLoader(types) {
      if (types == "show") {
        document.getElementById("full_loader").style.display = "flex";
      } else {
        document.getElementById("full_loader").style.display = "none";
      }
    },

    siteSearchScriptModal() { 
      let $this = this;
        this.getExcludeIds();
         this.hideShowLoader('show');
        let exist_sites = this.excludeOfferIds; 
        if(this.searchType != 'headcounts'){
          axios 
            .post("/search-groups", {
              term: this.search_site_term,
              ex_ids: exist_sites,
              searchType: this.searchType
            })
            .then((response) => {
              $this.searched_groups = response.data; 
            })
            .catch((error) => console.error(error)); 
        }
        axios 
          .post("/search-offerings", {
            term: this.search_site_term,
            ex_ids: exist_sites,
          })
          .then((response) => {
            $this.searched_sites = response.data;
            $this.hideShowLoader('hide');
          })
          .catch((error) => console.error(error)); 
        //search-groups
      
        
    },

    addUserGroupAddScript(site_array, index) 
    {      
      if(this.searchType == 'menu_planings' ){
        this.searched_groups.splice(index, 1);
        this.form.menu_planings_group.push(site_array);
      }

      if(this.searchType == 'food_preparation' ){
        this.searched_groups.splice(index, 1);
        this.form.food_preparation_group.push(site_array);
      }
    },

    addUserSiteAddScript(site_array, index) {
      this.searched_sites.splice(index, 1);
      if(this.searchType == 'menu_planings' ){
        this.form.menu_planings.push(site_array);
      }

      if(this.searchType == 'headcounts' ){
        this.form.headcounts.push(site_array);
      }

      if(this.searchType == 'food_preparation' ){
        this.form.food_preparation.push(site_array);
      }
    },

    addUserGroupDeleteScript(site_id, index, type) {
      if(type == 'menu_planings' ){
        this.form.menu_planings_group.forEach((value, index) => {
          if (site_id == value["id"]) {
            this.form.menu_planings_group.splice(index, 1);
          }
        });
      }

      if(type == 'food_preparation' ){
        this.form.food_preparation_group.forEach((value, index) => {
          if (site_id == value["id"]) {
            this.form.food_preparation_group.splice(index, 1);
          }
        });
      }
      
    },

    addUserSiteDeleteScript(site_id, index, type) {
      if(type == 'menu_planings' ){
        this.form.menu_planings.forEach((value, index) => {
          if (site_id == value["id"]) {
            this.form.menu_planings.splice(index, 1);
          }
        });
      }

      if(type == 'headcounts' ){
        this.form.headcounts.forEach((value, index) => {
          if (site_id == value["id"]) {
            this.form.headcounts.splice(index, 1);
          }
        });
      }

      if(type == 'food_preparation' ){
        this.form.food_preparation.forEach((value, index) => {
          if (site_id == value["id"]) {
            this.form.food_preparation.splice(index, 1);
          }
        });
      }
      
    },

     
  }
};
</script>
<style>
.min-height-third {
  min-height: 400px;
}

.sm\:text-sm {
  font-size: 0.85rem;
  line-height: 1.25rem;
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
</style>