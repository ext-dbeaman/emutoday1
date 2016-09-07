<template>
	<div class="row">
		<div class="medium-6 columns">
			<form class="form-horizontal" role="form" @submit.prevent="submit">
                <div class="form-group" v-bind:class = "{ 'has-error': hasError('first_name')  }">
                    <label class="col-sm-3 control-label">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="First Name"
                            v-model = "profile.first_name">
                        <span class="help-block" v-if = "hasError('first_name')">{{ errors.first_name }}</span>
                    </div>
                </div>

                <div class="form-group" v-bind:class = "{ 'has-error': hasError('last_name')  }">
                    <label class="col-sm-3 control-label">Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Last Name"
                            v-model = "profile.last_name">

                        <span class="help-block" v-if = "hasError('last_name')" >{{ errors.last_name }}</span>
                    </div>
                </div>

                <div class="form-group" v-bind:class = "{ 'has-error': hasError('email')  }">
                    <label class="col-sm-3 control-label">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" placeholder="Email"
                            v-model = "profile.email">

                        <span class="help-block" v-if = "hasError('email')">{{ errors.email }}</span>
                    </div>
                </div>

                <div class="form-group" v-bind:class = "{ 'has-error': hasError('url')  }">
                    <label class="col-sm-3 control-label">Profile URL</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Profile URL"
                            v-model = "profile.url">

                        <span class="help-block" v-if = "hasError('url')">{{ errors.url }}</span>
                    </div>
                </div>

                <div class="form-group" v-bind:class = "{ 'has-error': hasError('numeric')  }">
                    <label class="col-sm-3 control-label">Numeric</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Numeric"
                            v-model = "profile.numeric">

                        <span class="help-block" v-if = "hasError('numeric')">{{ errors.numeric }}</span>
                    </div>
                </div>

                <div class="form-group" v-bind:class = "{ 'has-error': hasError('integer')  }">
                    <label class="col-sm-3 control-label">Integer</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Integer"
                            v-model = "profile.integer">

                        <span class="help-block" v-if = "hasError('integer')">{{ errors.integer }}</span>
                    </div>
                </div>

                <div class="form-group" v-bind:class = "{ 'has-error': hasError('alphaNum')  }">
                    <label class="col-sm-3 control-label">Alpha Num</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" placeholder="Alpha Num"
                            v-model = "profile.alphaNum">

                        <span class="help-block" v-if = "hasError('alphaNum')">{{ errors.alphaNum }}</span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">&nbsp;</div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>&nbsp;
                            Submit
                        </button>
                    </div>
                </div>
            </form>
		</div><!-- /.medium-6 columns -->

			<div class="medium-6 columns">

			</div><!-- /.medium-6 columns -->
</div><!-- /.row -->
</template>
<style scoped>

</style>

<script>

module.exports  = {
  data: function() {
    return {
			errors: {}, profile: {},
			rules: {
				url: 'url',
				integer: 'integer',
				numeric: 'numeric',
				alphaNum: 'required,alphaNum',
				email: 'required,email',
				last_name: 'required,alpha',
				first_name: 'required,alpha',
			},
			messages: {
				'url': 'The field format is invalid.',
				'numeric': 'The field must be a number.',
				'integer': 'The field must be an integer.',
				'alpha': 'The field may only contain letters.',
				'required': 'The field field is required.',
				'email': 'The field must be a valid email address.',
				'alphaNum': 'The field may only contain letters and numbers.',
			}
    }
  },
  props: {
    //add props
  },
  computed: {

  },
  methods: {
		//submit the form.
		submit: function ()
		{
			//check for validation rules.
			let validate = Validator.make(this.profile, this.rules, this.messages);

			if (Object.keys(validate).length > 0)
			{
				this.errors = validate;
				return false;
			}

			this.errors = [];

			alert('Do something amazing!');
		},

		//look up possibles validation errors.
		hasError: function (key)
		{
			return typeof this.errors[key] !== 'undefined';
		}

  },
watch: {

},
created: function() {

},
directives: {
	// myajax: require('../directives/myajax.js'),


},
components: {


},
events: {


	}
};


</script>
