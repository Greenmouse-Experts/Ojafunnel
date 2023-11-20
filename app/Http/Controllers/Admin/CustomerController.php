<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function enable(Request $request)
    {
        $items = Customer::whereIn(
            'uid',
            is_array($request->uids) ? $request->uids : explode(',', $request->uids)
        );

        foreach ($items->get() as $item) {
            // authorize
            // if (\Gate::allows('update', $item)) {
            //     $item->enable();
            // }
            $item->enable();
        }

        $customer = Customer::where('uid', $request->uids)->first();

        // $user = User::where('customer_id', $customer->id)->first();
        $user = User::where('id', $request->uids)->first();

        $user->update([
            'status' => 'active'
        ]);

        return back()->with([
            'type' => 'success',
            'message' => "Customer was successfully activated"
        ]);
        // Redirect to my lists page
        //echo trans('messages.customers.enabled');
    }

    /**
     * Disable item.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function disable(Request $request)
    {
        /* $items = Customer::whereIn(
            'uid',
            is_array($request->uids) ? $request->uids : explode(',', $request->uids)
        );

        foreach ($items->get() as $item) {
            // authorize

            $item->disable();
        } */

        // $customer = Customer::where('uid', $request->uids)->first();

        $user = User::where('id', $request->uids)->first();

        $user->update([
            'status' => 'inactive'
        ]);

        // Redirect to my lists page
        return back()->with([
            'type' => 'success',
            'message' => trans('messages.customers.disabled')
        ]);
    }

    public function view(Request $request, $id)
    {
        $customer = User::where('id', $id)->first();
        // return $customer;

        //dd($customer);
        event(new \App\Events\UserUpdated($customer));

        // authorize
        // if (\Gate::denies('update', $customer)) {
        //     return $this->notAuthorized();
        // }

        if (!empty($request->old())) {
            $customer->fill($request->old());
            // User info
            $customer->user->fill($request->old());
        }

        return view('Admin.user.users-details', [
            'customer' => $customer,
        ]);
    }
}
