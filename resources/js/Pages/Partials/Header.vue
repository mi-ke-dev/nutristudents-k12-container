<template>

    <header class="bg-blue-nutri flex items-center justify-between flex-wrap">
          <div class="md:w-auto w-2/4 relative py-5 px-6">
            <img class="logo" :src="$page.props.asset_url + '/vendor/nutristudents/image/logo.png'"> 
          </div>
          <div class="relative flex ml-auto">
            <div v-if="$page.props.is_master_tenant" class="text-white md:w-auto w-2/4 text-sm px-8 py-7 pr-0   flex items-center justify-between flex-wrap ml-auto mr-5">
            <!-- <inertia-link :href="route('update-tenant-data')" method="post" class="button-color text-white font-bold py-3 rounded px-4 md:mt-0 mt-4 whitespace-nowrap inline-block max-w-max" as="button">Push Updates</inertia-link> -->
              <a @click="pushUpdates()" class="button-color text-white font-bold py-3 rounded px-4 md:mt-0 mt-4 whitespace-nowrap inline-block max-w-max" href="javascript:void(0)" >Push Updates</a>
            </div>
            <div class="md:w-auto w-2/4 text-sm px-8 py-7 pr-0 bg-blue-second flex items-center justify-between flex-wrap ml-auto help_box" role="menu"  aria-labelledby="user-menu">
                <div class="flex items-center">
                    <span class="cursor-pointer flex items-center">
                      <i class="fa fa-question-circle mr-2 text-lg" aria-hidden="true" style="color:#ffc919;"></i>
                      <div class="text-white text-lg h-10 flex items-center border-r border-gray-500 pr-4">Help</div>
                    </span>
                    <div class="absolute py-5 px-8 bg-blue-second help_info">

                      <div v-if="help_data.youtube_id" class="mb-5">
                        <iframe width="100%" height="120" :src="help_data.youtube_id" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                      </div>
                      <!-- <div class="font-medium mb-2">Helpful Links</div>
                      <div class="flex flex-col space-y-1 pl-2">
                        <a href="#" class="underline">text</a>
                        <a href="#" class="underline">text</a>
                      </div> -->
                      <div v-if="help_data.content" v-html="help_data.content"></div>
                      <div class="w-full border-t border-gray-500 my-4"></div>
                      <div class="font-medium mb-2">Contact Us</div>
                      <div class="flex flex-col space-y-1 pl-2">
                        <a href="tel:8442042847" class="underline">(844)204-2847</a>
                        <a href="mailto:support@nutristudentsk-12.com" class="underline">support@nutristudentsk-12.com</a>
                      </div>
                    </div>
                </div>
            </div>
            <div class="md:w-auto w-2/4 text-sm px-8 pl-4 py-7 bg-blue-second flex items-center justify-between flex-wrap cursor-pointer relative user-menu" role="menu"  aria-labelledby="user-menu">
                <img v-if="profile_photo_path" :src="$page.props.storage_image_url +profile_photo_path">
                <span v-else class="h-10 w-10 rounded-full bg-icon text-center font-extrabold  text-white flex items-center justify-center mr-3">{{user_short_name}}</span>
                <h2 class="text-white text-lg md:mr-2 mr-0">{{ user_info.name }}</h2>
                <i class="fa fa-chevron-down" aria-hidden="true" style="color:#ffc919;"></i>
                <div class="absolute top-full right-0 left-0 bg-blue-second text-white text-lg py-1 pb-2 text-center z-10 sub-menu">
                      <inertia-link :href="route('logout')" method="post" as="button">Log Out</inertia-link>
                </div>
            </div>
          </div>

</header>
</template>

<script>



export default {

  data: function () {
    return {
      user_info: [],
      user_short_name:'',
      //profile_photo_path:'images/recipes/Uro3xI59QhLDh09Eu9kVEDGAf9nMKlD9AWmpxtDk.jpg',
      profile_photo_path:'',
      help_data:[],
    }
  },
  created() {
    console.log('route.name',this.route());
     axios.post('/user-info',{user_id:''})
                    .then((response)=>{
                       this.user_info = response.data;
                       this.profile_photo_path = this.user_info.profile_photo_path;
                       let short_name = this.user_info.name.split(" ");
                       this.user_short_name = short_name[0][0].toUpperCase() + short_name[short_name.length-1][0].toUpperCase();
                     })
                    .catch(error => console.error(error));


      var route = "";
      axios.post('/helpstate-info',{route_name:this.route().current()})
                    .then((response)=>{
                       this.help_data = response.data;
                       if(this.help_data.youtube_id != null){
                        this.help_data.youtube_id = "https://www.youtube.com/embed/" +this.help_data.youtube_id;
                       }
                       //console.log(this.help_data);
                     })
                    .catch(error => console.error(error));
  },
  methods: {
    pushUpdates() {
      this.$inertia.post(route('update-tenant-data'), {
        onFinish: () => this.$toast.success("Push Updates Successfully!"),
      });
    }
  },

  logout() {
      this.$inertia.post(route('logout'));
    },
}

</script>

<style>
.bg-blue-nutri {
  background-color: #365491;
}
.bg-blue-second{
    background-color: #29447e;
}
.bg-icon{
     background-color: #ffc919;
}

.help_info {
    top: 96px;
    right: 0;
    z-index: 99;
    color: #fff;
    width: 290px;
    opacity: 0;
    visibility: hidden;
    transition: all 0.35s;
}
.help_box:hover .help_info,.help_box:focus .help_info{
  opacity: 1;
    visibility: visible;
}
.sub-menu{
  opacity: 0;
  visibility: hidden;
  transition: all 0.35s;
  border-top: 1px solid #365491;
}
.user-menu:hover .sub-menu{
  opacity: 1;
  visibility: visible;
}


.id-color,.cart-color,.id-color-menu-edit,.menu1-text-color,.text-color-first-li {
    color: #0092d0 !important;
}

.button-color,.menu1-background-color {
    background-color: #39b54a !important;
}
.active::before,.products-edit-minus-color{
  color: #39b54a !important;
}
.arrow-color {
    color: #0092d0 !important;
}
.title_color {
    color: #0092d0 !important;
}
.bg-white.popup-shadow {
    top: 10px;
    right: 24px;
    padding: 6px 0;
    font-size: 14px;
    width: 170px;
}
.bg-white.popup-shadow li.text-black {
    line-height: normal;
    margin-bottom: 4px;
}
button.menu1-background-color.rounded-full {
    background: #ffc919;
}
button.lg\:w-1\/5.w-16.xl\:inline-flex.justify-center.rounded-md.font-bold.px-4.py-2.uppercase.menu1-background-color.text-white.focus\:outline-none.mr-3.sm\:mt-0.mt-2 {
    background-color: #39b54a !important;
}
div.select-menu-height,div.select-menu-height-edit2 {
    background-color: #39b54a !important;
}
.cancel-background-color {
    background-color: #6b7280 !important;
}
</style>
