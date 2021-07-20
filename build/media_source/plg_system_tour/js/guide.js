//  Dummy Code for Guided tour, Changes are yet to made

Joomla = window.Joomla || {};

(function(Joomla, window) {
    document.addEventListener('DOMContentLoaded', function() {
        var urlParameters = Joomla.getOptions('tour-guide');
        if (!urlParameters) { return; }
        if (window.location.href.indexOf("&") > -1) {
            var filename = '';
            var URL = '';
            //case if their is presence of two paramteres and one of them is option
            if (urlParameters.urlOption) {
                filename = urlParameters.urlOption;

                //case if their is presence of two paramteres and they are view and option
                if (urlParameters.urlView) {

                    filename = filename + '_' + urlParameters.urlView;
                }

                //case if their is presence of three paramteres and they are view and option and layout
                if ((window.location.href.indexOf("layout=") > 0)) {

                    filename = filename + '_' + urlParameters.urlLayout;
                }
                //made the file name to be fetched out
                filename = filename + '.' + 'json';
                // path from where the file to be fetched
                URL = urlParameters.urlOption + '/' + filename;
            }
        } else {
            filename = urlParameters.urlOption + '.' + 'json';
            URL = urlParameters.urlOption + '/' + filename;
        }
        var btn = document.createElement('button');
        btn.classList.add('btn');
        btn.classList.add('btn-sm');
        btn.classList.add('btn-outline-primary');
        btn.setAttribute('id', 'startTourBtn');
        btn.innerHTML = '<span class="fad fa-car-side" aria-hidden="true"></span>' + urlParameters.btnName + '</button>';
        document.getElementById('toolbar').appendChild(btn);

    });
});
}(Joomla, window));