Joomla = window.Joomla || {};
(function(Joomla, window) {
    document.addEventListener('DOMContentLoaded', function() {
        // sessionStorage.setItem("tourid", 0);
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
                tour.start();
            });
        }
        var mainID = sessionStorage.getItem('tourid');
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
            var len = obj[mainID].steps.length;
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
                id: obj[mainID].id,
            });
        }

        if (mainID) {
            for (index = 0; index < obj[mainID].steps.length; index++) {
                var newInt = parseInt(objSteps[index].id);

                console.log(typeof(newInt));
                tour.addStep({
                    title: obj[mainID].steps[index].title,
                    text: obj[mainID].steps[index].description,
                    classes: 'intro-step shepherd-theme-arrows',
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
                    id: obj[mainID].steps[index].id,
                    arrow: true,

                });
                // console.log(len);

            }
        }


        tour.start();
        // sessionStorage.clear();

    });
}(Joomla, window));