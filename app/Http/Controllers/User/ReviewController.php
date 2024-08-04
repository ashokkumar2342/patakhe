<?php
namespace App\Http\Controllers\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Hash;
use Auth;
use App\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review = Review::orderBy('id','desc')->paginate(5);
         $user = Auth::guard('user')->user();
        return view('user.profile.review',compact('review'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[            
            'comments' => 'required|max:200'
        ]);
        $review = Review::create([
            'comments' => $request['comments'],
            'user_id' => Auth::guard('user')->user()->id, 
        ]);         
        return redirect()->back()->with(['message'=>'Comments Post   successfully ! .','class'=>'success']);       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
         
       $user = Auth::guard('user')->user();
        return view('user.profile.reviewedit',compact('review'));
         


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
       $user = Auth::guard('user')->user();
        
        $review->comments = $request->comments;       
        
        if($review->save()){
            return redirect()->route('user.review.post')->with(['message'=>'Post Updated Successfully','class'=>'sucess']);
        }
          
          
         


         
         
            
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        $review->delete();
         
         return redirect()->back()->with(['message'=>'Comments Delete   successfully ! .','class'=>'success']);
    }
}
