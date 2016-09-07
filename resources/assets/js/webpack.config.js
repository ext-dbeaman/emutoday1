var path = require("path");

module.exports = {
    context: path.resolve('resources'),
    entry: [
        './assets/js/CalVue.js'
    ],
    output: {
        path: path.resolve('public/assets/js/'),
        publicPath: 'http://emutoday.app',
        filename: "CalVue.js"
    },
	  module: {
	    // `loaders` is an array of loaders to use.
	    // here we are only configuring vue-loader
	    loaders: [
	      {
	        test: /\.vue$/, // a regex for matching all files that end in `.vue`
	        loader: 'vue'   // loader to use for matched files
	      }
	    ]
	  }
};
