Joomla = window.Joomla || {};
(function(Joomla, window) {
    document.addEventListener('DOMContentLoaded', function() {
        var mySteps = Joomla.getOptions('mySteps');

        console.log(mySteps);
        var tourDrop = document.getElementsByClassName('tourDrop');


        // Integrating ShepherdJS
        // const tour = new Shepherd.Tour({
        //     defaultStepOptions: {
        //         cancelIcon: {
        //             enabled: true
        //         },
        //         classes: 'class-1 class-2',
        //         scrollTo: { behavior: 'smooth', block: 'center' }
        //     }
        // });

        // tour.addStep({
        //     title: 'Creating a Shepherd Tour',
        //     text: `Creating a Shepherd tour is easy. too!\
        //            Just create a \`Tour\` instance, and add as many steps as you want.`,
        //     attachTo: {
        //         element: '.sidebar-item-title',
        //         on: 'right'
        //     },
        //     buttons: [{
        //             action() {
        //                 return this.back();
        //             },
        //             classes: 'shepherd-button-secondary',
        //             text: 'Back'
        //         },
        //         {
        //             action() {
        //                 return this.next();
        //             },
        //             text: 'Next'
        //         }
        //     ],
        //     id: 'creating'
        // });


    });
}(Joomla, window));