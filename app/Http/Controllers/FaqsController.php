<?php

    namespace App\Http\Controllers;
        
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use App\Faqs;
    use Illuminate\Support\Facades\File;
    use App\Http\Requests\FaqsStoreRequest;
    use App\Http\Requests\FaqsUpdateRequest;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\URL;
       
        
    class FaqsController extends Controller
    {
        
            public function index()
            {
                $faqs = Faqs::latest();
                
                if (request()->ajax()) {
                    return datatables()->of($faqs)
                        ->addIndexColumn()
                        ->addColumn('action', function($faqs){
                            return view('admin.faqs.action', compact('faqs'));
                         })
                        ->rawColumns(["action"])
                        ->make(true);
                }
              
                return view("admin.faqs.index");
            }
        
            /**
             * Show the form for creating a new resource.
             *
             * @return \Illuminate\Http\Response
             */
            public function create()
            {
                 return view("admin.faqs.create");
            }
        
            /**
             * Store a newly created resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @return \Illuminate\Http\Response
             */
            public function store(FaqsStoreRequest $request)
            {
                 $input = $request->all();
                $validated = $request->validated();
                if($validated){  
                                   
                    Faqs::create($input);
                    toastr()->success('Data has been saved successfully!');
                    return redirect()->route('faqs.index')->with('success','Post created successfully.');
                }
             
               
            }
        
            /**
             * Display the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function show($id)
            {
                //
            }
        
            /**
             * Show the form for editing the specified resource.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function edit(Faqs $faqs)
            {
                 return view("admin.faqs.edit", compact('faqs'));
            }
        
            /**
             * Update the specified resource in storage.
             *
             * @param  \Illuminate\Http\Request  $request
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function update(FaqsUpdateRequest $request, Faqs $faqs)
            {
                $faqs->update($request->all());
                toastr()->info('Data has been update successfully!');
                return redirect()->route('faqs.index')->with('success','Post update successfully.');
            }
        
            /**
             * Remove the specified resource from storage.
             *
             * @param  int  $id
             * @return \Illuminate\Http\Response
             */
            public function destroy($id)
            {
               try {
                Faqs::destroy($id);
                return $this->successResponse("Success Deleted Data");
                } catch (\Throwable $th) {
                    return $this->errorResponse("Error Deleted Data" . $th, 400);
                }
            }

             

        }


