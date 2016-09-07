<style>

h1 {
text-align: center;
background-color: #AC5C7E;
margin-top: 20px;
margin-bottom: 0;
padding: 10px;
}

h3 {
background-color: rgba(255, 255, 255, 0.2);
border-bottom: 5px solid #A13462;
text-align: center;
padding: 10px;
}

h3 div {
margin-bottom: 10px;
}

.tagline {
margin-top: 0;
}

a {
font-weight: bold;
}
a,
a:hover {
color: #ecf0f1;
}

pre {
white-space: pre-wrap;
}

pre code {
color: #fff;
font-size: 14px;
line-height: 1.3;
}

label {
display: block;
margin-bottom: 15px;
}

sub {
display: block;
margin-top: -10px;
margin-bottom: 15px;
font-size: 11px;
font-style: italic;
}

ul {
margin: 0;
padding: 0;
}

.parent {
background-color: rgba(255, 255, 255, 0.2);
margin: 50px 0;
padding: 20px;
}

input {
border: none;
outline: none;
background-color: #ecf0f1;
padding: 10px;
color: #942A57;
border: 0;
margin: 5px 0;
display: block;
width: 100%;
}

button {
background-color: #ecf0f1;
color: #942A57;
border: 0;
padding: 18px 12px;
margin-left: 6px;
cursor: pointer;
outline: none;
}

button:hover {
background-color: #e74c3c;
color: #ecf0f1;
}

.gh-fork {
position: fixed;
top: 0;
right: 0;
border: 0;
}

/* dragula-specific example page styles */
.dragwrapper {
display: table;
}
.dragcontainer {
display: block;
width: 100%;
padding: 10px;
background-color: rgba(255, 255, 255, 0.2);
}
.dragcontainer:nth-child(odd) {
background-color: rgba(0, 0, 0, 0.2);
}
/*
* note that styling gu-mirror directly is a bad practice because it's too generic.
* you're better off giving the draggable elements a unique class and styling that directly!
*/
.dragcontainer div,
.gu-mirror {
padding: 10px;
background-color: rgba(0, 0, 0, 0.2);
transition: opacity 0.4s ease-in-out;
}
.dragcontainer div {
cursor: move;
cursor: grab;
cursor: -moz-grab;
cursor: -webkit-grab;
margin-bottom: 10px;
}
.dragcontainer div:last-child {
margin-bottom: 0;
}
.gu-mirror {
cursor: grabbing;
cursor: -moz-grabbing;
cursor: -webkit-grabbing;
}
.dragcontainer .ex-moved {
background-color: #e74c3c;
}
.dragcontainer.ex-over {
background-color: rgba(255, 255, 255, 0.3);
}
.handle {
padding: 0 5px;
margin-right: 5px;
background-color: rgba(0, 0, 0, 0.4);
cursor: move;
}

</style>
<template>
	<div class="dragwrapper">
		<div class="row">
			<div class="col-md-6">
				<div class="dragcontainer" v-dragula="colOne" bag="first-bag">
					<!-- with click -->
					<div v-for="text in colOne" @click="onClick">{{text}} [click me]</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="dragcontainer" v-dragula="colTwo" bag="first-bag">
					<div v-for="text in colTwo">{{text}}</div>
				</div>
			</div>
		</div>


	</div>
</template>
<script>
export default {
	data() {
		return {
			colOne: [
	      'You can move these elements between these two containers',
	      'Moving them anywhere else isn"t quite possible',
	      'There"s also the possibility of moving elements around in the same container, changing their position'
	    ],
	    colTwo: [
	      'This is the default use case. You only need to specify the containers you want to use',
	      'More interactive use cases lie ahead',
	      'Another message'
	    ]
		};
		},
		// ready: function () {
		// 	console.log(this)
	  //   vm.$on(
	  //     'drop',
	  //     function (args) {
	  //       console.log('drop: ' + args[0])
	  //       console.log(colOne)
	  //     }
	  //   )
		// 	vm.$on(
	  //     'dropModel',
	  //     function (args) {
	  //       console.log('dropModel: ' + args[0])
	  //       console.log(colOne)
	  //     }
	  //   )
	  // },
	  methods: {
	    onClick: function () {
	      window.alert('click event')
	    }
	  }
}
  </script>
