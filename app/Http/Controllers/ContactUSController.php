<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContactUS;

class ContactUSController extends Controller
{
   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
   /*---For LARAVEL---*/
   public function contactUS()
   {
       return view('contactUS');
   }
/*-----------------*/
   /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Http\Response
    */
    /*---For LARAVEL---*/
  public function contactUSPost(Request $request)
  {
       $this->validate($request, [
        'name' => 'required',
        'email' => 'required|email',
        'message' => 'required'
        ]);

       ContactUS::create($request->all());

       return back()->with('success', 'Thanks for contacting us!');
  }
  /*public function readItems() {
    $users = contactus::all();
    return response()->json(["users"=>$users]);
  }*/

  public function index()
  {
    return contactus::all();
  }

  public function show($id)
  {
    return contactus::findOrFail($id);
  }

  public function update(Request $request, $id)
  {
    $users = contactus::findOrFail($id);
    $users->update($request->all());

    return $users;
  }

  public function store(Request $request)
  {
    $users = contactus::create($request->all());
    return $users;
  }

  public function destroy($id)
  {
    $users = contactus::findOrFail($id);
    $users->delete();
    return '';
  }
   /*-----------------*/
 /*  public function submit(Request $request) {
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        ContactUS::create($request->all());
       
          return back()->with('success', 'Thanks for contacting us!');
       // return response()->json(null, 200);
    }*/
}


/*namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContactUS;
use Mail;
 
class ContactUSController extends Controller
{
   public function contactUS()
{
return view('contactUS');
} 
   public function contactUSPost(Request $request) 
   {
    $this->validate($request, [ 'name' => 'required', 'email' => 'required|email', 'message' => 'required' ]);
    ContactUS::create($request->all()); 
   
    Mail::send('email',
       array(
           'name' => $request->get('name'),
           'email' => $request->get('email'),
           'user_message' => $request->get('message')
       ), function($message)
   {
       $message->from('saquib.gt@gmail.com');
       $message->to('saquib.rizwan@cloudways.com', 'Admin')->subject('Cloudways Feedback');
   });
 
    return back()->with('success', 'Thanks for contacting us!'); 
   }
}*/

