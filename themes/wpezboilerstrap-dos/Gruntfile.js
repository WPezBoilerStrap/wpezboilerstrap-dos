module.exports = function(grunt) {

	'use strict';

	// Project configuration.
    grunt.initConfig({

        pkg: grunt.file.readJSON('package.json'),

		options: {
			css: 'scss'		// .ext of src css files
		},

		sass:{
			wpt: {
				options: {
					style: 'expanded'
				},
				files: {
					// 'destination' : 'source'
					'<%= gruntConfig.gCss.paths.dest %>app.css' : '<%= gruntConfig.gCss.paths.src %>app.scss',
					'<%= gruntConfig.gCss.paths.dest %>app-new.css' : '<%= gruntConfig.gCss.paths.src %>app-new.scss'
				}
			},					
		},
		
		postcss: {
				
			options: {
				map: true, // inline sourcemaps 
				
				// -- or --
				/*
				map: {
					inline: false, // save all sourcemaps as separate files... 
					annotation: 'dist/css/maps/' // ...to the specified directory 
				},
				*/
				
				processors: [
				    require('pixrem')(), // add fallbacks for rem units 
					require('autoprefixer')({browsers: 'last 10 versions'}) // add vendor prefixes
					//require('cssnano')() // minify the result 
				]
			},
			wpt: {
				expand:true,
				src: '<%= gruntConfig.gCss.paths.dest %>*.css'
			}
		},		
		
		
		cssmin: {
			  options: {
				  shorthandCompacting: false,
				  roundingPrecision: -1
			  },
			wpt: {
				files: [{
					expand: true,
					cwd: '<%= gruntConfig.gCss.paths.dest %>',
					src: ['*.css', '!*.min.css'],
					dest: '<%= gruntConfig.gCss.paths.dist %>',  // all done...move it to dist/
					ext: '.min.css'
				}]
			}
		},

		concat: {
			options: {
				separator: ';',
			},

		},
		
	    uglify: {
			options: {
				mangle: false,
				banner: '/* <%= grunt.template.today("yyyy-mm-dd") %> */\n'
			},

		},

		watch: {

			configFiles: {
				files: [ 'Gruntfile.js' ],
					options: {
						reload: true
				}
			},

			themecss: {
				files: [
				   '<%= gruntConfig.gCss.paths.src %>*.scss'
				],
				tasks: ['sass:wpt', 'postcss:wpt', 'cssmin:wpt'],
				options: {
					spawn: false,
                    livereload: true,
				}
			},

		}

    });

	 // WATCH - Run predefined tasks whenever watched file patterns are added, changed or deleted.
	 // https://www.npmjs.com/package/grunt-contrib-watch
    grunt.loadNpmTasks('grunt-contrib-watch');
	
	 // SASS - Compile Sass to CSS
	 // https://www.npmjs.com/package/grunt-sass
	 // NOTE: Win 10 had issues with:  grunt.loadNpmTasks('grunt-contrib-sass'); https://www.npmjs.com/package/grunt-contrib-sass
    grunt.loadNpmTasks('grunt-sass');	
	
	 // POSTCSS - Apply several post-processors to your CSS using PostCSS
	 // https://www.npmjs.com/package/grunt-postcss
    grunt.loadNpmTasks('grunt-postcss');
	
	grunt.loadNpmTasks('grunt-pixrem');

	 // MINCSS - Minify CSS.
	 // https://www.npmjs.com/package/grunt-contrib-cssmin
    grunt.loadNpmTasks('grunt-contrib-cssmin');	

	 // JS HINT - Validate files with JSHint
	 // https://www.npmjs.com/package/grunt-contrib-jshint
    grunt.loadNpmTasks('grunt-contrib-jshint');

	// CONCAT - oncatenate files.
	// https://www.npmjs.com/package/grunt-contrib-concat
	grunt.loadNpmTasks('grunt-contrib-concat');

	// UGILIFY (JS only) - Minify files with UglifyJS
    // https://www.npmjs.com/package/grunt-contrib-uglify
    grunt.loadNpmTasks('grunt-contrib-uglify');

    // Default task(s).
    grunt.registerTask('default', ['watch']);

	grunt.registerTask('js', function(){

		grunt.task.run(['concat', 'uglify']);

	});

	var gConfig = {

		gCss:{

			"paths":{
				"src": "./app/assets/src/css/scss/",
	 			"dest": "./app/assets/src/css/build/",
				"dist": "./app/assets/dist/css/"
			}

		},


		gJs:{

			"paths": {
				"src": "./app/assets/src/js/",
				"dist": "./app/assets/dist/js/"
			}
		}
	};

	grunt.config.set('gruntConfig', gConfig);
};