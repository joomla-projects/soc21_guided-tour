Joomla = window.Joomla || {};
(function(Joomla, window) {
    document.addEventListener('DOMContentLoaded', function() {
        var btn = document.createElement('button');
        btn.classList.add('btn');
        btn.classList.add('btn-sm');
        btn.classList.add('btn-primary');
        btn.setAttribute('id', 'startTourBtn');
        btn.innerHTML = '<span class="fas fa-car-side" aria-hidden="true"></span>' + 'Take the Tour' + '</button>';
        document.getElementById('toolbar').appendChild(btn);

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
                element: '.d-flex align-items-center',
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
        document.getElementById("startTourBtn").addEventListener('click', function() {
            tour.start();
        });

    });
}(Joomla, window));