<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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
        $items = Customer::whereIn(
            'uid',
            is_array($request->uids) ? $request->uids : explode(',', $request->uids)
        );

        foreach ($items->get() as $item) {
            // authorize

            $item->disable();
        }

        // Redirect to my lists page
        return back()->with([
            'type' => 'success',
            'message' => trans('messages.customers.disabled')
        ]);
    }

    public function view(Request $request, $id)
    {
        $customer = Customer::findByUid($id);

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

        return view('admin.user.users-details', [
            'customer' => $customer,
        ]);
    }
}
