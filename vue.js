--directives everything that starts with v - stands for vue
v-model

conditionals - to render the element or not !!
v-if
v-else-if
v-else

v-show - like v-if but its still rendered with display:none if false

v-bind:disabled="email.length <2"

: stays for v-bind
v-bind:disabled == :disabled

:class="{red: email.length <2 }" -- will put class red if (1)

same as double curly to parse it as html
v-text="email" == {{}}
v-once - frozes the element to static html , - constant

cats is array in data
<li v-for="cat in cats"> {{ cat }} </li>

v-on == @

v-on:click == @click
-- push new cat to the array

<input v-demo="newCat" v-on:keyup.enter="addKitty">
<button v-on:click="addKitty"> </button>

--filters - like grep in linux, just us the function name to grep
<li v-for="cat in cats"> {{ cat | capitalize}} </li>

--computed methods
{{ kittifyName }} -- will output it when the method return

app = new Vue({
  el: '#root',
  data: {
    cats:['kitkat','fish']
  },
  newCat: ''
  methods: {
    addKitty: function(){
     this.cats.push(this.newCat);
     this.newCat = ''; //empty the cat
    }
  },
  filters: {
      capitalize: function(value) {
        return value.toUpperCase()
        }
    },
   computed: {
    kittifyName: function(){
    if(this.newCat.length > 1) {
  return this.newCat + 'y';   
}
    }
   }
  
)

--components
