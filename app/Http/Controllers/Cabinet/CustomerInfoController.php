<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cabinet\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerInfoController extends Controller
{

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $customer = User::query()->findOrFail(Auth::id());
        return view('cabinet.customer-info.show')->with(compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(User $customer)
    {
        return view('cabinet.customer-info.edit')->with(compact('customer'));
    }

    /**
     * /**
     * @param UserUpdateRequest $request
     * @param User $customer
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, User $customer)
    {
        $customer->update($request->all());

       return redirect()->route('cabinet.customer-info.show')
            ->with('success', 'Post updated successfully.');
    }
}
