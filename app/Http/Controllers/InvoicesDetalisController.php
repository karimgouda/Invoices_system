<?php

namespace App\Http\Controllers;

use App\Models\Invoice_attachments;
use App\Models\invoices;
use App\Models\Invoices_detalis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoicesDetalisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices_detalis  $invoices_detalis
     * @return \Illuminate\Http\Response
     */
    public function show(Invoices_detalis $invoices_detalis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices_detalis  $invoices_detalis
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoices_detalis $invoices_detalis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices_detalis  $invoices_detalis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoices_detalis $invoices_detalis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices_detalis  $invoices_detalis
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $invoices = Invoice_attachments::findOrFail($id);
        Storage::delete($invoices->file_name);
        $invoices->delete();
        session()->flash('delete','تم حذف المرفق بنجاح');
        return back();
    }

    public function getSection($id){

        $invoices = invoices::where('id',$id)->first();
        $details  = Invoices_detalis::where('id_Invoice',$id)->get();
        $attachments  = Invoice_attachments::where('invoice_id',$id)->get();
        return view('invoices.invoicesDetalis',['invoices'=>$invoices,'details'=>$details,'attachments'=>$attachments]);
    }

    public function download($invoice_number,$file_name){
      return response()->download(public_path('Attachments/'."$invoice_number/".$file_name));
 
    }


}
