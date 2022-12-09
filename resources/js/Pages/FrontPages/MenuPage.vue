<template>
  <Head>
  <title>Menu | NutriStudents K-12</title>
  <meta name="description" content="Menu">
  </Head>
  <div class="page_bg">
    <header class="bg-blue-nutri flex items-center justify-between flex-wrap">
      <div class="md:w-auto w-2/4 relative py-5 px-6">
        <img class="logo" :src="$page.props.asset_url + '/vendor/nutristudents/image/logo.png'">
      </div>
    </header>

    <div class="banner bg-black overflow-hidden flex justify-center items-center relative">
      <img class="opacity-70 h-full object-cover w-full" :src="$page.props.asset_url + '/vendor/nutristudents/image/turtle_rock-01.jpg'">
      <h1 class="absolute text-6xl font-bold text-gray-100 tracking-wide">Turtle Rock Elementary School</h1>
    </div>

    <div class="max-w-1665 m-auto -mt-28 w-11/12 pb-32">
        <div class="flex justify-end items-center px-5">
            <div class="w-full flex xl:flex-nowrap flex-wrap justify-end items-center bg-gray-200 drop-shadow-sm rounded-t-lg py-5 px-1">
                <div class="xl:w-2/5 w-full md:flex xl:flex-nowrap flex-wrap items-center">
                    <div class="text-2xl color-24 font-black pl-1 pr-2">
                        <i class="text-lg fa fa-chevron-left px-2" aria-hidden="true"></i>
                        <span class="text-3xl">April 2021</span>
                        <i class="text-lg fa fa-chevron-right px-2" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="xl:w-3/5 w-full xl:pl-12 pl-4 xl:pt-0 pt-6 flex md:flex-nowrap flex-wrap items-center xl:justify-end justify-start">
                    <div class="flex mr-8 space-x-5">
                        <a href="#" class="text-3xl text-blue"><i class="fa fa-calendar-o" aria-hidden="true"></i></a>
                        <a href="#" class="text-3xl text-blue"><i class="fa fa-calendar" aria-hidden="true"></i></a>
                    </div>
                    <div class="relative focus:outline-none lg:w-40 sm:w-1/2 w-full mr-3 md:mt-0 mt-4">
                        <select class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height">
                            <option>Lunch</option>
                        </select>
                        <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="relative focus:outline-none lg:w-40 sm:w-1/2 w-full mr-3 md:mt-0 mt-4">
                        <select class="shadow-sm focus:border-none block sm:text-sm border-gray-300 rounded-lg w-full select-menu-height">
                            <option>k-5</option>
                        </select>
                        <div class="absolute flex justify-center items-center searching-background-color select-menu-height w-9 text-white top-0 right-0 rounded-lg rounded-tl-none rounded-bl-none pointer-events-none">
                            <i class="fa fa-sort-desc" aria-hidden="true"></i>
                        </div>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 mr-3 arrow-color md:mt-0 mt-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 4v3H4a2 2 0 00-2 2v3a2 2 0 002 2h1v2a2 2 0 002 2h6a2 2 0 002-2v-2h1a2 2 0 002-2V9a2 2 0 00-2-2h-1V4a2 2 0 00-2-2H7a2 2 0 00-2 2zm8 0H7v3h6V4zm0 8H7v4h6v-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="relative overflow-x-auto">
            <table class="min-w-full shadow rounded-t-lg overflow-hidden table-background menu_table">
                <thead>
                    <tr class="searching-background-color rounded-t-lg border-b-2 border-gray-500">
                        <th scope="col" class="px-6 py-4 text-center text-2xl font-black text-white tracking-wider"> Monday </th>
                        <th scope="col" class="px-6 py-4 text-center text-2xl font-black text-white tracking-wider"> Tuesday </th>
                        <th scope="col" class="px-6 py-4 text-center text-2xl font-black text-white tracking-wider"> Wednesday </th>
                        <th scope="col" class="px-6 py-4 text-center text-2xl font-black text-white tracking-wider"> Thursday </th>
                        <th scope="col" class="px-6 py-4 text-center text-2xl font-black text-white tracking-wider"> Friday </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="shadow-sm">
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-50 cursor-not-allowed">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">29</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-full h-full">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-50 cursor-not-allowed">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">30</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-full h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-full h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/burger.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-50 cursor-not-allowed">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">31</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-full h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/burger.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/hot-dog.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-100">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">2</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <a href="javascript:void(0)"><img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'"></a>
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/burger.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/hot-dog.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/sandwich.jpg'">
                                        </div>
                                        <span class="w-16 h-16 rounded-full bg-blue-nutri absolute top-0 right-0 bottom-0 left-0 m-auto flex justify-center items-center font-black text-white text-2xl cursor-pointer">+3</span>
                                        <div class="item_info w-500 rounded-xl border border-blue absolute top-12 right-12 overflow-hidden bg-white z-10">
                                            <div class="flex flex-nowrap w-full">
                                                <div class="w-5/12 bg-gray-600">
                                                    <img class="w-full h-32 object-cover" :src="$page.props.asset_url + '/vendor/nutristudents/image/burger.jpg'">
                                                    <span class="uppercase text-sm arrow-color font-medium px-3 pt-4 flex w-full">ENTREE</span>
                                                    <ul class="mb-5">
                                                        <li class="text-xl text-white px-3">Beef Hotdog</li>
                                                    </ul>
                                                    <span class="uppercase text-sm arrow-color font-medium px-3 flex w-full">Sides</span>
                                                    <ul class="mb-5">
                                                        <li class="text-xl text-white px-3">Garden Salad</li>
                                                        <li class="text-xl text-white px-3">Sun Chips</li>
                                                    </ul>
                                                </div>
                                                <div class="w-7/12">
                                                    <div class="flex flex-col">
                                                        <h4 class="px-3 my-5 mb-3 uppercase text-blue text-xl font-black">Nutrition Facts</h4>
                                                        <table class="min-w-full divide-y divide-gray-200">
                                                            <tbody>
                                                                <!-- Odd row -->
                                                                <tr class="bg-white">
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xl font-medium text-gray-900">
                                                                        calories
                                                                    </td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-right text-xl">
                                                                        436
                                                                    </td>
                                                                </tr>

                                                                <!-- Even row -->
                                                                <tr class="bg-gray-100">
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xl font-medium text-gray-900">
                                                                        Sodium
                                                                    </td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-right text-xl">
                                                                        12gm
                                                                    </td>
                                                                </tr>
                                                                <!-- Odd row -->
                                                                <tr class="bg-white">
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xl font-medium text-gray-900">
                                                                        calories
                                                                    </td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-right text-xl">
                                                                        436
                                                                    </td>
                                                                </tr>

                                                                <!-- Even row -->
                                                                <tr class="bg-gray-100">
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xl font-medium text-gray-900">
                                                                        Sodium
                                                                    </td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-right text-xl">
                                                                        12gm
                                                                    </td>
                                                                </tr>
                                                                <!-- Odd row -->
                                                                <tr class="bg-white">
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xl font-medium text-gray-900">
                                                                        calories
                                                                    </td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-right text-xl">
                                                                        436
                                                                    </td>
                                                                </tr>

                                                                <!-- Even row -->
                                                                <tr class="bg-gray-100">
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xl font-medium text-gray-900">
                                                                        Sodium
                                                                    </td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-right text-xl">
                                                                        12gm
                                                                    </td>
                                                                </tr>
                                                                <!-- Odd row -->
                                                                <tr class="bg-white">
                                                                    <td class="px-3 py-2 whitespace-nowrap text-xl font-medium text-gray-900">
                                                                        calories
                                                                    </td>
                                                                    <td class="px-3 py-2 whitespace-nowrap text-right text-xl">
                                                                        436
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex justify-center items-center px-3 py-2 bg-blue-nutri text-white">
                                                <i class="fa fa-chevron-left px-5 cursor-pointer" aria-hidden="true"></i>
                                                <ul class="flex justify-center items-center space-x-2">
                                                    <li>
                                                        <span class="flex justify-center items-center w-8 h-8 rounded-full bg-blue-500 text-white">1</span>
                                                    </li>
                                                    <li>
                                                        <a href="#" class="flex justify-center items-center w-8 h-8 hover:bg-blue-500 rounded-full text-white">2</a>
                                                    </li>
                                                </ul>
                                                <i class="fa fa-chevron-right px-5 cursor-pointer" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-100">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">1</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-full h-full">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr class="shadow-sm">
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-100">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">5</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-full h-full">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-100">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">6</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-full h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-full h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/burger.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-100">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">7</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-full h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/burger.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/hot-dog.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-100">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">8</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/burger.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/hot-dog.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/sandwich.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-100">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">9</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-full h-full">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr class="shadow-sm">
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-100">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">12</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-full h-full">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pb-2">
                            <div class="pt-7 pb-9 pr-4 pl-12 relative no-school">
                                <div class="opacity-50">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">13</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="no_item p-2 w-full h-full flex justify-center items-center">
                                            <div class="w-full text-center">
                                                <img class="mx-auto mb-3" :src="$page.props.asset_url + '/vendor/nutristudents/image/no-school.png'">
                                                <span>No School</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-100">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">14</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-full h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/burger.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/hot-dog.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-100">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">15</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/burger.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/hot-dog.jpg'">
                                        </div>
                                        <div class="menu_item_inner p-2 w-1/2 h-1/2">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/sandwich.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="pb-2">
                            <div class="bg-white pt-7 pb-9 pr-4 pl-12 relative">
                                <div class="opacity-100">
                                    <div class="date absolute top-6 left-4 font-bold text-lg">16</div>
                                    <div class="menu_item -m-2 flex flex-wrap h-72 relative">
                                        <div class="menu_item_inner p-2 w-full h-full">
                                            <img class="w-full h-full object-cover border border-gray-200" :src="$page.props.asset_url + '/vendor/nutristudents/image/Gluten-Free-Pizza.jpg'">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

<!-- <carousel :items-to-show="1.5"> -->
        <carousel  :items-to-show="1.8" :wrap-around="false">
            <slide v-for="slide in 10" :key="slide">
                <div class="carousel__item">
                    <div class="bg-blue-nutri rounded-t-lg w-full flex justify-center text-2xl text-white text-center py-2">
                        Thursday, April 8
                    </div>
                    <img class="product_img" :src="'https://placeimg.com/1200/800/any?'+slide">
                    <div class="products_info sm:flex w-full py-6 px-12 text-left">
                        <div class="w-full border-r border-gray-600 pr-10">
                            <div class="arrow-color uppercase text-base font-semibold">Today's Entrees</div>
                            <ul class="mt-1 text-gray-300 underline">
                                <li><a href="">Beef Hotdog</a></li>
                                <li><a href="">Hamburger Pizza</a></li>
                                <li><a href="">Burger</a></li>
                            </ul>
                        </div>
                        <div class="w-full px-10">
                            <div class="arrow-color uppercase text-base font-semibold">Entree1</div>
                            <ul class="mt-1 mb-4 text-white text-xl">
                                <li>Beef Hotdog</li>
                            </ul>
                            <div class="arrow-color uppercase text-base font-semibold">Entree1</div>
                            <ul class="mt-1 mb-4 text-white text-xl">
                                <li>Hamburger Pizza</li>
                                <li>Burger</li>
                            </ul>
                        </div>
                        <div class="w-full">
                            <div class="arrow-color uppercase text-base font-semibold">Nutrition Facts</div>
                            <table class="w-full">
                                <tr>
                                    <td class="p-1 text-left text-white">Calories</td>
                                    <td class="p-1 text-right text-white">436</td>
                                </tr>
                                <tr class="bg-gray">
                                    <td class="p-1 text-left text-white">Calories</td>
                                    <td class="p-1 text-right text-white">436</td>
                                </tr>
                                <tr>
                                    <td class="p-1 text-left text-white">Calories</td>
                                    <td class="p-1 text-right text-white">436</td>
                                </tr>
                                <tr class="bg-gray">
                                    <td class="p-1 text-left text-white">Calories</td>
                                    <td class="p-1 text-right text-white">436</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </slide>
            <template #addons>
                <div class="pagination">
                    <navigation />
                </div>
                <!-- <pagination /> -->
            </template>
        </carousel>

    </div>

  </div>
</template>

<script>
import 'vue3-carousel/dist/carousel.css';
import { Carousel, Slide, Pagination, Navigation } from 'vue3-carousel';

export default {
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  data: () => ({
    settings: {
      snapAlign: 'center',
    }
  }),
};
</script>

<style>
@import 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css';
@import 'https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;0,700;0,900;1,400&display=swap';
body{
        font-family: 'Lato', sans-serif !important;
}
.color-24 {
    color: #636363;
}
.pagination button {
    background: #38558e;
}
.carousel__viewport {
    overflow: hidden;
    padding: 15px 0;
}
li.carousel__slide.carousel__slide--visible {
    transform: scale(1.02);
    z-index: 99;
    box-shadow: 0 0 10px #00000080;
    border-radius: 0.5rem;
}
li.carousel__slide.carousel__slide--visible .products_info {
    border-bottom-width: 10px;
}
</style>
<style scoped>
.bg-blue-nutri {
    background-color: #365491;
}
.border-blue{
    border-color: #365491;
}
.banner{
    height: 580px;
}
.banner img{
    object-position: top center;
}
.banner h1 {
    text-shadow: 4px 4px 1px #000;
}
i.text-xl {
    font-size: 1.25rem;
    line-height: 1.75rem;
}
.searching-background-color {
    background-color: #38558e;
}
.select-menu-height {
    height: 2.3rem;
}
.arrow-color {
    color: #f7a53a;
}
.max-w-1665{
    max-width: 1665px;
}
.text-blue{
  color: #355497;
}
.menu_table th,.menu_table td{
    width: 100%;
    max-width: 20%;
}
.page_bg{
   background: #e2e2e2;
}
.bg-gray-600{
    background: #3f3f3f;
}
.w-500{
    width: 500px;
}


.carousel__slide > .carousel__item {
  width: 100%;
}
.carousel__slide > .carousel__item::before {
    content: '';
    background: #fff;
    opacity: 0.4;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: 0.5rem;
}
.carousel__slide--visible > .carousel__item::before {
  display: none;
}
.carousel__item img{
    height: 550px;
    object-fit: cover;
    width: 100%;
}
.products_info{
    background: #3f3f3f;
    border-bottom: 5px solid #3e568d;
    border-radius:0 0 0.5rem 0.5rem;
}
.bg-gray{
    background: #515151;
}
.no-school{
    background: #f2f2f2;
}

</style>
