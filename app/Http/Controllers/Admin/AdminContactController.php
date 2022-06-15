<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class AdminContactController extends Controller
{
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }
    public function index(){
        $objContacts = $this->contact->getItems();
        return view('admin.contact.index',compact('objContacts'));
    }
    public function delete ($id){
        $result = $this->contact->delItem($id);
        if($result == true){
            return redirect()->Route('admin.contact.index')->with('msg','Xóa thành công ');
        }else{
            return redirect()->Route('admin.contact.index')->with('msg','Đã có lỗi xảy ra');
        }
    }
}
