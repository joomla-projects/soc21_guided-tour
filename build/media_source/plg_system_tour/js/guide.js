Joomla = window.Joomla || {};
(function(Joomla, window) {
    document.addEventListener('DOMContentLoaded', function() {
        var mySteps = Joomla.getOptions('mySteps');
        const obj = JSON.parse(mySteps);

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
                    var currentURL = window.location.href;
                    if (obj[mainID].steps[index].url !== currentURL) {
                        console.log(obj[mainID].steps[index].id[index]);
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
                    } else {
                        // action: function() {
                        //     window.location.href = obj[mainID].steps[index].url;
                        //     return tour.next();
                        // },
                        break;
                    }
                }
                // var newIndex = sessionStorage.getItem()
                tour.start();

            });
        }
    });
}(Joomla, window));