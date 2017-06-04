<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Link;
use Illuminate\Support\Facades\Auth;
//Google Url Shortener API Package for Laravel see https://github.com/mbarwick83/shorty
use Mbarwick83\Shorty\Facades\Shorty;
class LinkShortenerController extends Controller
{
    
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkLinksNumber')->except('linksList');
    }


    public function linksList()
    {
        return view('links.linksList')->with(['links' => Auth::user()->links()->get()]);
    }

    public function getForm()
    {

        return view('links.form');
    }

    public function postForm(Request $request)
    {
    	
    	//If validation fails, we return to the main page with an error info
 		$this->validate($request, [
        	'link' => 'required|max:255|url',
    	]);

    	//Now let's check if we already have the link in our database. If so, we get the first result

	    $link = Link::where('url','=',$request->link)
	    ->first();
	    //If we have the URL saved in our database already, we provide that information back to view.
	    if($link) {
	      return redirect()->to('/')
	      ->with('hash',$link->hash);
	      //Else we create a new unique URL
	    } else {
	      //First we create a new unique Hash
	       $newHash = Shorty::shorten($request->link);
	      
	      //Now we create a new database record
	      Link::create(array('url' => $request->link,'hash' => $newHash, 'user_id' => Auth::user()->id));


	      //And then we return the new shortened URL info to our action
	      return redirect()->to('/')
	      ->with('hash',$newHash);

	    }


    }

    public function deleteLink($linkId)
    {
        Link::findOrFail($linkId)->delete();
        return redirect()->to('/my-links')->with('success', 'Supprimé avec succès.');
    }
}
