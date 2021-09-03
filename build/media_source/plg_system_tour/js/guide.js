Joomla = window.Joomla || {};
(function(Joomla, window) {
    document.addEventListener('DOMContentLoaded', function() {

        var myTours = Joomla.getOptions('myTours');
        var mySteps = Joomla.getOptions('mySteps');
        var obj = JSON.parse(myTours);
        var objSteps = JSON.parse(mySteps);

        let btnGoods = document.querySelectorAll('.button-tour');
        for (var i = 0; i < btnGoods.length; i++) {
            btnGoods[i].addEventListener('click', function() {
                var dataID = this.getAttribute('data-id');
                var mainID = obj.findIndex(x => x.id === dataID);
                sessionStorage.setItem("tourid", mainID);

                var currentURL = window.location.href;

                if (currentURL != obj[mainID].url) {
                    window.location.href = obj[mainID].url;
                }
                const tour = new Shepherd.Tour({
                    defaultStepOptions: {
                        cancelIcon: {
                            enabled: true
                        },
                        classes: 'class-1 class-2 shepherd-theme-arrows',
                        scrollTo: { behavior: 'smooth', block: 'center' }
                    },
                    useModalOverlay: true,
                    keyboardNavigation: true,
                });

                if (sessionStorage.getItem('tourid')) {
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
                            },
                            {
                                action() {
                                    return this.complete();
                                },
                                text: 'Complete'
                            }
                        ],
                        id: obj[mainID].id,
                    });

                    // ----------------------------------------------------
                    for (index = 0; index < obj[mainID].steps.length; index++) {

                        tour.addStep({
                            title: obj[mainID].steps[index].title,
                            text: obj[mainID].steps[index].description,
                            classes: 'intro-step shepherd-theme-arrows',
                            attachTo: {
                                element: obj[mainID].steps[index].target,

                                on: obj[mainID].steps[index].position,


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
                                },
                                {
                                    action() {
                                        return this.complete();
                                    },
                                    text: 'Complete'
                                }
                            ],
                            id: obj[mainID].steps[index].id,
                            arrow: true,
                            showOn: obj[mainID].steps[index].position,
                            when: {

                                show() {
                                    const currentStepElement = tour.currentStep.el;
                                    const header = currentStepElement.querySelector('.shepherd-header');
                                    const progress = document.createElement('span');
                                    progress.style['margin-right'] = '1px';
                                    progress.innerText = `${tour.steps.indexOf(tour.currentStep) + 1}/${tour.steps.length}`;
                                    header.insertBefore(progress, currentStepElement.querySelector('.shepherd-cancel-icon'));
                                    var thisId = `${tour.steps.indexOf(tour.currentStep) + 1}`;
                                    var Id = `${tour.steps.id}`;
                                    console.log(Id);
                                    sessionStorage.setItem('stepID', thisId);
                                }

                            },


                        });
                    }
                }

                tour.start();
            });
        }
        var mainID = sessionStorage.getItem('tourid');
        var newIndex = sessionStorage.getItem('stepID');
        newIndex = newIndex - 1;
        const tour = new Shepherd.Tour({
            defaultStepOptions: {
                cancelIcon: {
                    enabled: true
                },
                classes: 'class-1 class-2 shepherd-theme-arrows',
                scrollTo: { behavior: 'smooth', block: 'center' }
            },
            useModalOverlay: true,
            keyboardNavigation: true,
            popperOptions: {
                modifiers: [{ name: 'offset', options: { offset: [0, 12] } }]
            }
        });


        if (mainID && newIndex) {
            for (index = newIndex; index < obj[mainID].steps.length - newIndex; index++) {

                tour.addStep({
                    title: obj[mainID].steps[index].title,
                    text: obj[mainID].steps[index].description,
                    classes: 'intro-step shepherd-theme-arrows',
                    attachTo: {
                        element: obj[mainID].steps[index].target,

                        on: obj[mainID].steps[index].position,


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
                        },
                        {
                            action() {
                                return this.complete();
                            },
                            text: 'Complete'
                        }
                    ],
                    id: obj[mainID].steps[index].id,
                    arrow: true,
                    showOn: obj[mainID].steps[index].position,
                    when: {

                        show() {
                            const currentStepElement = tour.currentStep.el;
                            const header = currentStepElement.querySelector('.shepherd-header');
                            const progress = document.createElement('span');
                            progress.style['margin-right'] = '1px';
                            progress.innerText = `${tour.steps.indexOf(tour.currentStep) + 1}/${tour.steps.length}`;
                            header.insertBefore(progress, currentStepElement.querySelector('.shepherd-cancel-icon'));
                            var thisId = `${tour.steps.indexOf(tour.currentStep) + 1}`;
                            sessionStorage.setItem('stepID', thisId);
                        }

                    },


                });
            }
        }

        tour.start();
    });
}(Joomla, window));