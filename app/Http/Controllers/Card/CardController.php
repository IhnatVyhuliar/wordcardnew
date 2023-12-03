<?php

namespace App\Http\Controllers\Card;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CardStoreRequest;
use App\Models\Card;

use Storage;
class CardController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function create(Request $folder)
    {
        $card=new Card;
        $folder_id=$folder->folder_id;
        //$folder=$card->folder()->where('folder_id',$folder->id);
       // dd($folder_id);
        //$folder_id=$id;
        return view('app/cards/create')->with('folder_id',$folder_id);
    }

    /**
     * Show the form for creating a new resource.
     */
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(CardStoreRequest $request)
    {
        
        $image=$request->file('image')->store('public/cards');
        /*dd(['word'=>$request->word,
        'translation'=>$request->translation,
        'definition'=>$request->definition,
        'user_id'=>auth()->id(),
        'folder_id'=>$request->folder_id,
        'image'=>$image]);*/
        //$request->validated();
        
        
        Card::create([
            'word'=>$request->word,
            'translation'=>$request->translation,
            'definition'=>$request->definition,
            'user_id'=>auth()->id(),
            'folder_id'=>$request->folder_id,
            'image'=>$image
            
        ]);
        return to_route('dashboard');
    }

    /**
     * Display the specified resource.
     * 
     */
    public function Favorite(Request $request)
    {    
        $card=Card::find($request->id);
        if($card->favorite){
            $card->favorite=false;
        }
        else{
            $card->favorite=true;
        }
        $card->update();    
        //if($id->url)
        
        if($request->page=='dashboard'){
            return to_route('dashboard');
        }
        else if($request->page=='cards'){
            $folder_id=$request->folder_id;
            return to_route('folders.show', $folder_id);
        }
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {

        return view('app/cards/edit', compact('card'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Card $card)
    {

        
        $request->validate([
            'word'=>'required','string', 'max:255',
            'translation'=>'required', 'max:255',
            'definition' => 'required','max:255'
        ]);

        $image=$card->image;
        if($request->hasFile('image')){
            Storage::delete($card->image);
            $image=$request->file('image')->store('public/cards');
        }

       /* $card->update([
            "word"=>$request->word,
            'translation'=>$request->translation,
            'definition'=> $request->definition,
            'image'=>$image,
            'folder_id'=>$request->id_folder,
        ]);*/
        $card->word=$request->word;
        $card->translation=$request->translation;
        $card->definition=$request->definition;
        $card->image=$image;
        $card->save();
        
        return to_route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        Storage::delete($card->image);
        $card->delete();
        
        return to_route('dashboard');
    }

    public static function increaseProcent(Card $card){
        if ($card->level!=4){
            //dd($card->level);
            $card->level=$card->level+1;
            //dd($card->level);
            $card->save();
        }
    }
}
