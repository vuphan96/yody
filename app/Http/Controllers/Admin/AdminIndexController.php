<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cat;
use App\Models\User;
use App\Models\Contact;
use App\Models\News;
class AdminIndexController extends Controller
{
    public function __construct(Cat $cat, User $user, News $news, Contact $contact)
    {
        $this->cat = $cat;
        $this->user = $user;
        $this->news = $news;
        $this->contact = $contact;
    }
    public function index(){
        $objCatCount = $this->cat->getItems()->count();
        $objUserCount = $this->user->getItems()->count();
        $objContactCount = $this->contact->getItems()->count();
        $objNewsCount = $this->news->getItems()->count();
        return view('admin.index.index',compact('objCatCount','objUserCount','objContactCount','objNewsCount'));
    }
}
