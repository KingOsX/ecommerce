/**
 * Created by KingOsX on 21/02/2016.
 */
module.exports=function(grunt){
    /*************************************
     * 1er >>configurer les modules
     **********************************/
    grunt.initConfig({
        symlink: {
            app: {
                dest: "web/bundles/app",
                relativeSrc: "../../app/Resources/public/",
                options:  {type: "dir"}

            }
        },
        cssmin: {
            options: {
                shorthandCompacting: false,
                roundingPrecision: -1
            },
            target: {
                files: {
                    'web/built/app/css/vapamax.min.css':
                        [
                            'app/Resources/public/css/custom.css',
                            'app/Resources/public/css/override.css'
                        ]
                }
            }
        },
        watch: {
            options: {
                livereload : true
            },
            css: {
                files: 'web/bundles/*/css/*.css',
                tasks: ['cssmin']
            }
        }

    });
    /***************************************************************
     * chargeemnt des modules
     * *************************************************************/
    grunt.loadNpmTasks('grunt-symlink');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');

    /************************************************************
     * Declaration des tasks(ligne de commande grunt)
     * ************************************************************/
    grunt.registerTask("default",['symlink','cssmin']);

};//fin du modules.export()
