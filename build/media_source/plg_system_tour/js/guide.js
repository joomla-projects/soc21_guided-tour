Joomla = window.Joomla || {};
(function(Joomla, window) {
    document.addEventListener('DOMContentLoaded', function() {
        var mySteps = Joomla.getOptions('mySteps');
        const obj = JSON.parse(mySteps);
        // console.log(obj);
        let btnGoods = document.querySelectorAll('.button-tour');
        for (var i = 0; i < btnGoods.length; i++) {
            btnGoods[i].addEventListener('click', function() {
                var dataID = this.getAttribute('data-id');
                var mainID = obj.findIndex(x => x.id === dataID);
                sessionStorage.setItem("tourid", mainID);
                console.log(obj[mainID]);
                // Integrating ShepherdJS
                const tour = new Shepherd.Tour({
                    defaultStepOptions: {
                        cancelIcon: {
                            enabled: true
                        },
                        classes: 'class-1 class-2 shepherd-theme-arrows',
                        scrollTo: { behavior: 'smooth', block: 'center' }
                    },
                    // Will use overlay effect to highlight the tour
                    useModalOverlay: true
                });

                console.log("I am here 1");
                tour.addStep({
                    title: obj[mainID].title,
                    text: obj[mainID].description,
                    classes: 'intro-step shepherd-theme-arrows',
                    attachTo: {
                        on: 'bottom'
                    },
                    buttons: [{
                            action() {
                                return this.back();
                            },
                            classes: 'shepherd-button-secondary shepherd-theme-arrows',
                            text: 'Back'
                        },
                        {
                            action() {
                                return this.next();
                            },
                            text: 'Next'
                        }
                    ],
                    id: 'creating'
                });
                // ----------------------------------------------------------------------------
                var currentURL = window.location.href;
                if (currentURL != obj[mainID].url) {
                    window.location.href = obj[mainID].url;
                    console.log(obj[mainID].url);
                    console.log(currentURL);
                    console.log("I am here 2");

                }
                if (!sessionStorage.getItem("id")) {
                    console.log("I am here 3");
                    for (index = 0; index < (obj[mainID].steps.length); index++) {
                        if (currentURL == obj[mainID].steps[index].url) {
                            sessionStorage.setItem("id", obj[mainID].steps[index].id);

                            tour.addStep({
                                title: obj[mainID].steps[index].title,
                                text: obj[mainID].steps[index].description,
                                classes: 'intro-step shepherd-theme-arrows highlightClass',
                                attachTo: {
                                    element: obj[mainID].steps[index].target,
                                    on: obj[mainID].steps[index].position
                                },
                                buttons: [{
                                        action() {
                                            return this.back();
                                        },
                                        classes: 'shepherd-button-secondary',
                                        text: 'Back'
                                    },
                                    {
                                        action() {
                                            return this.next();
                                        },
                                        text: 'Next'
                                    }
                                ],
                                id: obj[mainID].steps[index].id
                            });
                        }
                    }
                    tour.start();
                }
            });
        }

        //---------------------------------------------------------------------------------------------------
        // const tour = new Shepherd.Tour({
        //     defaultStepOptions: {
        //         cancelIcon: {
        //             enabled: true
        //         },
        //         classes: 'class-1 class-2 shepherd-theme-arrows',
        //         scrollTo: { behavior: 'smooth', block: 'center' }
        //     },
        // });
        // if (sessionStorage.getItem("tourid")) {
        //     var newID = sessionStorage.getItem("id");
        //     var newTourID = sessionStorage.getItem("tourid");

        //     for (index = newID; index < (obj[newTourID].steps.length) - newTourID; index++) {
        //         console.log("I am here");

        //         tour.addStep({
        //             title: obj[newTourID].steps[index].title,
        //             text: obj[newTourID].steps[index].description,
        //             classes: 'intro-step shepherd-theme-arrows highlightClass',
        //             attachTo: {
        //                 element: obj[newTourID].steps[index].target,
        //                 on: obj[newTourID].steps[index].position
        //             },
        //             buttons: [{
        //                     action() {
        //                         return this.back();
        //                     },
        //                     classes: 'shepherd-button-secondary',
        //                     text: 'Back'
        //                 },
        //                 {
        //                     action() {
        //                         return this.next();
        //                     },
        //                     text: 'Next'
        //                 }
        //             ],
        //             id: obj[newTourID].steps[index].id
        //         });
        //         tour.start();
        //     }
        //     sessionStorage.clear();
        // }
    });
}(Joomla, window));