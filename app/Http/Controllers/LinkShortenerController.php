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

    {   // Uses 'auth' Middleware
        $this->middleware('auth')->except('linksList');
        // Uses 'checkLinksNumber' Middleware to check links number (must be < 10)
        $this->middleware('checkLinksNumber' )->except(['userLinks', 'linksList','deleteLink']);
    }

    /**
     * Show the hole links list
     *
     * @return View
    */
    public function linksList()
    {   
        $links = Link::all();
        return view('links.linksList')->with(['links' => $links]);
    }

    /**
     * Show only user's links list
     * @return View
    */
    public function userLinks()
    {   
        return view('links.userLinks')->with(['links' => Auth::user()->links()->get()]);
    }


    /**
     * Show the 'Shortify' form
     *
     * @return View
    */ 
    public function getForm()
    {
        return view('links.form');
    }

    /**
     * handle creating the new short link
     *
     * @param Request $request
     * @return string|View
     */
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
	      return redirect()->route('get-form', ['lang' => app()->getLocale()])->with('hash',$link->hash);
	      //Else we create a new unique URL
	    } else {
	      //First we create a new unique Hash
	       $newHash = Shorty::shorten($request->link);
	      
	      //Now we create a new database record
	      Link::create(array('url' => $request->link,'hash' => $newHash, 'user_id' => Auth::user()->id));


	      //And then we return the new shortened URL info to our action
	      return redirect()->route('get-form', ['lang' => app()->getLocale()])->with('hash', $newHash);

	    }


    }

    /**
     * handle deleting a specific link
     *
     * @param string $linkId
     * @return string|View
    */
    public function deleteLink($linkId)
    {
        Link::findOrFail($linkId)->delete();
        return redirect()->route('user-links', ['lang' => app()->getLocale()])->with('success', 'Supprimé avec succès.');
    }
}
