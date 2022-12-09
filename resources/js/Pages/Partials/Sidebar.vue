<template>
    <button
        @click="showingModal = !showingModal"
        type="button"
        class="
            absolute
            top-6
            left-5
            border-gray-200
            text-gray-500
            focus:outline-none
            focus:ring-2 focus:ring-inset focus:ring-indigo-500
            lg:hidden
        "
    >
        <span class="sr-only">Open sidebar</span>
        <!-- Heroicon name: outline/menu-alt-2 -->
        <svg
            class="h-6 w-6"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true"
        >
            <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h7"
            />
        </svg>
    </button>
    <div class="flex bg-sidebar-color w-0 max-w-xxs lg:h-auto h-screen overflow-auto">
        <!-- Static sidebar for Mobile -->
        
        <div
            v-if="showingModal"
            :class="{ block: showingModal, hidden: !showingModal }"
            class="lg:hidden"
        >
            <div class="fixed inset-0 flex z-40">
                <div class="fixed inset-0" aria-hidden="true">
                    <div class="absolute inset-0 bg-gray-600 opacity-75"></div>
                </div>
                <div
                    class="
                        relative
                        flex-1 flex flex-col
                        max-w-xs
                        w-full
                        pt-5
                        pb-4
                        bg-sidebar-color
                    "
                >
                    <div class="absolute top-0 right-0 -mr-12 pt-2">
                        <button
                            @click="showingModal = !showingModal"
                            class="
                                ml-1
                                flex
                                items-center
                                justify-center
                                h-10
                                w-10
                                rounded-full
                                focus:outline-none
                                focus:ring-2 focus:ring-inset focus:ring-white
                            "
                        >
                            <span class="sr-only">Close sidebar</span>
                            <svg
                                class="h-6 w-6 icon-color"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
                    <div class="mt-5 flex-1 h-0 overflow-y-auto">
                        <nav class="space-y-1">
                            
                            <a
                                v-if="$page.props.isUserSuperAdmin"
                                href="#"
                                class="
                                    text-white
                                    pt-4
                                    group
                                    flex
                                    items-center
                                    px-2
                                    py-2
                                    text-lg
                                    font-bold
                                "
                            >
                                <!-- Heroicon name: outline/users -->
                                <svg
                                    class="mr-3 ml-3 h-6 w-6 icon-color"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                                Planning
                            </a>

                            <inertia-link
                                 
                                :href="route('calendars')"
                                :class="(route().current() == 'calendars')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Menu Planner
                            </inertia-link>

                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin"
                                :href="route('food-orders')"
                                :class="(route().current() == 'food-orders' )?'text-color-submenu group flex items-center pl-17 font-bold relative pb-6   active':'text-color-submenu group flex items-center pl-17 font-bold relative pb-6  '"
                            >
                                Food Orders
                            </inertia-link>
                            <a
                                href="#"
                                class="
                                    text-white
                                    group
                                    flex
                                    items-center
                                    px-2
                                    py-2
                                    font-bold
                                    rounded-md
                                    border-t border-color-menu
                                "
                            >
                                <!-- Heroicon name: outline/folder -->
                                <svg
                                    class="mr-3 ml-3 h-6 w-6 icon-color"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                    />
                                </svg>
                                Templates
                            </a>
                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin || $page.props.template_permission.includes('week_cycles')"
                                :href="route('week-cycles')"
                                :class="(route().current() == 'week-cycles' || route().current() == 'menu-cycle-add' || route().current() == 'menu-cycle-edit')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Week Cycles
                            </inertia-link>                            

                            <inertia-link v-if="$page.props.isUserSuperAdmin || $page.props.template_permission.includes('recipes')" :href="route('recipes')" :class="(route().current() == 'recipes' || route().current() == 'recipes-edit' || route().current() == 'recipes-add')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'">Recipes </inertia-link>                           

                            <inertia-link v-if="$page.props.isUserSuperAdmin || $page.props.template_permission.includes('ingredients')" :href="route('ingredients')" :class="(route().current() == 'ingredients' || route().current() == 'ingredients-edit' || route().current() == 'ingredients-add')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'">Ingredients </inertia-link>

                            <inertia-link v-if="$page.props.isUserSuperAdmin || $page.props.template_permission.includes('products')" :href="route('products')" :class="(route().current() == 'products' || route().current() == 'products_edit' || route().current() == 'products_add')?'active text-color-submenu group flex items-center pl-17 font-bold relative pb-6  ':'text-color-submenu group flex items-center pl-17 font-bold relative pb-6  '">Products </inertia-link>

                            <a
                                href="javascript:viod(0)"
                                class="
                                    text-white
                                    group
                                    flex
                                    items-center
                                    px-2
                                    py-2
                                    text-lg
                                    font-bold
                                    rounded-md
                                    border-t border-color-menu pt-4
                                "
                            >
                             
                            <svg class="mr-3 ml-3 h-6 w-5 icon-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path style="fill: #ffc919;" d="M507.6 122.8c-2.904-12.09-18.25-16.13-27.04-7.338l-76.55 76.56l-83.1-.0002l0-83.1l76.55-76.56c8.791-8.789 4.75-24.14-7.336-27.04c-23.69-5.693-49.34-6.111-75.92 .2484c-61.45 14.7-109.4 66.9-119.2 129.3C189.8 160.8 192.3 186.7 200.1 210.1l-178.1 178.1c-28.12 28.12-28.12 73.69 0 101.8C35.16 504.1 53.56 512 71.1 512s36.84-7.031 50.91-21.09l178.1-178.1c23.46 7.736 49.31 10.24 76.17 6.004c62.41-9.84 114.6-57.8 129.3-119.2C513.7 172.1 513.3 146.5 507.6 122.8zM80 456c-13.25 0-24-10.75-24-24c0-13.26 10.75-24 24-24s24 10.74 24 24C104 445.3 93.25 456 80 456z"/></svg>
                                
                                Tools
                            </a>
                            <inertia-link
                                :href="route('sizing-calculator')"
                                :class="(route().current() == 'sizing-calculator')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 '"
                            >
                               Sizing Calculator
                            </inertia-link>

                            <inertia-link
                                :href="route('group-meal-prep')"
                                :class="(route().current() == 'group-meal-prep')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 '"
                            >
                               Group Meal Prep
                            </inertia-link>

                            <a class="text-color-submenu group flex items-center pl-17 font-bold relative" href="https://www.menufreedom.com/client-dashboard/" target="_blank">Client Dashboard</a>

                            <a
                                href="#"
                                class="
                                    text-white
                                    group
                                    flex
                                    items-center
                                    px-2
                                    py-2
                                    text-lg
                                    font-bold
                                    rounded-md
                                    border-t border-color-menu pt-4
                                "
                            >
                                <!-- Heroicon name: outline/calendar -->
                                <svg
                                    class="mr-3 ml-3 h-6 w-6 icon-color"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                Settings
                            </a>                            

                            <inertia-link
                                :href="route('sites')"
                                :class="(route().current() == 'sites' || route().current() == 'add-site' || route().current() == 'edit-site')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Sites
                            </inertia-link>

                            <!-- <inertia-link
                                :href="route('groups')"
                                :class="(route().current() == 'groups' || route().current() == 'add-group' || route().current() == 'edit-group')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Groups
                            </inertia-link> -->
                            <inertia-link
                                :href="route('menu-creation-groups')"
                                :class="(route().current() == 'menu-creation-groups' || route().current() == 'add')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                               Menu Creation Group
                            </inertia-link>

                            <inertia-link
                                :href="route('meal-preparation-groups')"
                                :class="(route().current() == 'meal-preparation-groups' )?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                               Meal Preparation Group
                            </inertia-link>

                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin" :href="route('users')"
                                :class="(route().current() == 'users' || route().current() == 'add-user' || route().current() == 'edit-user')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Users
                            </inertia-link>

                            <inertia-link
                                :href="route('guidelines')"
                                :class="(route().current() == 'guidelines' || route().current() == 'add-guideline' || route().current() == 'edit-guideline')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Guidelines
                            </inertia-link> 

                            <inertia-link
                             
                                :href="route('setup')"
                                :class="(route().current() == 'setup')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Setup
                            </inertia-link> 

                            <inertia-link
                                 :href="route('help-states')"
                                 v-if="$page.props.is_master_tenant"
                                :class="(route().current() == 'help-states' || route().current() == 'add-help-state' || route().current() == 'edit-help-state')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Help States
                            </inertia-link>

                            <inertia-link
                                 :href="route('special-days')"
                                :class="(route().current() == 'special-days' || route().current() == 'add-special-days' )?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                               No Meal Service
                            </inertia-link>

                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin"
                                :href="route('product-categories')"
                                :class="(route().current() == 'product-categories' || route().current() == 'add-product-category' || route().current() == 'edit-product-category')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Product Categories
                            </inertia-link>

                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin"
                                :href="route('product-distributors')"
                                :class="(route().current() == 'product-distributors' || route().current() == 'add-product-distributor' || route().current() == 'edit-product-distributor')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Product Distributors
                            </inertia-link>                          

                            <inertia-link
                                :href="route('haccp-snippets')"
                                :class="(route().current() == 'haccp-snippets')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                HACCP Snippet
                            </inertia-link>
                        </nav>
                    </div>
                </div>
                <div class="flex-shrink-0 w-14" aria-hidden="true">
                    <!-- Dummy element to force sidebar to shrink to fit close icon -->
                </div>
            </div>
        </div>
        <!-- Static sidebar for Mobile -->

        <!-- Static sidebar for desktop -->
        <div class="hidden bg-sidebar-color lg:flex w-full desktop-sidebar">
            <div class="flex flex-col w-full">
                <!-- Sidebar component, swap this element with another sidebar if you like -->
                <div class="flex flex-col flex-grow pt-5 pb-4">
                    <div class="mt-5 flex-1 flex flex-col">
                        <nav class="flex-1 space-y-1">
                            <!-- Current: "bg-indigo-800 text-white", Default: "text-indigo-100 hover:bg-indigo-600" -->
                            

                            <a   
                                href="#"
                                class="
                                    text-white
                                    group
                                    flex
                                    items-center
                                    px-2
                                    py-2
                                    text-lg
                                    font-bold
                                "
                            >
                                <!-- Heroicon name: outline/users -->
                                <svg
                                    class="mr-3 ml-3 h-6 w-6 icon-color"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                                Planning
                            </a>
                            <inertia-link
                                 
                                :href="route('calendars')"
                                :class="(route().current() == 'calendars' || ((route().current() == 'menu-cycle-edit' || route().current() == 'menu-cycle-add') &&  guide_line_id != ''))  ?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Menu Planner
                            </inertia-link>

                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin"
                                :href="route('food-orders')"
                                :class="(route().current() == 'food-orders' )?'text-color-submenu group flex items-center pl-17 font-bold relative    active':'text-color-submenu group flex items-center pl-17 font-bold relative   '"
                            >
                                Food Orders
                            </inertia-link>
                            <a style="margin-top:20px !important;"
                                href="#"
                                class="
                                pt-4 border-t border-color-menu
                                    text-white
                                    group
                                    flex
                                    items-center
                                    px-2
                                    pb-2
                                    text-lg
                                    font-bold
                                    rounded-md
                                "
                            >
                                <!-- Heroicon name: outline/folder -->
                                <svg
                                    class="mr-3 ml-3 h-6 w-6 icon-color"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                    />
                                </svg>
                                Templates
                            </a>
                            <!-- v-if="$page.props.isUserSuperAdmin" -->
                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin || $page.props.template_permission.includes('week_cycles')"
                                :href="route('week-cycles')"
                                :class="(route().current() == 'week-cycles' || (route().current() == 'menu-cycle-add' || (route().current() == 'menu-cycle-edit')) &&  guide_line_id === '')  ? 'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Week Cycles
                            </inertia-link>

                            <inertia-link 
                            v-if="$page.props.isUserSuperAdmin || $page.props.template_permission.includes('recipes')" 
                            :href="route('recipes')" :class="(route().current() == 'recipes' || route().current() == 'recipes-edit' || route().current() == 'recipes-add')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Recipes 
                            </inertia-link>                           

                            <inertia-link
                            v-if="$page.props.isUserSuperAdmin || $page.props.template_permission.includes('ingredients')"  :href="route('ingredients')" :class="(route().current() == 'ingredients' || route().current() == 'ingredients-edit' || route().current() == 'ingredients-add')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Ingredients 
                            </inertia-link>

                            <inertia-link
                                :href="route('products')"
                                v-if="$page.props.isUserSuperAdmin || $page.props.template_permission.includes('products')" 
                                :class="(route().current() == 'products' || route().current() == 'products_edit' || route().current() == 'products_add' )?'text-color-submenu group flex items-center pl-17 font-bold relative    active':'text-color-submenu group flex items-center pl-17 font-bold relative '"
                            >
                                Products
                            </inertia-link>

                            <a
                            style="margin-top:20px !important;"
                                href="javascript:viod(0)"
                                class="
                                    text-white
                                    group
                                    flex
                                    items-center
                                    px-2
                                    py-2
                                    text-lg
                                    font-bold
                                    rounded-md
                                    border-t border-color-menu pt-4
                                    
                                "
                            >
                             
                            <svg class="mr-3 ml-3 h-6 w-5 icon-color" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path style="fill: #ffc919;" d="M507.6 122.8c-2.904-12.09-18.25-16.13-27.04-7.338l-76.55 76.56l-83.1-.0002l0-83.1l76.55-76.56c8.791-8.789 4.75-24.14-7.336-27.04c-23.69-5.693-49.34-6.111-75.92 .2484c-61.45 14.7-109.4 66.9-119.2 129.3C189.8 160.8 192.3 186.7 200.1 210.1l-178.1 178.1c-28.12 28.12-28.12 73.69 0 101.8C35.16 504.1 53.56 512 71.1 512s36.84-7.031 50.91-21.09l178.1-178.1c23.46 7.736 49.31 10.24 76.17 6.004c62.41-9.84 114.6-57.8 129.3-119.2C513.7 172.1 513.3 146.5 507.6 122.8zM80 456c-13.25 0-24-10.75-24-24c0-13.26 10.75-24 24-24s24 10.74 24 24C104 445.3 93.25 456 80 456z"/></svg>
                                
                                Tools
                            </a>
                            <inertia-link
                                :href="route('sizing-calculator')"
                                :class="(route().current() == 'sizing-calculator')?'active text-color-submenu group flex items-center pl-17 font-bold relative ':'text-color-submenu group flex items-center pl-17 font-bold relative  '"
                            >
                               Sizing Calculator
                            </inertia-link>

                            <inertia-link
                                :href="route('group-meal-prep')"
                                :class="(route().current() == 'group-meal-prep')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 '"
                            >
                               Group Meal Prep
                            </inertia-link>

                            <inertia-link
                                :href="route('food-production-report')"
                                :class="(route().current() == 'food-production-report')?'active text-color-submenu group flex items-center pl-17 font-bold relative ':'text-color-submenu group flex items-center pl-17 font-bold relative  '"
                            >
                               Food Production Report
                            </inertia-link>

                            <a class="text-color-submenu group flex items-center pl-17 font-bold relative" href="" target="_blank">Client Dashboard</a>                            

                            <a
                                v-if="$page.props.isUserSuperAdmin"
                                href="#"
                                style="margin-top:20px !important;"
                                class="
                                    text-white
                                    group
                                    flex
                                    items-center
                                    px-2
                                    py-2
                                    text-lg
                                    font-bold
                                    rounded-md
                                     border-t border-color-menu pt-4
                                "
                            >
                                <!-- Heroicon name: outline/calendar -->
                                <svg
                                    class="mr-3 ml-3 h-6 w-6 icon-color"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20"
                                    fill="currentColor"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                        clip-rule="evenodd"
                                    />
                                </svg>
                                Settings
                            </a>
                            
                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin"
                                :href="route('sites')"
                                :class="(route().current() == 'sites' || route().current() == 'add-site' || route().current() == 'edit-site')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Sites
                            </inertia-link>
                             <inertia-link
                             v-if="$page.props.isUserSuperAdmin"
                                :href="route('menu-creation-groups')"
                                :class="(route().current() == 'menu-creation-groups' || route().current() == 'menu-creation-groups.add' ||  route().current() == 'menu-creation-groups-edit')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                               Menu Creation Group
                            </inertia-link>

                            <inertia-link
                            v-if="$page.props.isUserSuperAdmin"
                                :href="route('meal-preparation-groups')"
                                :class="(route().current() == 'meal-preparation-groups' )?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                               Meal Preparation Group
                            </inertia-link>

                            <inertia-link

                                v-if="$page.props.isUserSuperAdmin" :href="route('users')"
                                :class="(route().current() == 'users' || route().current() == 'add-user' || route().current() == 'edit-user')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Users
                            </inertia-link>                            

                            <inertia-link
                            v-if="$page.props.isUserSuperAdmin"
                                :href="route('guidelines')"
                                :class="(route().current() == 'guidelines' || route().current() == 'add-guideline' || route().current() == 'edit-guideline')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Guidelines
                            </inertia-link>


                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin"
                                :href="route('setup')"
                                :class="(route().current() == 'setup')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Setup
                            </inertia-link>
                            
                            
                            <inertia-link
                                v-if="$page.props.is_master_tenant && $page.props.isUserSuperAdmin"
                                 :href="route('help-states')"
                                :class="(route().current() == 'help-states' || route().current() == 'add-help-state' || route().current() == 'edit-help-state')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Help States
                            </inertia-link>

                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin"
                                 :href="route('special-days')"
                                :class="(route().current() == 'special-days' || route().current() == 'add-special-days' )?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                No Meal Service
                            </inertia-link>

                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin"
                                :href="route('product-categories')"
                                :class="(route().current() == 'product-categories' || route().current() == 'add-product-category' || route().current() == 'edit-product-category')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Product Categories
                            </inertia-link>

                            <inertia-link
                                
                                v-if="$page.props.isUserSuperAdmin"
                                :href="route('product-distributors')"
                                :class="(route().current() == 'product-distributors' || route().current() == 'add-product-distributor' || route().current() == 'edit-product-distributor')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                Product Distributors
                            </inertia-link>

                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin"
                                :href="route('haccp-snippets')"
                                :class="(route().current() == 'haccp-snippets')?'active text-color-submenu group flex items-center pl-17 font-bold relative  pb-6 border-b border-color-menu':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                                HACCP Snippet
                            </inertia-link>
                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin"
                                :href="route('product-cn-excel-import')"
                                :class="(route().current() == 'product-cn-excel-import')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                            Excel Import CN24
                            </inertia-link>

                            <inertia-link
                                v-if="$page.props.isUserSuperAdmin"
                                :href="route('product-world-Sync-excel-import')"
                                :class="(route().current() == 'product-world-Sync-excel-import')?'active text-color-submenu group flex items-center pl-17 font-bold relative':'text-color-submenu group flex items-center pl-17 font-bold relative'"
                            >
                            Excel Import 1WorldSync
                            </inertia-link>
                            

                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    components: {},
    data() {
        return {
            log: console.log,
            showingModal: false,
            guide_line_id: '',
            permissions:[],
        };
    },
    mounted(){
        var urlParams = new URLSearchParams(window.location.search);
        if(urlParams.has('guide_line_id')){
            this.guide_line_id = urlParams.get('guide_line_id'); 
        } else {
            this.guide_line_id = '';
        }
    }
};
</script>
<style>
.bg-sidebar-color {
    background-color: #293b5a;
}

.icon-color {
    color: #ffc919;
}

.text-color-submenu {
    color: #cbcbcb;
}

.border-color-menu {
    border-color: #404f6a;
}

.arrow-color {
    color: #f7a53a;
}

.left-2 {
    left: 3.4rem;
}

.mt-5 {
    margin-top: 0.75rem;
}
@media (min-width:1024px) {
    .max-w-xxs {
        max-width: 275px;
        width: 100%;
    }
}
.pl-17 {
    padding-left: 4.2rem;
}
.active::before{
  content: "\f0da";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
    color: #f7a53a;
    font-size: 16px;
    position: absolute;
    top: -1px;
    left: 56px;
}
.desktop-sidebar{
    height: calc(100vh - 96px);
}
</style>
