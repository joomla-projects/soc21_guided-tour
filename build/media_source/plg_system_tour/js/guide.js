Joomla = window.Joomla || {};
(function(Joomla, window) {
    document.addEventListener('DOMContentLoaded', function() {
        var mySteps = Joomla.getOptions('mySteps');
        const obj = JSON.parse(mySteps);
        // console.log(obj[2].steps.length);

        // console.log(one);
        // console.log(obj[0].steps);
        // Accessing the 'data-id' 
        // 1. for each tour element
        // 2. get attribute id of each tour
        // 3. assign the onClick event and do what you want with that attribute id
        let btnGoods = document.querySelectorAll('.button-tour');
        for (var i = 0; i < btnGoods.length; i++) {
            btnGoods[i].addEventListener('click', function() {
                var dataID = this.getAttribute('data-id');
                var mainID = obj.findIndex(x => x.id === dataID);

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

                tour.addStep({
                    title: obj[mainID].title,
                    text: obj[mainID].description,
                    classes: 'intro-step shepherd-theme-arrows',
                    attachTo: {
                        element: '.hero-example',
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
                for (index = 0; index < (obj[mainID].steps.length); index++) {
                    // alert(obj[mainID].steps[0].target);
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
                tour.start();
            });
        }
    });
}(Joomla, window));