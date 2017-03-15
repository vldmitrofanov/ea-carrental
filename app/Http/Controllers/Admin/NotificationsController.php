<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EmailNotificationTemplate as EmailNotification;
use App\Http\Requests\EmailNotificationRequest;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oEmails = EmailNotification::paginate(15);
        return view('admin.notifications.index', compact('oEmails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $oEmailNotification = EmailNotification::where('id', $id)->firstOrFail();
        return view('admin.notifications.edit', compact('oEmailNotification'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailNotificationRequest $request, $id)
    {
        $oEmailNotification = EmailNotification::findOrFail($id);
        $oEmailNotification->name = $request->input('name');
        $oEmailNotification->email_body = $request->input('email_body');
        $oEmailNotification->save();

        \Session::flash('flash_message', 'Email Notification template saved successfully.');
        \Session::flash('flash_type', 'alert-success');

        return \Redirect::to('admin/notifications');
    }
}
