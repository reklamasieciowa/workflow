
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');

// window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app'
// });

$( document ).ready(function() {
	$('.datepicker').pickadate({
		format: 'yyyy-mm-dd ',
		monthsFull: [ 'styczeń', 'luty', 'marzec', 'kwiecień', 'maj', 'czerwiec', 'lipiec', 'sierpień', 'wrzesień', 'październik', 'listopad', 'grudzień' ],
    monthsShort: [ 'sty', 'lut', 'mar', 'kwi', 'maj', 'cze', 'lip', 'sie', 'wrz', 'paź', 'lis', 'gru' ],
    weekdaysFull: [ 'niedziela', 'poniedziałek', 'wtorek', 'środa', 'czwartek', 'piątek', 'sobota' ],
    weekdaysShort: [ 'niedz.', 'pn.', 'wt.', 'śr.', 'cz.', 'pt.', 'sob.' ],
    today: 'Dzisiaj',
    clear: 'Usuń',
    close: 'Zamknij',
    firstDay: 1,
    format: 'yyyy-mm-dd',
    formatSubmit: 'yyyy-mm-dd'
	});
});

$('#addTask').click(function(){
    var taskName = $('#task-name-def').val();
    var taskDescription = $('#task-description-def').val();

    if(taskName && taskDescription) {
        $('#form-tasks').append(
        '<div class="row mx-1"><div class="md-form col-lg-6 mt-3"><input type="text" id="task-name" name="tasks['+taskName+'][name]" class="form-control" value="'+ taskName +'"><label for="task-name" class="active">Nazwa</label></div><div class="md-form col-lg-6 mt-3"><input type="text" id="task-description" name="tasks['+taskName+'][description]" class="form-control" value="'+ taskDescription +'"><label for="task-description" class="active">Opis</label></div></div>'
        );

        $('#task-name-def').val('');
        $('#task-description-def').val('');
    }
});

$(document).ready(function() {
 $('.mdb-select').materialSelect();
});

$('#addUser').click(function(){
    var userId = $('#user-name-def').val();
    var userEmail = $('#user-name-def option:selected').text();

    if(userId && userEmail) {
        $('#form-users').append(
        '<div class="row mx-1"><div class="md-form col-lg-12 mt-3"><input type="text" id="user" name="users['+userId+']" class="form-control" value="'+userEmail+'"></div></div>'
        );
        $('#user-name-def option:selected').remove();
    }
});