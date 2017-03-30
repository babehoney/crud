<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
class FileController extends Controller {
    
    public function index(Request $request){
        $products = Product::orderBy('id','DESC')->paginate(5);
        return view('files.index',compact('products'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function create(){
        return view('files.create');
    }
    public function store(Request $request) {
        
        $this->validate($request, [
            'name' => 'required',
            'details' => 'required',
            'product_image' => 'required|mimes:zip,rar',

        ]);
        $product = new Product($request->input()) ;
     
         if($file = $request->hasFile('product_image')) {
            
            $file = $request->file('product_image') ;
            
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/scorm/' ;
            $file->move($destinationPath,$fileName);
            $product->product_image = $fileName ;
        }
        $product->save() ;
         return redirect()->route('upload-files.index')
                        ->with('success','You have successfully uploaded your files');
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product= Product::find($id);
        return view('files.show',compact('product'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product= Product::find($id);
        return view('files.edit',compact('product'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'details' => 'required',
        ]);
        Product::find($id)->update($request->all());
        return redirect()->route('upload-files.index')
                        ->with('success','Product updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('upload-files.index')
                        ->with('success','Product deleted successfully');
    }
    
}