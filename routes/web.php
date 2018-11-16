<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('landing');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::get('contact-us', 'ContactUSController@contactUS');
Route::post('contact-us', ['as'=>'contactus.store','uses'=>'ContactUSController@contactUSPost']);

Route::get('about-us', 'AboutUSController@aboutUS');

//Route::get('/', 'SinglePageController@index')->where('any', '.*');
Route::resource('companies', 'ContactUSController', ['except' => ['create', 'edit']]);


/*Route::post('/submit', 'ContactUSController@contactUSPost');
Route::get( '/vueitems', 'ContactUSController@readItems');
Route::post( '/destroy', 'ContactUSController@destroy');
Route::get( '/edit', 'ContactUSController@readItems');*/


/*----shopify-------*/
  /*var clname = $('#txtClName').val();
  var clSname = $('#txtClSName').val();
  var clemail = $('#txtemail').val();
  var clAdd4 = $('#SelRegion').val();
  var purchdt = $('#txtdate').val();
  var itempurch = $('#txtProduct').val();
  var purchlocat = $('#txtshop').val();
  var form = new FormData();
form.append("clname", clname);
form.append("clSname", clSname);
form.append("clemail", clemail);
form.append("clAdd4", clAdd4);
form.append("purchdt", purchdt);
form.append("itempurch", itempurch);
form.append("purchlocat", purchlocat);

var settings = {
  "async": true,
  "crossDomain": true,
  "url": "http://54.194.87.175/TridentAPIV2",
  "method": "POST",
  "headers": {
    "cache-control": "no-cache"
  },
  "processData": false,
  "contentType": false,
  "mimeType": "multipart/form-data",
  "data": form
}

$.ajax(settings).done(function (response) {
  console.log(response);
});

data: { clname: JSON.stringify(clname), clSname: JSON.stringify(clSname), clemail: JSON.stringify(clemail), clAdd4: JSON.stringify(clAdd4), purchdt: JSON.stringify(purchdt), itempurch: JSON.stringify(itempurch), purchlocat: JSON.stringify(purchlocat)},

.ajax({
    url: "http://54.194.87.175/TridentAPIV2",
    type:'post',
    data: { clname: clname, clSname: clSname, clemail: clemail, clAdd4: clAdd4, purchdt: purchdt, itempurch: itempurch, purchlocat: purchlocat},
    success: function(response) {
        alert(response);
    },
    error: function(xhr) {
    //Do Something to handle error
    }
});*/