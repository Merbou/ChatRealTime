<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use Auth;
use App\Events\NewMessage;

class contactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        
        $contacts=User::where('id', '!=' , Auth::id())->orWhereNull('id')->get();

        $inreadIds=Message::select(\DB::raw('`from` as sender_id , count(`from`) as messages_count'))
        ->where('to',Auth::id())
        ->where('read',false)
        ->groupBy('from')
        ->get();

        $contacts=$contacts->map(function($contact) use ($inreadIds){

            $contactUnread=$inreadIds->where('sender_id',$contact->id)->first();

            $contact->unread=$contactUnread?$contactUnread->messages_count:0;
            return $contact;

        });

        return response()->json($contacts);
    }


    public function getMessagesFor($id){

        Message::where('from',$id)->where('to',Auth::id())->update(['read'=>true]);
        
        $messages=Message::where(function ($q) use ($id){

            $q->where('from',Auth::id());
            $q->where('to',$id);

            
        })->OrWhere(function ($q) use ($id){
         
            $q->where('to',Auth::id());
            $q->where('from',$id);

        })->get();

        return response()->json($messages); 
    }



    public function send(Request $request){

     
        $message=Message::create([
            'from'=>Auth::id(),
            'to'=>$request->contact_id,
            'text'=>$request->text
        ]);
        
        event(new NewMessage($message));


        return response()->json($message); 
    }

    public function boom(){
    
        $message=Message::create([
            'from'=>1,
            'to'=>3,
            'text'=>'$request->text'
        ]);
        
    
        return response()->json($message); 
    
    }


}