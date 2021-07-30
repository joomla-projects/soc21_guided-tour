Joomla = window.Joomla || {};
(function(Joomla, window) {
    document.addEventListener('DOMContentLoaded', function() {
        var mySteps = Joomla.getOptions('mySteps');

        // Accessing the 'data-id' 
        // 1. for each tour element
        // 2. get attribute id of each tour
        // 3. assign the onClick event and do what you want with that attribute id
        let btnGoods = document.querySelectorAll('.button-tour');
        for (var i = 0; i < btnGoods.length; i++) {
            btnGoods[i].addEventListener('click', function() {
                var dataID = this.getAttribute('data-id');
                console.log(dataID);

                // Integrating ShepherdJS
                const tour = new Shepherd.Tour({
                    defaultStepOptions: {
                        cancelIcon: {
                            enabled: true
                        },
                        classes: 'class-1 class-2',
                        scrollTo: { behavior: 'smooth', block: 'center' }
                    }
                });

                tour.addStep({
                    title: 'Creating a Shepherd Tour',
                    text: `Creating a Shepherd tour is easy. too!\
                    Just create a \`Tour\` instance, and add as many steps as you want.`,
                    attachTo: {
                        element: '.hero-example',
                        on: 'bottom'
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
                    id: 'creating'
                });
                document.getElementsByClassName(".button-tour").addEventListener('click', function() {
                    tour.start();
                });

            });
        }
    });
}(Joomla, window));