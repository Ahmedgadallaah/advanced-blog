<?php

namespace App\Http\Controllers\BackEnd;
use Illuminate\Http\Request;
use App\Mail\ReplayContact;
use App\Models\Message;
use Illuminate\Support\Facades\Mail ;

class MessagesController extends BackEndController
{
    public function __construct(Message $model)
    {
        parent::__construct($model);
    }

    public function replay( $id , Request $request ){
        $this->validate($request,
        [
            'message' => [ 'required','min:10','max:500']
        ]);
        
        $message = $this->model->findOrFail($id);
        Mail::send(new ReplayContact($message,$request->message));
        return redirect()->route('message.edit' , ['id' => $message->id]);
    }

}
