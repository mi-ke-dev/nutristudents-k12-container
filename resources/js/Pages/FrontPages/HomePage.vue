<template>
  <Head>
  <title>Home | NutriStudents K-12</title>
  <meta name="description" content="Home">
  </Head>
  <div class="page_bg">
    <header class="bg-blue-nutri flex items-center justify-between flex-wrap">
      <div class="md:w-auto w-2/4 relative py-5 px-6">
        <img class="logo" :src="$page.props.asset_url + '/vendor/nutristudents/image/logo.png'">
      </div>
    </header>

    <div class="banner bg-black overflow-hidden flex justify-center items-center relative">
      <img class="opacity-70 h-full object-cover w-full" :src="$page.props.asset_url + '/vendor/nutristudents/image/turtle_rock-01.jpg'">
      <h1 class="absolute text-6xl font-bold text-gray-100 tracking-wide">Welcome to NutriStudents K-12</h1>
    </div>

    <div class="max-w-1665 m-auto mt-20 w-11/12 pb-20">

       <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
       <br>
       <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?</p>
       <br>
       <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.</p>

    </div>

    <!-- <div class="groups w-11/12 pb-20">
    <div class="group">
      <Container group-name="1" :get-child-payload="getChildPayload1" @drop="onDrop('items1', $event)" @dragenter="checkDrop" @dragover="checkDrop" :should-accept-drop="shouldAcceptDrop" @drop-ready="onDropReady">
        <Draggable v-for="item in items1" :key="item.id">
          <div class="draggable-item drag_style">
            {{item.data}}
          </div>
        </Draggable>
      </Container>
    </div>
    <div class="group">
      <Container group-name="1" :get-child-payload="getChildPayload2" @drop="onDrop('items2', $event)">
        <Draggable v-for="item in items2" :key="item.id">
          <div class="draggable-item drag_style">
            {{item.data}}
          </div>
        </Draggable>
      </Container>
    </div>
    <div class="group">
      <Container group-name="1" :get-child-payload="getChildPayload3" @drop="onDrop('items3', $event)">
        <Draggable v-for="item in items3" :key="item.id">
          <div class="draggable-item drag_style">
            {{item.data}}
          </div>
        </Draggable>
      </Container>
    </div>
    <div class="group">
      <Container group-name="1" :get-child-payload="getChildPayload4" @drop="onDrop('items4', $event)">
        <Draggable v-for="item in items4" :key="item.id">
          <div class="draggable-item drag_style">
            {{item.data}}
          </div>
        </Draggable>
      </Container>
    </div>
  </div> -->

  </div>

</template>

<script>
// import { Container, Draggable, smoothDnD } from 'vue-dndrop';
// import { applyDrag, generateItems } from '../../utils/helpers';
// export default {
//   name: 'Groups',
//   components: {Container, Draggable},
//   data () {
//     return {
//       items1: this.generateItems(15, i => ({
//         id: '1' + i,
//         data: `Draggable 1 - ${i}`
//       })),
//       items2: this.generateItems(15, i => ({
//         id: '2' + i,
//         data: `Draggable 2 - ${i}`
//       })),
//       items3: this.generateItems(15, i => ({
//         id: '3' + i,
//         data: `Draggable 3 - ${i}`
//       })),
//       items4: this.generateItems(15, i => ({
//         id: '4' + i,
//         data: `Draggable 3 - ${i}`
//       }))
//     }
//   },
//   methods: {

//     checkDrop(){
//      Event.preventDefault();
//     },

//     shouldAcceptDrop (sourceContainerOptions, payload) {
//       return true;
//     },

//     onDrop (collection, dropResult) {
//       alert('yes');
//       console.log(dropResult);
//       //this[collection] = this.applyDrag(this[collection], dropResult)
//     },
//     getChildPayload1 (index) {
//       console.log('getChildPayload1', index);
//       return this.items1[index]
//     },
//     getChildPayload2 (index) {
//      console.log('getChildPayload2', index);
//       return this.items2[index]
//     },
//     getChildPayload3 (index) {
//         console.log('getChildPayload3', index);
//       return this.items3[index]
//     },
//     getChildPayload4 (index) {
//         console.log('getChildPayload4', index);
//       return this.items4[index]
//     },

//    onDropReady(dropResult) {
//       console.log('drop ready', dropResult)
//     },

// applyDrag(arr, dragResult) {
//   const { removedIndex, addedIndex, payload } = dragResult
//   if (removedIndex === null && addedIndex === null) return arr

//   const result = [...arr]
//   let itemToAdd = payload

//   if (removedIndex !== null) {
//     itemToAdd = result.splice(removedIndex, 1)[0]
//   }

//   if (addedIndex !== null) {
//     result.splice(addedIndex, 0, itemToAdd)
//   }

//   return result
// },

// generateItems(count, creator) {
//   const result = []
//   for (let i = 0; i < count; i++) {
//     result.push(creator(i))
//   }
//   return result
// },

//   }
// }

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
</style>
<style scoped>
.bg-blue-nutri {
    background-color: #365491;
}
.border-blue{
    border-color: #365491;
}
.banner{
    height: 300px;
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

  .groups {
    display: flex;
    justify-content: stretch;
    margin-top: 50px;
    margin-right: 50px;
  }
  .group {
    margin-left: 50px;
    flex: 1;
  }

  .drag_style{
    padding: 10px;
    background: #365491;
    margin-bottom: 20px;
    cursor: default;
    color: #fff;
  }
</style>
