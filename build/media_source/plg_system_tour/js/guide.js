Joomla = window.Joomla || {};
(function(Joomla, window) {
    document.addEventListener('DOMContentLoaded', function() {
        var tours = Joomla.getOptions('tours');
        var steps = Joomla.getOptions('steps');
        tours.forEach(element1 => {
            steps.forEach(element2 => {
                if (element1.id == element2.tour_id) {
                    console.log(element2.title);

                }
            })
        });


    });
}(Joomla, window));





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
//     Just create a \`Tour\` instance, and add as many steps as you want.`,
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

// document.getElementById("startTourBtn").addEventListener('click', function() {
//     tour.start();
// });