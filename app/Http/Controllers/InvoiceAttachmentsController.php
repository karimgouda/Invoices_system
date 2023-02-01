<?php

namespace App\Http\Controllers;

use App\Models\Invoice_attachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceAttachmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'file_name'=>'mimes:pdf'
        ],[
            'file_name.mimes'=>'صيغه المرفق يجب ان تكون pdf'
        ]);

        $file = $request->file('file_name');
        $file_name = $file->getClientOriginalName();

         $attachment = new Invoice_attachments();
         $attachment->file_name = $file_name;
         $attachment->invoice_number = $request->invoice_number;
         $attachment->invoice_id = $request->invoice_id;
         $attachment->created_by = Auth::user()->name;
        $attachment->save();



         $file_title = $request->file_name->getClientOriginalName();
         $request->file_name->move(public_path('Attachments/'.$request->invoice_number),$file_title);
         session()->flash('add','تم اضافه المرفق بنجاح');
         return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice_attachments  $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice_attachments $invoice_attachments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice_attachments  $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice_attachments $invoice_attachments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice_attachments  $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice_attachments $invoice_attachments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice_attachments  $invoice_attachments
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice_attachments $invoice_attachments)
    {
        //
    }
}
